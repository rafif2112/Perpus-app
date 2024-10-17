<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Statistics Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6">{{ __('Library Statistics') }}</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <p class="text-4xl mb-1 font-bold text-blue-600">{{$totalBooks}}</p>
                                <p class="text-gray-600">{{ __('Total Books') }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-4xl mb-1 font-bold text-green-600">{{$totalUsers}}</p>
                                <p class="text-gray-600">{{ __('Total Users') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Recent Activities') }}</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center space-x-3">
                                <span class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full"></span>
                                <span>{{ __('John Doe borrowed "The Great Gatsby"') }}</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <span class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full"></span>
                                <span>{{ __('Jane Smith returned "1984"') }}</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <span class="flex-shrink-0 w-2 h-2 bg-yellow-500 rounded-full"></span>
                                <span>{{ __('Alice Johnson reserved "To Kill a Mockingbird"') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="mt-6 bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Quick Actions') }}</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            {{ __('Add Book') }}
                        </button>
                        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                            {{ __('New Member') }}
                        </button>
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">
                            {{ __('Issue Book') }}
                        </button>
                        <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                            {{ __('Return Book') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>