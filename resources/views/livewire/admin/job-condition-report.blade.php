<div class="grid grid-cols-2 w-full gap-2 mb-3">
    @foreach ($conditionReportPictures as $conditionReportPicture)
        <div class="p-2 border flex flex-col gap-1">
            <div class="h-72" style="background-image: url('{{ asset($conditionReportPicture['path']) }}')">
                <div
                    class="w-full h-full text-white bg-black bg-opacity-40 opacity-0 hover:opacity-100 flex justify-center items-center cursor-pointer">
                    Click to delete
                </div>
            </div>

            <textarea name="description[]" class=" border-gray-300"></textarea>
        </div>
    @endforeach

    <div class="p-2 border flex flex-col gap-1">
        @if ($newPicture)
            <div class="h-72 "
                style="background-image: url('{{ $newPicture->temporaryUrl() }}'); background-position: center;background-repeat: no-repeat; background-size: contain">
                <div
                    class="w-full h-full text-white bg-black bg-opacity-40 opacity-0 hover:opacity-100 flex justify-center items-center cursor-pointer">
                    Click to delete
                </div>
            </div>

            <textarea name="description[]" class=" border-gray-300"></textarea>
        @else
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-72 border-2 border-gray-300 border-dashed cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="font-semibold">Click to upload</span>
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)
                        </p>
                    </div>
                    <input wire:model="newPicture" id="dropzone-file" type="file" class="hidden" />
                </label>
            </div>
            <textarea wire:model="newDescription" class="border-gray-300"></textarea>
        @endif
        {{-- <button class="bg-green-500 text-white py-2">Submit</button> --}}
    </div>

</div>
