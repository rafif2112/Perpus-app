<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    @vite('resources/css/app.css', 'resources/js/app.js')
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    {{-- swiper js --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- icon web --}}
    <link rel="icon" href="{{asset('assets/images/icon/logo.png')}}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js">
    </script><link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css" rel="stylesheet">

    {{-- animate css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        * {
            --webkit-font-smoothing: antialiased;
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">

    <div id="loading-screen" class="fixed w-full h-screen inset-0 bg-black/30 flex items-center justify-center z-50">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-20 w-20"></div>
    </div>

    <style>
        .loader {
            border-top-color: #3498db;
            animation: spin 1.5s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <script>
        const loadingScreen = document.getElementById('loading-screen');
        window.addEventListener('load', () => {
            loadingScreen.style.display = 'none';
        });
    </script>

    <!-- Navbar -->
    <x-user.navbar></x-user.navbar>
    
    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-10">
        <div class="container mx-auto py-8 px-4">
            <div class="flex flex-wrap justify-center">
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-xl font-semibold mb-4">PerpusApp</h3>
                    <p class="text-gray-400">Menyediakan akses mudah ke dunia literasi digital.</p>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-xl font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="text-gray-400">
                        <li class="mb-2"><a href="#" class="hover:text-white">Beranda</a></li>
                        <li class="mb-2"><a href="#" class="hover:text-white">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#" class="hover:text-white">Layanan</a></li>
                        <li class="mb-2"><a href="#" class="hover:text-white">Kontak</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-xl font-semibold mb-4">Kontak Kami</h3>
                    <p class="text-gray-400">Email: info@perpusapp.com</p>
                    <p class="text-gray-400">Telepon: (021) 1234-5678</p>
                </div>
                <div class="w-full md:w-1/4">
                    <h3 class="text-xl font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <ion-icon name="logo-linkedin"></ion-icon>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>