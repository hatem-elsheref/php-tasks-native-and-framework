<?php

namespace App\Http\Controllers;
use App\Models\Subscribe;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){
        $user=auth('web')->user();

        $all_subscriptions=Subscribe::where('status', true)
            ->where('user_id', $user->id)
            ->select(\DB::raw('count(*) as total'),'serviceType')
            ->groupBy('serviceType')
            ->get()->pluck('total','serviceType')->toArray();


        $theServicesThatWillBeNotifiedSoon=Subscribe::where('status', true)
            ->where('user_id', $user->id)
            ->whereYear('endDate',Carbon::now()->year)
            ->whereMonth('endDate',Carbon::now()->month)
            ->whereDay('endDate','<=',Carbon::now()->addDays(7))
            ->get();


        return view('home.index',compact('all_subscriptions'))->with('theHotServices',$theServicesThatWillBeNotifiedSoon);
    }


    public function markAllAsRead(){
        $user=auth('web')->user();
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->route('dashboard');
    }

    public function markAsRead($notification){
        $user=auth('web')->user();
        $no=$user->unreadNotifications()->find($notification);
        if ($no){
            $no->markAsRead();
        }
        return redirect()->route('dashboard');
    }
}
