<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Staff Model
 * 
 * Model untuk tabel staff yang merepresentasikan karyawan Ria Busana
 * Staff bisa berupa:
 * - Staff Counter: counter_id diisi (staff khusus satu counter)
 * - Staff Umum: counter_id null (staff general/admin)
 */
class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'counter_id',  // FK ke counter (nullable untuk staff umum)
        'nama',        // Nama staff
        'jabatan',     // Jabatan/posisi di perusahaan
    ];

    /**
     * Relasi ke Counter
     * Staff bisa null (staff umum) atau satu counter
     */
    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
}
