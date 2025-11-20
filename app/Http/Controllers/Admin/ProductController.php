<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Counter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('counter')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counters = Counter::all();
        return view('admin.products.create', compact('counters'));
    }

    public function createForCounter($counterId)
{
    $counter = Counter::findOrFail($counterId);
    return view('admin.products.create', compact('counter'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'counter_id' => 'required|exists:counters,id',
        'nama'       => 'required',
        'deskripsi'  => 'nullable',
        'harga'      => 'required|numeric',
        'gambar'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Simpan gambar
    $namaFile = null;
    if ($request->hasFile('gambar')) {
        $namaFile = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('upload/produk'), $namaFile);
    }

    Product::create([
        'counter_id' => $request->counter_id,
        'nama'       => $request->nama,
        'deskripsi'  => $request->deskripsi,
        'harga'      => $request->harga,
        'gambar'     => $namaFile,
    ]);

    return redirect()->route('admin.products.index')
                     ->with('success', 'Produk berhasil ditambahkan!');
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
     */
    public function edit(string $id)
    {
        $product  = Product::findOrFail($id);
        $counters = Counter::all();
        return view('admin.products.edit', compact('product', 'counters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

    $request->validate([
        'nama'      => 'required',
        'deskripsi' => 'nullable',
        'harga'     => 'required|numeric',
        'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $namaFile = $product->gambar;

    if ($request->hasFile('gambar')) {

        // hapus gambar lama
        if ($product->gambar && file_exists(public_path('upload/produk/' . $product->gambar))) {
            unlink(public_path('upload/produk/' . $product->gambar));
        }

        $namaFile = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('upload/produk'), $namaFile);
    }

    $product->update([
        'nama'      => $request->nama,
        'deskripsi' => $request->deskripsi,
        'harga'     => $request->harga,
        'gambar'    => $namaFile,
    ]);

    return redirect()->route('admin.products.index')
                     ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
