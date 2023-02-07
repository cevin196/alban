@extends('admin.layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('select2-4.1.0-rc.0/dist/css/select2.min.css') }}">
    <script src="{{ asset('select2-4.1.0-rc.0/dist/js/select2.min.js') }}"></script>
@endsection
@inject('alternativeCriteria', 'App\Models\Admin\AlternativeCriteria')
@section('content')
    <div class="flex gap-1 text-xl items-center text-[#444444]">
        <a href="{{ route('alternative.index') }}" class="font-bold">Alternative</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <a href="#">Edit</a>
    </div>

    <div class="bg-white rounded p-5 mt-3 shadow-lg w-full">
        <span class="text-[#444444] font-bold text-lg">Edit Alternative</span>

        <form class="mt-3" method="POST" action="{{ route('alternative.update', $alternative) }}">
            @csrf @method('put')
            <div class="grid grid-cols-2 gap-x-3">
                <div class="form-group mb-3">
                    <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Name</label>
                    <input type="text" name="name"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputName" placeholder="Enter Name" value="{{ $alternative->name }}">
                    @error('name')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="role" class="form-label inline-block mb-2 text-gray-700">Permission</label>
                    <select name="job_id"
                        class="js-example-placeholder-single  form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option value="" {{ $alternative->job_id ? '' : 'selected' }}>Please Select</option>
                        @foreach ($jobs as $job)
                            <option value="{{ $job->id }}" {{ $alternative->job_id == $job->id ? 'selected' : '' }}>
                                {{ $job->unit_part_number }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles')
                        <small class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <hr class="col-span-2 my-2">


                @foreach ($criterias as $criteria)
                    <div class="form-group mb-3">
                        <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Criteria
                            <span class="text-amber-500">{{ $criteria->name }}</span></label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="{{ 'criteria' . $criteria->id }}"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="inputName" placeholder="Enter Name" required
                                value="{{ $alternativeCriteria->where(['alternative_id' => $alternative->id, 'criteria_id' => $criteria->id])->first()->value }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                                class="bi bi-info-circle text-blue-600 cursor-pointer hover:text-blue-500"
                                viewBox="0 0 16 16" data-bs-toggle="popover" data-bs-title="Popover title"
                                data-bs-content="{{ $criteria->description }}">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                        </div>
                    </div>
                @endforeach

            </div>


            <div class="flex justify-center gap-3">
                <a href="{{ route('alternative.index') }}"
                    class="px-6 py-2.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md 
                hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 
                active:shadow-lg transition duration-150 ease-in-out">Back</a>
                <button type="submit"
                    class="px-6 py-2.5 bg-amber-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md 
                hover:bg-amber-600 hover:shadow-lg focus:bg-amber-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-amber-700 
                active:shadow-lg transition duration-150 ease-in-out">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.js-example-placeholder-single').select2({
                placeholder: "Select Job Name",
                allowClear: true
            });
        });
    </script>
@endsection
