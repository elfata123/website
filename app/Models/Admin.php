<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Admin Model
 * 
 * Model untuk tabel admins yang merepresentasikan user admin sistem
 * Digunakan untuk login dan autentikasi admin panel
 * Email harus unik per admin
 */
class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'nama',       // Nama lengkap admin
        'email',      // Email unik untuk login
        'password',   // Password yang sudah di-hash
    ];

    protected $hidden = [
        'password',   // Jangan tampilkan password di output
    ];
}
