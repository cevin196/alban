<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Condition Report</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@inject('carbon', 'Carbon\Carbon')
@include('includes.formater')

<body class="font-sans" onload="print()">
    <div class="flex justify-between">
        <img src="{{ asset('images/public/headerNota.jpg') }}" alt="Header Nota" class="w-96">
        {{-- <div>{{ $carbon::now()->format('d F Y') }}</div> --}}
    </div>

    <div class="flex justify-center mt-3">
        <span class="capitalize text-lg font-bold underline">Condition Report</span>
    </div>
    <table class="w-full">
        <tr>
            <td colspan="2" class="bg-blue-200 p-1 border border-black font-bold">Serviceman</td>
        </tr>
        <tr>
            <td class="px-1 border border-black">
                <span class="font-bold">Name: </span> Refly Tamamilang
            </td>
            <td class="px-1 border border-black">
                <span class="font-bold">Date:</span> {{ $carbon::now()->format('d F Y') }}
            </td>
        </tr>
        <tr>
            <td colspan="2" class="bg-blue-200 px-1 border border-black font-bold">Customer</td>
        </tr>
        <tr>
            <td class="px-1 border border-black">
                <span class="font-bold">Name: </span> Refly Tamamilang
            </td>
            <td class="px-1 border border-black">
                <span class="font-bold">Location:</span> Perum Daun Village
            </td>
        </tr>
        <tr>
            <td colspan="2" class="bg-blue-200 px-1 border border-black font-bold">Machine / Engine</td>
        </tr>
        <tr>
            <td colspan="2" class="border border-black">
                <div class="flex flex-row justify-around text-center divide-x divide-black">
                    <div class="flex flex-col w-full">
                        <span class="font-bold">Model:</span>
                        <span>Cummins 6bt</span>
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="font-bold">Serial Number:</span>
                        <span>21477684</span>
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="font-bold">Component:</span>
                        <span>Engine group</span>
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="font-bold">Arrg Number:</span>
                        <span></span>
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="font-bold">Hours Meter:</span>
                        <span></span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="bg-blue-200 px-1 border border-black font-bold">Job Outline</td>
        </tr>
        <tr>
            <td colspan="2" class="px-1 border border-black">
                <span class="font-bold">General Overhoul Engine</span>
            </td>

        </tr>
    </table>

    <div class="grid grid-cols-2 mt-3">
        @foreach ($pictures as $picture)
            <div class="p-2 border border-black flex flex-col">
                <div class="h-52"
                    style="background-image: url('{{ asset('storage/conditionReport/' . $picture['path']) }}');background-position: center;background-repeat: no-repeat; background-size: contain">
                    <div
                        class="w-full h-full text-white bg-black bg-opacity-40 opacity-0 flex justify-center items-center">
                        Click to delete
                    </div>
                </div>

                <div class=" border-gray-300">{{ $picture['description'] }}</div>
            </div>
        @endforeach
        @if ($pictures->count() % 2 == 1)
            <div class="p-2 border border-black flex flex-col">
                <div class="h-52"
                    style=";background-position: center;background-repeat: no-repeat; background-size: contain">
                    <div
                        class="w-full h-full text-white bg-black bg-opacity-40 opacity-0 flex justify-center items-center">
                        Click to delete
                    </div>
                </div>

                <div class=" border-gray-300"></div>
            </div>
        @endif
    </div>
</body>

</html>
