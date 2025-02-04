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
                        <a href="{{route('admin.peminjaman.export')}}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out shadow-md">
                            {{ __('Export Excel') }} <ion-icon class="ml-1 text-lg -mb-0.5" name="download-outline"></ion-icon>
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
                                        <th class="py-3 px-6 text-left">{{ __('Status Peminjaman') }}</th>
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
                                        <td class="py-3 px-6 text-left">{{ $item['status_pengembalian'] }} 
                                            @if ($item['status_pengembalian'] == 'dipinjam')
                                                <ion-icon name="time-outline" class="text-yellow-500"></ion-icon>
                                            @else
                                                <ion-icon name="checkmark-done-outline" class="text-green-500"></ion-icon>
                                            @endif
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <a href="{{route('admin.peminjaman.print', $item->id)}}" class="bg-gray-500 hover:bg-gray-400 text-white rounded-md mx-1 p-2 transition duration-300 ease-in-out">
                                                    Download (.pdf)
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>