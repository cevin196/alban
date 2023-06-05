@extends('user.layouts.app')

@section('content')
    <div class="bg-white p-5 w-75 mx-auto">
        <h2 class="text-center">Update Pekerjaan Terakhir</h2>
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nomor Unit</th>
                    <th scope="col">Sedang Dilakukan</th>
                    <th scope="col">Status Pengerjaan</th>
                    <th scope="col">Condition Report</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $job->serial_number }}</td>
                        <td>{{ $job->doing }}</td>
                        <td>{{ $job->status }}</td>
                        <td>
                            @if ($job->conditionReports()->exists())
                                <a href="{{ route('conditionReport.print', $job->conditionReports->first()->id) }}"
                                    class="px-2 py-1 rounded bg-primary text-white">
                                    Pergi
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
