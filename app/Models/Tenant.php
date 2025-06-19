<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Menu;

class Tenant extends Model
{
    use HasFactory;

    // --- TAMBAHKAN ATAU UBAH BAGIAN INI ---
    protected $fillable = [
        'user_id', // Pastikan ini ada!
        'name',
        'address',
        'phone_number',
    ];
    // --- AKHIR BAGIAN YANG DIUBAH ---

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
