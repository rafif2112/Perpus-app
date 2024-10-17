<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Profile Information') }}
                    </h3>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-center">
                            <strong class="w-24">{{ __('Name :') }}</strong>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <strong class="w-24">{{ __('Email :') }}</strong>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                        <!-- Add more user information here as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
