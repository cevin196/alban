@extends('admin.layouts.app')

@section('content')
    <div class="flex gap-1 text-xl items-center text-[#444444]">
        <a href="{{ route('alternative.index') }}" class="font-bold">Alternatif</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <a href="#">Detail</a>
    </div>

    <div class="bg-white rounded p-5 mt-3 shadow-lg md:w-2/3 mx-auto">
        <span class="text-[#444444] font-bold text-lg">Detail Alternatif</span>

        <div class="flex justify-between items-center mb-3">
            <span>Nama: {{ $alternative->name }}</span>
            @if ($alternative->job)
                <a href="{{ route('job.show', $alternative->job_id) }}"
                    class="bg-primary text-white rounded p-1 hover:bg-amber-600">Detail Pekerjaan</a>
            @endif
        </div>

        <div class="flex justify-center">
            <span class="font-bold">Nilai Kriteria</span>
        </div>

        <table class="lg:w-1/2 mx-auto mb-3">
            @foreach ($alternative->criterias as $alternativeCriteria)
                <tr class="{{ $loop->even ? 'bg-gray-200' : '' }} border-y">
                    <td>{{ $alternativeCriteria->name }} </td>
                    <td>:</td>
                    <td>{{ $alternativeCriteria->pivot->value }}</td>
                </tr>
            @endforeach
        </table>

        <div class="flex justify-center gap-2">
            <a href="{{ route('alternative.index') }}"
                class="px-4 py-1 rounded bg-gray-500 hover:bg-gray-600 text-white">Kembali</a>
            <a href="{{ route('alternative.edit', $alternative) }}"
                class="px-4 py-1 rounded bg-primary hover:bg-amber-600 text-white">Ubah Nilai</a>
        </div>
    </div>
@endsection
