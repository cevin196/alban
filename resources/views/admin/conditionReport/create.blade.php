@extends('admin.layouts.app')

@section('content')
    <div class="flex gap-1 text-xl items-center text-[#444444]">
        <a href="{{ route('alternative.index') }}" class="font-bold">Condition Report</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <a href="#">Create</a>
    </div>

    <div class="bg-white rounded p-5 mt-3 shadow-lg w-full">
        <span class="text-[#444444] font-bold text-lg">Create Condition Report</span>

        <form class="mt-3" method="POST" action="{{ route('conditionReport.store') }}">
            @csrf
            <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                <div class="form-group">
                    <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Name</label>
                    <input type="text" name="name"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputName" placeholder="Enter Name">
                    @error('name')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputName" class="form-label inline-block mb-2 text-gray-700">Date</label>
                    <input type="date" name="date"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="inputName" placeholder="Enter Name">
                    @error('date')
                        <small id="emailHelp" class="block mt-1 text-xs text-red-600">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <hr class="col-span-2 my-4">

            <div class="grid grid-cols-2 w-full gap-2">
                <div class="p-2 rounded border flex flex-col gap-1">
                    <div
                        class="h-72 bg-blue-100 text-white 
                        bg-[url('https://qph.cf2.quoracdn.net/main-qimg-ac7742eb9e0e18c3ae6df73e63e5a13b-lq')]">
                        <div
                            class="w-full h-full bg-black bg-opacity-40 opacity-0 hover:opacity-100 relative  flex justify-center items-center cursor-pointer">
                            Click to delete
                        </div>
                    </div>

                    <textarea name="description[]" class=" border-gray-300"></textarea>
                </div>

                <div class="p-2 rounded border flex flex-col gap-1">
                    <button type="button" class="flex justify-center items-center bg-gray-100 h-72">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-60 h-60 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <textarea name="description[]" class="border-gray-300"></textarea>
                </div>

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
