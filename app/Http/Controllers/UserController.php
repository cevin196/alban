<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";
        $user->save();

        return redirect(route('user.index'))->with('success', 'User added successfully!');
    }

    public function show()
    {
        $this->authorize('user_show');
        return view('admin.user.show');
    }

    public function edit(User $user)
    {
        $this->authorize('user_edit');
        return view('admin.user.edit', compact('user'));
    }
}
