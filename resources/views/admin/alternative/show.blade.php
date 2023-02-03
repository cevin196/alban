@extends('admin.layouts.app')

@section('content')
    <div class="flex gap-1 text-xl items-center text-[#444444]">
        <a href="{{ route('alternative.index') }}" class="font-bold">Alternative</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <a href="#">Show</a>
    </div>

    <div class="bg-white rounded p-5 mt-3 shadow-lg md:w-2/3 mx-auto">
        <span class="text-[#444444] font-bold text-lg">Alternative Detail</span>

        <table class="h-full">
            <tr>
                <td>Name</td>
                <td>:</td>
                <td>{{ $alternative->name }}</td>
            </tr>
            @if ($alternative->job_id)
                <tr>
                    <td>Job</td>
                    <td>:</td>
                    <td>{{ $alternative->job->unit_part_number }}</td>
                </tr>
            @endif
        </table>

        <div class="flex justify-center">
            <a href="{{ route('alternative.index') }}" class="px-4 py-1 rounded bg-gray-500 text-white">Back</a>
        </div>
    </div>
@endsection
