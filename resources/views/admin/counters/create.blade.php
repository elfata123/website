@extends('admin.layouts.app')

@section('content')
<div class="card p-4">
    <h3>Tambah Counter</h3>

    <form action="{{ route('admin.counters.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Counter</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.counters.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
