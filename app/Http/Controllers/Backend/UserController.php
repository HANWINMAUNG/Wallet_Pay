<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
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

        return view('backend.user.index');
    }

    private function dataTable()
    {
        $query = User::query();  
            return DataTables::of($query)
                       ->editColumn('user_agent' , function($user){
                        if($user->user_agent)
                            {
                                $agent = new Agent();
                                $agent->setUserAgent($user->user_agent);
                                $device = $agent->device();
                                $platform = $agent->platform();
                                $browser = $agent->browser();
                                return view('backend.user_agent_column.user_agent' , [
                                    'device' => $device,
                                    'platform' => $platform,
                                    'browser' => $browser
                                    ]);
                            }
                                return '-';
                       })
                       ->addColumn('action' , function($user)
                       {
                        return view('backend.action.user_action' , ['user' => $user]);
                       
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
                       ->rawColumns(['user_agent','action'])
                       ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try{
            $attributes = $request->validated();
            User::create($attributes);
            Wallet::firstOrCreate([
                'user_id' => $attributes->id,
            ],
            [
                'account_number' => '13333333',
                'amount' => 0,
            ]
            );
            DB::commit();
            return redirect()->route('user.index')->with('success' , 'User is successfully created!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors(['fail' => 'Something Wrong'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.user.edit' , ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request,$id)
    {
         $user = User::findOrFail($id);
        
        $user->update();
        return redirect()->route('user.index')->with('success' , 'User is successfully updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return 'success';
    }
}