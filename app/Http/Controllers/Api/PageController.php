<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\TransactionDetailResource;
use App\Http\Resources\NotificationDetailResource;

class PageController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $data = new ProfileResource($user);
       return success('success',$data);
    }
    public function transaction(Request $request)
    {
        $userAuth = auth()->user();
        $transactions = Transaction::with('User','Source')->orderBy('created_at' , 'DESC')->where('user_id',$userAuth->id);
        if($request->type){
            $transactions = $transactions->where('type', $request->type);
        }
        if($request->date){
            $transactions = $transactions->whereDate('created_at', $request->date);
        }
        $transactions = $transactions->paginate(5);
        $data = TransactionResource::collection($transactions)->additional(['result' => 1,'message' => 'Success']);
        return $data;
    }
    public function  transactionDetail($trx_no)
    {
        $userAuth = auth()->user();
        $transaction = Transaction::with('User','Source')->where('user_id' , $userAuth->id)->where('trx_no',$trx_no)->firstOrFail();
        $data = new TransactionDetailResource($transaction);
        return success('Success',$data);
    }
    public function notification()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(5);
        $data = NotificationResource::collection($notifications)->additional(['result' => 1,'message' => 'Success']);
        return $data;
    }
    public function notificationDetail($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id',$id)->firstOrFail();
        $notification->markAsRead();
        $data = new NotificationDetailResource($notification);
        return success('Success',$data);
    }
    public function toAccountVerify(Request $request)
    {
        if($request->phone){
            $userAuth = auth()->user();
            if($userAuth->phone != $request->phone){
                $user = User::where('phone',$request->phone)->first();
                if($user){
                    return success('Success',['phone' => $user->phone,'name' => $user->name ]);
                }
            }
        }
        return fail('Invalid data',null);
    }
    public function transferConfirm(Request $request)
    {
        $hash_value = $request->hash_value;
        $userAuth = auth()->user();
        $str = $request->phone.$request->amount.$request->description;
        $hash_value2 = hash_hmac('sha256',$str,'walletpay123!@#');
        if($hash_value !== $hash_value2){
            return fail('The given data is hash',null);
        }
        $to_user = User::where('phone' , $request->phone)->first();
        if(!$to_user){
            return fail('The account is invalid',null);
        }
        if($userAuth->phone == $request->phone){
            return fail('The account is invalid',null);
        }
        if($request->amount < 1000){
            return fail('The amount must be minimum 1000 MMK',null);
        }
        if(!$userAuth->Wallet || !$to_user->Wallet){
            return fail('Something wrong .The given data is invalid',null);
        }
        if($userAuth->Wallet->amount < $request->amount){
            return fail('The amount is not enough',null);
        }
        return success('Success',[
            'from_account_name' => $userAuth->name,
            'from_account_phone' => $userAuth->phone,

            'to_account_name' => $to_user->name,
            'to_account_phone' => $to_user->phone,
            'amount' => $request->amount,
            'description' => $request->description,
            'hash_value' => $request->hash_value,
        ]);
    }
}
