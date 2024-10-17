<x-user.layout>
    <div class="container min-h-[60vh] mx-auto px-4 py-8">
        <div class="flex justify-center items-center gap-6 md:flex">
            <div class="flex justify-center items-center md:w-[20%]">
                <img class="h-full w-full object-cover" src="{{ asset('assets/images/buku/'.$book['gambar']) }}" alt="{{ $book->judul }} cover">
            </div>
            <div class="md:w-1/2 p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $book->kategori }}</div>
                <h1 class="mt-2 text-3xl leading-8 font-bold tracking-tight text-gray-900">{{ $book->judul }}</h1>
                <p class="mt-2 text-gray-500"><b>Oleh :</b> {{ $book->penulis }}</p>
                <p class="mt-4 text-gray-600 text-justify"><b>Deskripsi :</b> {{ $book->deskripsi }}</p>
                <div class="flex gap-4 mt-6">

                    @php
                        $previousRoute = url()->previous();
                        $backRoute = str_contains($previousRoute, route('buku-saya')) ? route('buku-saya') : route('daftar-buku');
                    @endphp
                    <a href="{{ $backRoute }}" class="inline-block bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 transition duration-300">
                        <ion-icon class="-mb-0.5 mr-1.5" src="{{asset('assets/images/icon/arrow-back-outline.svg')}}"></ion-icon>
                        Kembali
                    </a>

                    @if($book->isBorrowed())
                        @php
                            $loan = $book->loans()->where('user_id', Auth::id())->where('status_pengembalian', 'dipinjam')->first();
                        @endphp
                        @if($loan)
                            <a href="{{route('kembalikan', $loan->id)}}" class="inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300">Kembalikan</a>
                        @endif
                    @else
                        <a href="{{route('pinjam', $book->id)}}" class="inline-block bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition duration-300">Pinjam</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-user.layout>