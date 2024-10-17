<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - 
        @if (request()->routeIs('login'))
            Masuk
        @elseif (request()->routeIs('login.register'))
            Daftar
        @endif
    </title>
    @vite('resources/css/app.css', 'resources/js/app.js')
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman:wght@400;700&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/4b9ba14b0f.js" crossorigin="anonymous"></script>
    {{-- icon web --}}
    <link rel="icon" href="{{asset('assets/images/icon/logo.png')}}">
</head>
<body class="bg-cover bg-center" style="background-image: url('{{asset('assets/images/login/backgrond.png')}}');">
    <div class="flex flex-col md:flex-row h-screen bg-black bg-opacity-50">
        <!-- Sisi Kiri - Formulir Masuk -->
        <div class="md:w-1/2 flex items-center justify-center">
            <div id="login-form" class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg {{ request()->routeIs('login.register') ? 'hidden' : '' }}">
                <x-login-page.login></x-login-page.login>
            </div>
            
            <div id="register-form" class="w-full max-w-md bg-white py-6 px-12 rounded-lg shadow-lg {{ request()->routeIs('login') ? 'hidden' : '' }}">
                <x-login-page.register></x-login-page.register>
            </div>
        </div>

        <!-- Sisi Kanan - Gambar Dekoratif -->
        <div class="w-full md:w-1/2 h-64 md:h-full flex items-center justify-center relative">
            <div class="text-white z-50 text-center p-6 bg-opacity-90 bg-blue-800 shadow-lg rounded-md">
                <h2 class="text-3xl md:text-5xl font-extrabold mb-4">Temukan Dunia <br> Pengetahuan</h2>
                <p class="text-lg md:text-2xl">Akses ribuan buku, jurnal, dan sumber daya</p>
            </div>
        </div>
    </div>

    <script>
        function toggleForms() {
            document.getElementById('login-form').classList.toggle('hidden');
            document.getElementById('register-form').classList.toggle('hidden');
        }
    </script>
</body>
</html>
