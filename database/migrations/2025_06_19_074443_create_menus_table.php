<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            // --- Tambahkan baris-baris ini ---
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade'); // Menghubungkan menu dengan kantin
            $table->string('name'); // Nama menu
            $table->text('description')->nullable(); // Deskripsi menu
            $table->decimal('price', 8, 2); // Harga menu (misal: 10000.50)
            $table->integer('stock')->default(0); // Jumlah stok, default 0
            $table->string('image')->nullable(); // Nama file gambar menu
            // --- Akhir penambahan ---
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};