<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'counter_id',
        'nama',
        'jabatan',
    ];

    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
}
