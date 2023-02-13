@extends('admin.layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('select2-4.1.0-rc.0/dist/css/select2.min.css') }}">
    <script src="{{ asset('select2-4.1.0-rc.0/dist/js/select2.min.js') }}"></script>
@endsection

@section('content')
    <div class="flex gap-1 text-xl items-center text-[#444444]">
        <a href="{{ route('job.index') }}" class="font-bold">Job</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <a href="#">Edit</a>
    </div>

    <div class="bg-white rounded p-5 mt-3 shadow-lg w-full">
        <span class="text-[#444444] font-bold text-lg">Edit Job</span>

        <form class="mt-3" method="POST" action="{{ route('job.update', $job) }}">
            @csrf @method('put')
            <div class="grid grid-cols-3 gap-x-4 gap-y-2">
                <div class="form-group">
                    <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Name</label>
                    <input type="text" name="name"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputName" placeholder="Enter Name" value="{{ $job->name }}">
                    @error('name')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Serial Number</label>
                    <input type="text" name="serial_number"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputName" placeholder="Enter Serial Number" value="{{ $job->serial_number }}">
                    @error('serial_number')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role" class="form-label inline-block mb-2 text-gray-700">Unit Kilometer</label>
                    <input type="number" name="unit_kilometer"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputName" placeholder="Enter Customer Name" value="{{ $job->unit_kilometer }}">
                    @error('unit_kilometer')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Customer Name</label>
                    <input type="text" name="customer_name" list="customers"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputName" placeholder="Enter Customer Name" value="{{ $job->customer_name }}">
                    @error('customer_name')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror

                    <datalist id="customers">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                        @endforeach
                    </datalist>
                </div>

                <div class="form-group">
                    <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Date In</label>
                    <input type="date" name="date_in"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputName" placeholder="Enter Serial Number" value="{{ $job->date_in }}">
                    @error('date_in')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Date Out</label>
                    <input type="date" name="date_out"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputName" placeholder="Enter Serial Number" value="{{ $job->date_out }}">
                    <small id="emailHelp" class="block mt-1 text-xs text-gray-600">* Not required</small>
                    @error('date_out')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Status</label>
                    <select name="status"
                        class="form-control w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option value="">-- Select One --</option>
                        <option value="To Do" {{ $job->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                        <option value="Doing" {{ $job->status == 'Doing' ? 'selected' : '' }}>Doing</option>
                        <option value="Done" {{ $job->status == 'Done' ? 'selected' : '' }}>Done</option>
                        <option value="Canceled" {{ $job->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                    <small id="emailHelp" class="block mt-1 text-xs text-gray-600">* Not required</small>
                    @error('status')
                        <small class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>


            </div>
            @livewire('admin.job-edit', ['job' => $job])

            <div class="flex justify-center gap-3">
                <a href="{{ route('job.index') }}"
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
    <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-placeholder-single').select2({
                placeholder: "Select Job by name",
                allowClear: true
            });

            var popoverTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="popover"]')
            );
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new Popover(popoverTriggerEl);
            });
        });
    </script>
@endsection
