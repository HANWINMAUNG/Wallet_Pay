<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\UUIDGenerate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TransferRequest;
use Illuminate\Support\Facades\Session;
use App\Notifications\GeneralNotification;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Notification;

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
            $title = 'Changed Password';
            $message = 'Your password is successfully changed.';
            $sourceable_id = $user->id;
            $sourceable_type = User::class;
            $web_link = route('profile');
            $deep_link = [
                'target' => 'profile',
                'parameter' =>null
            ];
            Notification::send([$user], new GeneralNotification($title,$message,$sourceable_id,$sourceable_type,$web_link,$deep_link));
            return redirect()->route('profile')->with('success' , 'Successfully Updated Password');
        }
        return back()->withErrors(['old_password' => 'Old password is incorrect'])->withInput();
    }
    public function wallet()
    {
        dd(Session::get('language'));
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
        $hash_value = $request->hash_value;
        $userAuth = auth()->guard('web')->user();
        $str = $request->phone.$request->amount.$request->description;
        $hash_value2 = hash_hmac('sha256',$str,'walletpay123!@#');
        if($hash_value !== $hash_value2){
            return back()->withErrors(['fail' => 'The given data is invalid'])->withInput();
        }
        $to_user = User::where('phone' , $request->phone)->first();
        if(!$to_user){
            return back()->withErrors(['phone' => 'The account is invalid'])->withInput();
        }
        if($userAuth->phone == $request->phone){
            return back()->withErrors(['phone' => 'The account is invalid'])->withInput();
        }
        if($request->amount < 1000){
            return back()->withErrors(['amount' => 'The amount must be minimum 1000 MMK'])->withInput();
        }
        if(!$userAuth->Wallet || !$to_user->Wallet){
            return back()->withErrors(['fail' => 'Something wrong .The given data is invalid'])->withInput();
        }
        if($userAuth->Wallet->amount < $request->amount){
            return back()->withErrors(['amount' => 'The amount is not enough'])->withInput();
        }
        $attributes = $request->validated();
        return view('frontend.transfer_confirm',[
            'userAuth' => $userAuth,
            'to_user' => $to_user,
            'attributes' => $attributes,
            'hash_value' => $hash_value
        ]);
    }
    public function transferComplete(TransferRequest $request)
    {
        $userAuth = auth()->guard('web')->user();
        $str = $request->phone.$request->amount.$request->description;
        $hash_value2 = hash_hmac('sha256',$str,'walletpay123!@#');
        if($request->hash_value !== $hash_value2){
            return back()->withErrors(['fail' => 'The given data is invalid'])->withInput();
        }
        $to_user = User::where('phone' , $request->phone)->first();
        if(!$to_user){
            return back()->withErrors(['fail' => 'The account is invalid'])->withInput();
        }
        
        if($userAuth->phone == $request->phone){
            return back()->withErrors(['fail' => 'The account is invalid'])->withInput();
        }
        if($request->amount < 1000){
            return back()->withErrors(['fial' => 'The amount must be minimum 1000 MMK'])->withInput();
        }
        if($userAuth->Wallet->amount < $request->amount){
            return back()->withErrors(['fail' => 'The amount is not enough'])->withInput();
        }
        $attributes = $request->validated();
        $amount = $attributes['amount'];
        $description = $attributes['description'];
        if(!$userAuth->Wallet || !$to_user->Wallet){
            return back()->withErrors(['fail' => 'Something wrong .The given data is invalid'])->withInput();
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
            return redirect('transaction-detail/' . $from_account_transaction->trx_no )->with('success' ,'Successfully transfered');
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors(['fail' => 'Something wrong ' .$error->getMessage()])->withInput();
        }
        
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
    public function passwordCheck(Request $request)
    {
        if(!$request->password){
            return response()->json([
                'status' => 'fail',
                'message' => 'Please fill your password!',
            ]);
        }
        $userAuth = auth()->guard('web')->user();
        if (!Hash::check($request->password,$userAuth->password)) {
            return response()->json([
                'status' => 'success',
                'message' => 'The password is correct!',
            ]);
        }
        return response()->json([
            'status' => 'fail',
            'message' => 'The password is incorrect!',
        ]);
    }
    public function transferHash(Request $request)
    {
        $str = $request->phone.$request->amount.$request->description;
        $hash_value = hash_hmac('sha256',$str,'walletpay123!@#');
        return response()->json([
            'status' => 'success',
            'data' => $hash_value,
        ]);
    }
    public function transaction(Request $request)
    {
        $userAuth = auth()->guard('web')->user();
        $transactions = Transaction::with('User','Source')->orderBy('created_at' , 'DESC')->where('user_id',$userAuth->id);

        if($request->type){
            $transactions = $transactions->where('type', $request->type);
        }
        if($request->date){
            $transactions = $transactions->whereDate('created_at', $request->date);
        }
        $transactions = $transactions->paginate(5);
        return view('frontend.transaction' , ['transactions' => $transactions ]);
    }
    public function transactionDetail($trx_no)
    {
        $userAuth = auth()->guard('web')->user();
        $transaction = Transaction::with('User','Source')->where('user_id' , $userAuth->id)->where('trx_no',$trx_no)->first();
        return view('frontend.transaction_detail' , ['transaction' => $transaction ]);
    }
    public function receiveQr()
    {
        $userAuth = auth()->guard('web')->user();
        return view('frontend.receive_qr', ['userAuth' => $userAuth ]);
    }
    public function scanAndPay()
    {
       return  view('frontend.scan_and_pay');
    }
    public function scanAndPayForm(Request $request)
    {
        $form_account = auth()->guard('web')->user();
        $to_account = User::where('phone', $request->phone)->first();
        if(!$to_account){
            return back()->withErrors(['fail' => 'The QR code is invalid'])->withInput(); 
        }
       return  view('frontend.scan_and_pay_form',[
        'to_account' => $to_account,
        'form_account' => $form_account
       ]);
    }
    public function scanAndPayConfirm(TransferRequest $request)
    {
        $hash_value = $request->hash_value;
        $userAuth = auth()->guard('web')->user();
        $str = $request->phone.$request->amount.$request->description;
        $hash_value2 = hash_hmac('sha256',$str,'walletpay123!@#');
        if($hash_value !== $hash_value2){
            return back()->withErrors(['fail' => 'The given data is invalid'])->withInput();
        }
        $to_user = User::where('phone' , $request->phone)->first();
        if(!$to_user){
            return back()->withErrors(['phone' => 'The account is invalid'])->withInput();
        }
        if($userAuth->phone == $request->phone){
            return back()->withErrors(['phone' => 'The account is invalid'])->withInput();
        }
        if($request->amount < 1000){
            return back()->withErrors(['amount' => 'The amount must be minimum 1000 MMK'])->withInput();
        }
        if(!$userAuth->Wallet || !$to_user->Wallet){
            return back()->withErrors(['fail' => 'Something wrong .The given data is invalid'])->withInput();
        }
        if($userAuth->Wallet->amount < $request->amount){
            return back()->withErrors(['amount' => 'The amount is not enough'])->withInput();
        }
        $attributes = $request->validated();
        return view('frontend.scan_and_pay_confirm',[
            'userAuth' => $userAuth,
            'to_user' => $to_user,
            'attributes' => $attributes,
            'hash_value' => $hash_value
        ]);
    }
    public function scanAndPayComplete(TransferRequest $request)
    {
        $userAuth = auth()->guard('web')->user();
        $str = $request->phone.$request->amount.$request->description;
        $hash_value2 = hash_hmac('sha256',$str,'walletpay123!@#');
        if($request->hash_value !== $hash_value2){
            return back()->withErrors(['fail' => 'The given data is invalid'])->withInput();
        }
        $to_user = User::where('phone' , $request->phone)->first();
        if(!$to_user){
            return back()->withErrors(['fail' => 'The account is invalid'])->withInput();
        }
        
        if($userAuth->phone == $request->phone){
            return back()->withErrors(['fail' => 'The account is invalid'])->withInput();
        }
        if($request->amount < 1000){
            return back()->withErrors(['fial' => 'The amount must be minimum 1000 MMK'])->withInput();
        }
        if($userAuth->Wallet->amount < $request->amount){
            return back()->withErrors(['fail' => 'The amount is not enough'])->withInput();
        }
        $attributes = $request->validated();
        $amount = $attributes['amount'];
        $description = $attributes['description'];
        if(!$userAuth->Wallet || !$to_user->Wallet){
            return back()->withErrors(['fail' => 'Something wrong .The given data is invalid'])->withInput();
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
            return redirect('transaction-detail/' . $from_account_transaction->trx_no )->with('success' ,'Successfully transfered');
        } catch (\Exception $error) {
            DB::rollBack();
            return back()->withErrors(['fail' => 'Something wrong ' .$error->getMessage()])->withInput();
        }
        
    }
}
