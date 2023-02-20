@extends('admin.layouts.app')

@inject('jobs', 'App\Models\Admin\Job')
@inject('carbon', 'Carbon\Carbon')
@section('content')
    @php
        $jobDatas = '';
        $months = [];
        
        for ($i = 1; $i < 7; $i++) {
            $jobDatas .=
                $jobs
                    ->whereBetween('date_in', [
                        $carbon
                            ::now()
                            ->startOfMonth()
                            ->subMonth($i),
                        $carbon
                            ::now()
                            ->startOfMonth()
                            ->subMonth($i - 1),
                    ])
                    ->where('status', 'Done')
                    ->orderBy('date_in')
                    ->count() . ', ';
            $months[] = $carbon
                ::now()
                ->startOfMonth()
                ->subMonth($i)
                ->format('F');
        }
        $months = array_reverse($months);
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
                    data: [20, 22, 27, 18, 17, 22],
                },
                {
                    label: "Outcome",
                    backgroundColor: "rgb(255, 139, 0)",
                    borderColor: "rgb(255, 139, 0)",
                    data: [18, 20, 25, 16, 15, 20],
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
{{-- old dashboard --}}
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
