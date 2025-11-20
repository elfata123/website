<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'deskripsi',
        'harga_asli',
        'diskon',
        'harga_setelah_diskon',
        'mulai',
        'berakhir',
    ];

    public function product()
{
    return $this->belongsTo(Product::class);
}

public function getHargaSetelahDiskonAttribute()
{
    return $this->harga_asli - ($this->harga_asli * ($this->diskon / 100));
}

public function isExpired()
{
    return $this->berakhir < date('Y-m-d');
}

}
