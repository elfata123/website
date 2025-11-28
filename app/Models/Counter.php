<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Counter Model
 * 
 * Model untuk tabel counters yang merepresentasikan toko/outlet Ria Busana
 * Setiap counter memiliki nama, lokasi, serta hubungan dengan products dan staff
 */
class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',       // Nama counter/toko
        'lokasi',     // Lokasi geografis counter
    ];

    /**
     * Relasi ke Staff
     * Satu counter memiliki banyak staff
     */
    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    /**
     * Relasi ke Products
     * Satu counter memiliki banyak produk
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
