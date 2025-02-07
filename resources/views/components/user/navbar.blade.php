<nav class="bg-white border-gray-200 shadow-md">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap">PerpusApp</span>
        </a>
        <div class="flex gap-4 items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-11 h-11 rounded-full" src="{{asset('assets/images/profile/image.jpg')}}" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden w-52 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900">{{ Auth::user()->name }}</span>
                    <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="{{route('profile.edit')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                    </li>
                    <li>
                        <a href="{{route('saved')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Disimpan</a>
                    </li>
                    <hr class="pb-2">
                    <li>
                        <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100">Keluar</a>
                    </li>
                </ul>
            </div>
            <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white md:dark:bg-gray-900">
                <li>
                    <a href="{{route('home')}}" class="block py-2 px-1 text-black {{ request()->routeIs('home') ? 'active text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : '' }}">Beranda</a>
                </li>
                <li>
                    <a href="{{route('daftar-buku')}}" class="block py-2 px-1 text-black {{ request()->routeIs('daftar-buku') ? 'active text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : '' }}">Daftar Buku</a>
                </li>
                <li>
                    <a href="{{route('buku-saya')}}" class="block py-2 px-1 text-black {{ request()->routeIs('buku-saya') ? 'active text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : '' }}">Buku Saya</a>
                </li>
            </ul>
        </div>
    </div>
</nav>