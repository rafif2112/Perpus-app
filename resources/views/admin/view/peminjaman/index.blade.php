<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Kelola Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <div class="flex justify-end mb-8">
                        <a href="" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out shadow-md">
                            {{ __('Tambah Peminjaman') }}
                        </a>
                    </div>

                    <!-- Peminjaman Section -->
                    <section class="mb-12">
                        <h3 class="text-xl font-semibold mb-6 text-gray-800">{{ __('Peminjaman') }}</h3>
                        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">{{ __('User ID') }}</th>
                                        <th class="py-3 px-6 text-left">{{ __('Book ID') }}</th>
                                        <th class="py-3 px-6 text-left">{{ __('Tanggal Pinjam') }}</th>
                                        <th class="py-3 px-6 text-left">{{ __('Tanggal Jatuh Tempo') }}</th>
                                        <th class="py-3 px-6 text-left">{{ __('Status Pengembalian') }}</th>
                                        <th class="py-3 px-6 text-center">{{ __('Aksi') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($loans as $item)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item['user_id'] }}</td>
                                        <td class="py-3 px-6 text-left">{{ $item['book_id'] }}</td>
                                        <td class="py-3 px-6 text-left">{{ $item['tanggal_pinjam'] }}</td>
                                        <td class="py-3 px-6 text-left">{{ $item['tanggal_jatuh_tempo'] }}</td>
                                        <td class="py-3 px-6 text-left">{{ $item['status_pengembalian'] }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <a href="" class="bg-blue-500 hover:bg-blue-600 text-white rounded-md mx-1 p-2 transition duration-300 ease-in-out">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <button onclick="showModalDelete({{ $item['id'] }}, '{{ $item['user_id'] }}')" class="bg-red-500 hover:bg-red-600 text-white rounded-md mx-1 p-2 transition duration-300 ease-in-out">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>


                    <!-- Delete Modal -->
                    <div id="showModalDelete" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Hapus Peminjaman
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    Apakah Anda yakin ingin menghapus peminjaman dengan User ID <span id="userName" class="font-semibold"></span>?
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
                        function showModalDelete(id, userId) {
                            document.getElementById('showModalDelete').classList.remove('hidden');
                            document.getElementById('userName').textContent = userId;
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
