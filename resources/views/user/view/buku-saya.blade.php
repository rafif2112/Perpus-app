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
                                            @php
                                                $loan = $book
                                                    ->loans()
                                                    ->where('user_id', Auth::id())
                                                    ->where('status_pengembalian', 'dipinjam')
                                                    ->first();
                                            @endphp
                                            <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition duration-300 mx-2">
                                                <img src="{{ asset('assets/images/buku/' . $book['gambar']) }}" alt="{{ $book['judul'] }}" class="w-full h-64 object-cover">
                                                <div class="p-4">
                                                    <h3 class="font-semibold mb-2">{{ $book['judul'] }}</h3>
                                                    <p class="text-sm text-gray-600 mb-2">Oleh : {{ $book['penulis'] }}</p>
                                                    <div class="flex justify-around pt-2">
                                                        <a href="{{route('detail-buku', $book['id'])}}" class="button-container">
                                                            <button class="bg-gray-900 text-white py-2 px-4 rounded-full hover:bg-gray-800 transition duration-300 button-lihat">Lihat <ion-icon class="ml-1.5 -mb-0.5 text-lg" src="{{asset('assets/images/icon/open-outline.svg')}}"></ion-icon></button>
                                                        </a>
                                                        @if ($loan)
                                                            <a href="{{ route('kembalikan', $loan->id) }}" class="button-container">
                                                                <button class="inline-block rounded-full bg-red-500 px-4 py-2 text-white text-center transition duration-300 hover:bg-red-600 button-kembalikan">Kembalikan</button>
                                                            </a>
                                                        @endif
                                                    </div>
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
                        <button class="text-red-600 py-2 px-4 rounded-full hover:underline transition duration-300" onclick="showModalDelete()">Hapus Histori</button>
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

            <div id="showModalDelete" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <!-- Heroicon name: outline/exclamation -->
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Hapus Histori Peminjaman
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Apakah Anda yakin ingin menghapus seluruh histori<span id="bookTitle" class="font-semibold"></span>?
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <form id="deleteForm" method="POST" action="{{ route('hapus-histori-pengembalian') }}" class="sm:ml-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Hapus
                                </button>
                            </form>
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModalDelete()">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function showModalDelete() {
                    document.getElementById('showModalDelete').classList.remove('hidden');
                }

                function closeModalDelete() {
                    document.getElementById('showModalDelete').classList.add('hidden');
                }
            </script>

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
