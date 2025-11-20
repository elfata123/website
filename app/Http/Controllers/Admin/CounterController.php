<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counters = Counter::all();
        return view('admin.counters.index', compact('counters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.counters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'nullable',
        ]);

        Counter::create($request->all());

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
     */
    public function edit(string $id)
    {
        $counter = Counter::findOrFail($id);
        return view('admin.counters.edit', compact('counter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $counter = Counter::findOrFail($id);

        $counter->update($request->all());

        return redirect()->route('admin.counters.index')->with('success', 'Counter berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Counter::destroy($id);

        return redirect()->back()->with('success', 'Counter berhasil dihapus');
    }

    public function detail($id)
    {
        $counter = Counter::with(['staff', 'products'])->findOrFail($id);
        return view('admin.counters.detail', compact('counter'));
    }
}
