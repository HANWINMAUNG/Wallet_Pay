<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\UUIDGenerate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TransferRequest;
use App\Http\Resources\ProfileResource;
use App\Notifications\GeneralNotification;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\Notification;
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
    public function transferComplete(TransferRequest $request)
    {
        if(!$request->password){
            return fail('Please fill your password!',null);
        }
        $userAuth = auth()->user();
        if (!Hash::check($request->password,$userAuth->password)) {
            return fail('The password is correct!',null);
        }
        $str = $request->phone.$request->amount.$request->description;
        $hash_value2 = hash_hmac('sha256',$str,'walletpay123!@#');
        if($request->hash_value !== $hash_value2){
            return fail('The given data is invalid',null);
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
        if($userAuth->Wallet->amount < $request->amount){
            return fail('The amount is not enough',null);
        }
        $attributes = $request->validated();
        $amount = $attributes['amount'];
        $description = $attributes['description'];
        if(!$userAuth->Wallet || !$to_user->Wallet){
            return fail('Something wrong .The given data is invalid',null);
        }
        DB::beginTransaction();
        try {
            $from_account_wallet = $userAuth->Wallet;
            $from_account_wallet->decrement('amount', $amount);
            $from_account_wallet->update();

            $to_account_wallet = $to_user->Wallet;
            $to_account_wallet->increment('amount', $amount);
            $to_account_wallet->update();

            $ref_no = UUIDGenerate::refNumber();
            $from_account_transaction = new Transaction();
            $from_account_transaction->ref_no = $ref_no;
            $from_account_transaction->trx_no = UUIDGenerate::trxNumber();
            $from_account_transaction->user_id = $userAuth->id;
            $from_account_transaction->type = 2;
            $from_account_transaction->amount = $amount;
            $from_account_transaction->source_id = $to_user->id;
            $from_account_transaction->description = $description;
            $from_account_transaction->save();

            $to_account_transaction = new Transaction();
            $to_account_transaction->ref_no = $ref_no;
            $to_account_transaction->trx_no = UUIDGenerate::trxNumber();
            $to_account_transaction->user_id = $to_user->id;
            $to_account_transaction->type = 1;
            $to_account_transaction->amount = $amount;
            $to_account_transaction->source_id = $userAuth->id;
            $to_account_transaction->description = $description;
            $to_account_transaction->save();
            //from noti
            $title = 'E-money transfered';
            $message = 'Your e-money transfered'.number_format($amount).'MMK to'.$to_user->name.' ('.$to_user->phone.').';
            $sourceable_id = $from_account_transaction->id;
            $sourceable_type = Transaction::class;
            $web_link = route('transaction-detail' , $from_account_transaction->trx_no );
            $deep_link = [
                'target' => 'transaction-detail',
                'parameter' =>[
                    'trx_no' => $from_account_transaction->trx_no
                ]
            ];
            Notification::send([$userAuth], new GeneralNotification($title,$message,$sourceable_id,$sourceable_type,$web_link,$deep_link));
            //to noti
            $title = 'E-money received';
            $message = 'Your e-money received'.number_format($amount).'MMK from'.$userAuth->name.' ('.$userAuth->phone.').';
            $sourceable_id = $to_account_transaction->id;
            $sourceable_type = Transaction::class;
            $web_link = route('transaction-detail' , $to_account_transaction->trx_no );
            $deep_link = [
                'target' => 'transaction-detail',
                'parameter' =>[
                    'trx_no' => $to_account_transaction->trx_no
                ]
            ];
            Notification::send([$to_user], new GeneralNotification($title,$message,$sourceable_id,$sourceable_type,$web_link,$deep_link));
            DB::commit();
            return success('Successfully transfered',['trx_no' => $from_account_transaction->trx_no ]);
        } catch (\Exception $error) {
            DB::rollBack();
            return fail('Something wrong ' .$error->getMessage(),null);
        }
        
    }
    public function scanAndPayForm(Request $request)
    {
        $form_account = auth()->user();
        $to_account = User::where('phone', $request->phone)->first();
        if(!$to_account){
            fail('The QR code is invalid',null); 
        }
       return  success('Success',[
        'form_name' => $form_account->name,
        'form_phone' => $form_account->phone,
        'to_name' => $to_account->name,
        'to_phone' => $to_account->phone,
       ]);
    }
    public function scanAndPayConfirm(TransferRequest $request)
    {
        $hash_value = $request->hash_value;
        $userAuth = auth()->user();
        $str = $request->phone.$request->amount.$request->description;
        $hash_value2 = hash_hmac('sha256',$str,'walletpay123!@#');
        if($hash_value !== $hash_value2){
            return fail('The given data is invalid',null);
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
    public function scanAndPayComplete(TransferRequest $request)
    {
        if(!$request->password){
            return fail('Please fill your password!',null);
        }
        $userAuth = auth()->user();
        if (!Hash::check($request->password,$userAuth->password)) {
            return fail('The password is correct!',null);
        }
        $str = $request->phone.$request->amount.$request->description;
        $hash_value2 = hash_hmac('sha256',$str,'walletpay123!@#');
        if($request->hash_value !== $hash_value2){
            return fail('The given data is invalid',null);
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
        if($userAuth->Wallet->amount < $request->amount){
            return fail('The amount is not enough',null);
        }
        $attributes = $request->validated();
        $amount = $attributes['amount'];
        $description = $attributes['description'];
        if(!$userAuth->Wallet || !$to_user->Wallet){
            return fail('Something wrong .The given data is invalid',null);
        }
        DB::beginTransaction();
        try {
            $from_account_wallet = $userAuth->Wallet;
            $from_account_wallet->decrement('amount', $amount);
            $from_account_wallet->update();

            $to_account_wallet = $to_user->Wallet;
            $to_account_wallet->increment('amount', $amount);
            $to_account_wallet->update();

            $ref_no = UUIDGenerate::refNumber();
            $from_account_transaction = new Transaction();
            $from_account_transaction->ref_no = $ref_no;
            $from_account_transaction->trx_no = UUIDGenerate::trxNumber();
            $from_account_transaction->user_id = $userAuth->id;
            $from_account_transaction->type = 2;
            $from_account_transaction->amount = $amount;
            $from_account_transaction->source_id = $to_user->id;
            $from_account_transaction->description = $description;
            $from_account_transaction->save();

            $to_account_transaction = new Transaction();
            $to_account_transaction->ref_no = $ref_no;
            $to_account_transaction->trx_no = UUIDGenerate::trxNumber();
            $to_account_transaction->user_id = $to_user->id;
            $to_account_transaction->type = 1;
            $to_account_transaction->amount = $amount;
            $to_account_transaction->source_id = $userAuth->id;
            $to_account_transaction->description = $description;
            $to_account_transaction->save();
            //from noti
            $title = 'E-money transfered';
            $message = 'Your e-money transfered'.number_format($amount).'MMK to'.$to_user->name.' ('.$to_user->phone.').';
            $sourceable_id = $from_account_transaction->id;
            $sourceable_type = Transaction::class;
            $web_link = route('transaction-detail' , $from_account_transaction->trx_no );
            $deep_link = [
                'target' => 'transaction-detail',
                'parameter' =>[
                    'trx_no' => $from_account_transaction->trx_no
                ]
            ];
            Notification::send([$userAuth], new GeneralNotification($title,$message,$sourceable_id,$sourceable_type,$web_link,$deep_link));
            //to noti
            $title = 'E-money received';
            $message = 'Your e-money received'.number_format($amount).'MMK from'.$userAuth->name.' ('.$userAuth->phone.').';
            $sourceable_id = $to_account_transaction->id;
            $sourceable_type = Transaction::class;
            $web_link = route('transaction-detail' , $to_account_transaction->trx_no );
            $deep_link = [
                'target' => 'transaction-detail',
                'parameter' =>[
                    'trx_no' => $to_account_transaction->trx_no
                ]
            ];
            Notification::send([$to_user], new GeneralNotification($title,$message,$sourceable_id,$sourceable_type,$web_link,$deep_link));
            DB::commit();
            return success('Successfully transfered',['trx_no' => $from_account_transaction->trx_no ]);
        } catch (\Exception $error) {
            DB::rollBack();
            return fail('Something wrong ' .$error->getMessage(),null);
        }
        
    }
}
