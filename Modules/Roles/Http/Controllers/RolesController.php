<?php

namespace Modules\Roles\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Role $role)
    {
        $title = 'roles and permissions';
        $roles = Role::with(['permissions'])->get();
        $selected_role = $role;
        $permissions = [];

        $permissionArray = Permission::orderBy('module')->get();
        foreach ($permissionArray as $item) {
            $module = $item->module;
            $permission = $item->name;
            $permissions[$module][] = $permission;
        }
        return view('roles::index',compact(
            'title','roles','selected_role','permissions'
        ));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $role = Role::create(['name' => $request->name]);
        $notification = notify('role created successfully');
        return back()->with($notification);
    }


    public function updatePermission(Request $request, Role $role){
        $request->validate([
            'permissions' => 'required',
        ]);
        $role->syncPermissions($request->permissions);
        $notification = notify("permissions has been updated");
        return back()->with($notification);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $role = Role::findOrFail($request->id);
        $role->update([
            'name' => $request->name
        ]);
        $notification = notify("Role has been updated");
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        Role::findOrFail($request->id)->delete();
        $notification = notify("Role has been deleted");
        return back()->with($notification);
    }
}
