<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\MenuController; // <--- PASTIKAN BARIS INI ADA

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

Route::get('/menu', function () {
    return view('menu');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- PASTIKAN BLOK RUTE KHUSUS PENJUAL INI ADA ---
    Route::prefix('seller')->name('seller.')->group(function () {
        // Rute untuk manajemen menu penjual (CRUD)
        Route::resource('menus', MenuController::class);
    });
    // --- AKHIR BLOK RUTE KHUSUS PENJUAL ---
});

require __DIR__.'/auth.php';