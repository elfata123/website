@extends('admin.layouts.app')

@section('title', 'Tambah Promo')

@section('content')
<div class="card p-4">
    <h3>Tambah Promo Produk</h3>

    <form action="{{ route('admin.promo.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Pilih Produk</label>
            <select name="product_id" class="form-control" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Deskripsi Promo</label>
            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label>Diskon (%)</label>
            <input type="number" name="diskon" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Berakhir</label>
            <input type="date" name="berakhir" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.promo.index') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>
@endsection
