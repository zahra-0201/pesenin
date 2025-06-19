<x-app-layout>
    {{-- Bagian Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="text-center mb-10">
                        <div class="w-24 h-24 bg-gray-300 rounded-full mx-auto mb-4"></div>
                        <h1 class="text-2xl font-bold">
                            {{-- Nanti ini diisi nama kantin dari database --}}
                            Kantin Sejahtera
                        </h1>
                        <p class="text-sm text-gray-500">
                            {{-- Nanti ini diisi alamat kantin dari database --}}
                            Jl. Bahagia No. 123
                        </p>
                    </div>


                    <div class="mb-10">
                        <h3 class="text-lg font-semibold mb-4">Top Menu</h3>
                        {{-- Menggunakan Grid untuk menampung card menu --}}
                        {{-- Akan menampilkan 5 kolom di layar besar, 2 di layar tablet, dan 1 di HP --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6">
                            
                            {{-- Ini adalah kerangka untuk 1 card menu. Kita buat 5 buah sebagai contoh --}}
                            @for ($i = 1; $i <= 5; $i++)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="w-full h-32 bg-gray-300 rounded-md mb-3"></div>
                                <h4 class="font-bold">Nama Menu {{ $i }}</h4>
                                <p class="text-sm text-gray-600">Stok Tersisa: XX</p>
                            </div>
                            @endfor
                            
                        </div>
                    </div>


                    <div class="mb-10">
                        <h3 class="text-lg font-semibold mb-4">Pesanan Terbaru</h3>
                        {{-- Card untuk menampilkan detail pesanan terbaru --}}
                        <div class="border border-gray-200 rounded-lg p-6">
                            <p class="text-gray-500">Informasi pesanan yang baru masuk akan ditampilkan di sini.</p>
                            {{-- Contoh detail yang bisa ditampilkan nanti --}}
                            <div class="mt-4">
                                <p><span class="font-semibold">ID Pesanan:</span> #XXXXX</p>
                                <p><span class="font-semibold">Nama Pemesan:</span> Nama Pembeli</p>
                                <p><span class="font-semibold">Waktu Pesan:</span> XX Menit yang lalu</p>
                                <p><span class="font-semibold">Status:</span> Menunggu Diproses</p>
                            </div>
                        </div>
                    </div>


                    <div>
                        <h3 class="text-lg font-semibold mb-4">Laporan Mingguan</h3>
                        <div class="border border-gray-200 rounded-lg p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Total Pesanan</p>
                                    {{-- Placeholder untuk angka total --}}
                                    <p class="text-3xl font-bold">XXX</p> 
                                    {{-- Placeholder untuk persentase --}}
                                    <p class="text-sm text-gray-500">+X% dari minggu lalu</p> 
                                </div>
                                <div class="w-3/5">
                                    <p class="text-center text-sm font-semibold mb-2">Grafik Penjualan</p>
                                    <div class="flex justify-between items-end h-32 bg-gray-100 p-2 rounded">
                                        {{-- Kita buat 7 batang untuk 7 hari --}}
                                        @foreach (['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $hari)
                                            <div class="text-center">
                                                <div class="bg-gray-400 w-6 sm:w-8" style="height: {{ rand(20, 100) }}px;"></div>
                                                <p class="text-xs mt-1">{{ $hari }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
            </div>
        </div>
    </div>
</x-app-layout>