<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\UUIDGenerate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->dataTable();
        }

        return view('backend.wallet.index');
    }

    private function dataTable()
    {
        $query = Wallet::query();  
            return DataTables::of($query)
                        ->addColumn('user_id' , function($wallet){
                        if($wallet->user_id)
                        {
                            return view('backend.column.wallet_user' , ['wallet' => $wallet]);
                        }
                            return '-';
                        })
                        ->editColumn('amount' , function($wallet){
                            return number_format($wallet->amount , 2);
                        })
                       ->order(function ($user)
                       {
                        $user->orderBy('created_at' , 'desc');
                       })
                       ->addColumn('created_at' , function ($data)
                      {
                        return date('d-M-Y H:i:s' , strtotime($data->created_at));
                      })
                      ->addColumn('updated_at' , function ($data)
                      {
                        return Carbon::parse($data->updated_at)->format('d-M-Y H:i:s');
                      })
                      ->rawColumns(['user_id'])
                      ->make(true);
    }

   public function addAmount()
   {
    $users = User::orderBy('name')->get();
    return view('backend.wallet.add_amount',['users' => $users]);
   }
   public function addAmountStore(Request $request)
   {
    if($request->amount < 1000){
        return back()->withErrors(['fial' => 'The amount must be minimum 1000 MMK'])->withInput();
    }
    $to_account = User::with('Wallet')->where('id',$request->user_id)->firstOrFail();
    $to_account_wallet = $to_account->Wallet;
    DB::beginTransaction();
    try {
    $to_account_wallet->increment('amount', $request->amount);
    $to_account_wallet->update();

    $ref_no = UUIDGenerate::refNumber();
    $to_account_transaction = new Transaction();
    $to_account_transaction->ref_no = $ref_no;
    $to_account_transaction->trx_no = UUIDGenerate::trxNumber();
    $to_account_transaction->user_id = $to_account->id;
    $to_account_transaction->type = 1;
    $to_account_transaction->amount = $request->amount;
    $to_account_transaction->source_id = 0;
    $to_account_transaction->description = $request->description;
    $to_account_transaction->save();
    DB::commit();
    return redirect()->route('wallet.index')->with('success' , 'Successfully added amount!');
    } catch (\Exception $error) {
         DB::rollBack();
    return back()->withErrors(['fail' => 'Something wrong ' .$error->getMessage()])->withInput();
    }
   }
   public function removeAmount()
   {
    $users = User::orderBy('name')->get();
    return view('backend.wallet.remove_amount',['users' => $users]);
   }
   public function removeAmountReduce(Request $request)
   {
    if($request->amount < 1){
        return back()->withErrors(['fial' => 'The amount must be at least 1 MMK'])->withInput();
    }
    $to_account = User::with('Wallet')->where('id',$request->user_id)->firstOrFail();
    $to_account_wallet = $to_account->Wallet;
    DB::beginTransaction();
    try {
    if($to_account_wallet->amount < $request->amount ){
        throw new Exception('The amount is greater than the wallet balance');
    }
    $to_account_wallet->decrement('amount', $request->amount);
    $to_account_wallet->update();

    $ref_no = UUIDGenerate::refNumber();
    $to_account_transaction = new Transaction();
    $to_account_transaction->ref_no = $ref_no;
    $to_account_transaction->trx_no = UUIDGenerate::trxNumber();
    $to_account_transaction->user_id = $to_account->id;
    $to_account_transaction->type = 2;
    $to_account_transaction->amount = $request->amount;
    $to_account_transaction->source_id = 0;
    $to_account_transaction->description = $request->description;
    $to_account_transaction->save();
    DB::commit();
    return redirect()->route('wallet.index')->with('success' , 'Successfully reduced amount!');
    } catch (\Exception $error) {
         DB::rollBack();
    return back()->withErrors(['fail' => 'Something wrong ' .$error->getMessage()])->withInput();
    }
   }

}
