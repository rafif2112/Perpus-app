<x-user.layout>
    <div class="text-white mt-10">
        <div class="container mx-auto text-center px-4">
            <!-- Search Bar -->
            <div class="flex justify-center">
                <div class="relative w-full max-w-3xl">
                    <input id="searchInput" type="text" placeholder="Cari judul buku, penulis, atau genre..."
                        class="w-full rounded-full py-4 px-6 text-gray-700 border-none shadow-inner leading-tight focus:outline-none focus:shadow-outline">
                    <button id="searchButton"
                        class="absolute right-0 top-0 mt-0.5 mr-0.5 bg-yellow-400 text-white font-bold py-3 px-6 rounded-full hover:bg-yellow-300 focus:outline-none focus:shadow-outline transition duration-300">
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section class="container mx-auto w-11/12 px-4 py-12">
        <div id="booksContainer" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach ($books as $book)
                <div class="book-item bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition duration-300">
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
    </section>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const books = document.querySelectorAll('.book-item');

            books.forEach(function(book) {
                const title = book.querySelector('h3').textContent.toLowerCase();
                const author = book.querySelector('p').textContent.toLowerCase();

                if (title.includes(searchInput) || author.includes(searchInput)) {
                    book.style.display = 'block';
                } else {
                    book.style.display = 'none';
                }
            });
        });
    </script>
</x-user.layout>
