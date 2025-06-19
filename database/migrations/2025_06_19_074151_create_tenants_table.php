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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            // --- Tambahkan baris-baris ini ---
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan tenant dengan user yang membuatnya
            $table->string('name'); // Nama kantin
            $table->string('address')->nullable(); // Alamat kantin (opsional)
            $table->string('phone_number')->nullable(); // No telepon kantin (opsional)
            // --- Akhir penambahan ---
            $table->timestamps(); // Ini otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};