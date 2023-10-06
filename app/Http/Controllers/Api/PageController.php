<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\TransactionResource;

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
}
