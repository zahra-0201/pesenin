    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use App\Models\User;
    use App\Models\Tenant;
    use App\Models\OrderItem;

    class Order extends Model
    {
        use HasFactory;

        protected $fillable = [
            'user_id',
            'tenant_id',
            'total_amount',
            'status',
            'payment_method',
            'notes',
        ];

        // Relasi ke User (pembeli)
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        // Relasi ke Tenant (kantin)
        public function tenant()
        {
            return $this->belongsTo(Tenant::class);
        }

        // Relasi ke OrderItems (detail item pesanan)
        public function items()
        {
            return $this->hasMany(OrderItem::class);
        }
    }
    
    