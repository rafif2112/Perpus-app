<div class="mx-auto w-full max-w-md">
    <div class="mb-2 text-center">
        <ion-icon class="text-[60px]" name="book-outline"></ion-icon>
    </div>
    <h2 class="mb-4 text-center text-3xl font-bold text-blue-800">Selamat datang di Perpustakaan kami!</h2>
    <p class="mb-8 text-center text-blue-700">Masuk untuk mengakses koleksi pengetahuan kami yang luas.</p>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="mt-1 block w-full pr-10" type="password" name="password" required
                    autocomplete="current-password" />
                <button type="button" onclick="togglePasswordVisibility()"
                    class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <ion-icon id="password-icon" class="text-gray-500 text-2xl" name="eye-off-outline"></ion-icon>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <script>
            function togglePasswordVisibility() {
                const passwordInput = document.getElementById('password');
                const passwordIcon = document.getElementById('password-icon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordIcon.name = 'eye-outline';
                } else {
                    passwordInput.type = 'password';
                    passwordIcon.name = 'eye-off-outline';
                }
            }
        </script>

        <!-- Remember Me -->
        <div class="mt-4 block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-5 flex flex-col items-start justify-between gap-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit"
                class="w-full rounded-md bg-blue-600 px-4 py-2 text-white transition duration-150 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Masuk
            </button>
        </div>
    </form>

    <p class="mt-8 text-center text-sm text-blue-600">
        Tidak punya kartu perpustakaan?
        <a href="{{route('login.register')}}"
            class="font-medium text-blue-800 hover:text-blue-700">Daftar di sini
        </a>
    </p>
</div>
