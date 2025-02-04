<x-user.layout>
    <div class="mt-10 text-white">
        <div class="container mx-auto px-4 text-center">
            <!-- Search Bar -->
            <div class="flex justify-center">
                <div class="relative w-full max-w-3xl">
                    <form id="searchForm" action="{{ route('daftar-buku') }}" class="relative flex">
                        <input id="searchInput" type="text" name="cari_buku"
                            placeholder="Cari judul buku, penulis, atau genre..." value="{{ request()->cari_buku }}"
                            class="focus:shadow-outline w-full rounded-full border-none px-6 py-4 leading-tight text-gray-700 shadow-inner focus:outline-none"
                            autocomplete="off">
                        <button id="searchButton" type="submit"
                            class="focus:shadow-outline absolute right-0 top-0 mr-0.5 mt-0.5 rounded-full bg-yellow-400 px-6 py-3 font-bold text-white transition duration-300 hover:bg-yellow-300 focus:outline-none">
                            Cari
                        </button>
                        @if (request()->has('cari_buku'))
                            <button type="button" onclick="clearSearch()"
                                class="absolute right-20 top-2 mr-5 mt-1.5 transition duration-300 focus:outline-none">
                                <ion-icon name="close-outline"
                                    class="rounded-full bg-black/40 text-2xl text-white shadow"></ion-icon>
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="container mx-auto w-11/12 px-4 py-12">
        <div id="booksContainer" class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
            @foreach ($books as $book)
                <div id="book-{{ $book['id'] }}"
                    class="book-item overflow-hidden rounded-lg bg-white shadow transition duration-300 hover:shadow-lg"
                    data-saved="{{ $book['is_saved'] === 'saved' ? 'true' : 'false' }}">
                    <img src="{{ asset('assets/images/buku/' . $book['gambar']) }}" alt="{{ $book['judul'] }}"
                        class="h-64 w-full object-cover">
                    <div class="p-4">
                        <h3 class="mb-2 font-semibold text-black">{{ $book['judul'] }}</h3>
                        <p class="mb-2 text-sm text-gray-600">Oleh : {{ $book['penulis'] }}</p>
                        <div class="flex w-full gap-2">
                            <a href="{{ route('detail-buku', $book['id']) }}" class="w-full">
                                <button
                                    class="mt-4 w-full rounded-full bg-gray-900 py-2 text-white transition duration-100 hover:bg-gray-600">Lihat
                                    <ion-icon class="-mb-0.5 ml-1.5 text-lg"
                                        src="{{ asset('assets/images/icon/open-outline.svg') }}"></ion-icon></button>
                            </a>

                            <form action="">
                                @csrf
                                @if ($book['is_saved'] == 'unsaved')
                                    <button type="button"
                                        onclick="toggleSave({{ $book['id'] }}, @foreach ($saves as $save) {{ $save->id }} @endforeach)"
                                        class="mt-4 rounded-full bg-gray-900 px-2.5 py-2 text-white transition duration-300 hover:bg-gray-800">
                                        <ion-icon id="save-{{ $book['id'] }}" class="-mb-1 text-xl"
                                            name="bookmark-outline"></ion-icon>
                                    @elseif ($book['is_saved'] == 'saved')
                                        <button type="button"
                                            onclick="toggleUnsave({{ $book['id'] }}, @foreach ($saves as $save) {{ $save->id }} @endforeach)"
                                            class="mt-4 rounded-full bg-gray-900 px-2.5 py-2 text-white transition duration-300 hover:bg-gray-800">
                                            <ion-icon id="save-{{ $book['id'] }}" class="-mb-1 text-xl"
                                                name="bookmark">
                                                src="{{ asset('assets/images/icon/bookmark.svg') }}"></ion-icon>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $books->links() }}
        </div>

        <div id="alert-success-save"
            class="z-99999 fixed bottom-4 right-4 hidden items-center rounded-lg bg-green-500 px-14 py-8 text-white dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <div class="text-md font-medium">
                <ion-icon class="-mb-[5px] mr-1 text-xl" name="information-circle-outline"></ion-icon> Buku berhasil
                disimpan!
            </div>
        </div>

    </section>

    <script>
        function clearSearch() {
            const url = new URL(window.location.href);
            url.searchParams.delete('cari_buku');
            window.location.href = url.toString();
        }

        function toggleSave(bookId, saveId) {
            const bookItem = document.getElementById(`book-${bookId}`);
            const saveIcon = document.getElementById(`save-${bookId}`);
            const saveButton = saveIcon?.closest('button');

            if (!bookItem || !saveIcon || !saveButton) {
                console.error('Elemen tidak ditemukan.');
                return;
            }

            fetch("{{ route('save-book', '') }}/" + bookId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        book_id: bookId,
                        user_id: {{ Auth::id() }},
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update UI
                        saveIcon.setAttribute('name', 'bookmark');
                        saveIcon.src = "{{ asset('assets/images/icon/bookmark.svg') }}";
                        bookItem.setAttribute('data-saved', 'true');
                        saveButton.setAttribute('onclick', `toggleUnsave(${bookId}, ${data.save_id})`);
                        showAlert('Buku berhasil disimpan!');
                    } else {
                        console.error('Gagal menyimpan buku:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        function toggleUnsave(bookId, saveId) {
            const bookItem = document.getElementById(`book-${bookId}`);
            const saveIcon = document.getElementById(`save-${bookId}`);
            const saveButton = saveIcon?.closest('button');

            if (!bookItem || !saveIcon || !saveButton) {
                console.error('Elemen tidak ditemukan.');
                return;
            }

            fetch("{{ route('unsave-book', '') }}/" + saveId, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update UI
                        saveIcon.setAttribute('name', 'bookmark-outline');
                        saveIcon.src = "{{ asset('assets/images/icon/bookmark-outline.svg') }}";
                        bookItem.setAttribute('data-saved', 'false');
                        saveButton.setAttribute('onclick', `toggleSave(${bookId})`);
                        showAlert('Buku berhasil dihapus dari daftar simpan!');
                    } else {
                        console.error('Gagal menghapus simpanan:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        function showAlert() {
            const alert = document.getElementById('alert-success-save');
            clearTimeout(alert.hideTimeout);
            alert.classList.remove('hidden', 'animate__fadeOutRight');
            alert.classList.remove('animate__animated', 'animate__fadeInRight');
            void alert.offsetWidth; // Trigger reflow to restart animation
            alert.classList.add('animate__animated', 'animate__fadeInRight');
            alert.hideTimeout = setTimeout(() => {
                alert.classList.remove('animate__fadeInRight');
                alert.classList.add('animate__animated', 'animate__fadeOutRight');
                setTimeout(() => {
                    alert.classList.add('hidden');
                }, 1000); // Duration of fadeOut animation
            }, 2000); // Duration to show the alert
        }
        document.getElementById('alert-success-save').hideTimeout = null;
    </script>
</x-user.layout>
