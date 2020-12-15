<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){
        $user=auth('web')->user();
        $all_subscriptions=Subscribe::where(['status'=>true,'user_id'=>$user->id])->orderByDesc('id')->paginate(PAGINATION);
        return view('subscribe.index',compact('all_subscriptions'));
    }


    public function show(){
        $user=auth('web')->user();
        $all_subscriptions=Subscribe::where(['status'=>false,'user_id'=>$user->id])->orderByDesc('id')->paginate(PAGINATION);
        return view('subscribe.show',compact('all_subscriptions'));
    }
    public function create(){
        $types=config('business.subscription-types');
        return view('subscribe.create',compact('types'));
    }


    public function store(Request $request){
        $this->makeValidate($request);

        $start=Carbon::createFromFormat('d/m/Y',$request->service_start);
        $end=Carbon::createFromFormat('d/m/Y',$request->service_end);
        if ($end->lessThan($start)){
            self::Fail();
           return redirect()->back()->withInput()->withErrors(['service_start'=>'backend.start_must_be_less_than_end']);
        }


        $subscription=Subscribe::create([
            'serviceName'=>$request->service_name,
            'serviceProvider'=>$request->service_provider,
            'serviceType'=>$request->service_type,
            'serviceCapacity'=>$request->service_capacity,
            'serviceCost'=>$request->service_cost,
            'startDate'=>$start->format('Y-m-d'),
            'endDate'=>$end->format('Y-m-d'),
            'user_id'=>auth('web')->id()
        ]);
        self::Success();
        return redirect()->route('Subscribe.index');
    }

    public function edit($id){
        $subscribe=Subscribe::find($id);
        if (!$subscribe){
            self::NotFound();
            return redirect()->route('Subscribe.index');
        }

        if ($subscribe->user_id === auth('web')->id()){
            $types=config('business.subscription-types');
            return view('subscribe.edit',compact('types'))->with('subscribe',$subscribe);
        }else{
            self::NotAuthorized();
            return redirect()->route('Subscribe.index');
        }




    }

    public function update(Request $request,$id){
        $subscribe=Subscribe::find($id);
        if (!$subscribe){
            self::NotFound();
            return redirect()->route('Subscribe.index');
        }

        if ($subscribe->user_id !== auth('web')->id()){
            self::NotAuthorized();
            return redirect()->route('Subscribe.index');
        }

        $this->makeValidate($request);

        $start=Carbon::createFromFormat('d/m/Y',$request->service_start);
        $end=Carbon::createFromFormat('d/m/Y',$request->service_end);
        if ($end->lessThan($start)){
            self::Fail();
            return redirect()->back()->withInput()->withErrors(['service_start'=>'backend.start_must_be_less_than_end']);
        }


        $validatedData=[
            'serviceName'=>$request->service_name,
            'serviceProvider'=>$request->service_provider,
            'serviceType'=>$request->service_type,
            'serviceCapacity'=>$request->service_capacity,
            'serviceCost'=>$request->service_cost,
            'startDate'=>$start->format('Y-m-d'),
            'endDate'=>$end->format('Y-m-d'),
            'user_id'=>auth('web')->id()
        ];

        if ($subscribe->update($validatedData)){
            self::Success();
        }else{
            self::Fail();
        }
        return redirect()->route('Subscribe.index');
    }
    public function destroy($id){
        $subscribe=Subscribe::find($id);
        if (!$subscribe){
            self::NotFound();
            return redirect()->route('Subscribe.index');
        }

        if ($subscribe->user_id !== auth('web')->id()){
            self::NotAuthorized();
            return redirect()->route('Subscribe.index');
        }

        $subscribe->delete();
        self::Success();
        return redirect()->route('Subscribe.index');
    }


    private function makeValidate(Request $request){
        $types=array_column(config('business.subscription-types'),'name');
        $request->validate([
            'service_name'=>'required|string|max:191',
            'service_provider'=>'required|string|max:191|nullable',
            'service_type'=>['required','string','max:191'.Rule::in($types)],
            'service_capacity'=>'required|numeric|nullable',
            'service_cost'=>'required|numeric|nullable',
            'service_start'=>'required|date_format:d/m/Y',
            'service_end'=>'required|date_format:d/m/Y'
        ]);
    }

}
