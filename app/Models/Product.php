<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'counter_id',
        'nama',
        'deskripsi',
        'harga',
        'gambar',
    ];

    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
}
