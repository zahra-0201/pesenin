{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            {{-- Bagian Top Menu Anda (Simulasi Menu Terlaris) --}}
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-4">
                        {{ __('Top Menu Anda (Simulasi Terlaris)') }}
                    </h3>

                    @if ($topMenus->isEmpty())
                        <p class="text-center text-gray-500">Anda belum memiliki menu untuk ditampilkan di top menu, atau belum ada menu yang terlaris.</p>
                        <p class="text-center text-gray-500">Silakan tambahkan menu baru melalui "Manajemen Menu > Tambah Menu Baru" terlebih dahulu.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($topMenus as $menu)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                                    <a href="{{ route('seller.menus.edit', $menu->id) }}" class="block">
                                        @if ($menu->image)
                                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-40 object-cover">
                                        @else
                                            <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                                Tidak ada gambar
                                            </div>
                                        @endif
                                        <div class="p-3">
                                            <h4 class="text-md font-semibold text-gray-800 mb-1">{{ $menu->name }}</h4>
                                            <p class="text-sm text-gray-600">Rp{{ number_format($menu->price, 2, ',', '.') }}</p>
                                            <p class="text-xs text-gray-500">Stok: {{ $menu->stock }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Bagian Tambahan: Pesanan Terbaru --}}
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-4">
                        {{ __('Pesanan Terbaru') }}
                    </h3>

                    @if ($latestOrders->isEmpty())
                        <p class="text-center text-gray-500">Belum ada pesanan terbaru.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID Pesanan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pembeli
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Waktu Pesan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Detail
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($latestOrders as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $order->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $order->user ? $order->user->name : 'Tamu' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Rp{{ number_format($order->total_amount, 2, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                                    @elseif($order->status == 'ready') bg-green-100 text-green-800
                                                    @elseif($order->status == 'completed') bg-gray-100 text-gray-800
                                                    @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $order->created_at->format('d M H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('seller.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Detail') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Bagian Tambahan: Laporan Mingguan --}}
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-4">
                        {{ __('Laporan Mingguan') }}
                    </h3>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Total Pesanan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $weeklyReport['total_orders_week'] }}</p>
                            <p class="text-sm text-green-500">{{ $weeklyReport['percentage_change'] }}% Minggu Ini</p>
                        </div>
                        {{-- Placeholder untuk Grafik --}}
                        <div class="w-2/3 h-32 bg-gray-100 rounded-lg p-2 flex justify-around items-end">
                            @foreach ($weeklyReport['data_points'] as $key => $data)
                                <div class="flex flex-col items-center">
                                    <div class="bg-indigo-500 rounded-t" style="height: {{ $data / 100 * 80 }}px; width: 15px;"></div>
                                    <span class="text-xs text-gray-500 mt-1">{{ $weeklyReport['labels'][$key] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
