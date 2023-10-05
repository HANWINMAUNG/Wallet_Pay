<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone' =>'required',
            'password' => 'required|min:8|max:20'
        ]);
        if(Auth::attempt(['phone' => $request->phone,'password' => $request->password])){
            $user = auth()->user();
            $token = $user->createToken('Wallet Pay')->accessToken;
            return success('Successfully Login',['token' => $token]);
        }
        return fail('These credentials does not match our record',null);
    }
}
