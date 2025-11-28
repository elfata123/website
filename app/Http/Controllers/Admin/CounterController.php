<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Counter;
use Illuminate\Http\Request;

/**
 * CounterController
 * 
 * Controller untuk mengelola CRUD operasi counter/toko
 * Menampilkan daftar counter, tambah counter baru, edit, dan hapus
 */
class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan semua counter dalam bentuk tabel
     */
    public function index()
    {
        // Ambil semua counter dari database
        $counters = Counter::all();
        // Kirim data ke view admin.counters.index
        return view('admin.counters.index', compact('counters'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat counter baru
     */
    public function create()
    {
        return view('admin.counters.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data counter baru ke database
     * @param Request $request - Data dari form (nama, lokasi)
     */
    public function store(Request $request)
    {
        // Validasi input: nama wajib, lokasi opsional
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'nullable',
        ]);

        // Buat counter baru
        Counter::create($request->all());

        // Redirect ke halaman list counter dengan pesan sukses
        return redirect()->route('admin.counters.index')->with('success', 'Counter berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit untuk counter tertentu
     * @param string $id - ID counter yang akan diedit
     */
    public function edit(string $id)
    {
        // Cari counter berdasarkan ID, jika tidak ada return 404
        $counter = Counter::findOrFail($id);
        return view('admin.counters.edit', compact('counter'));
    }

    /**
     * Update the specified resource in storage.
     * Mengupdate data counter di database
     * @param Request $request - Data form yang sudah diubah
     * @param string $id - ID counter yang diupdate
     */
    public function update(Request $request, string $id)
    {
        // Cari counter dan update dengan data baru
        $counter = Counter::findOrFail($id);
        $counter->update($request->all());

        // Redirect ke list counter dengan pesan sukses
        return redirect()->route('admin.counters.index')->with('success', 'Counter berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus counter dari database
     * @param string $id - ID counter yang dihapus
     */
    public function destroy(string $id)
    {
        // Hapus counter (akan cascade delete staff dan products)
        Counter::destroy($id);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Counter berhasil dihapus');
    }

    /**
     * Menampilkan detail counter beserta staff dan products-nya
     * Digunakan untuk halaman detail admin counter
     * @param int $id - ID counter
     * @return view - admin.counters.detail dengan data counter lengkap
     */
    public function detail($id)
    {
        // Load counter dengan eager loading staff dan products untuk efisiensi
        $counter = Counter::with(['staff', 'products'])->findOrFail($id);
        return view('admin.counters.detail', compact('counter'));
    }
}
