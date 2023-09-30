<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TransferRequest;
use App\Http\Requests\UpdatePasswordRequest;

class PageController extends Controller
{
    public function home()
    {
        $user = auth()->guard('web')->user();
        return view('frontend.home' ,['user' => $user]);
    }
    public function profile()
    {
        return view('frontend.profile');
    }
    public function updatePassword()
    {
        return view('frontend.update_password');
    }
    public function updatePasswordStore(UpdatePasswordRequest $request)
    {
        $attributes = $request->validated();
        $user = Auth::guard('web')->user();
        if (Hash::check($attributes['old_password'], $user->password)) {
            $user->password = bcrypt($attributes['new_password']);
            $user->update();
            return redirect()->route('profile')->with('success' , 'Successfully Updated Password');
        }
        return back()->withErrors(['old_password' => 'Old password is incorrect'])->withInput();
    }
    public function wallet()
    {
        $user = auth()->guard('web')->user();
        return view('frontend.wallet',['user' => $user]);
    }
    public function transfer()
    {
        $user = auth()->guard('web')->user();
        return view('frontend.transfer',['user' => $user]);
    }
    public function transferConfirm(TransferRequest $request)
    {
        $check_phone = User::where('phone' , $request->phone)->first();
        if(!$check_phone){
            return back()->withErrors(['phone' => 'The account is invalid'])->withInput();
        }
        if($request->amount < 1000){
            return back()->withErrors(['amount' => 'The amount must be minimum 1000 MMK'])->withInput();
        }
        $attributes = $request->validated();
        $user = auth()->guard('web')->user();
        return view('frontend.transfer_confirm',[
            'user' => $user,
            'attributes' => $attributes
        ]);
    }
    public function toAccountVerify(Request $request)
    {
        $userAuth = auth()->guard('web')->user();
        if($userAuth->phone != $request->phone){
            $user = User::where('phone',$request->phone)->first();
            if($user){
                return response()->json([
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $user
                ]);
            }
        }
        return response()->json([
            'status' => 'fail','message' => 'Invalid data',
        ]);
    }
}
