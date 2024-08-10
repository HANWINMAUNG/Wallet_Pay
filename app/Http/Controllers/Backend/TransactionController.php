<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
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

        return view('backend.transaction.index');
    }

    private function dataTable()
    {
        $query = Transaction::query();  
            return DataTables::of($query)
                       ->editColumn('type' , function($transaction){
                           if($transaction->type == 1){
                            return "Income";
                           }
                           return "Expense";
                       })
                       ->editColumn('user_id' , function($transaction){
                        return $transaction->User->phone;
                    })
                       ->editColumn('source_id' , function($transaction){
                            $source_id = User::where('id',$transaction->source_id)->first();
                            return $source_id->phone;
                       })
                       ->addColumn('action' , function($transaction)
                       {
                        return view('backend.action.transaction_action' , ['transaction' => $transaction]);
                       
                       })
                       ->order(function ($transaction)
                       {
                        $transaction->orderBy('created_at' , 'desc');
                       })
                       ->addColumn('created_at' , function ($data)
                      {
                        return date('d-M-Y H:i:s' , strtotime($data->created_at));
                      })
                      ->addColumn('updated_at' , function ($data)
                      {
                        return Carbon::parse($data->updated_at)->format('d-M-Y H:i:s');
                      })
                       ->rawColumns(['user_id','source_id','type','action'])
                       ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('backend.transaction.show',['transaction'=>$transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
