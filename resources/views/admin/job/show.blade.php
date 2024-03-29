@extends('admin.layouts.app')
@include('includes.formater')
@section('content')
    <div class="flex gap-1 text-xl items-center text-[#444444]">
        <a href="{{ route('job.index') }}" class="font-bold">Pekerjaan</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <a href="#">Detail Pekerjaan</a>
    </div>

    <div class="bg-white rounded p-5 mt-3 shadow-lg w-full">
        <span class="text-[#444444] font-bold text-lg">Detail Pekerjaan</span>

        <div class="grid grid-cols-2 gap-x-10">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $job->name }}</td>
                </tr>
                <tr>
                    <td>Serial Number</td>
                    <td>:</td>
                    <td>{{ $job->serial_number }}</td>
                </tr>
                <tr>
                    <td>Kilometer Unit</td>
                    <td>:</td>
                    <td>{{ $job->unit_kilometer }}</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Tanggal Masuk</td>
                    <td>:</td>
                    <td>{{ $job->date_in }}</td>
                </tr>
                @if ($job->date_out)
                    <tr>
                        <td>Tanggal Keluar</td>
                        <td>:</td>
                        <td>{{ $job->date_out }}</td>
                    </tr>
                @else
                    <tr>
                        <td>Estimasi Pengerjaan</td>
                        <td>:</td>
                        <td>{{ $job->work_estimation }} Days</td>
                    </tr>
                @endif
                <tr>
                    <td>Nama Customer</td>
                    <td>:</td>
                    <td>{{ $job->customer_name }}</td>
                </tr>
            </table>
        </div>

        {{-- service --}}

        <div class="flex justify-center mt-3">
            <span class="font-bold">Services</span>
        </div>
        <table class="mx-auto w-3/4">
            <thead class="border-b bg-gray-50">
                <tr>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 w-1/12">
                        #
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                        Nama
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                        Qty
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                        Biaya
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                        Sub Total
                    </th>

                </tr>
            </thead class="border-b">
            <tbody>
                @php
                    $totalServices = 0;
                @endphp
                @foreach ($job->services as $jobService)
                    @php
                        $subTotal = $jobService->qty * $jobService->ammount;
                        $totalServices += $subTotal;
                    @endphp
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            {{ $loop->index + 1 }}</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{ $jobService->name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                            {{ $jobService->qty }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                            {{ rupiah($jobService->ammount) }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                            {{ rupiah($subTotal) }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-sm text-gray-900 font-bold px-6 py-4 whitespace-nowrap text-right" colspan="4">
                        Total Service
                    </td>
                    <td class="text-sm text-gray-900 font-bold px-6 py-4 whitespace-nowrap text-right">
                        {{ rupiah($totalServices) }}
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- service end --}}

        {{-- sparepart --}}

        <div class="flex justify-center mt-3">
            <span class="font-bold">Spare Parts</span>
        </div>
        <table class="mx-auto w-3/4">
            <thead class="border-b bg-gray-50">
                <tr>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 w-1/12">
                        #
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                        Nama Spare Part
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                        Qty
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                        Harga
                    </th>
                    <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                        Sub Total
                    </th>

                </tr>
            </thead class="border-b">
            <tbody>
                @php
                    $totalSpareParts = 0;
                @endphp
                @foreach ($job->spareParts as $jobSparePart)
                    @php
                        $subTotal = $jobSparePart->qty * $jobSparePart->ammount;
                        $totalSpareParts += $subTotal;
                    @endphp
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            {{ $loop->index + 1 }}</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{ $jobSparePart->name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                            {{ $jobSparePart->qty }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                            {{ rupiah($jobSparePart->ammount) }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                            {{ rupiah($subTotal) }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-sm text-gray-900 font-bold px-6 py-4 whitespace-nowrap text-right" colspan="4">
                        Total Spare parts
                    </td>
                    <td class="text-sm text-gray-900 font-bold px-6 py-4 whitespace-nowrap text-right">
                        {{ rupiah($totalSpareParts) }}
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- sparepart end --}}

        <table class="mx-auto  w-3/4 border-t-4">
            <tr>
                <td class="text-lg text-gray-900 font-bold px-6 py-4 whitespace-nowrap text-center">
                    Grand Total:
                </td>
                <td class="text-lg text-gray-900 font-bold px-6 py-4 whitespace-nowrap text-right">
                    {{ rupiah($totalSpareParts + $totalServices) }}
                </td>
            </tr>
        </table>


        <div class="flex justify-center gap-3 mt-5">
            <a href="{{ route('job.index') }}"
                class="px-6 py-2.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md 
            hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 
            active:shadow-lg transition duration-150 ease-in-out">Kembali</a>
            <a href="{{ route('job.edit', $job) }}" class="px-4 py-1 rounded bg-primary hover:bg-amber-600 text-white">Ubah
                Nilai</a>

        </div>
    </div>
@endsection
