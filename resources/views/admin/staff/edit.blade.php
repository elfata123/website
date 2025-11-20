@extends('admin.layouts.app')

@section('title', 'Edit Staff')

@section('content')

<div class="card p-4">

    <h3 class="mb-4">Edit Staff</h3>

    <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Staff</label>
            <input type="text" name="nama" 
                   class="form-control"
                   value="{{ $staff->nama }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Jabatan</label>
            <input type="text" name="jabatan"
                   class="form-control"
                   value="{{ $staff->jabatan }}" required>
        </div>

        <button class="btn btn-primary">Simpan</button>

        <a href="{{ route('admin.counters.detail', $staff->counter_id) }}" 
           class="btn btn-secondary ms-1">Kembali</a>

    </form>

</div>

@endsection
