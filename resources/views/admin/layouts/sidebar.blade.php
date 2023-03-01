@inject('alternativeModel', 'App\Models\Admin\Alternative')
<div class="w-full lg:w-1/6 hidden lg:block h-full lg:top-0 pt-10 lg:pt-5 shadow-md bg-white fixed transition-all ease-in-out 
    duration-500 bg-bottom bg-no-repeat bg-contain"
    style="background-image: url('{{ asset('images/public/layerSidebar.png') }}')" id="sideNav">
    <a href="{{ route('dashboard') }}" class="hidden lg:flex items-center gap-3 px-6">
        <img src="{{ asset('images/public/Logo.png') }}" alt="Company Logo" class="w-12 lg:w-20 mx-auto ">

    </a>
    <ul class="relative px-1">
        <li class="relative" id="sidenavSecEx1">
            <a class="flex items-center text-sm py-4 px-6 h-12
            overflow-hidden {{ request()->routeIs('dashboard') ? 'text-amber-500' : 'text-gray-700' }} text-ellipsis whitespace-nowrap rounded hover:text-amber-500 transition
            duration-300 ease-in-out "
                href="{{ route('dashboard') }}" data-mdb-ripple="true" data-mdb-ripple-color="orange">
                <span class="font-bold">Dashboard</span>
            </a>
        </li>
        <li class="relative" id="sidenavSecEx2">
            <a href="{{ route('finance.index') }}"
                class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-amber-500 transition duration-300 ease-in-out cursor-pointer"
                data-mdb-ripple="true" data-mdb-ripple-color="orange">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-2 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                </svg>
                <span>Finance</span>
            </a>
        </li>
        <li class="relative" id="sidenavSecEx3">
            <a href="{{ route('job.index') }}"
                class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-amber-500 transition duration-300 ease-in-out cursor-pointer"
                data-mdb-ripple="true" data-mdb-ripple-color="orange">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-2 text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                </svg>

                <span>Jobs</span>
            </a>
        </li>

        <li class="relative" id="SideNavUser">
            <a href="{{ route('user.index') }}"
                class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden {{ request()->routeIs(['user*', 'role*', 'permission*']) ? 'text-amber-500' : 'text-gray-700' }} text-ellipsis whitespace-nowrap rounded hover:text-amber-500 transition duration-300 ease-in-out cursor-pointer"
                data-mdb-ripple="true" data-mdb-ripple-color="orange" data-bs-toggle="collapse"
                data-bs-target="#collapseSidenavUser" aria-expanded="false" aria-controls="collapseSidenavUser">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="comments"
                    class="w-5 h-5 mr-2 text-amber-500" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>

                <span>User</span>
                <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 ml-auto" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor"
                        d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z">
                    </path>
                </svg>
            </a>
            <ul class="relative accordion-collapse collapse" id="collapseSidenavUser" aria-labelledby="sidenavSecEx3"
                data-bs-parent="#sideNav">
                <li class="relative">
                    <a href="{{ route('user.index') }}"
                        class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden {{ request()->routeIs('user.index') ? 'text-amber-500' : 'text-gray-700' }} text-ellipsis whitespace-nowrap rounded hover:text-amber-500 transition duration-300 ease-in-out"
                        data-mdb-ripple="true" data-mdb-ripple-color="orange">Users</a>
                </li>
                <li class="relative">
                    <a href="{{ route('role.index') }}"
                        class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden {{ request()->routeIs('role.index') ? 'text-amber-500' : 'text-gray-700' }} text-ellipsis whitespace-nowrap rounded hover:text-amber-500 transition duration-300 ease-in-out"
                        data-mdb-ripple="true" data-mdb-ripple-color="orange">Roles</a>
                </li>
                <li class="relative">
                    <a href="{{ route('permission.index') }}"
                        class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden {{ request()->routeIs('permission.index') ? 'text-amber-500' : 'text-gray-700' }} text-ellipsis whitespace-nowrap rounded hover:text-amber-500 transition duration-300 ease-in-out"
                        data-mdb-ripple="true" data-mdb-ripple-color="orange">Permission</a>
                </li>
            </ul>
        </li>

    </ul>
    <hr class="my-2">
    @php
        $status = true;
        $alternatives = $alternativeModel->all();
        foreach ($alternatives as $alternative) {
            $alternative->checkStatus() ? '' : ($status = false);
        }
    @endphp
    <ul class="relative px-1">
        <li class="relative">
            <a class="flex items-center {{ $status ? '' : 'bg-gray-400 hover:text-gray-700' }} text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-amber-500 transition duration-300 ease-in-out "
                href="{{ $status ? route('jobPriority.index') : '#' }}" data-mdb-ripple="true"
                data-mdb-ripple-color="{{ $status ? 'orange' : '' }}">
                <span class="font-bold">Job Priority</span>
            </a>
        </li>
        <li class="relative" id="sidenavXxEx2">
            <a href="{{ route('alternative.index') }}"
                class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 {{ request()->routeIs(['alternative*']) ? 'text-amber-500' : 'text-gray-700' }} text-ellipsis whitespace-nowrap rounded hover:text-amber-500 transition duration-300 ease-in-out cursor-pointer"
                data-mdb-ripple="true" data-mdb-ripple-color="orange">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-2 text-amber-800">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                </svg>

                <span>Alternatives</span>
            </a>
        </li>
        <li class="relative" id="sidenavXxEx3">
            <a href="{{ route('criteria.index') }}"
                class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 {{ request()->routeIs(['criteria*']) ? 'text-amber-500' : 'text-gray-700' }} text-ellipsis whitespace-nowrap rounded hover:text-amber-500 transition duration-300 ease-in-out cursor-pointer"
                data-mdb-ripple="true" data-mdb-ripple-color="orange">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-2 text-amber-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>


                <span>Criterias</span>

            </a>

        </li>
    </ul>
    <div class="text-center bottom-0 absolute w-full bg-white">
        <hr class="m-0">
        <p class="py-2 text-sm text-gray-700">© Cevin Tamamilang</p>
    </div>
</div>
