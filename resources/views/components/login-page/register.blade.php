<div class="mx-auto w-full max-w-md">
    <div class="text-center mb-2">
        <ion-icon class="text-[60px]" name="book-outline"></ion-icon>
    </div>
    <h2 class="text-3xl font-bold mb-4 text-center text-blue-800">Bergabunglah dengan Perpustakaan Kami!</h2>
    <p class="text-blue-700 text-center mb-8">Daftar untuk mengakses koleksi pengetahuan kami yang luas.</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-start gap-5 justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="javascript:void(0);" onclick="toggleForms()">
                {{ __('Already registered?') }}
            </a>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">Daftar</button>
        </div>
    </form>
    
    <p class="mt-8 text-center text-sm text-blue-600">
        Sudah punya akun? 
        <a href="{{route('login')}}" class="font-medium text-blue-800 hover:text-blue-700">Masuk di sini</a>
    </p>
</div>