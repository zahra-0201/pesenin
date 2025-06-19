<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Menu; // Import Model Menu
use App\Models\Tenant; // Import Model Tenant
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login
use Illuminate\Support\Facades\Storage; // Untuk menyimpan file gambar
use Illuminate\Support\Collection; // Penting untuk Collection::make() di index()

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar menu kantin milik penjual yang sedang login.
     */
    public function index()
    {
        $menus = Collection::make(); // Inisialisasi $menus sebagai koleksi kosong
        $user = Auth::user(); // Ambil user yang sedang login

        // Cek apakah user sudah login dan punya tenant (kantin)
        if ($user && $user->tenant) {
            // Jika punya, ambil semua menu dari tenant tersebut
            // Pastikan mengambil semua menu, termasuk yang soft-deleted jika diperlukan,
            // tapi secara default Eloquent hanya mengambil yang tidak soft-deleted.
            $menus = $user->tenant->menus;
        }

        return view('seller.index', compact('menus')); // Arahkan ke view seller.index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat menu baru.
     */
    public function create()
    {
        return view('seller.create'); // Mengembalikan view seller.create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data menu baru yang dikirim dari form.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk gambar
        ]);

        // Pastikan user yang sedang login punya tenant (kantin)
        $tenant = Auth::user()->tenant;
        if (!$tenant) {
            // Jika user belum punya tenant, buatkan dulu secara otomatis
            $tenant = Tenant::create([
                'user_id' => Auth::id(),
                'name' => Auth::user()->name . "'s Kantin", // Nama kantin default
            ]);
        }

        $imagePath = null;
        // Jika ada gambar yang diupload, simpan ke storage
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        // Buat menu baru di database menggunakan Model Menu
        Menu::create([
            'tenant_id' => $tenant->id, // Ambil ID tenant dari user yang login
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'image' => $imagePath,
        ]);

        // Redirect kembali ke halaman daftar menu penjual dengan pesan sukses
        return redirect()->route('seller.menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk mengedit menu.
     */
    public function edit(string $id)
    {
        // Ambil menu berdasarkan ID, dan pastikan itu milik tenant dari user yang sedang login
        $menu = Menu::where('id', $id)->whereHas('tenant.user', function($query) {
            $query->where('id', Auth::id());
        })->firstOrFail(); // firstOrFail() akan memunculkan 404 jika tidak ditemukan/tidak berhak

        return view('seller.edit', compact('menu')); // Kirim data menu ke view seller.edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     * Menyimpan perubahan data menu yang diedit.
     */
    public function update(Request $request, string $id)
    {
        // Temukan menu yang akan diupdate, pastikan milik user yang login
        $menu = Menu::where('id', $id)->whereHas('tenant.user', function($query) {
            $query->where('id', Auth::id());
        })->firstOrFail();

        // Validasi data yang masuk dari form edit
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar opsional saat update
        ]);

        $imagePath = $menu->image; // Default: pertahankan gambar lama
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan ada gambar baru diupload
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        // Update data menu di database
        $menu->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'image' => $imagePath,
        ]);

        return redirect()->route('seller.menus.index')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus menu dari database secara permanen.
     */
    public function destroy(string $id)
    {
        // Temukan menu yang akan dihapus, pastikan milik user yang login
        $menu = Menu::where('id', $id)->whereHas('tenant.user', function($query) {
            $query->where('id', Auth::id());
        })->firstOrFail();

        // Hapus gambar terkait dari storage jika ada
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }
        
        // --- UBAH DARI $menu->delete() MENJADI $menu->forceDelete() UNTUK HAPUS PERMANEN ---
        $menu->forceDelete(); // Menghapus data menu dari database secara permanen

        return redirect()->route('seller.menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}

