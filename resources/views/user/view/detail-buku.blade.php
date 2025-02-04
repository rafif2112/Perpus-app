<x-user.layout>
    <div class="container mx-auto min-h-[60vh] px-4 py-8">
        <div class="flex items-center justify-center gap-6 md:flex">
            <div class="flex items-center justify-center md:w-[20%]">
                <img class="h-full w-full object-cover" src="{{ asset('assets/images/buku/' . $book['gambar']) }}"
                    alt="{{ $book->judul }} cover">
            </div>
            <div class="p-8 md:w-1/2">
                <div class="text-sm font-semibold uppercase tracking-wide text-indigo-500">{{ $book->kategori }}</div>
                <h1 class="mt-2 text-3xl font-bold leading-8 tracking-tight text-gray-900">{{ $book->judul }}</h1>
                <p class="mt-2 text-gray-500"><b>Oleh :</b> {{ $book->penulis }}</p>
                <p class="mt-4 text-justify text-gray-600"><b>Deskripsi :</b> {{ $book->deskripsi }}</p>
                <div class="mt-6 flex gap-4">
                    @php
                        $previousRoute = url()->previous();
                        $backRoute = str_contains($previousRoute, route('buku-saya'))
                            ? route('buku-saya')
                            : route('daftar-buku');
                    @endphp
                    <a href="{{ $backRoute }}"
                        class="inline-block rounded bg-indigo-500 px-4 py-2 text-white transition duration-300 hover:bg-indigo-600">
                        <ion-icon class="-mb-0.5 mr-1.5"
                            src="{{ asset('assets/images/icon/arrow-back-outline.svg') }}"></ion-icon>
                        Kembali
                    </a>

                    @if ($book->isBorrowed())
                        @php
                            $loan = $book
                                ->loans()
                                ->where('user_id', Auth::id())
                                ->where('status_pengembalian', 'dipinjam')
                                ->first();
                        @endphp
                        @if ($loan)
                            <a href="{{ route('kembalikan', $loan->id) }}"
                                class="inline-block rounded bg-red-500 px-4 py-2 text-white transition duration-300 hover:bg-red-600">Kembalikan</a>
                        @endif
                    @else
                        <a href="{{ route('pinjam', $book->id) }}"
                            class="inline-block rounded bg-black px-4 py-2 text-white transition duration-300 hover:bg-gray-800">Pinjam</a>
                    @endif
                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                        type="button">
                        <ion-icon class="text-red-600 text-2xl mt-1" name="information-circle-outline" class="text-xl"></ion-icon>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
        <div class="relative max-h-full w-full max-w-2xl p-4">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Ketentuan Peminjaman
                    </h3>
                    <button type="button"
                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="space-y-4 p-4 md:p-5">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        1. Peminjaman buku maksimal 1 minggu.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        2. Denda keterlambatan sebesar Rp 1.000 per hari.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        3. Buku yang hilang atau rusak harus diganti dengan buku yang sama atau membayar sesuai harga buku.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        4. Peminjaman buku hanya bisa dilakukan oleh anggota yang terdaftar.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        5. Buku yang dipinjam harus dikembalikan ke perpustakaan dalam kondisi baik.
                    </p>
                </div>
            </div>
        </div>
    </div>

    @session('telat')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Telat Pengembalian Buku',
                text: '{{ session('telat') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('bayar-denda', ['loan_id' => $loan->id]) }}";
                }
            });
        </script>
    @endsession
</x-user.layout>
