{{-- resources/views/seller/create.blade.php --}}

{{-- Menggunakan layout aplikasi bawaan dari Laravel Breeze --}}
<x-app-layout>
    {{-- Slot untuk judul halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Menu Baru') }}
        </h2>
    </x-slot>

    {{-- Konten utama halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Form untuk menambah menu baru --}}
                    {{-- method="POST" karena kita akan mengirim data --}}
                    {{-- action="{{ route('seller.menus.store') }}" mengarah ke fungsi store di MenuController --}}
                    {{-- enctype="multipart/form-data" diperlukan karena ada input file (gambar) --}}
                    <form method="POST" action="{{ route('seller.menus.store') }}" enctype="multipart/form-data">
                        @csrf {{-- Token CSRF untuk keamanan, wajib ada di setiap form POST --}}

                        <!-- Nama Menu -->
                        <div>
                            {{-- Label untuk input nama menu --}}
                            <x-input-label for="name" :value="__('Nama Menu')" />
                            {{-- Input teks untuk nama menu. old('name') menjaga nilai input jika ada validasi gagal --}}
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            {{-- Menampilkan pesan error validasi untuk kolom 'name' --}}
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-4">
                            {{-- Label untuk input deskripsi --}}
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            {{-- Textarea untuk deskripsi (bisa input teks panjang) --}}
                            <textarea id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="description">{{ old('description') }}</textarea>
                            {{-- Menampilkan pesan error validasi untuk kolom 'description' --}}
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Harga -->
                        <div class="mt-4">
                            {{-- Label untuk input harga --}}
                            <x-input-label for="price" :value="__('Harga')" />
                            {{-- Input angka untuk harga. step="0.01" memungkinkan nilai desimal --}}
                            <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="old('price')" required />
                            {{-- Menampilkan pesan error validasi untuk kolom 'price' --}}
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- Stok -->
                        <div class="mt-4">
                            {{-- Label untuk input stok --}}
                            <x-input-label for="stock" :value="__('Stok')" />
                            {{-- Input angka untuk stok --}}
                            <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock')" required />
                            {{-- Menampilkan pesan error validasi untuk kolom 'stock' --}}
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>

                        <!-- Gambar Menu -->
                        <div class="mt-4">
                            {{-- Label untuk input gambar --}}
                            <x-input-label for="image" :value="__('Gambar Menu')" />
                            {{-- Input file untuk upload gambar. Styling Tailwind CSS kustom ditambahkan --}}
                            <input id="image" type="file" name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            {{-- Menampilkan pesan error validasi untuk kolom 'image' --}}
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        {{-- Tombol untuk menyimpan menu --}}
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Simpan Menu') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
