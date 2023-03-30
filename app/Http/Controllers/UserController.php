<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('user_access');
        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|min:8|max:20',

        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";
        $user->save();

        notify()->success('User created succesfully!');
        return redirect(route('user.index'));
    }

    public function show(User $user)
    {
        $this->authorize('user_show');
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('user_edit');

        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.user.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|min:8|max:20',
            'new_password' => 'nullable|min:6'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        ($request->new_password) ? $user->password = Hash::make($request->new_password) : null;

        $user->syncRoles($request->roles);
        $user->syncPermissions($request->extra_permissions);

        $user->update();

        notify()->success('User updated succesfully!');
        return redirect(route('user.index'));
    }
}
