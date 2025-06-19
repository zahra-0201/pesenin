<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\MenuController;
use App\Http\Controllers\Seller\OrderController;
use App\Models\Menu;
use App\Models\Tenant;
use App\Models\Order; // Tambahkan ini
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Ubah rute dashboard untuk mengambil data menu, pesanan, dan laporan
Route::get('/dashboard', function () {
    $user = Auth::user();
    $topMenus = collect(); // Inisialisasi sebagai koleksi kosong
    $latestOrders = collect(); // Inisialisasi untuk pesanan terbaru
    $weeklyReport = [ // Data laporan mingguan bohongan
        'total_orders_week' => 120,
        'percentage_change' => 10,
        'data_points' => [40, 55, 30, 70, 50, 65, 45], // Contoh data untuk grafik
        'labels' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']
    ];

    // Jika user sudah login dan punya tenant, ambil data mereka
    if ($user && $user->tenant) {
        $tenantId = $user->tenant->id;

        // Ambil 4 menu pertama atau acak dari tenant ini sebagai 'top menu' bohongan
        $topMenus = Menu::where('tenant_id', $tenantId)->inRandomOrder()->take(4)->get();

        // Ambil 3 pesanan terbaru untuk tenant ini
        $latestOrders = Order::with(['user', 'items.menu'])
                                ->where('tenant_id', $tenantId)
                                ->latest()
                                ->take(3) // Ambil 3 pesanan terbaru
                                ->get();
    }

    return view('dashboard', compact('topMenus', 'latestOrders', 'weeklyReport')); // Kirim semua data ke view dashboard
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Rute Khusus Penjual ---
    Route::prefix('seller')->name('seller.')->group(function () {
        // Rute untuk manajemen menu penjual (CRUD)
        Route::resource('menus', MenuController::class);
        // Rute untuk manajemen pesanan penjual (CRUD dasar, fokus index)
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
    });
    // --- AKHIR BLOK RUTE KHUSUS PENJUAL ---
});

require __DIR__.'/auth.php';
