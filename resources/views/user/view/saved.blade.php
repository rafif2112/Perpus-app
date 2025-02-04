<x-user.layout>

    <section class="container mx-auto w-11/12 px-4 py-12">

        <div id="booksContainer" class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
            @foreach ($saves as $simpan)
                <div id="book-{{ $simpan->book['id'] }}"
                    class="book-item overflow-hidden rounded-lg bg-white shadow transition duration-300 hover:shadow-lg"
                    data-saved="{{ $simpan->book['is_saved'] ? 'true' : 'false' }}">
                    <img src="{{ asset('assets/images/buku/' . $simpan->book['gambar']) }}" alt="{{ $simpan->book['judul'] }}"
                        class="h-64 w-full object-cover">
                    <div class="p-4">
                        <h3 class="mb-2 font-semibold text-black">{{ $simpan->book['judul'] }}</h3>
                        <p class="mb-2 text-sm text-gray-600">Oleh : {{ $simpan->book['penulis'] }}</p>
                        <div class="flex w-full gap-2">
                            <a href="{{ route('detail-buku', $simpan->book['id']) }}" class="w-full">
                                <button
                                    class="mt-4 w-full rounded-full bg-gray-900 py-2 text-white transition duration-100 hover:bg-gray-600">Lihat
                                    <ion-icon class="-mb-0.5 ml-1.5 text-lg"
                                        src="{{ asset('assets/images/icon/open-outline.svg') }}"></ion-icon></button>
                            </a>

                            <form action="{{ route('save-book', $simpan->book->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $simpan->book['id'] }}">
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            
                                <button type="submit" onclick="toggleSave({{ $simpan->book['id'] }})"
                                    class="mt-4 rounded-full bg-gray-900 px-2.5 py-2 text-white transition duration-300 hover:bg-gray-800">
                                    <ion-icon id="save-{{ $simpan->book['id'] }}" class="-mb-1 text-xl"
                                        src="{{ $simpan->book['is_saved'] ? asset('assets/images/icon/bookmark.svg') : asset('assets/images/icon/bookmark-outline.svg') }}"></ion-icon>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $saves->links() }}
        </div>

        <div id="alert-success-save"
            class="z-99999 fixed bottom-4 right-4 hidden items-center rounded-lg bg-green-500 py-8 px-14 text-white dark:bg-gray-800 dark:text-green-400"
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

        function toggleSave(bookId) {
            const bookItem = document.getElementById(`book-${bookId}`);
            const saveIcon = document.getElementById(`save-${bookId}`);
            const isSaved = bookItem.getAttribute('data-saved') === 'true';

            if (isSaved) {
                saveIcon.src = "{{ asset('assets/images/icon/bookmark-outline.svg') }}";
                bookItem.setAttribute('data-saved', 'false');
            } else {
                saveIcon.src = "{{ asset('assets/images/icon/bookmark.svg') }}";
                bookItem.setAttribute('data-saved', 'true');
                showAlert();
            }
        }

        function showAlert() {
            const alert = document.getElementById('alert-success-save');
            clearTimeout(alert.hideTimeout);
            alert.classList.remove('hidden', 'animate__fadeOutRight');
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
