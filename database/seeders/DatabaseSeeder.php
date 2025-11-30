<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Counter;
use App\Models\Product;
use App\Models\Staff;
use App\Models\Promo;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        Admin::create([
            'nama' => 'Admin Ria Busana',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // Create Sample Counters
        $counter1 = Counter::create([
            'nama' => 'Studio',
            'lokasi' => 'Counter kiri, lantai 1',
        ]);

        $counter2 = Counter::create([
            'nama' => 'Dewasa Pria',
            'lokasi' => 'Counter kanan, lantai 2',
        ]);

        // Create Products
        Product::create([
            'counter_id' => $counter1->id,
            'nama' => 'Kemeja Casual Pria',
            'deskripsi' => 'Kemeja casual berkualitas dengan bahan katun premium',
            'harga' => 150000,
            'gambar' => 'kemeja-casual.jpg',
        ]);

        Product::create([
            'counter_id' => $counter1->id,
            'nama' => 'Celana Jeans Wanita',
            'deskripsi' => 'Celana jeans stretch yang nyaman dan stylish',
            'harga' => 200000,
            'gambar' => 'celana-jeans.jpg',
        ]);

        Product::create([
            'counter_id' => $counter2->id,
            'nama' => 'Dress Formal Wanita',
            'deskripsi' => 'Dress formal untuk acara spesial',
            'harga' => 350000,
            'gambar' => 'dress-formal.jpg',
        ]);

        // Create General Staff
        Staff::create([
            'counter_id' => null,
            'nama' => 'Budi Santoso',
            'jabatan' => 'Manager Umum',
        ]);

        Staff::create([
            'counter_id' => null,
            'nama' => 'Siti Nurhaliza',
            'jabatan' => 'Marketing Manager',
        ]);

        // Create Counter-Specific Staff
        Staff::create([
            'counter_id' => $counter1->id,
            'nama' => 'Ahmad Wijaya',
            'jabatan' => 'Counter Manager',
        ]);

        Staff::create([
            'counter_id' => $counter1->id,
            'nama' => 'Dini Pratama',
            'jabatan' => 'Sales Staff',
        ]);

        Staff::create([
            'counter_id' => $counter2->id,
            'nama' => 'Rina Kusuma',
            'jabatan' => 'Counter Manager',
        ]);

        // Create Promos
        Promo::create([
            'product_id' => 1,
            'deskripsi' => 'Diskon Special November',
            'harga_asli' => 150000,
            'diskon' => 20,
            'harga_setelah_diskon' => 120000,
            'mulai' => Carbon::now()->format('Y-m-d'),
            'berakhir' => Carbon::now()->addDays(7)->format('Y-m-d'),
        ]);

        Promo::create([
            'product_id' => 2,
            'deskripsi' => 'Flash Sale Celana Jeans',
            'harga_asli' => 200000,
            'diskon' => 15,
            'harga_setelah_diskon' => 170000,
            'mulai' => Carbon::now()->format('Y-m-d'),
            'berakhir' => Carbon::now()->addDays(3)->format('Y-m-d'),
        ]);

        $this->command->info('Database seeding completed successfully!');
        $this->command->info('Admin login: admin@gmail.com / password');
    }
}
