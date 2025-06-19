<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;

class Menu extends Model
{
    use HasFactory;

    // --- TAMBAHKAN ATAU UBAH BAGIAN INI ---
    protected $fillable = [
        'tenant_id', // Pastikan ini ada!
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];
    // --- AKHIR BAGIAN YANG DIUBAH ---

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}