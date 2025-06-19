<?php // Pastikan ini adalah baris pertama, tanpa spasi atau karakter tersembunyi di atasnya

namespace App\Models; // Pastikan ini langsung setelah <?php atau declare, tanpa spasi/baris kosong di atasnya

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Pastikan ini juga ada jika menggunakan Sanctum
use App\Models\Tenant; // <--- BARIS PENTING: Tambahkan ini

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    // Pastikan HasApiTokens ada di sini jika Laravel Sanctum digunakan.
    // Jika tidak ada di file Anda, jangan tambahkan, cukup HasFactory, Notifiable
    use HasApiTokens, HasFactory, Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // <--- BARIS PENTING: Tambahkan relasi ini
    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }
    // <--- Akhir penambahan relasi
}
