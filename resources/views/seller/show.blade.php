<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Judul halaman, bisa diisi nama menu dari controller --}}
            {{ __('Detail Menu: Sandwich Ayam Pedas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    
                    {{-- Menggunakan Grid 2 kolom untuk layout yang rapi --}}
                    {{-- Kolom kiri untuk detail, kolom kanan untuk gambar --}}
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-8">

                        <div class="md:col-span-3">
                            <h1 class="text-3xl font-bold mb-4">
                                {{-- Nama Menu: $menu->name --}}
                                Sandwich Ayam Pedas
                            </h1>

                            <p class="text-gray-600 mb-6">
                                {{-- Deskripsi Menu: $menu->description --}}
                                Sandwich lezat dengan isian ayam pedas yang digoreng renyah, disajikan dengan selada segar, tomat, dan saus spesial di dalam roti yang lembut. Pilihan tepat untuk makan siang yang mengenyangkan.
                            </p>
                            
                            <div class="mb-6">
                                <p class="text-sm text-gray-500">Harga</p>
                                <p class="text-2xl font-semibold text-blue-600">
                                    Rp {{-- number_format($menu->price, 0, ',', '.') --}} 15.000
                                </p>
                            </div>

                            <div class="mb-8">
                                <p class="text-sm text-gray-500">Stok Tersedia</p>
                                <p class="text-xl font-medium">
                                    {{-- $menu->stock --}} 12 Porsi
                                </p>
                            </div>

                            <div class="flex items-center space-x-4">
                                <a href="#" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"> {{-- route('seller.menus.edit', $menu->id) --}}
                                    Edit Menu
                                </a>
                                <form action="#" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                     {{-- @csrf --}}
                                     {{-- @method('DELETE') --}}
                                    <button type="submit" class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                        Hapus Menu
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                             <div class="w-full h-96 bg-gray-300 rounded-lg shadow-lg">
                                {{-- Nanti di sini: <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover rounded-lg"> --}}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>