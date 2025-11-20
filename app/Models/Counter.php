<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'lokasi',
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
