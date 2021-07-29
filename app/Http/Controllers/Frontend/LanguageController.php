<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //
    public function Urdu(){
        session()->get('language');
        session()->forget('language');
        Session::put('language' , 'urdu');
        return redirect()->back();
    }

    public function English(){
        session()->get('language');
        session()->forget('language');
        Session::put('language' , 'english');
        return redirect()->back();
    }
}
