<?php

namespace App\Http\Controllers;

use App\Mission;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('pages.index');
    }
    public function available(){
        $missions=Mission::with('country','study')->get();
        return view('pages.available',compact('missions'));
    }
    public function guide(){
        return view('pages.guide');
    }

    public function faq(){
        return view('pages.faq');
    }
    public function advice(){
        return view('pages.advice');
    }
    public function contact(){
        return view('pages.contact');
    }
}
