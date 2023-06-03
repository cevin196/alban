<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error 404</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">

    <div class="grid place-items-center h-screen">
        <div class="flex flex-col items-center gap-y-3">
            <span class=" font-bakbakOne text-6xl">Halaman tidak ditemukan!</span>
            <span class=" font-bakbakOne text-2xl">Error 404</span>
            <div class="grid grid-cols-2 gap-3">
                <a class="text-center font-bold px-2 py-1 bg-blue-500 hover:bg-blue-600 rounded border border-blue-400 text-white"
                    href="/">Dashboard</a>
                <a class="text-center font-bold px-2 py-1 bg-orange-500 hover:bg-orange-600 rounded border border-orange-400 text-white"
                    href="{{ redirect()->back()->getTargetUrl() }}">Kembali</a>
            </div>
        </div>
    </div>
</body>

</html>
