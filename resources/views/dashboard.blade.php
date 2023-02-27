@extends('admin.layouts.app')

@section('content')
    @php
        
    @endphp
    <h1 class="text-2xl lg:text-3xl font-bold">Dashboard</h1>
    <span class="capitalize text-xl text-[#444444]">Here what's doing in your business right now</span>

    <div class="grid grid-cols-2 gap-3 mt-3">
        {{-- <span class="font-bold text-[#444]">Sub Menu 1</span> --}}
        <div class="bg-white p-3 mb-3 shadow-lg overflow-hidden col-span-2">
            <div class="flex justify-center">
                <span class="font-bold text-[#444] capitalize">comparison of income and expenses each month</span>
            </div>
            <div class=" flex justify-center max-h-[22rem]">
                <canvas id="chartLine"></canvas>
            </div>
        </div>

        <div class="p-3 bg-white shadow col-span-2 sm:col-span-1">
            <span class="font-bold text-[#444]">Job Done in Last Six Month</span>
            <canvas id="chartBar"></canvas>
        </div>

        <div
            class="p-5 bg-white shadow col-span-2 sm:col-span-1 flex flex-col justify-center overflow-hidden  max-h-[22rem]">
            <span class="font-bold text-[#444] block">Sub Menu 2</span>
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
                    label: "Income",
                    backgroundColor: "rgb(121, 217, 76)",
                    borderColor: "rgb(121, 217, 76)",
                    data: [{{ $financeDataIncome }}],
                },
                {
                    label: "Outcome",
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
                label: "Job",
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
            labels: ["JavaScript", "Python", "Ruby"],
            datasets: [{
                label: "My First Dataset",
                data: [300, 50, 100],
                backgroundColor: [
                    "rgb(133, 105, 241)",
                    "rgb(164, 101, 241)",
                    "rgb(101, 143, 241)",
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
