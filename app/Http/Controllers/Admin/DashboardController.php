<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Product;
use App\Models\Staff;
use App\Models\Promo;

/**
 * DashboardController
 * 
 * Controller untuk menampilkan dashboard admin dengan statistik real-time
 * Menampilkan total data dari setiap tabel (counters, products, staff, promos)
 */
class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard dengan statistik real-time
     * 
     * Method ini mengambil jumlah total dari setiap model:
     * - Counter::count() → Total jumlah counter yang terdaftar
     * - Product::count() → Total jumlah produk di semua counter
     * - Staff::count() → Total jumlah staff (baik umum maupun counter)
     * - Promo::count() → Total jumlah promo yang aktif/terdaftar
     * 
     * @return \Illuminate\View\View admin.dashboard
     */
    public function index()
    {
        // Hitung total data dari setiap tabel
        $counters = Counter::count();
        $products = Product::count();
        $staff = Staff::count();
        $promos = Promo::count();

        // Return view dashboard dengan data statistik
        return view('admin.dashboard', compact('counters', 'products', 'staff', 'promos'));
    }
}
