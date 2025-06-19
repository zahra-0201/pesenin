{{-- resources/views/seller/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Form untuk mengedit menu --}}
                    {{-- method="POST" karena kita akan mengirim data --}}
                    {{-- action="{{ route('seller.menus.update', $menu->id) }}" mengarah ke fungsi update di MenuController --}}
                    {{-- enctype="multipart/form-data" diperlukan karena ada input file (gambar) --}}
                    <form method="POST" action="{{ route('seller.menus.update', $menu->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Penting: ini akan membuat request PUT/PATCH untuk update --}}

                        <!-- Nama Menu -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Menu')" />
                            {{-- Mengisi nilai input dengan data menu yang ada --}}
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $menu->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            {{-- Mengisi nilai textarea dengan data menu yang ada --}}
                            <textarea id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="description">{{ old('description', $menu->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Harga -->
                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Harga')" />
                            {{-- Mengisi nilai input dengan data menu yang ada --}}
                            <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="old('price', $menu->price)" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- Stok -->
                        <div class="mt-4">
                            <x-input-label for="stock" :value="__('Stok')" />
                            {{-- Mengisi nilai input dengan data menu yang ada --}}
                            <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock', $menu->stock)" required />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>

                        <!-- Gambar Menu -->
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Gambar Menu')" />
                            {{-- Menampilkan gambar saat ini jika ada --}}
                            @if ($menu->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="h-24 w-24 object-cover rounded-md">
                                </div>
                            @endif
                            {{-- Input file untuk upload gambar baru --}}
                            <input id="image" type="file" name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        {{-- Tombol untuk menyimpan perubahan --}}
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Perbarui Menu') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

