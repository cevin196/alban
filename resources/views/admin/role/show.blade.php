@extends('admin.layouts.app')

@section('content')
    <div class="flex gap-1 text-xl items-center text-[#444444]">
        <a href="{{ route('user.index') }}" class="font-bold">User</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <a href="#">Show</a>
    </div>

    <div class="bg-white rounded p-5 mt-3 shadow-lg md:w-2/3 mx-auto">
        <span class="text-[#444444] font-bold text-lg">Role Detail</span>

        <div class="block mb-2">This <span class=" text-amber-500">{{ $role->name }}</span> role has
            permissions to:</div>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-1 pb-2 mb-3">
            @foreach ($role->permissions->pluck('name') as $permission)
                <span class="p-1 rounded bg-green-500 text-white text-center">{{ $permission }}</span>
            @endforeach
        </div>
        <div class="flex justify-center">
            <a href="{{ route('role.index') }}" class="px-4 py-1 rounded bg-gray-500 text-white">Back</a>
        </div>
    </div>
@endsection
