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
