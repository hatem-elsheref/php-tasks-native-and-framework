<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:web','AdminOnly']);
    }

    public function index(){
        return view('setting.settings-overview');
    }
}
