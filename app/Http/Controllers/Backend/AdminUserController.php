<?php

namespace App\Http\Controllers\Backend;

use App\Models\AdminUser;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;

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
                                return '<table class="table table-bordered">
                                            <tbody>
                                            <tr><td>Device</td><td>'.$device.'</td></tr>
                                            <tr><td>Platform</td><td>'.$platform.'</td></tr>
                                            <tr><td>Brower</td><td>'.$browser.'</td></tr>
                                            </tbody>
                                            </table>';
                            }
                                return '-';
                       })
                       ->addColumn('action' , function($admin_user)
                       {
                        $edit_icon = '<a href="'.route('admin-user.edit' , $admin_user->id).'"><svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#ff9300" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#ff9300" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></a>';
                        $delete_icon = '<a href="#" class="delete" data-id="'.$admin_user->id.'"><svg width="33px" height="33px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 11V17" stroke="#ff2600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V17" stroke="#ff2600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#ff2600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#ff2600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ff2600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></i></a>';
                        return '<div class="action_icon">' . $edit_icon . $delete_icon . '</div>';
                       })
                       ->order(function ($admin_user)
                       {
                        $admin_user->orderBy('created_at' , 'desc');
                       })
                       ->addColumn('created_at' , function ($data)
                      {
                        return date('d-M-Y H:i:s' , strtotime($data->created_at));
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
    public function update(AdminUserRequest $request,$id)
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
