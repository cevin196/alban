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
                            </tr>
                        </thead class="border-b">
                        <tbody>
                            @foreach ($permissions as $permission)
                                <a href="#">
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $loop->index + 1 }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $permission->name }}
                                        </td>

                                    </tr class="bg-white border-b">
                                </a>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
