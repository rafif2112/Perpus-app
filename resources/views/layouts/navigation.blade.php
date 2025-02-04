<!-- Navigation Sidebar -->
<navbar x-show="sidebarOpen" @click.away="sidebarOpen = false" id="sidebar" 
     class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:static lg:inset-0 lg:translate-x-0"
    :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" x-data="{ sidebarOpen: true }">
    
    <!-- Logo -->
    <div class="flex items-center justify-center -ml-5 mt-8">
        <img src="{{ asset('assets/images/icon/logo.png') }}" alt="Logo" class="h-12 w-12">
        <div class="ml-4 text-2xl font-semibold text-white">PerpusApp</div>
    </div>

    <!-- Navigation Links -->
    <nav class="fixed my-10 inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:static lg:inset-0 lg:translate-x-0">
        @if (Auth::user())
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-2 mt-4 text-gray-300 transition-colors duration-200 transform hover:bg-gray-700 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                    <ion-icon class="text-xl" name="bar-chart-outline"></ion-icon>
                    <span class="mx-3">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.daftar-buku.index') }}" class="flex items-center px-6 py-2 mt-4 text-gray-300 transition-colors duration-200 transform hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.daftar-buku.index') ? 'bg-gray-700' : '' }}">
                    <ion-icon class="text-xl" name="book-outline"></ion-icon>
                    <span class="mx-3">Daftar Buku</span>
                </a>

                <a href="{{ route('admin.kelola-akun.index') }}" class="flex items-center px-6 py-2 mt-4 text-gray-300 transition-colors duration-200 transform hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.kelola-akun.index') ? 'bg-gray-700' : '' }}">
                    <ion-icon class="text-xl" name="person-outline"></ion-icon>
                    <span class="mx-3">Kelola Akun</span>
                </a>

                <a href="{{ route('admin.peminjaman.index') }}" class="flex items-center px-6 py-2 mt-4 text-gray-300 transition-colors duration-200 transform hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.peminjaman.index') ? 'bg-gray-700' : '' }}">
                    <ion-icon class="text-xl" name="time-outline"></ion-icon>
                    <span class="mx-3">Riwayat Peminjaman</span>
                </a>

            @elseif (Auth::user()->role == 'user')
                <a href="{{ route('home') }}" class="flex items-center px-6 py-2 mt-4 text-gray-300 transition-colors duration-200 transform hover:bg-gray-700 hover:text-white {{ request()->routeIs('home') ? 'bg-gray-700' : '' }}">
                    <ion-icon class="text-xl" name="home-outline"></ion-icon>
                    <span class="mx-3">{{ __('Home') }}</span>
                </a>
            @endif
        @else
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-2 mt-4 text-gray-300 transition-colors duration-200 transform hover:bg-gray-700 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                <ion-icon class="text-xl" name="bar-chart-outline"></ion-icon>
                <span class="mx-3">Dashboard</span>
            </a>
        @endif
    </nav>

    <!-- Settings Dropdown -->
    <div class="w-full px-6 py-4 border-t border-gray-700">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center w-full px-4 py-2 text-sm font-medium text-left text-gray-300 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150">
                    <img src="{{ asset('assets/images/profile/image.jpg') }}" alt="User Avatar" class="w-10 h-10 rounded-full">
                    <div class="ml-3">{{ Auth::user()->name }}</div>
                    <div class="ml-auto">
                        <ion-icon class="w-4 h-4" name="chevron-down-outline"></ion-icon>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Logout -->
                <x-dropdown-link :href="route('logout')">
                    {{ __('Log Out') }}
                </x-dropdown-link>
                
                {{-- <form method="POST" action="{{ route('logout') }}">
                    @csrf
                </form> --}}
            </x-slot>
        </x-dropdown>
    </div>
</navbar>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const sidebarOpen = sidebar.__x.$data.sidebarOpen;

        if (window.innerWidth >= 1024) {
            sidebarOpen = true;
        }

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024) {
                sidebarOpen = true;
            } else {
                sidebarOpen = false;
            }
        });
    });
</script>