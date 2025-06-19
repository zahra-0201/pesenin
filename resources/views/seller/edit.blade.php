{{-- resources/views/seller/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail & Edit Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Pesan sukses --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="md:flex md:space-x-8">
                        {{-- Kolom Kiri: Form Edit --}}
                        <div class="md:w-1/2">
                            <form method="POST" action="{{ route('seller.menus.update', $menu->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') {{-- Penting: ini akan membuat request PUT/PATCH untuk update --}}

                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Nama')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $menu->name)" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="description" :value="__('Deskripsi')" />
                                    <textarea id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="description">{{ old('description', $menu->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="price" :value="__('Harga')" />
                                    <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="old('price', $menu->price)" required />
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="stock" :value="__('Stok')" />
                                    <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock', $menu->stock)" required />
                                    <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                                </div>

                                <div class="mb-6">
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

                        {{-- Kolom Kanan: Tampilan Gambar Detail Menu --}}
                        <div class="md:w-1/2 mt-8 md:mt-0 flex flex-col items-center justify-center">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $menu->name }}</h3>
                            @if ($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-auto max-w-full rounded-lg shadow-xl object-contain" style="max-height: 500px;">
                            @else
                                <div class="w-full h-auto max-w-full bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg" style="min-height: 300px; max-height: 500px;">
                                    Tidak ada gambar
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
