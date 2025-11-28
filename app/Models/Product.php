<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Product Model
 * 
 * Model untuk tabel products yang merepresentasikan produk busana di setiap counter
 * Setiap produk terikat pada satu counter dan bisa memiliki promo
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'counter_id',  // FK ke counter
        'nama',        // Nama produk
        'deskripsi',   // Deskripsi singkat produk
        'harga',       // Harga produk
        'gambar',      // Nama file gambar produk
    ];

    /**
     * Relasi ke Counter
     * Banyak produk milik satu counter
     */
    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }

    /**
     * Relasi ke Promo
     * Satu produk bisa memiliki banyak promo
     */
    public function promos()
    {
        return $this->hasMany(Promo::class);
    }
}
