<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::find($id);
        return view('admin.role.edit', compact('permissions', 'role'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function changePermission()
    {
    }

    public function destroy($id)
    {
        //
    }
}
