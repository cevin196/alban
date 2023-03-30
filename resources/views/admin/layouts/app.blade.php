<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @notifyCss --}}
    @livewireStyles

    @include('admin.layouts.head')
</head>

<body class="font-sans antialiased bg-[#FEFFDB]">
    @include('admin.layouts.sidebar')
    {{-- <div class="w-1/6 bg-red-400 p-10 h-full fixed">
    </div> --}}
    <div class="w-full lg:w-5/6 lg:absolute right-0 top-0 " id="content-container">
        {{-- <div id="navbar" class="py-3 bg-red-500  fixed w-5/6 mr-10 pr-10 text-right h-15 ">
        </div> --}}
        @include('admin.layouts.navbar')
        <div class="lg:mt-16 p-3">
            @section('content')

            @show
        </div>
    </div>
    @include('admin.layouts.script')
    @livewireScripts
    <x:notify-messages />
    @notifyJs
</body>

</html>
