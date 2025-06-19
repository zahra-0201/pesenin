<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Menu Kantin Anda') }}
            </h2>
            {{-- Tombol untuk menuju halaman tambah menu --}}
            <a href="{{ route('seller.menus.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                + Tambah Menu Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-semibold mb-6">Daftar Menu</h3>

                    {{-- Pesan Sukses jika ada (misal: setelah berhasil menambah/update menu) --}}
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Grid untuk menampung semua kartu menu --}}
                    {{-- Responsif: 1 kolom di mobile, 2 di tablet, 4 di desktop --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

                        {{-- Looping data menu dari controller --}}
                        {{-- Ganti @for dengan @foreach($menus as $menu) saat data sudah ada --}}
                        @for ($i = 1; $i <= 8; $i++)
                        <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                            {{-- Setiap kartu menu adalah link ke halaman detail --}}
                            <a href="#"> {{-- Nanti arahkan ke route('seller.menus.show', $menu->id) --}}
                                <div class="w-full h-40 bg-gray-300">
                                    {{-- Nanti di sini: <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-40 object-cover"> --}}
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-lg truncate">{{-- Nama Menu {{$i}} --}} Nasi Goreng Spesial</h4>
                                    <p class="text-gray-700 mb-2">Rp {{-- number_format(25000, 0, ',', '.') --}} 25.000</p>
                                    <p class="text-sm text-gray-500">Stok: {{-- $menu->stock --}} 10</p>
                                </div>
                            </a>
                            
                            <div class="px-4 pb-4 flex justify-between items-center">
                                <a href="#" class="text-sm text-blue-500 hover:underline"> {{-- route('seller.menus.edit', $menu->id) --}}
                                    Edit
                                </a>
                                {{-- Form untuk hapus data, ini cara paling aman di Laravel --}}
                                <form action="#" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                    {{-- @csrf --}}
                                    {{-- @method('DELETE') --}}
                                    <button type="submit" class="text-sm text-red-500 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endfor
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>