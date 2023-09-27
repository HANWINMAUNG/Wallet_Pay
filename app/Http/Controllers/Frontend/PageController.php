<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }
    public function profile()
    {
        return view('frontend.profile');
    }
    public function updatePassword()
    {
        return view('frontend.update_password');
    }
}
