<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * AdminAuthController
 * 
 * Controller untuk menangani autentikasi admin
 * Mengelola login, logout, dan verifikasi credentials admin
 */
class AdminAuthController extends Controller
{
    /**
     * Tampilkan halaman login admin
     * 
     * @return \Illuminate\View\View admin.login
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Proses login admin
     * 
     * Validasi email dan password:
     * 1. Cek apakah email terdaftar di tabel admins
     * 2. Verifikasi password menggunakan Hash::check()
     * 3. Jika valid: set session('admin_id') dan redirect ke dashboard
     * 4. Jika invalid: kembali ke login dengan error message
     * 
     * @param Request $request - Menerima email & password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Cari admin berdasarkan email
        $admin = Admin::where('email', $request->email)->first();

        // Verifikasi password dan set session
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Simpan admin_id ke session (lifetime: 525600 menit = 1 tahun)
            session(['admin_id' => $admin->id]);
            return redirect('/admin');
        }

        // Password salah - kembalikan dengan error
        return back()->with('error', 'Email atau password salah');
    }

    /**
     * Logout admin
     * 
     * Menghapus session admin_id dan redirect ke halaman login
     * Membersihkan seluruh session untuk keamanan maksimal
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Hapus session admin_id dan flush semua session
        session()->forget('admin_id');
        session()->flush();

        // Redirect ke login page
        return redirect('/admin/login')->with('message', 'Anda telah logout. Silakan login kembali.');
    }
}
