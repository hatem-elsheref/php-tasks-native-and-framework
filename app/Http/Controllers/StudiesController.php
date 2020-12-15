<?php

namespace App\Http\Controllers;

use App\ApplicationForm;
use App\Mission;
use App\MissionApplication;
use App\Rules\ValidEmail;
use App\Studies;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin:student');
    }

    public function index(){
        $universities=config('menah.universities');
        $departments=config('menah.primary_school_departments');
        $application=ApplicationForm::with(['user','study'])->where('user_id',auth()->id())->first();
        $data=['application'=>$application,'universities'=>$universities,'departments'=>$departments];
        return view('studies.scholarship.index',$data);
    }

    private function prepareData(){
        $studies=Studies::all();
        $departments=config('menah.primary_school_departments');
        $universities=config('menah.universities');
        return ['studies'=>$studies,'departments'=>$departments,'universities'=>$universities];
}

    public function create(){

        return view('studies.scholarship.create',$this->prepareData());
    }

    public function store(Request $request){

        $universities=collect(config('menah.universities'))->pluck('name')->toArray();
        $departments=config('menah.primary_school_departments');


        $request->validate([
            'studentName'       =>['required', 'string', 'max:255'],
            'studentEmail'      =>['required', 'string', 'email', 'max:255',new ValidEmail()],
            'studentPhone'      =>['required', PHONE_PATTERN, 'digits:'.PHONE_DIGITS],
            'studentCity'       =>['required', 'string', 'max:255'],
            'faculty'           =>['required', 'string', 'max:255'],
            'university'        =>['required',Rule::in($universities)],
            'studies'           =>['required',Rule::exists('studies','id')],
            'department'        =>['required',Rule::in($departments)],
            'graduation_date'   =>['required'],
            'id_card'           =>['required','mimes:pdf,png,jpg,jpeg','max:'.AVATAR_MAX_SIZE],
            'school_certificate'=>['required','mimes:pdf,png,jpg,jpeg','max:'.AVATAR_MAX_SIZE],
            'birthdate_certificate'=>['required','mimes:pdf,png,jpg,jpeg','max:'.AVATAR_MAX_SIZE]
        ]);

        $forms=ApplicationForm::where('user_id',auth()->id())->count();
        if ($forms > 0){
            self::Fail('backend.fail','لا يمكن طلب منح مره اخرى ');
            return redirect()->route('studies.index');
        }
        $validatedData=[
            'status'=>'pending','department'=>$request->department,'study_id'=>$request->studies,
            'user_id'=>auth()->id(),'university'=>$request->university,'faculty'=>$request->faculty];
        $validatedData['graduation']=date_format(date_create($request->graduation_date),'Y');
        $validatedData=$this->uploadAndSave($request,$validatedData);


        $form=ApplicationForm::create($validatedData);
        ($form)?self::Success():self::Fail();
            return redirect()->route('studies.index');
    }


    public function showAllMyMissions(){
        $departments=config('menah.primary_school_departments');
        $application=MissionApplication::with(['user','mission','mission.study'])->where('user_id',auth()->id())->first();
        $data=['application'=>$application,'departments'=>$departments];
        return view('studies.mission.index',$data);
    }
    public function createMission(){
        $missions=Mission::with('study','country')->get();
        return view('studies.mission.create',$this->prepareData())->with('missions',$missions);
    }
    public function storeMission(Request $request){
        $departments=config('menah.primary_school_departments');
        $request->validate([
            'studentName'       =>['required', 'string', 'max:255'],
            'studentEmail'      =>['required', 'string', 'email', 'max:255',new ValidEmail()],
            'studentPhone'      =>['required', PHONE_PATTERN, 'digits:'.PHONE_DIGITS],
            'studentCity'       =>['required', 'string', 'max:255'],
            'mission'           =>['required',Rule::exists('missions','id')],
            'department'        =>['required',Rule::in($departments)],
            'graduation_date'   =>['required'],
            'id_card'           =>['required','mimes:pdf,png,jpg,jpeg','max:'.AVATAR_MAX_SIZE],
            'school_certificate'=>['required','mimes:pdf,png,jpg,jpeg','max:'.AVATAR_MAX_SIZE],
            'birthdate_certificate'=>['required','mimes:pdf,png,jpg,jpeg','max:'.AVATAR_MAX_SIZE]
        ]);

        $forms=MissionApplication::where('user_id',auth()->id())->count();
        if ($forms > 0){
            self::Fail('backend.fail','لا يمكن طلب منح مره اخرى ');
            return redirect()->route('StudyMission.index');
        }

        $validatedData=['status'=>'pending','department'=>$request->department,'user_id'=>auth()->id(),'mission_id'=>$request->mission];
        $validatedData['graduation']=date_format(date_create($request->graduation_date),'Y');
        $validatedData=$this->uploadAndSave($request,$validatedData);




        $form=MissionApplication::create($validatedData);
        ($form)?self::Success():self::Fail();
        return redirect()->route('StudyMission.index');
    }

    private function uploadAndSave($request,$validatedData){
        $validatedData['studentEmail']  =$request->studentEmail;
        $validatedData['studentName']   =$request->studentName;
        $validatedData['studentCity']   =$request->studentCity;
        $validatedData['studentPhone']  =$request->studentPhone;

        if ($request->hasFile('id_card') && !empty($request->file('id_card'))){
            $name=time().'-'.rand(0,5000).'-id-card.'.$request->file('id_card')->getClientOriginalExtension();
            $validatedData['id_card']='uploads/id_cards/'.$name;
            $request->file('id_card')->move(public_path('uploads/id_cards'),$name);
        }

        if ($request->hasFile('school_certificate') && !empty($request->file('school_certificate'))){
            $name=time().'-'.rand(0,5000).'-school-certificate.'.$request->file('school_certificate')->getClientOriginalExtension();
            $validatedData['school_certificate']='uploads/school_certificates/'.$name;
            $request->file('school_certificate')->move(public_path('uploads/school_certificates'),$name);
        }

        if ($request->hasFile('birthdate_certificate') && !empty($request->file('birthdate_certificate'))){
            $name=time().'-'.rand(0,5000).'-birthdate-certificate.'.$request->file('birthdate_certificate')->getClientOriginalExtension();
            $validatedData['birthdate_certificate']='uploads/birthdate_certificates/'.$name;
            $request->file('birthdate_certificate')->move(public_path('uploads/birthdate_certificates'),$name);
        }

        return $validatedData;
    }
}
