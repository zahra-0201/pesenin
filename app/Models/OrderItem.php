<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Menu;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'unit_price',
        'notes',
    ];

    // Relasi ke Order (pesanan induk)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke Menu (item menu yang dipesan)
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
