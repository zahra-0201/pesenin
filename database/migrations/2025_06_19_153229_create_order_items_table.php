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
            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                // Pesanan induk
                $table->foreignId('order_id')->constrained()->onDelete('cascade');
                // Menu yang dipesan
                $table->foreignId('menu_id')->constrained()->onDelete('cascade');
                $table->integer('quantity'); // Jumlah item
                $table->decimal('unit_price', 10, 2); // Harga satuan saat dipesan (untuk riwayat jika harga menu berubah)
                $table->text('notes')->nullable(); // Catatan per item (misal: "tidak pedas")
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('order_items');
        }
    };
    