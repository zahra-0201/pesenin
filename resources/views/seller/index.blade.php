    {{-- resources/views/seller/index.blade.php --}}

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Menu Kantin Anda') }}
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

                        <div class="flex justify-end mb-4">
                            <a href="{{ route('seller.menus.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Tambah Menu Baru') }}
                            </a>
                        </div>

                        @if ($menus->isEmpty())
                            <p class="text-center text-gray-500">Anda belum memiliki menu. Silakan tambahkan yang pertama!</p>
                        @else
                            {{-- Grid untuk menampilkan kartu menu --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($menus as $menu)
                                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                        {{-- Kartu menu bisa diklik untuk detail/edit --}}
                                        <a href="{{ route('seller.menus.edit', $menu->id) }}" class="block">
                                            @if ($menu->image)
                                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                                            @else
                                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                                    Tidak ada gambar
                                                </div>
                                            @endif
                                            <div class="p-4">
                                                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $menu->name }}</h3>
                                                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($menu->description, 30) }}</p>
                                                <p class="text-md font-bold text-gray-800">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
                                                <p class="text-sm text-gray-500">Stok: {{ $menu->stock }}</p>
                                            </div>
                                        </a>
                                        <div class="p-4 border-t border-gray-100 flex justify-end space-x-2">
                                            {{-- Tombol Edit: Mengarahkan ke halaman edit menu spesifik --}}
                                            <a href="{{ route('seller.menus.edit', $menu->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">{{ __('Edit') }}</a>
                                            
                                            {{-- Tombol Hapus: Menggunakan form dengan metode DELETE --}}
                                            <form action="{{ route('seller.menus.destroy', $menu->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">{{ __('Hapus') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    