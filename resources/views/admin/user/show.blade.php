@extends('admin.layouts.app')

@section('content')
    <div class="flex gap-1 text-xl items-center text-[#444444]">
        <a href="{{ route('user.index') }}" class="font-bold">Pengguna</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <a href="#">Detail</a>
    </div>

    <div class="bg-white rounded p-5 mt-3 shadow-lg md:w-2/3 mx-auto">
        <span class="text-[#444444] font-bold text-lg">Detail Pengguna</span>
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="profil" class="w-32 mx-auto mb-5">
        <table class="mx-auto md:w-5/6 border-spacing-x-2">
            <tr>
                <td>Nama </td>
                <td class="px-2">:</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Email </td>
                <td class="px-2">:</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr class="align-top">
                <td>Nomor Telepon </td>
                <td class="px-2">:</td>
                <td>{{ $user->phone_number }}</td>
            </tr>
            <tr class="align-top ">
                <td>Peran </td>
                <td class="px-2">:</td>
                <td class="grid grid-cols-2 lg:grid-cols-3 gap-1 pb-2">
                    @foreach ($user->getRoleNames() as $role)
                        <a href="{{ route('role.show', $role) }}"
                            class="p-1 rounded bg-green-500 text-white text-center">{{ $role }}</a>
                    @endforeach
                </td>
            </tr>
            @if ($user->getDirectPermissions()->count() > 0)
                <tr class="align-top">
                    <td>Izin Extra </td>
                    <td class="px-2">:</td>
                    <td class="grid grid-cols-2 lg:grid-cols-3 gap-1">
                        @foreach ($user->getDirectPermissions() as $permission)
                            <span class="p-1 rounded bg-amber-500 text-white text-center">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                </tr>
            @endif
        </table>
    </div>
@endsection
