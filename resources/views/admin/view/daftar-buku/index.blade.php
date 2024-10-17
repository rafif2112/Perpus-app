<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-indigo-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <div class="flex justify-end items-center mb-8">
                        <a href="{{route('admin.daftar-buku.create')}}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-md">
                            {{ __('Tambah Buku Baru') }}
                        </a>
                    </div>

                    <!-- Tabel Daftar Buku -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-4 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('Cover') }}</th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-4 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('Judul') }}</th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-4 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('Penulis') }}</th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-4 text-gray-600 font-bold tracking-wider uppercase text-xs">{{ __('Kategori') }}</th>
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-4 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($books as $book)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="border-t px-6 py-4">
                                        <img src="{{ asset('assets/images/buku/'. $book['gambar']) }}" alt="{{ $book['judul'] }}" class="h-20 w-20 object-cover rounded-lg">
                                    </td>
                                    <td class="border-t px-6 py-4">{{ $book['judul'] }}</td>
                                    <td class="border-t px-6 py-4">{{ $book['penulis'] }}</td>
                                    <td class="border-t px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-800">
                                            {{ $book['kategori'] }}
                                        </span>
                                    </td>
                                    <td class="border-t px-6 py-4 text-center">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{route('admin.daftar-buku.edit', $book['id'])}}" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-md transition duration-300 ease-in-out">
                                                {{ __('Edit') }}
                                            </a>
                                            <button class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-2 px-4 rounded-md transition duration-300 ease-in-out" onclick="showModalDelete({{ $book['id'] }}, '{{ $book['judul'] }}')">
                                                {{ __('Hapus') }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>

                    {{-- Modal Delete --}}
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
                                                Hapus Buku
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    Apakah Anda yakin ingin menghapus buku <span id="bookTitle" class="font-semibold"></span>?
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <form id="deleteForm" method="POST" action="" class="sm:ml-3">
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
                        function showModalDelete(id, judul) {
                            document.getElementById('showModalDelete').classList.remove('hidden');
                            document.getElementById('bookTitle').textContent = judul;
                            document.getElementById('deleteForm').action = "{{ route('admin.daftar-buku.destroy', '') }}/" + id;
                        }

                        function closeModalDelete() {
                            document.getElementById('showModalDelete').classList.add('hidden');
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>