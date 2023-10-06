<?php

namespace App\Http\Controllers\Api;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Helpers\UUIDGenerate;
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
            $user->ip = $request->ip();
            $user->user_agent = $request->server('HTTP_USER_AGENT');
            $user->login_at = date('Y-m-d H:i:s'); 
            Wallet::firstOrCreate([
                'user_id' => $user->id,
            ],
            [
                'account_number' => UUIDGenerate::accountNumber(),
                'amount' => 0,
            ]
            );
            $token = $user->createToken('Wallet Pay')->accessToken;
            return success('Successfully Login',['token' => $token]);
        }
        return fail('These credentials does not match our record',null);
    }
    public function logout()
    {
        $user = auth()->user();
        $user->token()->revoke();
        return success('Successfully logout',null);
    }
}
