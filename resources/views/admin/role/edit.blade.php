@extends('layouts.admin.app')

@section('content')
    <h1 class="text-xl lg:text-2xl font-bold">Permissions</h1>
    <span class="capitalize text-lg text-[#444444]">Here what's doing in your business right now</span>

    <div class="w-full bg-white rounded p-5 mt-3 grid grid-cols-10 text-center justify-center gap-1 items-stretch">
        @foreach ($permissions as $permission)
            <a href="#"
                class="p-1 {{ $role->hasPermissionTo($permission->id) ? 'bg-green-600' : 'bg-gray-400' }} text-center text-white rounded"
                onclick="document.getElementById('form-update-role-{{ $permission->id }}').submit()">
                {{ $permission->name }}
            </a>

            <form id="form-update-role-{{ $permission->id }}" action="{{ route('role.changePermission', $role) }}"
                method="POST" style="display: none">
                <input type="hidden" name="permission" name="permission" value="{{ $permission->id }}">
                @csrf
            </form>
        @endforeach
    </div>
@endsection
