<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.index');
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        notify()->success('Role created succesfully!');
        return redirect(route('role.index'));
    }

    public function show($roleName)
    {
        $role = Role::findByName($roleName);
        return view('admin.role.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.role.edit', compact('permissions', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        notify()->success('Role updated succesfully!');
        return redirect(route('role.index'));
    }

    public function changePermission()
    {
    }

    public function destroy($id)
    {
        //
    }
}
