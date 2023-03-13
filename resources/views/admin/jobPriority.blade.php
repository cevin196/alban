@extends('admin.layouts.app')
@include('includes.jobPriority')
@section('content')
    <h1 class="text-2xl lg:text-3xl font-bold">
        Job Priority</h1>
    <span class="capitalize text-xl text-[#444444]">Showing job priority (alternative) using defined criterias with weighted
        product method</span>


    <div class="shadow-lg overflow-hiddenbg-white p-3 mb-3 bg-white mt-3">
        <div class="flex justify-center mt-5">
            <span>Urutan prioritas alternative setelah menggunakan metode weighted product</span>
        </div>
        <table class=" mx-auto">
            <tr class="border">
                <th class="border">Alias</th>
                <th class="border">Name</th>
                <th class="border px-4">Vector V Point</th>
                <th class="border">Order</th>
            </tr>
            @foreach ($sortedAlternatives as $index => $alternative)
                <tr class="border">
                    <td class="text-center px-4 border">{{ $alternative['alias'] }}</td>
                    <td class="text-center px-4">{{ $alternative['name'] }}</td>
                    <td class="text-center px-4">{{ $alternative['vector_v'] }}</td>
                    <td class="text-center px-4">{{ $loop->index + 1 }}</td>
                </tr>
            @endforeach
        </table>

        <div class="flex justify-center mt-5">
            <span class="text-xl font-bold">Detail Perhitungan</span>
        </div>

        {{-- detail perhitungan --}}
        <div>
            <div class="flex justify-center mt-5">
                <span class="text-lg font-bold">Nilai alternatif pada tiap kriteria</span>
            </div>
            <table class="mx-auto text-center border">
                <tr class="border-b">
                    <td class="px-4 py-1 border" rowspan="2">Alternative</td>
                    <td class="px-4 py-1" colspan="{{ $criterias->count() }}">Criteria</td>
                </tr>
                <tr class="border-b">
                    @foreach ($criterias as $criteria)
                        <td class="px-4 py-1">{{ $criteria->name }}</td>
                    @endforeach
                </tr>

                @foreach ($alternativeDatas as $alternative)
                    <tr>
                        <td class="px-4 py-1">{{ 'A' . $loop->index + 1 }}</td>
                        @foreach ($alternative['criterias'] as $key => $alternativeCriteria)
                            <td class="px-4 py-1">{{ $alternativeCriteria['value'] }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- detail perhitungan setelah normalisasi --}}
        <div>
            <div class="flex justify-center mt-5">
                <span class="font-bold text-lg capitalize">Normalisasi nilai alternatif pada tiap kriteria</span>
            </div>
            <table class="mx-auto text-center">
                <tr class="border-b">
                    <td class="px-4 py-1" rowspan="2">Alternative</td>
                    <td class="px-4 py-1" colspan="{{ $criterias->count() }}">Criteria</td>
                </tr>
                <tr class="border-b">
                    @foreach ($criterias as $criteria)
                        <td class="px-4 py-1">{{ $criteria->name }}</td>
                    @endforeach
                </tr>

                @foreach ($alternativeDatas as $alternative)
                    <tr>
                        <td class="px-4 py-1">{{ 'A' . $loop->index + 1 }}</td>
                        @foreach ($alternative['criterias'] as $alternativeCriteria)
                            <td class="px-4 py-1">
                                {{ round($alternativeCriteria['normalized_value'], 3) }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- bobot preferensi --}}
        <hr class="my-4">
        <div>
            <div class="flex justify-center mt-5">
                <span class="font-bold text-lg capitalize">Bobot Preferensi Kriteria</span>
            </div>
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
        </div>

        {{-- normalisasi bobot --}}
        <hr class="my-4 mx-auto">
        <div>
            <div class="flex justify-center mt-5">
                <span class="font-bold text-lg capitalize">Normalisasi bobot kriteria</span>
            </div>
            <table class="mx-auto text-center">
                <tr class="border-b">
                    <td class="px-4 py-1">Kriteria</td>
                    <td>bobot</td>
                </tr>
                @foreach ($criterias as $criteria)
                    <tr>
                        <td>{{ $criteria->name }}</td>
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
        </div>

        {{-- menentukan vector s --}}
        <div>
            <div class="flex justify-center mt-5">
                <span class="font-bold text-lg capitalize">Menentukan Vector S</span>
            </div>
            <table class="mx-auto">
                @foreach ($alternativeDatas as $alternative)
                    <tr>
                        <td>S{{ $loop->index + 1 }}</td>
                        <td class="px-4 py-1">
                            @foreach ($alternative['criterias'] as $alternativeCriteria)
                                ({{ round($alternativeCriteria['normalized_value'], 3) }}
                                <sup>
                                    {{-- {{ $alternativeCriteria['type'] == 'Cost' ? '-' : '' }} --}}
                                    {{ round($alternativeCriteria['normalized_weight'], 3) }}
                                </sup>)
                                {{ $loop->last ? '' : '*' }}
                            @endforeach
                        </td>

                        <td>
                            = {{ round($alternative['vector_s'], 3) }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- menentukan vecktor V --}}
        <div>
            <span class="block text-center mt-3 text-xl font-bold">Menentukan nilai vektor V</span>
            <table class="mx-auto">
                @foreach ($alternativeDatas as $alternative)
                    <tr>
                        <td class="px-2 py-1">V{{ $loop->index + 1 }}</td>
                        <td class="flex flex-col px-2 text-center">
                            <span>{{ round($alternative['vector_s'], 3) }}</span>
                            <hr>
                            <span>
                                @foreach ($alternativeDatas as $AD)
                                    {{ round($AD['vector_s'], 3) }} +
                                @endforeach
                            </span>
                        </td>
                        <td>=</td>
                        <td class="flex flex-col px-2">
                            <span>{{ round($alternative['vector_s'], 3) }}</span>
                            <hr>
                            <span>{{ round($vectorSTotal, 3) }}</span>
                        </td>
                        <td class="px-2 py-1">=</td>
                        <td class="px-2 py-1">{{ round($alternative['vector_v'], 3) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
