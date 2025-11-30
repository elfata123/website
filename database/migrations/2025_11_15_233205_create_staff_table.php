<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel Staff - Menyimpan data karyawan Ria Busana
     * 
     * Columns:
     * - id: Primary key auto increment
     * - counter_id: Foreign key ke tabel counters (nullable untuk staff umum)
     *   - Jika null: Staff general/umum (tampil di halaman utama)
     *   - Jika terisi: Staff khusus counter (hanya tampil di detail counter)
     * - nama: Nama lengkap karyawan
     * - jabatan: Posisi/jabatan di perusahaan (misal: "Manager", "Sales")
     * - timestamps: created_at & updated_at untuk audit trail
     * 
     * Relasi:
     * - Satu counter bisa memiliki banyak staff
     * - Jika counter dihapus, staff-nya otomatis terhapus (cascade)
     */
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('counter_id')->nullable();  // FK ke counter (opsional)
            $table->string('nama');                                  // Nama staff
            $table->string('jabatan')->nullable();                   // Jabatan/posisi
            $table->timestamps();                                    // created_at, updated_at

            // Foreign key constraint dengan cascade delete
            $table->foreign('counter_id')
                ->references('id')
                ->on('counters')
                ->onDelete('cascade');                             // Hapus staff jika counter dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
