<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin', function () {
    if (!session('admin_id')) {
        return redirect()->route('admin.login');
    }
    return view('admin.dashboard');
})->name('admin.dashboard');


// =============================
// LOGIN ROUTE
// =============================
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// =============================
// ROUTE KHUSUS ADMIN (protected)
// =============================
Route::prefix('admin')->name('admin.')->middleware('adminAuth')->group(function () {

    // CRUD COUNTER
    Route::resource('counters', CounterController::class);

    // DETAIL COUNTER (lihat staff)
    Route::get('counters/{counter}/detail', [CounterController::class, 'detail'])
        ->name('counters.detail');

    // TAMBAH STAFF UNTUK COUNTER TERTENTU
    Route::get('counters/{counter}/staff/create', [StaffController::class, 'createForCounter'])
        ->name('counters.staff.create');

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

    Route::resource('promo', \App\Http\Controllers\Admin\PromoController::class);

    Route::resource('promo', \App\Http\Controllers\Admin\PromoController::class);

    Route::get('counters/{counter}/products/create', 
    [ProductController::class, 'createForCounter'])
    ->name('counters.products.create');


    // CRUD STAFF
    Route::resource('staff', StaffController::class);
});
