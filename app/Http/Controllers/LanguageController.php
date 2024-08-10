<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function languageSwitch(Request $request)
    {
        $language = $request->input('language');
        // dd($language);
        // Session::forget('language');
        Session::put('language',$language);
        
        Log::info(Session::get('language'));
        return redirect()->back()->with(['language'=>$language]);
    }
}
