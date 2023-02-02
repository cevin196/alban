<div class="bg-white rounded p-5 mt-3 shadow-lg">
    <div class="flex justify-between items-center">
        <input type="search" wire:model.debounce.500ms="search"
            class="form-control block w-1/3 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="exampleSearch" placeholder="Search Something..." />
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-center mb-1">
                        <thead class="border-b bg-gray-50">
                            <tr>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 w-1/12">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                                    Name
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                                    Description
                                </th>
                            </tr>
                        </thead class="border-b">
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer"
                                    wire:click="permissionsDetail({{ $permission }})" data-bs-toggle="modal"
                                    data-bs-target="#detailPermissionModal">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $loop->index + 1 }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $permission->name }}
                                    </td>
                                    <td
                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap break-all text-left text-ellipsis overflow-hidden max-w-md">
                                        {{ $permission->description }}
                                    </td>
                                </tr class="bg-white border-b">
                            @endforeach
                        </tbody>
                    </table>
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        wire:key="bar" id="detailPermissionModal" tabindex="-1" aria-labelledby="detailPermissionModal"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="detailPermissionModal">
                        {{ $selectedPermission ? $selectedPermission->name . ' detail' : '' }}
                    </h5>
                    <button type="button"
                        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-4">
                    {{ $selectedPermission ? $selectedPermission->description : '' }}
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                        class="px-6 py-2.5 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

</div>
