@extends('admin.layouts.app')

@section('content')
    @include('includes.toast')
    <div class="flex gap-1 text-xl items-center text-[#444444]">
        <a href="#" class="font-bold">User</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <a href="{{ route('user.index') }}">Index</a>

    </div>
    {{-- <h1 class="text-xl lg:text-2xl font-bold">Users</h1> --}}
    {{-- <span class="capitalize text-lg text-[#444444]">Manage user data</span> --}}
    @livewire('admin.user')
@endsection
