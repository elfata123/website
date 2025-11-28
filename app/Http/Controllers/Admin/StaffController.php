<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Counter;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::with('counter')->get();
        return view('admin.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource (umum).
     */
    public function create()
    {
        $counters = Counter::all(); // untuk dropdown counter
        return view('admin.staff.create', compact('counters'));
    }

    /**
     * Show the form for creating staff untuk 1 counter tertentu.
     */
    public function createForCounter($counterId)
    {
        $counter = Counter::findOrFail($counterId);
        return view('admin.staff.create', compact('counter'));
    }

    /**
     * Store a newly created staff.
     */
    public function store(Request $request)
    {
        $request->validate([
            'counter_id' => 'nullable|exists:counters,id',
            'nama'       => 'required|string|max:191',
            'jabatan'    => 'required|string|max:191',
        ]);

        Staff::create([
            'counter_id' => $request->counter_id,
            'nama'       => $request->nama,
            'jabatan'    => $request->jabatan,
        ]);

        // Redirect ke counter detail jika ada counter_id, else ke staff index
        if ($request->counter_id) {
            return redirect()
                ->route('admin.counters.detail', $request->counter_id)
                ->with('success', 'Staff berhasil ditambahkan!');
        } else {
            return redirect()
                ->route('admin.staff.index')
                ->with('success', 'Staff umum berhasil ditambahkan!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff data.
     */
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'nama'    => 'required|string|max:191',
            'jabatan' => 'required|string|max:191',
        ]);

        $staff->update([
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()
            ->route('admin.counters.detail', $staff->counter_id)
            ->with('success', 'Staff berhasil diperbarui!');
    }

    /**
     * Remove staff from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $counterId = $staff->counter_id;

        $staff->delete();

        return redirect()
            ->route('admin.counters.detail', $counterId)
            ->with('success', 'Staff berhasil dihapus!');
    }
}
