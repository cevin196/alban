@extends('admin.layouts.app')

@section('content')
    <div class="flex gap-1 text-xl items-center text-[#444444]">
        <a href="{{ route('criteria.index') }}" class="font-bold">Criteria</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <a href="#">Create</a>
    </div>

    <div class="bg-white rounded p-5 mt-3 shadow-lg w-full">
        <span class="text-[#444444] font-bold text-lg">Create New Criteria</span>

        <form class="mt-3" method="POST" action="{{ route('criteria.store') }}">
            @csrf
            <div class="grid grid-cols-12 gap-x-3">
                <div class="form-group mb-3 col-span-4">
                    <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Name</label>
                    <input type="text" name="name"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputName" placeholder="Enter Name">
                    @error('name')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3 col-span-3">
                    <label for="inputWeight" class="form-label inline-block mb-2 text-gray-700">Weight</label>
                    <input type="number" name="weight"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputWeight" placeholder="Enter Weight">
                    <small id="emailHelp" class="block mt-1 text-xs text-gray-600">Weight must be integer between
                        1-5</small>
                    @error('weight')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3 col-span-3">
                    <label for="inputUnit" class="form-label inline-block mb-2 text-gray-700">Unit Measurement</label>
                    <input type="text" name="unit"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputUnit" placeholder="Enter Unit measurement">
                    @error('unit')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3 col-span-2">
                    <label for="role" class="form-label inline-block mb-2 text-gray-700">Type</label>
                    <select name="type"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option value="0">Cost</option>
                        <option value="1">Benefit</option>
                    </select>
                    @error('roles')
                        <small class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>


            </div>

            <div class="flex justify-center gap-3">
                <a href="{{ route('criteria.index') }}"
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
