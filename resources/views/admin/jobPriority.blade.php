@extends('admin.layouts.app')
@include('includes.jobPriority')
@section('content')
    <h1 class="text-2xl lg:text-3xl font-bold mt-10 md:mt-0">
        Job Priority</h1>
    <span class="capitalize text-xl text-[#444444]">Showing job priority (alternative) using defined criterias with weighted
        product method</span>


    <div class="shadow-lg  p-3 mb-3 bg-white mt-3">
        <div class="overflow-auto">
            <div class="flex justify-center mt-5">
                <span class="text-lg font-bold">Priority based on job delay or weighted product calculation</span>
            </div>
            <table class=" mx-auto">
                <tr class="bg-primary border border-primary">
                    <th class="px-2 py-1">Alias</th>
                    <th class="px-2 py-1">Name</th>
                    <th class="px-2 py-1">Value</th>
                    <th class="px-2 py-1">Order</th>
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
                        onclick="window.location.href = '{{ route('alternative.edit', $alternative['id']) }}'">
                        <td class="text-center px-4 py-1">{{ $alternative['alias'] }}</td>
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
                        onclick="window.location.href = '{{ route('alternative.edit', $alternative['id']) }}'">
                        <td class="text-center px-4">{{ $alternative['alias'] }}</td>
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
                    <span>Based on Job Late Duration</span>
                </div>
                <div class="flex justify-center items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-square-fill text-green-500" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z" />
                    </svg>
                    <span>Based on WP Method</span>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-5">
            <span class="text-xl font-bold">Detail Perhitungan</span>
        </div>

        {{-- Tabel Khusus --}}
        <div class="overflow-auto">
            <div class="flex justify-center">
                <span class="text-lg font-bold">Alternatif khusus dengan nilai keterlambatan</span>
            </div>
            <table class="mx-auto text-center border border-white">
                <tr class=" bg-green-500 text-white">
                    <td class="px-4 py-1 border border-white">Alternative</td>
                    <td class="px-4 py-1 border border-white">Nilai keterlambatan</td>
                </tr>

                @foreach ($specialAlternatives as $alternative)
                    <tr class="border-b border-white {{ $loop->even ? 'bg-gray-100' : '' }}">
                        <td class="px-4 py-1 font-bold">{{ $alternative['alias'] }}</td>
                        <td class="px-4 py-1">{{ $alternative['value'] }}</td>

                    </tr>
                @endforeach
            </table>
        </div>

        {{-- detail perhitungan --}}
        <div class="overflow-auto mt-5">
            <div class="flex justify-center">
                <span class="text-lg font-bold">Nilai alternatif pada tiap kriteria</span>
            </div>
            <table class="mx-auto text-center border border-white">
                <tr class=" bg-primary">
                    <td class="px-4 py-1 border border-white" rowspan="2">Alternative</td>
                    <td class="px-4 py-1 border border-white" colspan="{{ $criterias->count() }}">Criteria</td>
                </tr>
                <tr class="border-b border-white bg-primary">
                    @foreach ($criterias as $criteria)
                        @if ($criteria->id == 5)
                            @continue
                        @endif
                        <td class="px-4 py-1 border border-white">{{ $criteria->name }}</td>
                    @endforeach
                </tr>

                @foreach ($normalAlternatives as $alternative)
                    <tr class="border-b border-white {{ $loop->even ? 'bg-gray-100' : '' }}">
                        <td class="px-4 py-1 font-bold">{{ $alternative['alias'] }}</td>
                        @foreach ($alternative['criterias'] as $alternativeCriteria)
                            <td class="px-4 py-1">{{ $alternativeCriteria['value'] }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- detail perhitungan setelah normalisasi --}}
        <div class="overflow-auto">
            <div class="flex justify-center mt-5">
                <span class="font-bold text-lg capitalize">Normalisasi nilai alternatif pada tiap kriteria</span>
            </div>
            <table class="mx-auto text-center">
                <tr class="bg-primary border border-white">
                    <td class="px-4 py-1 border border-white" rowspan="2">Alternative</td>
                    <td class="px-4 py-1" colspan="{{ $criterias->count() }}">Criteria</td>
                </tr>
                <tr class="bg-primary border border-white">
                    @foreach ($criterias as $criteria)
                        @if ($criteria->id == 5)
                            @continue
                        @endif
                        <td class="px-4 py-1 border border-white">{{ $criteria->name }}</td>
                    @endforeach
                </tr>

                @foreach ($normalAlternatives as $alternative)
                    <tr class="border border-gray-100 {{ $loop->even ? 'bg-gray-100' : '' }}">
                        <td class="px-4 py-1 font-bold">{{ $alternative['alias'] }}</td>
                        @foreach ($alternative['criterias'] as $alternativeCriteria)
                            <td class="px-4 py-1 ">
                                {{ round($alternativeCriteria['normalized_value'], 3) }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- bobot preferensi --}}
        <hr class="my-4">
        <div class="overflow-auto">
            <div class="flex justify-center mt-5">
                <span class="font-bold text-lg capitalize">Bobot Preferensi Kriteria</span>
            </div>
            <table class="mx-auto text-center">
                <tr class="border-b bg-primary">
                    <td class="px-4 py-1 border border-white">Bobot Preferensi</td>
                    @foreach ($criterias as $criteria)
                        <td class="border border-white px-4">{{ 'C' . $loop->index + 1 }}</td>
                    @endforeach
                    <td class="px-4">Total</td>
                </tr>
                <tr class="border border-gray-100">
                    <td>W = (
                        @foreach ($criterias->pluck('weight') as $criteria)
                            {{ $loop->last ? $criteria : $criteria . ', ' }}
                        @endforeach
                        )
                    </td>
                    @foreach ($criterias->pluck('weight') as $criteria)
                        <td class="px-4 py-1">{{ $criteria }}</td>
                    @endforeach

                    <td class="font-bold">
                        {{ $totalPreferenceWeightCount }}
                    </td>
                </tr>
            </table>
        </div>

        {{-- normalisasi bobot --}}
        <hr class="my-4 mx-auto">
        <div class="overflow-auto">
            <div class="flex justify-center mt-5">
                <span class="font-bold text-lg capitalize">Normalisasi bobot kriteria</span>
            </div>
            <table class="mx-auto text-center">
                <tr class="bg-primary">
                    <td class="px-4 py-1">Kriteria</td>
                    <td class="px-4 py-1">Bobot</td>
                </tr>
                @foreach ($criterias as $criteria)
                    <tr class="border border-gray-100 {{ $loop->even ? 'bg-gray-100' : '' }}">
                        <td class="px-2 py-1">{{ $criteria->name }}</td>
                        <td class="px-2 py-1">
                            {{ $criteria->weight . '/' . $criterias->sum('weight') . '=' . round($criteria->getNormalizedWeight(), 3) }}
                        </td>
                    </tr>
                @endforeach

                <tr class="border border-gray-200 font-bold">
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
        <div class="overflow-auto">
            <div class="flex justify-center mt-5">
                <span class="font-bold text-lg capitalize">Menentukan Vector S</span>
            </div>
            <table class="mx-auto">
                @foreach ($normalAlternatives as $alternative)
                    <tr class="align-top md:align-middle ">
                        <td class="px-2 py-1">S{{ $loop->index + 1 }}</td>
                        <td class="px-2 py-1">=</td>
                        <td class="px-2 py-1">
                            @foreach ($alternative['criterias'] as $alternativeCriteria)
                                @if ($alternativeCriteria['normalized_value'] == 0)
                                    @continue
                                @endif
                                <span> ({{ round($alternativeCriteria['normalized_value'], 3) }}
                                    <sup>
                                        {{ round($alternativeCriteria['normalized_weight'], 3) }}
                                    </sup>)
                                    {{ $loop->last ? '' : '*' }}</span>
                            @endforeach
                        </td>
                        <td class="px-2 py-1"> = </td>
                        <td class="px-2 py-1">
                            {{ round($alternative['vector_s'], 3) }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- menentukan vecktor V --}}
        <div class="overflow-auto">
            <span class="block text-center mt-3 text-xl font-bold">Menentukan nilai vektor V</span>
            <table class="mx-auto min-w-min">
                @foreach ($normalAlternatives as $alternative)
                    <tr>
                        <td class="px-2 py-1">V{{ $loop->index + 1 }}</td>
                        <td class="px-2 py-1">=</td>
                        <td class="px-2 py-1 flex flex-col text-center ">
                            <span>{{ round($alternative['vector_s'], 3) }}</span>
                            <hr>
                            <span>
                                @foreach ($normalAlternatives as $AD)
                                    {{ $loop->last ? round($AD['vector_s'], 3) : round($AD['vector_s'], 3) . ' +' }}
                                @endforeach
                            </span>
                        </td>
                        <td class="px-2 py-1">=</td>
                        <td class="flex flex-col px-2 py-1">
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
