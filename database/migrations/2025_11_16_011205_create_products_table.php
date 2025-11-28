<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel Products - Menyimpan data produk busana di setiap counter
     * 
     * Columns:
     * - id: Primary key auto increment
     * - counter_id: Foreign key ke tabel counters (produk milik counter mana)
     * - nama: Nama produk (misal: "Hijab Premium")
     * - deskripsi: Deskripsi detail produk (bahan, ukuran, dll)
     * - harga: Harga jual produk dalam Rupiah (tanpa promo)
     * - timestamps: created_at & updated_at untuk audit trail
     * 
     * Relasi:
     * - Satu counter memiliki banyak produk (one-to-many)
     * - Jika counter dihapus, produknya otomatis terhapus (cascade)
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('counter_id');     // FK ke counter
            $table->string('nama');                        // Nama produk
            $table->text('deskripsi')->nullable();         // Deskripsi detail
            $table->integer('harga');                      // Harga produk (Rp)
            $table->timestamps();                          // created_at, updated_at

            // Foreign key constraint
            $table->foreign('counter_id')
                  ->references('id')
                  ->on('counters')
                  ->onDelete('cascade');                   // Hapus produk jika counter dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
