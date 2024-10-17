<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ __('Edit Buku') }}</h3>
                    </div>

                    <!-- Form Edit Buku -->
                    <form action="{{ route('admin.daftar-buku.update', $book['id']) }}" method="POST" enctype="multipart/form-data">
                        {{$errors}}
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                                <input type="text" name="judul" id="judul" value="{{ $book['judul'] }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="penulis" class="block text-sm font-medium text-gray-700">Penulis</label>
                                <input type="text" name="penulis" id="penulis" value="{{ $book['penulis'] }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <input type="text" name="kategori" id="kategori" value="{{ $book['kategori'] }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $book['deskripsi'] }}</textarea>
                            </div>
                            <div>
                                <label for="cover" class="block text-sm font-medium text-gray-700">Cover</label>
                                <div id="drop-area" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md p-4 border-dashed border-2 border-gray-300">
                                    <p class="text-gray-600">Drag & drop an image here or click to select one</p>
                                    <input type="file" name="gambar" id="cover" class="hidden" onchange="previewImage(event)">
                                </div>
                                <div class="mt-2">
                                    <span class="text-sm text-gray-700">Gambar Sebelumnya / Preview Gambar Baru:</span>
                                    <img id="preview" src="{{ asset('assets/images/buku/'.$book['gambar']) }}" alt="Cover Buku" class="mt-1 h-32">
                                </div>
                            </div>

                            <script>
                                function previewImage(event) {
                                    var reader = new FileReader();
                                    reader.onload = function(){
                                        var output = document.getElementById('preview');
                                        output.src = reader.result;
                                    };
                                    reader.readAsDataURL(event.target.files[0]);
                                }

                                // Drag and Drop functionality
                                let dropArea = document.getElementById('drop-area');

                                // Prevent default drag behaviors
                                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                                    dropArea.addEventListener(eventName, preventDefaults, false)
                                });

                                function preventDefaults (e) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                }

                                // Highlight drop area when item is dragged over it
                                ['dragenter', 'dragover'].forEach(eventName => {
                                    dropArea.addEventListener(eventName, () => dropArea.classList.add('bg-gray-100'), false)
                                });

                                ['dragleave', 'drop'].forEach(eventName => {
                                    dropArea.addEventListener(eventName, () => dropArea.classList.remove('bg-gray-100'), false)
                                });

                                // Handle dropped files
                                dropArea.addEventListener('drop', handleDrop, false);

                                function handleDrop(e) {
                                    let dt = e.dataTransfer;
                                    let files = dt.files;

                                    document.getElementById('cover').files = files;
                                    previewImage({ target: { files: files } });
                                }

                                // Handle click to open file dialog
                                dropArea.addEventListener('click', () => document.getElementById('cover').click());
                            </script>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                {{ __('Simpan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>