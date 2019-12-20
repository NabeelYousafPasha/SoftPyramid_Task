<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index')
            ->with([
                'page_title' => trans('lang.user.page_title'),
                'entity' => trans('lang.user.entity'),
            ]);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    public function list_permission_role()
    {
        if (! $this->loggedInUser->hasRole('admin'))
            return $this->permission_denied();

        $roles = \DB::table('roles')->get();
        $permissions = \DB::table('permissions')->get();
        $permission_role = \DB::table('role_has_permissions')
            ->select(\DB::raw('CONCAT(permission_id,"-",role_id) AS detail'))
            ->pluck('detail')->all();

        return view('dashboard.permission_role.list')
                ->with([
                    'page_title' => trans('lang.permission_role'),
                    'entity' => trans('lang.permission_role'),
                ])
                ->with([
                    'roles' => $roles,
                    'permissions' => $permissions,
                    'permission_role' => $permission_role
                ]);
    }


    public function store_permission_role(Request $request)
    {
        if (! $this->loggedInUser->hasRole('admin'))
            return $this->permission_denied();

        $insert = [];
        $permissions_roles = ($request->input('permission_role')) ? : [];
        foreach($permissions_roles as $perm => $roles)
            foreach($roles as $role => $value)
                $insert[] = array('permission_id' => $perm, 'role_id' => $role);

        \DB::table('role_has_permissions')->truncate();

        $perm_role = \DB::table('role_has_permissions')->insert($insert);

        $status = $perm_role ? array('msg' => "Permissions have been assigned to respective Roles successfully!", 'toastr' => "successToastr") : array('msg' => "Some Error occured in deleting record. Try again.", 'toastr' => "errorToastr");
        \Session::flash($status['toastr'], $status['msg']);
        return redirect()->route('permission_role');
    }
}
