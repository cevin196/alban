<div class="bg-white rounded p-5 mt-3 shadow-lg">
    <div class="flex justify-between items-center">
        <input type="search" wire:model.debounce.500ms="search"
            class="form-control block w-1/3 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="exampleSearch" placeholder="Search Something..." />
        <a href="{{ route('criteria.create') }}" class="px-2 py-1 rounded bg-green-500 text-white hover:bg-green-600">Add
            New</a>
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
                                    Weight
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                                    Measurement Unit
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                                    Type
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 w-2/12">
                                    Action
                                </th>
                            </tr>
                        </thead class="border-b">
                        <tbody>
                            @foreach ($criterias as $criteria)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $loop->index + 1 }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $criteria->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $criteria->weight }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $criteria->unit }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $criteria->type }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light">
                                        <div class="flex justify-around">
                                            {{-- <a href="{{ route('criteria.show', $criteria->id) }}" title="Show Detail"
                                                class="transition duration-150 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-eye text-blue-700"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg>
                                            </a> --}}
                                            <a href="{{ route('criteria.edit', $criteria) }}" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-pencil-square text-amber-500"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </a>

                                            <a href="#" title="Delete" data-bs-toggle="modal"
                                                wire:click="confirmCriteriaDeletion({{ $criteria }})"
                                                data-bs-target="#deleteCriteriaModal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-trash3-fill text-red-500"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr class="bg-white border-b">
                            @endforeach
                        </tbody>
                    </table>
                    {{ $criterias->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        wire:key="bar" id="deleteCriteriaModal" tabindex="-1" aria-labelledby="deleteCriteriaModal" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="deleteCriteriaModal">Delete User
                    </h5>
                    <button type="button"
                        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-4">
                    Are you sure want to delete <span
                        class="text-amber-500">{{ $selectedCriteria ? $selectedCriteria->name : '' }}</span> from
                    Criteria
                    table?
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                        class="px-6 py-2.5 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="deleteCriteria()"
                        class="px-6 py-2.5 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out ml-1"
                        data-bs-dismiss="modal">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
