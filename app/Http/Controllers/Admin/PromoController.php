<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\Product;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Urutkan: Active dulu, lalu expired
        $promos = Promo::with('product')
            ->orderByRaw("CASE WHEN berakhir >= CURDATE() THEN 0 ELSE 1 END")
            ->orderBy('mulai', 'desc')
            ->get();

        return view('admin.promo.index', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.promo.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'deskripsi'  => 'nullable',
            'diskon'     => 'required|numeric|min:1|max:100',
            'mulai'      => 'required|date',
            'berakhir'   => 'required|date|after_or_equal:mulai',
        ]);

        $product = Product::findOrFail($request->product_id);

        // harga asli ambil dari product
        $hargaAsli = $product->harga;
        $diskon = $request->diskon;
        $hargaPromo = $hargaAsli - ($hargaAsli * ($diskon / 100));

        Promo::create([
            'product_id' => $product->id,
            'deskripsi'  => $request->deskripsi,
            'harga_asli' => $hargaAsli,
            'diskon'     => $diskon,
            'harga_setelah_diskon' => $hargaPromo,
            'mulai'      => $request->mulai,
            'berakhir'   => $request->berakhir,
        ]);

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $promo = Promo::with('product')->findOrFail($id);
        return view('admin.promo.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $promo = Promo::findOrFail($id);

        $request->validate([
            'deskripsi' => 'required',
            'diskon' => 'required|numeric|min:1|max:100',
            'mulai' => 'required|date',
            'berakhir' => 'required|date|after_or_equal:mulai',
        ]);

        // hitung ulang harga promo
        $hargaPromo = $promo->harga_asli - ($promo->harga_asli * ($request->diskon / 100));

        $promo->update([
            'deskripsi' => $request->deskripsi,
            'diskon' => $request->diskon,
            'harga_setelah_diskon' => $hargaPromo,
            'mulai' => $request->mulai,
            'berakhir' => $request->berakhir,
        ]);

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Promo::destroy($id);
        return redirect()->back()->with('success', 'Promo berhasil dihapus');
    }
}
