<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Roles and Permissions';
        $company_id = Auth()->user()->company_id;
        $role_permissions = Role::with('permissions')->where('company_id','=', $company_id)->orWhere('id','=', 1)->get();
        $permissions = Permission::get();

        return view('organization.roles.roles', compact('permissions', 'role_permissions', 'title'));
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
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        $company_id = auth()->user()->company_id;

        // Creating the role
        $role = Role::create([
            'name' => $request->input('name'),
            'company_id' => $company_id
        ]);

        // Assign Selected Permissions
        $role->syncPermissions($request->input('permission'));

        //Redirect with a success message
        return redirect()->route('org.roles.index')->with('success', 'Role created successfully');
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
        $company_id = auth()->user()->company_id;

        $role = Role::find($id);

        if($role->id == 1){
            return redirect()->route('org.roles.index')->with('warning', 'Admin Role cannot be deleted');
        }

        if (auth()->user()->company_id == $company_id) {
            $role->delete();
            return redirect()->route('org.roles.index')->with('success', 'Role deleted Successfully');
        }
        
    }
}
