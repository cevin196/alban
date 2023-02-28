@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl lg:text-3xl font-bold">
        Job Priority</h1>
    <span class="capitalize text-xl text-[#444444]">Showing job priority (alternative) using defined criterias with weighted
        product method</span>


    <div class="shadow-lg overflow-hiddenbg-white p-3 mb-3 bg-white mt-3">
        <div class="flex justify-center">
            <span>Alternatif terbaik Berdasarkan Perhitungan Menggunakan Metode Weighted Product Adalah</span>
        </div>
        <table class="w-1/2 mx-auto">
            <tr>
                <th>Alias</th>
                <th>Name</th>
                <th>Vector V Point</th>
                <th>Order</th>
            </tr>
            @foreach ($alternativeDatas as $index => $alternative)
                <tr>
                    <td class="text-center">{{ $alternative['alias'] }}</td>
                    <td class="text-center">{{ $alternative['name'] }}</td>
                    <td class="text-center">{{ $alternative['vectorV'] }}</td>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                </tr>
            @endforeach
        </table>
        <table class="mx-auto text-center">
            <tr class="border-b">
                <td class="px-4 py-1" rowspan="2">Alternative</td>
                <td class="px-4 py-1" colspan="{{ $criterias->count() }}">Criteria</td>
            </tr>
            <tr class="border-b">
                @foreach ($criterias as $criteria)
                    <td class="px-4 py-1">{{ $loop->index + 1 }}</td>
                @endforeach
            </tr>

            @foreach ($alternatives as $alternative)
                <tr>
                    <td class="px-4 py-1">{{ 'A' . $loop->index + 1 }}</td>
                    @foreach ($alternative->criterias as $alternativeCriteria)
                        <td class="px-4 py-1">{{ $alternativeCriteria->pivot->value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>

        <hr class="my-4 w-3/4 mx-auto">
        <table class="mx-auto text-center">
            <tr class="border-b">
                <td class="px-4 py-1">Bobot Preferensi</td>
                @foreach ($criterias as $criteria)
                    <td>{{ 'C' . $loop->index + 1 }}</td>
                @endforeach
                <td>Total</td>
            </tr>
            <tr class="border-b">
                <td>W = (
                    @foreach ($criterias->pluck('weight') as $criteria)
                        {{ $loop->last ? $criteria : $criteria . ', ' }}
                    @endforeach
                    )
                </td>
                @foreach ($criterias->pluck('weight') as $criteria)
                    <td class="px-4 py-1">{{ $criteria }}</td>
                @endforeach

                <td>
                    {{ $totalPreferenceWeightCount }}
                </td>
            </tr>
        </table>

        <hr class="my-4 w-3/4 mx-auto">

        <table class="mx-auto text-center max-w-md">
            <tr class="border-b">
                <td class="px-4 py-1">Kriteria</td>
                <td>bobot</td>
            </tr>
            @foreach ($criterias as $criteria)
                <tr>
                    <td>{{ 'C' . $loop->index + 1 }}</td>
                    <td>{{ $criteria->weight . '/' . $criterias->sum('weight') . '=' . round($criteria->getNormalizedWeight(), 3) }}
                    </td>
                </tr>
            @endforeach

            <tr>
                <td>Normalisasi bobot</td>
                <td class="px-4 py-1">
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($criterias as $criteria)
                        @php
                            $total += $criteria->getNormalizedWeight();
                        @endphp
                        {{ $loop->last ? round($criteria->getNormalizedWeight(), 3) : round($criteria->getNormalizedWeight(), 3) . ' + ' }}
                    @endforeach
                    = {{ $total }}
                </td>
            </tr>
        </table>

        <span class="block text-center mt-3 text-xl font-bold">Menentukan nilai vektor S</span>
        <table class="mx-auto">
            @foreach ($alternatives as $alternative)
                <tr>
                    <td>S{{ $loop->index + 1 }}</td>
                    <td class="px-4 py-1">

                        @foreach ($alternative->criterias as $alternativeCriteria)
                            ({{ $alternativeCriteria->pivot->value }}
                            <sup>{{ $alternativeCriteria->type == 'Cost' ? '-' : '' }}{{ round($alternativeCriteria->getNormalizedWeight(), 3) }}</sup>)
                            {{ $loop->last ? '' : '*' }}
                        @endforeach
                    </td>

                    <td>
                        = {{ round($alternative->vectorS(), 3) }}
                    </td>
                </tr>
            @endforeach
        </table>

        <span class="block text-center mt-3 text-xl font-bold">Menentukan nilai vektor V</span>

        <table class="mx-auto">
            @foreach ($alternatives as $alternative)
                <tr>
                    <td class="px-2 py-1">V{{ $loop->index + 1 }}</td>
                    <td class="flex flex-col">
                        <span>{{ round($alternative->vectorS(), 3) }}</span>
                        <hr>
                        <span>{{ round($vectorSTotal, 3) }}</span>
                    </td>
                    <td class="px-2 py-1">=</td>
                    <td class="px-2 py-1">{{ round($alternative->vectorS() / $vectorSTotal, 3) }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
