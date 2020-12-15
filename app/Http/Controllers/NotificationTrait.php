<?php
namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
trait NotificationTrait{

    // used you tried to access any element not found in database
    public static function NotFound($title='backend.attention',$message='backend.not_found'){
        Alert::error(__($title),__($message));
    }

    // if you tried to perform any operation and done successfully
    public static function Success($title='backend.success',$message='backend.successful_operation'){
        Alert::success(__($title),__($message));
    }

    // if you tried to perform any operation and failed
    public static function Fail($title='backend.fail',$message='backend.failed_operation'){
        Alert::error(__($title),__($message));
    }

    // if you tried to Access Some Content Or Do Some Operation You Dont Allowed To Access
    public static function NotAuthorized($title='backend.sorry',$message='backend.not_allowed_to_you_to_access_this_content'){
        Alert::error(__($title),__($message));
    }
}
