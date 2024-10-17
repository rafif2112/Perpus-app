<!-- Sidebar -->
<nav :class="sidebarOpen ? 'block' : 'hidden'" class="top-0 left-0 bg-gray-900 text-white w-64 space-y-6 py-7 px-2 lg:block z-50">
    <!-- Logo -->
    <div class="flex items-center space-x-2 px-4">
        <a href="#" class="text-2xl font-semibold">
            PerusApp
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="space-y-2">
        @if (Auth::user())
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('dashboard') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-800 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 9v-6h4v6m-4 0h4" />
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.daftar-buku.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-800 {{ request()->routeIs('admin.daftar-buku.index') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5zm0-10l9-5-9-5-9 5 9 5z" />
                    </svg>
                    <span class="ml-3">Daftar Buku</span>
                </a>

                <a href="{{ route('admin.kelola-akun.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-800 {{ request()->routeIs('admin.kelola-akun.index') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196zM12 7a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <span class="ml-3">Kelola Akun</span>
                </a>

                <a href="{{ route('admin.peminjaman.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-800 {{ request()->routeIs('admin.peminjaman.index') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V5a1 1 0 00-1-1H9a1 1 0 00-1 1v6M5 11h14M5 11a2 2 0 012-2h10a2 2 0 012 2M5 11v10a2 2 0 002 2h10a2 2 0 002-2V11" />
                    </svg>
                    <span class="ml-3">Riwayat Peminjaman</span>
                </a>

            @elseif (Auth::user()->role == 'user')
                <a href="{{ route('home') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-800 {{ request()->routeIs('home') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 9v-6h4v6m-4 0h4" />
                    </svg>
                    <span class="ml-3">{{ __('Home') }}</span>
                </a>
            @endif
        @else
            <a href="{{ route('dashboard') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-800 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 9v-6h4v6m-4 0h4" />
            </svg>
            <span class="ml-3">Dashboard</span>
            </a>
        @endif
    </div>

    <!-- Settings Dropdown -->
    <div class="w-full px-6 py-4 border-t border-gray-700">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center w-full px-4 py-2 text-sm font-medium text-left text-gray-300 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150">
                    <img src="{{asset('assets/images/profile/image.jpg')}}" alt="User Avatar" class="w-10 h-10 rounded-full">
                    <div class="ml-3">{{ Auth::user()->name }}</div>
                    <div class="ml-auto">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" fill="white" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>