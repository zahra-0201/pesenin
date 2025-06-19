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
            $menus = $user->tenant->menus; // Jika punya, ambil semua menu dari tenant tersebut
        }

        return view('seller.index', compact('menus')); // Arahkan ke view index.blade.php
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
            // Di proyek nyata, mungkin ada form terpisah untuk pendaftaran tenant
            $tenant = Tenant::create([
                'user_id' => Auth::id(),
                'name' => Auth::user()->name . "'s Kantin", // Nama kantin default
            ]);
        }

        $imagePath = null;
        // Jika ada gambar yang diupload, simpan ke storage
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
            // 'menu_images' adalah folder di dalam storage/app/public
            // 'public' adalah disk storage yang mengarah ke storage/app/public
        }

        // Buat menu baru di database menggunakan Model Menu
        Menu::create([
            'tenant_id' => $tenant->id, // Ambil ID tenant dari user yang login
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'image' => $imagePath, // Simpan path gambar
        ]);

        // Redirect kembali ke halaman daftar menu penjual dengan pesan sukses
        return redirect()->route('seller.menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail satu menu. (Belum diimplementasikan sepenuhnya)
     */
    public function show(string $id)
    {
        // Akan diimplementasikan nanti
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk mengedit menu. (Belum diimplementasikan sepenuhnya)
     */
    public function edit(string $id)
    {
        // Akan diimplementasikan nanti
    }

    /**
     * Update the specified resource in storage.
     * Menyimpan perubahan data menu yang diedit. (Belum diimplementasikan sepenuhnya)
     */
    public function update(Request $request, string $id)
    {
        // Akan diimplementasikan nanti
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus menu dari database. (Belum diimplementasikan sepenuhnya)
     */
    public function destroy(string $id)
    {
        // Akan diimplementasikan nanti
    }
}
