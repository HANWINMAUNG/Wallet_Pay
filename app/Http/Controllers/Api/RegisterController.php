<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(UserRequest $request)
    {
        // $user =  User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'password' => Hash::make($request->password),
        //     'ip' => $request->ip(),
        //     'user_agent' => $request->server('HTTP_USER_AGENT'),
        //     'login_at' => date('Y-m-d H:i:s'), 
        // ]);
        $user =  new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->ip = $request->ip();
            $user->user_agent = $request->server('HTTP_USER_AGENT');
            $user->login_at = date('Y-m-d H:i:s'); 
            $user->save();
        $token = $user->createToken('Wallet Pay')->accessToken;
        return success('Successfully registered',['token' => $token]);
    }
}
