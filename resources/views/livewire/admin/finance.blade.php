<div class="bg-white rounded p-5 mt-3 shadow-lg">
    @include('includes.formater')
    <div class="flex justify-between items-center">
        <input type="search" wire:model.debounce.500ms="search"
            class="form-control block w-1/3 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="exampleSearch" placeholder="Cari Sesuatu..." />
        <a href="#" title="Create New" data-bs-toggle="modal" data-bs-target="#createFinanceModal"
            class="px-2 py-1 rounded bg-green-500 text-white hover:bg-green-600">
            Tambah Baru
        </a>

    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="w-full text-center mb-1 table-fixed">
                        <thead class="border-b bg-gray-50">
                            <tr>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 w-1/12">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 ">
                                    Deskripsi
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                                    Total
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                                    Tanggal
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4">
                                    Tipe
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 w-2/12">
                                    Aksi
                                </th>
                            </tr>
                        </thead class="border-b">
                        <tbody>
                            @foreach ($finances as $finance)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $loop->index + 1 }}</td>
                                    <td
                                        class="text-sm text-left text-gray-900 font-light px-6 py-4 whitespace-nowrap break-all text-ellipsis overflow-hidden max-w-md">
                                        {{ $finance->description }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                        Rp. {{ rupiah($finance->ammount) }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $finance->date }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap ">
                                        <span
                                            class="px-2 py-1 rounded text-white {{ $finance->type == 'Outcome' ? 'bg-red-500' : 'bg-green-500' }}">
                                            {{ $finance->type }}
                                        </span>
                                    </td>


                                    <td class="text-sm text-gray-900 font-light">
                                        <div class="flex justify-around">
                                            <a href="#" title="Edit" data-bs-toggle="modal"
                                                wire:click="confirmFinanceEdit({{ $finance }})"
                                                data-bs-target="#editFinanceModal">
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
                                                wire:click="confirmJobDeletion({{ $finance }})"
                                                data-bs-target="#deleteJobModal">
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
                    {{ $finances->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

    {{-- modal create --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        wire:key="bar" id="createFinanceModal" tabindex="-1" aria-labelledby="createFinanceModal" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="createFinanceModal">Tambah Data
                        Keuangan
                    </h5>
                    <button type="button"
                        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                        data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body relative p-4">
                    <div class="flex flex-col mb-3">
                        <label for="description">Deskripsi:</label>
                        <input type="text" wire:model="inputDescription" id="description" class="rounded"
                            placeholder="Ex: Beli sparepart exa">
                        @error('inputDescription')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="ammount">Total:</label>
                        <input type="text" wire:model="inputAmmount" id="ammount" class="rounded"
                            placeholder="Ex: 500000">
                        @error('inputAmmount')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="date">Tanggal:</label>
                        <input type="date" wire:model="inputDate" id="date" class="rounded">
                        @error('inputDate')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="type">Tipe:</label>
                        <select wire:model="inputType" id="type" class="rounded w-1/2">
                            <option value="">-- Select One --</option>
                            <option value="0">Income</option>
                            <option value="1">Outcome</option>
                        </select>
                        @error('inputType')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                        class="px-6 py-2.5 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal">Tutup</button>
                    <button type="button" wire:click.prevent="saveFinance()"
                        class="px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out ml-1">Simpan</button>
                </div>
            </div>
        </div>
    </div>


    {{-- modal update --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        wire:key="bar" id="editFinanceModal" tabindex="-1" aria-labelledby="editFinanceModal" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="editFinanceModal">Update Data
                        Keuangan</h5>
                    <button type="button"
                        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-4">
                    @if ($selectedFinance)
                        <div class="flex flex-col mb-3">
                            <label for="description">Deskripsi:</label>
                            <input type="text" wire:model="inputDescription" id="description" class="rounded">
                            @error('inputDescription')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-3">
                            <label for="ammount">Total:</label>
                            <input type="text" wire:model="inputAmmount" id="ammount" class="rounded">
                            @error('inputAmmount')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-3">
                            <label for="date">Tanggal:</label>
                            <input type="date" wire:model="inputDate" id="date" class="rounded">
                            @error('inputDate')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="type">Tipe:</label>
                            <select wire:model="inputType" id="type" class="rounded w-1/2">
                                <option value="">-- Select One --</option>
                                <option value="1">Income</option>
                                <option value="0">Outcome</option>
                            </select>
                            @error('inputType')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                        class="px-6 py-2.5 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal">Tutup</button>
                    <button type="button" wire:click.prevent="updateFinance()"
                        class="px-6 py-2.5 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out ml-1"
                        data-bs-dismiss="modal">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal delete --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        wire:key="bar" id="deleteJobModal" tabindex="-1" aria-labelledby="deleteJobModal" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="deleteJobModal">Hapus Data
                        Keuangan
                    </h5>
                    <button type="button"
                        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-4">
                    @if ($selectedFinance)
                        Apakah anda yakin menghapus data keuangan dari database?
                        <table>
                            <tr class="align-top">
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>{{ $selectedFinance->description }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>:</td>
                                <td>Rp.{{ rupiah($selectedFinance->ammount) }}</td>
                            </tr>
                            <tr>
                                <td>Tipe</td>
                                <td>:</td>
                                <td>
                                    <span
                                        class="px-2 py-1 rounded text-white {{ $selectedFinance->type == 'Outcome' ? 'bg-red-500' : 'bg-green-500' }}">
                                        {{ $selectedFinance->type }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    @endif
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                        class="px-6 py-2.5 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal">Tutup</button>
                    <button type="button" wire:click.prevent="deleteJob()"
                        class="px-6 py-2.5 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out ml-1"
                        data-bs-dismiss="modal">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
