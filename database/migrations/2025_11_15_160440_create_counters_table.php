<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel Counters - Menyimpan data toko/outlet Ria Busana
     * 
     * Columns:
     * - id: Primary key auto increment
     * - nama: Nama counter/toko (misal: "Toko Pusat", "Counter 1")
     * - lokasi: Lokasi geografis toko (misal: "Mall XYZ, Lt. 2")
     * - pegawai: Field legacy (masih ada tapi tidak digunakan, sudah dipindah ke staff table)
     * - timestamps: created_at & updated_at untuk audit trail
     */
    public function up(): void
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                       // Nama counter
            $table->string('lokasi')->nullable();         // Lokasi counter
            $table->string('pegawai')->nullable();        // Legacy field - gunakan Staff table
            $table->timestamps();                         // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counters');
    }
};
