<x-user.layout>
    <!-- Bagian Hero -->
    <div class="relative bg-gradient-to-r from-blue-600 to-blue-800 py-24 text-white">
        <div class="container mx-auto text-center px-4 relative z-10">
            <h1 class="mb-6 text-5xl font-bold leading-tight">Selamat Datang di PerpusApp</h1>
            <p class="mb-12 text-xl">Temukan dan pinjam buku favorit Anda dengan mudah</p>

            <!-- Tombol Get Started -->
            <div class="flex justify-center">
                <a href="#buku" class="bg-yellow-400 text-white font-semibold py-3 px-20 rounded-full hover:bg-yellow-300 focus:outline-none focus:shadow-outline transition duration-300">
                    Get Started
                </a>
            </div>
        </div>
    </div>

    <section class="container mx-auto px-4 w-11/12 py-24">
        <div class="flex flex-col md:flex-row items-center justify-between p-4">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h1 class="text-5xl font-bold mb-4">Temukan Buku Selanjutnya</h1>
                <p class="text-lg text-gray-600 mb-6">Buku paling populer dan trending kami. Tidak yakin apa yang harus dibaca selanjutnya? Temukan suasana membaca yang sempurna.</p>
                <a href="{{route('daftar-buku')}}" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition duration-300">Jelajahi Sekarang 
                    <svg class="inline-block w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M12 3l9 9-9 9"></path>
                    </svg>
                </a>
            </div>
            <div class="flex justify-center items-center gap-4">
                @foreach ($buku->take(3) as $book)
                    <div class="flex flex-col gap-4 justify-center items-center">
                        @if ($loop->index % 2 == 0)
                            <img class="h-96 w-64 object-cover rounded-t-full" src="{{ asset('assets/images/buku/' . $book->gambar) }}" alt="{{ $book->judul }}">
                            <div class="flex flex-col justify-center items-center">
                                <p class="font-semibold">{{ $book->judul }}</p>
                                <p class="font-light">{{ $book->penulis }}</p>
                            </div>
                        @else
                            <div class="flex flex-col justify-center items-center">
                                <p class="font-semibold">{{ $book->judul }}</p>
                                <p class="font-light">{{ $book->penulis }}</p>
                            </div>
                            <img class="h-96 w-64 object-cover rounded-b-full" src="{{ asset('assets/images/buku/' . $book->gambar) }}" alt="{{ $book->judul }}">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Bagian Kartu Buku -->
    <div id="buku" class="container mx-auto mt-10 px-4 w-11/12">
        <h2 class="mb-14 text-center text-4xl font-bold text-gray-800">Buku Terbaru</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

            @foreach ($books as $book)
            @if ($loop->index == 10)
                @break
            @endif
            <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition duration-300">
                <img src="{{ asset('assets/images/buku/' . $book['gambar']) }}" alt="{{ $book['judul'] }}" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="font-semibold mb-2">{{ $book['judul'] }}</h3>
                    <p class="text-sm text-gray-600 mb-2">Oleh : {{ $book['penulis'] }}</p>
                    <a href="{{route('detail-buku', $book['id'])}}">
                        <button class="w-full bg-gray-900 text-white py-2 mt-4 rounded-full hover:bg-gray-800 transition duration-300">Lihat <ion-icon class="ml-1.5 -mb-0.5 text-lg" src="{{asset('assets/images/icon/open-outline.svg')}}"></ion-icon></button>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
        <div class="text-center mt-16">
            <a href="{{route('daftar-buku')}}" class="text-blue-600 text-xl hover:text-blue-800 font-semibold">
            Lihat Semua Buku
            <svg class="inline-block w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M12 3l9 9-9 9"></path>
            </svg>
            </a>
        </div>
    </div>
</x-user.layout>
