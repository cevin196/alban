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
</head>

<body class="font-sans antialiased bg-[#FEFFDB]">
    @include('admin.layouts.sidebar')
    {{-- <div class="w-1/6 bg-red-400 p-10 h-full fixed">
    </div> --}}
    <div class="w-5/6 absolute right-0 top-0 ">
        <div id="navbar" class="py-3 bg-[#FEFFDB]  fixed w-5/6 mr-10 pr-10 text-right h-15 ">
        </div>
        @include('admin.layouts.navbar')
        <div class="mt-14 p-3">
            @section('content')

            @show
        </div>
    </div>

    <x:notify-messages />
    @notifyJs

    <script>
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            let navbar = document.getElementById('navbar');

            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                // navbar.classList.remove('bg-black');
                navbar.classList.add('shadow-[0_4px_4px_0px_rgb(0,0,0,0.1)]');
            } else {
                navbar.classList.remove('shadow-[0_4px_4px_0px_rgb(0,0,0,0.1)]');
                // navbar.classList.add('bg-black');
            }

        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {

            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        }
    </script>
</body>

</html>
