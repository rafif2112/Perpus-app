<x-user.layout>
    <div class="container mx-auto px-4 w-11/12 min-h-[60vh] py-8">
        <div class="space-y-12">
            <!-- Di Pinjam Swiper -->
            <section>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Di Pinjam</h2>
                <div class="swiper-container overflow-hidden">
                    <div class="swiper-wrapper">
                        @if ($loans->where('status_pengembalian', 'dipinjam')->isEmpty())
                            <p class="text-gray-600">Tidak ada buku yang dipinjam.</p>
                        @else
                            @foreach ($loans as $pinjam)
                                @if ($pinjam->status_pengembalian == 'dipinjam')
                                    @foreach ($pinjamBuku as $book)
                                        @if ($pinjam->book_id == $book->id)
                                            <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition duration-300 mx-2">
                                                <img src="{{ asset('assets/images/buku/' . $book['gambar']) }}" alt="{{ $book['judul'] }}" class="w-full h-64 object-cover">
                                                <div class="p-4">
                                                    <h3 class="font-semibold mb-2">{{ $book['judul'] }}</h3>
                                                    <p class="text-sm text-gray-600 mb-2">Oleh : {{ $book['penulis'] }}</p>
                                                    <a href="{{route('detail-buku', $book['id'])}}">
                                                        <button class="w-full bg-gray-900 text-white py-2 mt-4 rounded-full hover:bg-gray-800 transition duration-300">Lihat <ion-icon class="ml-1.5 -mb-0.5 text-lg" src="{{asset('assets/images/icon/open-outline.svg')}}"></ion-icon></button>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>

            <hr class="my-8 border-t-2 border-gray-300">

            <!-- Di Kembalikan Swiper -->
            <section>
                <div class="flex justify-between">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Di Kembalikan</h2>
                    @if ($loans->where('status_pengembalian', 'dikembalikan')->isNotEmpty())
                        <form action="{{ route('hapus-histori-pengembalian') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 py-2 px-4 rounded-full hover:underline transition duration-300" >Hapus Histori</button>
                        </form>
                        
                    @endif
                </div>
                
                <div class="swiper-container overflow-hidden">
                    <div class="swiper-wrapper">
                        @if ($loans->where('status_pengembalian', 'dikembalikan')->isEmpty())
                            <p class="text-gray-600">Belum ada buku yang dikembalikan.</p>
                        @else
                        @foreach ($loans as $pinjam)
                            @if ($pinjam->status_pengembalian == 'dikembalikan')
                                @foreach ($pinjamBuku as $book)
                                    @if ($pinjam->book_id == $book->id)
                                        <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition duration-300 mx-2">
                                            <img src="{{ asset('assets/images/buku/' . $book['gambar']) }}" alt="{{ $book['judul'] }}" class="w-full h-64 object-cover">
                                            <div class="p-4">
                                                <h3 class="font-semibold mb-2">{{ $book['judul'] }}</h3>
                                                <p class="text-sm text-gray-600 mb-2">Oleh : {{ $book['penulis'] }}</p>
                                                <a href="{{route('detail-buku', $book['id'])}}">
                                                    <button class="w-full bg-gray-900 text-white py-2 mt-4 rounded-full hover:bg-gray-800 transition duration-300">Lihat <ion-icon class="ml-1.5 -mb-0.5 text-lg" src="{{asset('assets/images/icon/open-outline.svg')}}"></ion-icon></button>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        @endif
                    </div>
                </div>
            </section>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var swipers = document.querySelectorAll('.swiper-container');
                    swipers.forEach(function (swiperContainer) {
                        new Swiper(swiperContainer, {
                            slidesPerView: 1,
                            spaceBetween: 10,
                            breakpoints: {
                                640: {
                                    slidesPerView: 2,
                                    spaceBetween: 20,
                                },
                                768: {
                                    slidesPerView: 4,
                                    spaceBetween: 30,
                                },
                                1024: {
                                    slidesPerView: 5,
                                    spaceBetween: 40,
                                },
                            },
                        });
                    });
                });
            </script>

        </div>
    </div>
</x-user.layout>