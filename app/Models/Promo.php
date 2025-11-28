<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Promo Model
 * 
 * Model untuk tabel promos yang merepresentasikan diskon/promosi untuk produk
 * Setiap promo terikat pada satu produk dan memiliki periode berlaku
 * Otomatis menghitung harga setelah diskon
 */
class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',              // FK ke product
        'deskripsi',               // Deskripsi promo/penawaran
        'harga_asli',              // Harga normal tanpa diskon
        'diskon',                  // Persentase diskon (0-100)
        'harga_setelah_diskon',    // Harga final setelah diskon
        'mulai',                   // Tanggal mulai promo (Y-m-d)
        'berakhir',                // Tanggal berakhir promo (Y-m-d)
    ];

    /**
     * Relasi ke Product
     * Satu promo milik satu produk
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get Harga Setelah Diskon (Accessor)
     * Otomatis menghitung harga final berdasarkan harga asli dan persentase diskon
     * @return float - Harga setelah diskon diterapkan
     */
    public function getHargaSetelahDiskonAttribute()
    {
        return $this->harga_asli - ($this->harga_asli * ($this->diskon / 100));
    }

    /**
     * Check if Promo is Expired
     * Membandingkan tanggal berakhir dengan hari ini
     * @return bool - true jika promo sudah berakhir
     */
    public function isExpired()
    {
        return $this->berakhir < date('Y-m-d');
    }
}
