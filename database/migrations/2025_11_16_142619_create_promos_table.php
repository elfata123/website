<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel Promos - Menyimpan data promosi/diskon untuk produk
     * 
     * Columns:
     * - id: Primary key auto increment
     * - product_id: Foreign key ke tabel products (promo untuk produk mana)
     * - deskripsi: Deskripsi promosi (misal: "Beli 2 gratis 1")
     * - harga_asli: Harga normal produk sebelum diskon (Rp)
     * - diskon: Persentase diskon (0-100), misal 25 artinya 25%
     * - harga_setelah_diskon: Harga final setelah diskon diterapkan (Rp)
     * - mulai: Tanggal mulai berlaku promosi (format: YYYY-MM-DD)
     * - berakhir: Tanggal berakhir promosi (format: YYYY-MM-DD)
     * - timestamps: created_at & updated_at untuk audit trail
     * 
     * Relasi:
     * - Satu produk bisa memiliki banyak promo
     * - Jika produk dihapus, promosi-nya otomatis terhapus (cascade)
     */
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');              // FK ke product
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');                           // Hapus promo jika produk dihapus
            $table->text('deskripsi')->nullable();                 // Deskripsi promosi
            $table->integer('harga_asli');                         // Harga normal (Rp)
            $table->integer('diskon')->nullable();                 // Persentase diskon (%)
            $table->integer('harga_setelah_diskon');               // Harga setelah diskon (Rp)
            $table->date('mulai');                                 // Tanggal mulai (YYYY-MM-DD)
            $table->date('berakhir');                              // Tanggal berakhir (YYYY-MM-DD)
            $table->timestamps();                                  // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
