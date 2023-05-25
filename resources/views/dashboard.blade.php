@include('includes.jobPriority')
@extends('admin.layouts.app')
@inject('carbon', 'Carbon\Carbon')
@section('content')
    <h1 class="text-2xl lg:text-3xl font-bold mt-14 md:mt-0">Beranda</h1>
    {{-- <span class="capitalize text-xl text-[#444444]">Here what's doing in your business right now</span> --}}

    <div class="grid grid-cols-2 gap-3 mt-3">
        <div class="bg-white p-3 mb-3 shadow-lg overflow-hidden col-span-2">
            <div class="overflow-auto">
                <div class="flex justify-center mt-5">
                    <span class="font-bold text-[#444]">
                        Prioritas Pekerjaan Berdasarkan Perhitungan Keterlambatan dan Algoritma Weighted Product
                    </span>
                </div>
                <table class=" mx-auto">
                    <tr class="bg-primary border border-primary">
                        <th class="px-2 py-1">Alias</th>
                        <th class="px-2 py-1">Nama</th>
                        <th class="px-2 py-1">Nilai</th>
                        <th class="px-2 py-1">Urutan</th>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    @php
                        $order = 0;
                    @endphp
                    @foreach ($sortedSpecialAlternatives as $index => $alternative)
                        @php
                            $order++;
                        @endphp
                        <tr class="border border-primary hover:bg-gray-100 cursor-pointer"
                            onclick="window.location.href = '{{ route('alternative.show', $alternative['id']) }}'">
                            <td class="text-center px-4 py-1">{{ 'A' . $alternative['alias'] }}</td>
                            <td class="text-center px-4 py-1">{{ $alternative['name'] }}</td>
                            <td class="text-center px-4 py-1">{{ $alternative['value'] }}</td>
                            <td class="text-center px-4 py-1">{{ $order }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                    </tr>
                    @foreach ($sortedNormalAlternatives as $index => $alternative)
                        @php
                            $order++;
                        @endphp
                        <tr class="border border-green-500 hover:bg-gray-100 cursor-pointer"
                            onclick="window.location.href = '{{ route('alternative.show', $alternative['id']) }}'">
                            <td class="text-center px-4">{{ 'A' . $alternative['alias'] }}</td>
                            <td class="text-center px-4">{{ $alternative['name'] }}</td>
                            <td class="text-center px-4">{{ $alternative['vector_v'] }}</td>
                            <td class="text-center px-4">{{ $order }}</td>
                        </tr>
                    @endforeach
                </table>
                <div class="md:flex items-center justify-center gap-4 mt-0 md:mt-2">
                    <div class="flex justify-center items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-square-fill text-primary" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z" />
                        </svg>
                        <span>Hasil berdasarkan keterlambatan</span>
                    </div>
                    <div class="flex justify-center items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-square-fill text-green-500" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z" />
                        </svg>
                        <span>Hasil berdasarkan algoritma weighted product</span>
                    </div>
                </div>
            </div>
        </div>
        @can('finance_show')
            <div class="bg-white p-3 mb-3 shadow-lg overflow-hidden col-span-2">
                <div class="flex justify-center">
                    <span class="font-bold text-[#444] capitalize">Perbandingan Pemasukan dan Pengeluaran Dalam Enam Bulan
                        Terakhir</span>
                </div>
                <div class=" flex justify-center max-h-[22rem]">
                    <canvas id="chartLine"></canvas>
                </div>
            </div>
        @endcan

        <div class="p-3 bg-white shadow col-span-2 sm:col-span-1">
            <span class="font-bold text-[#444]">Jumlah Pekerjaan Selesai pada Enam Bulan Terakhir</span>
            <canvas id="chartBar"></canvas>
        </div>

        <div
            class="p-5 bg-white shadow col-span-2 sm:col-span-1 flex flex-col justify-center overflow-hidden  max-h-[22rem]">
            <span class="font-bold text-[#444] block">Status Pekerjaan pada Bulan
                {{ $carbon::now()->translatedFormat('F') }}</span>
            <canvas id="chartDoughnut" class="mx-auto"></canvas>
        </div>

    </div>

    <!-- Required chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart line -->

    <script>
        const labels = [
            @foreach ($months as $month)
                "{{ $month }}",
            @endforeach
        ];
        const data = {
            labels: labels,
            datasets: [{
                    label: "Pemasukan",
                    backgroundColor: "rgb(121, 217, 76)",
                    borderColor: "rgb(121, 217, 76)",
                    data: [{{ $financeDataIncome }}],
                },
                {
                    label: "Pengeluaran",
                    backgroundColor: "rgb(255, 139, 0)",
                    borderColor: "rgb(255, 139, 0)",
                    data: [{{ $financeDataOutcome }}],
                },
            ],
        };

        const configLineChart = {
            type: "line",
            data,
            options: {},
        };

        var chartLine = new Chart(
            document.getElementById("chartLine"),
            configLineChart
        );

        // // // // // // // // //


        const dataBarChart = {
            labels: labels,
            datasets: [{
                label: "Pekerjaan",
                backgroundColor: "rgb(255, 139, 0)",
                borderColor: "rgb(255, 139, 0)",
                data: [{{ $jobDatas }}],
            }, ],
        };

        const configBarChart = {
            type: "bar",
            data: dataBarChart,
            options: {},
        };

        var chartBar = new Chart(
            document.getElementById("chartBar"),
            configBarChart
        );

        // // // // // // // // // 

        const dataDoughnut = {
            labels: ["Sedang Dikerjakan", "Diterima", "Dibatalkan"],
            datasets: [{
                label: ["Total Pekerjaan"],
                data: [{{ $jobStatus }}],
                backgroundColor: [
                    "rgb(255, 139, 0)",
                    "rgb(247, 228, 99)",
                    "rgb(217, 83, 79)",
                ],
                hoverOffset: 4,
            }, ],
        };

        const configDoughnut = {
            type: "doughnut",
            data: dataDoughnut,
            options: {},
        };

        var chartBar = new Chart(
            document.getElementById("chartDoughnut"),
            configDoughnut
        );
    </script>
@endsection
