<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Counter;
use App\Models\Product;
use App\Models\Staff;
use App\Models\Promo;


/*
|--------------------------------------------------------------------------
| Web Routes - HALAMAN USER (AMOEBA)
|--------------------------------------------------------------------------
|
| Routes untuk halaman publik yang dapat diakses tanpa login
| Menampilkan produk, counter, staff, dan informasi perusahaan
|
*/

/**
 * HALAMAN UTAMA - Menampilkan semua counter dengan produk dan staff
 * GET / → view: amoeba.index
 * Mengambil: counters dengan relation products & staff, semua products, staff umum, promos aktif
 */
Route::get('/', function () {
    $counters = Counter::with('products', 'staff')->get();
    $products = Product::all();
    $staff = Staff::where('counter_id', null)->get();
    $promos = Promo::where('berakhir', '>=', date('Y-m-d'))->get();

    return view('amoeba.index', compact('counters', 'products', 'staff', 'promos'));
})->name('amoeba');

/**
 * HALAMAN DETAIL COUNTER - Menampilkan produk dan tim di counter spesifik
 * GET /counter/{id} → view: amoeba.counter
 * Mengambil: detail counter dengan products & staff, promos aktif
 */
Route::get('/counter/{counter}', function (Counter $counter) {
    $counter->load('products', 'staff');
    $promos = Promo::where('berakhir', '>=', date('Y-m-d'))->get();

    return view('amoeba.counter', compact('counter', 'promos'));
})->name('counter.detail');

/**
 * HALAMAN STAFF UMUM - Menampilkan daftar staff yang tidak ada di counter
 * GET /staff → view: amoeba.staff
 * Mengambil: staff dengan counter_id = null (staff umum saja)
 */
Route::get('/staff', function () {
    $staff = Staff::where('counter_id', null)->get();

    return view('amoeba.staff', compact('staff'));
})->name('staff.index');


/*
|--------------------------------------------------------------------------
| Admin Routes - DASHBOARD & LOGIN
|--------------------------------------------------------------------------
|
| Routes untuk admin panel yang memerlukan autentikasi
| Menggunakan middleware 'adminAuth' untuk proteksi
|
*/

/**
 * DASHBOARD ADMIN - Menampilkan statistik real-time
 * GET /admin → view: admin.dashboard (dengan middleware protection)
 * Menampilkan: Total counter, products, staff, promos
 * Jika belum login, middleware AdminAuth akan redirect ke /admin/login
 */
Route::get('/admin', [DashboardController::class, 'index'])->middleware('adminAuth')->name('admin.dashboard');

/**
 * LOGIN PAGE - Form login admin
 * GET /admin/login → view: admin.login
 */
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');

/**
 * LOGIN PROCESS - Validasi email & password, set session admin_id
 * POST /admin/login → redirect ke /admin jika berhasil
 */
Route::post('/admin/login', [AdminAuthController::class, 'login']);

/**
 * LOGOUT - Hapus session admin_id
 * GET /admin/logout → redirect ke /admin/login
 */
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/**
 * FORCE DESTROY SESSION - Untuk testing/debugging
 * GET /admin/destroy-session → hapus semua session dan redirect ke login
 */
Route::get('/admin/destroy-session', function () {
    session()->forget('admin_id');
    session()->flush();
    return redirect('/admin/login')->with('message', 'Session cleared. Please login again.');
})->name('admin.destroy-session');


/*
|--------------------------------------------------------------------------
| Admin CRUD Routes - PROTECTED (Memerlukan Login)
|--------------------------------------------------------------------------
|
| Semua routes di dalam group ini dilindungi oleh middleware 'adminAuth'
| Jika tidak login, otomatis redirect ke /admin/login
|
*/

Route::prefix('admin')->name('admin.')->middleware('adminAuth')->group(function () {

    // ===== COUNTER CRUD =====
    // Resource routes untuk Create, Read, Update, Delete counter
    Route::resource('counters', CounterController::class);

    // Detail counter dengan daftar staff
    Route::get('counters/{counter}/detail', [CounterController::class, 'detail'])
        ->name('counters.detail');

    // Form create staff untuk counter spesifik
    Route::get('counters/{counter}/staff/create', [StaffController::class, 'createForCounter'])
        ->name('counters.staff.create');

    // ===== PRODUCT CRUD =====
    // Resource routes untuk Create, Read, Update, Delete produk
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

    // Form create produk untuk counter spesifik
    Route::get(
        'counters/{counter}/products/create',
        [ProductController::class, 'createForCounter']
    )
        ->name('counters.products.create');

    // ===== PROMO CRUD =====
    // Resource routes untuk Create, Read, Update, Delete promo
    Route::resource('promo', \App\Http\Controllers\Admin\PromoController::class);

    // ===== STAFF CRUD =====
    // Resource routes untuk Create, Read, Update, Delete staff
    Route::resource('staff', StaffController::class);
});
