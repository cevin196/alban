@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl lg:text-3xl font-bold">Dashboard</h1>
    <span class="capitalize text-xl text-[#444444]">Here what's doing in your business right now</span>

    <div class="grid grid-cols-2 gap-3 mt-3">
        <div class="shadow-lg overflow-hidden col-span-2 max-h-[22rem] flex justify-center bg-white p-3 mb-3">
            <canvas id="chartLine"></canvas>
        </div>

        <div class="p-3 bg-white shadow col-span-2 sm:col-span-1">
            <span class="font-bold text-[#444]">Sub Menu 1</span>
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
        const labels = ["January", "February", "March", "April", "May", "June"];
        const data = {
            labels: labels,
            datasets: [{
                label: "My First dataset",
                backgroundColor: "rgb(255, 139, 0)",
                borderColor: "rgb(255, 139, 0)",
                data: [0, 10, 5, 2, 20, 30, 45],
            }, ],
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

        // // // // // // // //

        const labelsBarChart = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
        ];
        const dataBarChart = {
            labels: labelsBarChart,
            datasets: [{
                label: "My First dataset",
                backgroundColor: "rgb(255, 139, 0)",
                borderColor: "rgb(255, 139, 0)",
                data: [10, 10, 5, 2, 20, 30, 45],
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
