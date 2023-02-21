<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Print</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@inject('carbon', 'Carbon\Carbon')
@include('includes.formater')

<body class="font-sans" onload="print()">
    <div class="flex justify-between">
        <img src="{{ asset('images/public/headerNota.jpg') }}" alt="Header Nota" class="w-96">
        <table class="h-min max-w-xs mt-3 text-sm">
            <tr>
                <td>Balikpapan</td>
                <td>:</td>
                <td>{{ $carbon::now()->format('d F Y') }}</td>
            </tr>
            <tr>
                <td>Kepada</td>
                <td>:</td>
                <td>{{ $job->customer_name }}</td>
            </tr>
        </table>
    </div>

    <div class="flex justify-center mt-3">
        <span class="capitalize text-lg font-bold">INVOICE</span>
    </div>
    <table class="w-1/3">
        <tr>
            <td>
                Name
            </td>
            <td>:</td>
            <td>{{ $job->name }}</td>
        </tr>
        <tr>
            <td>Serial Number</td>
            <td>:</td>
            <td>{{ $job->serial_number }}</td>
        </tr>
        <tr>
            <td>Unit Kilometer</td>
            <td>:</td>
            <td>{{ $job->unit_kilometer }}</td>
        </tr>
    </table>
    <table class="w-full mt-3">
        <tr>
            <th class="border">No.</th>
            <th class="border">Services</th>
            <th class="border">Qty</th>
            <th class="border w-1/5">Ammount</th>
            <th class="border w-1/5">Sub Total</th>
        </tr>
        @php
            $totalServices = 0;
        @endphp
        @foreach ($job->services as $jobService)
            @php
                $subTotal = $jobService->qty * $jobService->ammount;
                $totalServices += $subTotal;
            @endphp
            <tr>
                <td class="text-center border">
                    {{ $loop->index + 1 }}</td>
                <td class="border pl-2">
                    {{ $jobService->name }}
                </td>
                <td class="text-center border">
                    {{ $jobService->qty }}
                </td>
                <td class="text-right border pr-2">
                    {{ rupiah($jobService->ammount) }}
                </td>
                <td class="text-right border pr-2">
                    {{ rupiah($subTotal) }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-right font-bold border pr-2">
                Total Service
            </td>
            <td class="text-right font-bold border pr-2">
                {{ rupiah($totalServices) }}
            </td>
        </tr>
    </table>

    <table class="w-full mt-3">
        <tr>
            <th class="border">No.</th>
            <th class="border">Part Name</th>
            <th class="border">Qty</th>
            <th class="border w-1/5">Ammount</th>
            <th class="border w-1/5">Sub Total</th>
        </tr>
        @php
            $totalSpareParts = 0;
        @endphp
        @foreach ($job->spareParts as $jobSparePart)
            @php
                $subTotal = $jobSparePart->qty * $jobSparePart->ammount;
                $totalSpareParts += $subTotal;
            @endphp
            <tr>
                <td class="text-center border">
                    {{ $loop->index + 1 }}</td>
                <td class="border pl-2">
                    {{ $jobSparePart->name }}
                </td>
                <td class="text-center border">
                    {{ $jobSparePart->qty }}
                </td>
                <td class="text-right border pr-2">
                    {{ rupiah($jobSparePart->ammount) }}
                </td>
                <td class="text-right border pr-2">
                    {{ rupiah($subTotal) }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-right font-bold border pr-2">
                Total Spare Part
            </td>
            <td class="text-right font-bold border pr-2">
                {{ rupiah($totalSpareParts) }}
            </td>
        </tr>
    </table>

    <table class="w-full mt-2 border-t-2">
        <tr>
            <td class="text-right font-bold border pr-2">
                Grand Total
            </td>
            <td class="text-right font-bold border pr-2 w-1/5">
                {{ rupiah($totalSpareParts) }}
            </td>
        </tr>
    </table>

    <div class="flex justify-between mt-5 ">
        <table class="w-1/3 h-min text-sm">
            <tr>
                <td colspan="3">Pembayaran Via Transfer Ke:</td>
            </tr>
            <tr>
                <td>Rekening</td>
                <td>:</td>
                <td>1912545851</td>
            </tr>
            <tr>
                <td>Bank</td>
                <td>:</td>
                <td>Bank Central Asia</td>
            </tr>
            <tr>
                <td>Atas Nama</td>
                <td>:</td>
                <td>Refly Tamamilang</td>
            </tr>
        </table>
        <div class="w-1/3">
            <div class="flex flex-col items-center gap-y-3">
                <span>Bengkel Alban Technik Mandiri</span>
                <img src="{{ asset('images/public/Logo.png') }}" alt="Header Nota" class="w-24 opacity-50">
                <span>Refly Tamamilang</span>
            </div>
        </div>
    </div>
</body>

</html>
