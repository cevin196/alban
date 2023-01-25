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
    @livewireStyles
</head>

<body class="font-sans antialiased bg-[#FEFFDB]">
    @include('admin.layouts.navbar')

    @include('admin.layouts.sidebar')

    {{-- p-10 absolute right-0 top-16 w-[70rem] --}}

    <div class="pt-20 px-5 lg:p-10 lg:absolute lg:right-0 lg:top-10 lg:w-[70rem] ">
        @section('content')

        @show
    </div>

    @include('admin.layouts.script')
    @livewireScripts
</body>

</html>
