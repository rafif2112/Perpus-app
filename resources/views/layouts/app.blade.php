<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/icon/logo.png') }}">
</head>

<body>
    <div class="h-screen flex bg-gray-100">
        <div x-data="{ sidebarOpen: false }" class="flex w-full">
            <!-- Sidebar Overlay -->
            <div x-show="sidebarOpen" 
                 @click="sidebarOpen = false"
                 class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden">
            </div>
        
            <!-- Sidebar -->
            <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" 
            class="fixed inset-y-0 left-0 z-20 w-64 transform bg-gray-900 text-white transition-transform md:static md:translate-x-0 overflow-y-auto">
                
                <!-- Logo Section -->
                <div class="flex h-20 items-center justify-center border-b border-gray-800">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/images/icon/logo.png') }}" alt="Logo" class="h-12 w-12">
                        <span class="ml-3 text-2xl font-semibold text-white">PerpusApp</span>
                    </div>
                </div>
        
                <!-- Navigation Links -->
                <nav class="mt-6 space-y-2 px-4">
                    @auth
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('dashboard') }}" 
                               class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-300 transition-all duration-200 
                                      {{ request()->routeIs('dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                                <ion-icon name="bar-chart-outline" class="text-xl"></ion-icon>
                                <span class="font-medium">Dashboard</span>
                            </a>
        
                            <a href="{{ route('admin.daftar-buku.index') }}" 
                               class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-300 transition-all duration-200 
                                      {{ request()->routeIs('admin.daftar-buku.index') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                                <ion-icon name="book-outline" class="text-xl"></ion-icon>
                                <span class="font-medium">Daftar Buku</span>
                            </a>
        
                            <a href="{{ route('admin.kelola-akun.index') }}" 
                               class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-300 transition-all duration-200 
                                      {{ request()->routeIs('admin.kelola-akun.index') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                                <ion-icon name="person-outline" class="text-xl"></ion-icon>
                                <span class="font-medium">Kelola Akun</span>
                            </a>
        
                            <a href="{{ route('admin.peminjaman.index') }}" 
                               class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-300 transition-all duration-200 
                                      {{ request()->routeIs('admin.peminjaman.index') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                                <ion-icon name="time-outline" class="text-xl"></ion-icon>
                                <span class="font-medium">Riwayat Peminjaman</span>
                            </a>
                            
                        @elseif (Auth::user()->role == 'user')
                            <a href="{{ route('home') }}" 
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-300 transition-all duration-200 
                                    {{ request()->routeIs('home') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                                <ion-icon name="home-outline" class="text-xl"></ion-icon>
                                <span class="font-medium">{{ __('Home') }}</span>
                            </a>
                        @endif
                    @endauth
                </nav>
        
                <!-- User Profile Section -->
                @auth
                <div class="absolute w-full border-t border-gray-800 bg-gray-900 p-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex w-full items-center rounded-md px-4 py-3 text-gray-300 transition-all duration-200 hover:bg-gray-800 hover:text-white">
                                <img src="{{ asset('assets/images/profile/image.jpg') }}" 
                                    alt="{{ Auth::user()->name }}" 
                                    class="h-8 w-8 rounded-full object-cover">
                                <span class="ml-3 text-sm font-medium">{{ Auth::user()->name }}</span>
                                <ion-icon name="chevron-down-outline" class="ml-auto h-4 w-4"></ion-icon>
                            </button>
                        </x-slot>
        
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                                <ion-icon name="person-outline"></ion-icon>
                                <span>{{ __('Profile') }}</span>
                            </x-dropdown-link>
        
                            <x-dropdown-link :href="route('logout')"
                                        {{-- onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center space-x-2"> --}}>
                                <ion-icon name="log-out-outline"></ion-icon>
                                <span>{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                            
                            {{-- <form method="POST" action="{{ route('logout') }}">
                                @csrf
                            </form> --}}
                        </x-slot>
                    </x-dropdown>
                </div>
                @endauth
            </aside>
        
            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Top Navigation -->
                <header class="sticky top-0 z-10 flex h-16 items-center justify-between bg-white px-6 shadow-sm">
                    <button @click="sidebarOpen = !sidebarOpen" 
                            class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 focus:outline-none md:hidden">
                        <ion-icon name="menu-outline" class="h-6 w-6"></ion-icon>
                    </button>
        
                    <h1 class="text-xl font-semibold text-gray-800 md:text-2xl lg:text-3xl">
                        {{ $header ?? 'Dashboard' }}
                    </h1>
        
                    @auth
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="rounded-full p-2 text-gray-600 transition-colors hover:bg-gray-100">
                                <ion-icon name="notifications-outline" class="h-6 w-6"></ion-icon>
                            </button>
                            <!-- Notification badge -->
                            <span class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-xs text-white">
                                2
                            </span>
                        </div>
        
                    </div>
                    @endauth
                </header>
        
                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                    <div class="container mx-auto">
                        <div class="rounded-lg bg-white p-6 shadow-md">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>