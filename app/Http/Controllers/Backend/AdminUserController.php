<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\AdminUser;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\UpdateAdminUserRequest;

class AdminUserController extends Controller
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

        return view('backend.admin_user.index');
    }

    private function dataTable()
    {
        $query = AdminUser::query();  
            return DataTables::of($query)
                       ->editColumn('user_agent' , function($admin_user){
                        if($admin_user->user_agent)
                            {
                                $agent = new Agent();
                                $agent->setUserAgent($admin_user->user_agent);
                                $device = $agent->device();
                                $platform = $agent->platform();
                                $browser = $agent->browser();
                                return view('backend.column.user_agent' , [
                                    'device' => $device,
                                    'platform' => $platform,
                                    'browser' => $browser
                                    ]);
                            }
                                return '-';
                       })
                       ->addColumn('action' , function($admin_user)
                       {
                        return view('backend.action.admin_user_action' , ['admin_user' => $admin_user]);
                       
                       })
                       ->order(function ($admin_user)
                       {
                        $admin_user->orderBy('created_at' , 'desc');
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
        return view('backend.admin_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $attributes = $request->validated();
        AdminUser::create($attributes);
        return redirect()->route('admin-user.index')->with('success' , 'Admin User is successfully created!');
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
    public function edit(AdminUser $admin_user)
    {
        return view('backend.admin_user.edit' , ['admin_user' => $admin_user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminUserRequest $request,$id)
    {
         $admin_user = AdminUser::findOrFail($id);
        
        $admin_user->update();
        return redirect()->route('admin-user.index')->with('success' , 'Admin is successfully updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin_user = AdminUser::findOrFail($id);
        $admin_user->delete();
        return 'success';
    }
}