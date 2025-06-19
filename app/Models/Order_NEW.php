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

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function tenant()
        {
            return $this->belongsTo(Tenant::class);
        }

        public function items()
        {
            return $this->hasMany(OrderItem::class);
        }
    }
    