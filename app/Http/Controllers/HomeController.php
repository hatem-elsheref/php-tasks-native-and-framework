<?php

namespace App\Http\Controllers;
use App\ApplicationForm;
use App\Country;
use App\Jobs\SendingEmail;
use App\Mission;
use App\MissionApplication;
use App\Studies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;


class HomeController extends Controller
{

    const MISSION='mission';
    const MENAH='menah';
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin:admin');
    }

    public function index(){
        $studies=Studies::count();
        $missions=Mission::count();
        $menahCount=ApplicationForm::count();
        $missionsCount=MissionApplication::count();
        return view('index',['missions'=>$missions,'studies'=>$studies,'menahCount'=>$menahCount,'missionsCount'=>$missionsCount]);
    }

    public function menah(){

        $Applications=ApplicationForm::with(['user','study'])->get();

//        $approvedApplications=ApplicationForm::with(['user','study'])
//            ->where('status','approved')->paginate(PAGINATION);
//
//        $canceledApplications=ApplicationForm::with(['user','study'])
//            ->where('status','canceled')->paginate(PAGINATION);


//        return view('home')->with('approved',$approvedApplications)->with('canceled',$canceledApplications)->with('pending',$pendingApplications);
        return view('home_menah')->with('applications',$Applications);


    }
    public function mission(){
        $applications=MissionApplication::with(['user','mission','mission.study'])->get();
        return view('home_mission')->with('applications',$applications);
    }

    public function destroy($id,$type){

        if ($type === self::MISSION){
            $application=MissionApplication::findOrFail($id);
        }elseif ($type === self::MENAH){
            $application=ApplicationForm::findOrFail($id);
        }

        File::delete(public_path($application->id_card));
        File::delete(public_path($application->birthdate_certificate));
        File::delete(public_path($application->school_certificate));
        $application->delete();
        self::Success();
        return redirect()->route('home');
    }


    public function accept($id,$type){
        if ($type === self::MISSION){
            $application=MissionApplication::findOrFail($id);
        }elseif ($type === self::MENAH){
            $application=ApplicationForm::findOrFail($id);
        }

        $application->status='approved';
        $application->save();

        SendingEmail::dispatch($application);

        self::Success();
        return redirect()->route('home');
    }


    public function refuse($id,$type){
        if ($type === self::MISSION){
            $application=MissionApplication::findOrFail($id);
        }elseif ($type === self::MENAH){
            $application=ApplicationForm::findOrFail($id);
        }

        $application->status='canceled';
        $application->save();
        self::Success();
        return redirect()->route('home');
    }


    public function showAllMissions(){
        $missions=Mission::with('country','study')->get();
        return view('missions.index',compact('missions'));
    }
    public function createMission(){
        $countries=Country::all();
        $studies=Studies::all();
        return view('missions.create',compact('countries'))->with('studies',$studies);
    }
    public function editMission($id){
        $mission=Mission::findOrFail($id);
        $countries=Country::all();
        $studies=Studies::all();
        return view('missions.edit',compact('countries'))->with('studies',$studies)->with('mission',$mission);
    }
    public function storeMission(Request $request){

        $request->validate([
            'country'   =>['required',Rule::exists('countries','id')],
            'university'=>['required','string','max:191'],
            'studies'   =>['required',Rule::exists('studies','id')],
            'manual'    =>['required','mimes:pdf'],
            'endDate'   =>['required','date_format:Y-m-d'],
            'number'   =>['required','numeric'],
            'degree'   =>['required','string','max:191']
        ]);

        $validatedData=['study_id'=>$request->studies,'source'=>$request->university,'country_id'=>$request->country,'vacanciesNumber'=>$request->number,'degree'=>$request->degree];
        $validatedData['endDate']=date_format(date_create($request->graduation_date),'Y-m-d');

        if ($request->hasFile('manual') && !empty($request->file('manual'))){
            $name=time().'-'.rand(0,5000).'.pdf';
            $validatedData['manual']='uploads/manuals/'.$name;
            $request->file('manual')->move(public_path('uploads/manuals'),$name);
        }
        $mission=Mission::create($validatedData);
        if ($mission){
            self::Success();
        }else{
            self::Fail();
        }
        return redirect()->route('mission.index');
    }
    public function updateMission(Request $request,$id){
        $mission=Mission::findOrFail($id);
        $request->validate([
            'country'   =>['required',Rule::exists('countries','id')],
            'university'=>['required','string','max:191'],
            'studies'   =>['required',Rule::exists('studies','id')],
            'manual'    =>['mimes:pdf'],
            'endDate'   =>['required','date_format:Y-m-d'],
            'number'   =>['required','numeric'],
            'degree'   =>['required','string','max:191']
        ]);

        $validatedData=['study_id'=>$request->studies,'source'=>$request->university,'country_id'=>$request->country,'vacanciesNumber'=>$request->number,'degree'=>$request->degree];
        $validatedData['endDate']=date_format(date_create($request->graduation_date),'Y-m-d');

        if ($request->hasFile('manual') && !empty($request->file('manual'))){
            $name=time().'-'.rand(0,5000).'.pdf';
            $validatedData['manual']='uploads/manuals/'.$name;
            File::delete(public_path($mission->manual));
            $request->file('manual')->move(public_path('uploads/manuals'),$name);
        }else{
            $validatedData['manual']=$mission->manual;
        }
        if ($mission->update($validatedData)){
            self::Success();
        }else{
            self::Fail();
        }
        return redirect()->route('mission.index');
    }

    public function destroyMission($id){
        $mission=Mission::findOrFail($id);
        File::delete(public_path($mission->manual));
        $mission->delete();
        self::Success();
        return redirect()->route('mission.index');
    }

}
