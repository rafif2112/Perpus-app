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
                        <h3 class="text-2xl font-semibold text-gray-800">{{ __('Tambah Buku') }}</h3>
                    </div>

                    <!-- Form Edit Buku -->
                    <form action="{{ route('admin.daftar-buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{$errors}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="penulis" class="block text-sm font-medium text-gray-700">Penulis</label>
                                <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <input type="text" name="kategori" id="kategori" value="{{ old('kategori') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('deskripsi') }}</textarea>
                            </div>
                            <div>
                                <label for="cover" class="block text-sm font-medium text-gray-700">Cover</label>
                                <div id="drop-area" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-4 border-dashed border-2 justify-center items-center">
                                    <p>Drag & Drop your image here or click to select</p>
                                    <input type="file" name="gambar" id="cover" class="hidden" onchange="previewImage(event)">
                                </div>
                                <img id="cover-preview" src="#" alt="Cover Preview" class="mt-4 hidden w-32 h-32 object-cover">
                            </div>

                            <script>
                                function previewImage(event) {
                                    var reader = new FileReader();
                                    reader.onload = function(){
                                        var output = document.getElementById('cover-preview');
                                        output.src = reader.result;
                                        output.classList.remove('hidden');
                                    };
                                    reader.readAsDataURL(event.target.files[0]);
                                }

                                var dropArea = document.getElementById('drop-area');
                                var fileInput = document.getElementById('cover');

                                dropArea.addEventListener('dragover', function(event) {
                                    event.preventDefault();
                                    dropArea.classList.add('bg-gray-100');
                                });

                                dropArea.addEventListener('dragleave', function(event) {
                                    dropArea.classList.remove('bg-gray-100');
                                });

                                dropArea.addEventListener('drop', function(event) {
                                    event.preventDefault();
                                    dropArea.classList.remove('bg-gray-100');
                                    var files = event.dataTransfer.files;
                                    if (files.length > 0) {
                                        fileInput.files = files;
                                        previewImage({ target: { files: files } });
                                    }
                                });

                                dropArea.addEventListener('click', function() {
                                    fileInput.click();
                                });
                            </script>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                {{ __('Tambah') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>