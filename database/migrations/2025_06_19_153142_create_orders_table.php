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
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                // User yang memesan (bisa null jika guest/belum login)
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
                // Kantin (tenant) yang menerima pesanan
                $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
                $table->decimal('total_amount', 10, 2); // Total harga pesanan, 10 digit total, 2 desimal
                $table->string('status')->default('pending'); // Status pesanan: pending, processing, ready, completed, cancelled
                $table->string('payment_method')->nullable(); // Metode pembayaran: cash, online, etc.
                $table->text('notes')->nullable(); // Catatan tambahan dari pembeli
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('orders');
        }
    };
    