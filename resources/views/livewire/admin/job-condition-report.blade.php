<div>
    <div class="grid grid-cols-1 md:grid-cols-2 w-full gap-2 mb-3">
        @foreach ($conditionReportDetails as $conditionReportDetail)
            <div class="p-2 border flex flex-col gap-1">
                <div class="h-72"
                    style="background-image: url('{{ asset('storage/conditionReport/' . $conditionReportDetail['path']) }}');background-position: center;background-repeat: no-repeat; background-size: contain">
                    <a href="#" title="Delete" data-bs-toggle="modal"
                        wire:click="confirmConditionReportDetailDeletion({{ $conditionReportDetail['id'] }})"
                        data-bs-target="#deleteConditionReportModal">
                        <div
                            class="w-full h-full text-white bg-black bg-opacity-40 opacity-0 hover:opacity-100 flex justify-center items-center cursor-pointer">
                            Click to delete
                        </div>
                    </a>
                </div>

                <textarea class=" border-gray-300">{{ $conditionReportDetail['description'] }}</textarea>
            </div>
        @endforeach

        <div class="p-2 border flex flex-col gap-1">
            <div class="flex items-center justify-center w-full">
                <div
                    class="flex flex-col items-center justify-center w-full h-72 border-2 border-gray-300 border-dashed cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <a href="#" title="Create New" data-bs-toggle="modal"
                        data-bs-target="#createConditionReportModal"
                        class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-20 h-2w-20 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                        </svg>

                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="font-semibold">Add New Data</span>
                        </p>
                    </a>
                    {{-- <input wire:model="newPicture" id="dropzone-file" type="file" class="hidden" /> --}}
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div wire:key="bar" wire:ignore.self
        class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        id="createConditionReportModal" tabindex="-1" aria-labelledby="createConditionReportModal" aria-hidden="true">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="createConditionReportModal">Create
                        Add new data
                    </h5>
                    <button type="button"
                        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-4">

                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-72 border-2  border-dashed cursor-pointer 
                                hover:bg-bray-800 bg-gray-700  border-gray-600 hover:border-gray-500 hover:bg-gray-600
                                hover:bg-blend-darken"
                            @if ($newPicture) style="background-image: url('{{ $newPicture->temporaryUrl() }}'); background-position: center;background-repeat: no-repeat; background-size: contain" @endif>
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 ">

                                @if ($newPicture)
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">Click to change</span>
                                    </p>
                                @else
                                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">Click to upload</span>
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                        800x400px)
                                    </p>
                                @endif
                            </div>
                            <input wire:model="newPicture" id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>
                    @error('newPicture')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <textarea wire:model.lazy="newDescription" class="border-gray-300 w-full mt-1"></textarea>
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                        class="px-6 py-2.5 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="saveConditionReport()"
                        class="px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out ml-1"
                        data-bs-dismiss="modal">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal delete-->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        wire:key="bar" id="deleteConditionReportModal" tabindex="-1" aria-labelledby="deleteConditionReportModal"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="deleteConditionReportModal">Delete
                        User
                    </h5>
                    <button type="button"
                        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-4">
                    Are you sure want to delete this data?
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                        class="px-6 py-2.5 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal">Close</button>
                    @if ($selectedConditionReport)
                        <button type="button" wire:click.prevent="deleteConditionReport()"
                            class="px-6 py-2.5 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out ml-1"
                            data-bs-dismiss="modal">
                            Confirm
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @if ($newPicture)
        <div class="h-72"
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
    @endif --}}
