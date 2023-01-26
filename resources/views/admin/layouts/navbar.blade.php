<nav class="flex justify-between items-center px-5 py-1 bg-white border w-full fixed z-10">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
        <img src="{{ asset('images/public/Logo.png') }}" alt="Company Logo" class="w-12 lg:w-16">
        <span class="text-xl lg:text-2xl font-bakbakOne ">Alban Technik Mandiri</span>
    </a>

    <button class="block lg:hidden" onclick="menu(this)" name="opened">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    <div class="hidden lg:flex justify-between items-center gap-3">
        <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('images/profiles/user1.jpg') }}" alt="Profile picture"
                class="w-12 h-12 rounded-full bg-contain bg-center cursor-pointer">
        </button>
        <ul class="dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-xl mt-1 m-0 bg-clip-padding border-gray-400"
            aria-labelledby="dropdownMenuButton1">
            <li class="p-3 font-bold capitalize">{{ auth()->user()->name }}</li>
            <li class="p-3 flex justify-between">
                @foreach (auth()->user()->getRoleNames() as $role)
                    <span>{{ $role }}</span>
                @endforeach
            </li>
            <li>
                <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                    href="#">Profile</a>
            </li>
            <li>
                <a href="#" type="button"
                    class="px-6 py-2.5 bg-red-500 text-white rounded shadow-md hover:bg-red-600 hover:shadow-lg focus:bg-red-600 focus:shadow-lg focus:outline-none focus:ring-0 
                    active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out flex justify-between items-center"
                    data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <span class="text-white">Log Out</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-box-arrow-right text-white ml-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                        <path fill-rule="evenodd"
                            d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div
                class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="logoutModalLabel">Logout</h5>
                <button type="button"
                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body relative p-4">
                Are you sure want to log out?
            </div>
            <div
                class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md gap-3">
                <button type="button"
                    class="px-6 py-2.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out"
                    data-bs-dismiss="modal">Close</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex justify-between px-4 py-2 text-sm bg-red-500 hover:bg-red-600 text-white rounded">
                        Confirm
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
