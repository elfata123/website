@extends('admin.layouts.app')

@section('title', 'Edit Promo')

@section('content')

<div class="card p-4">

    <h3>Edit Promo</h3>

    <form action="{{ route('admin.promo.update', $promo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Produk</label>
            <input type="text" class="form-control" value="{{ $promo->product->nama }}" disabled>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required>{{ $promo->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Diskon (%)</label>
            <input type="number" name="diskon" class="form-control" value="{{ $promo->diskon }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="mulai" class="form-control" value="{{ $promo->mulai }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Berakhir</label>
            <input type="date" name="berakhir" class="form-control" value="{{ $promo->berakhir }}" required>
        </div>

        <div class="mb-3">
            <label>Status Promo</label>
            <input type="text" class="form-control"
                   value="{{ $promo->isExpired() ? 'Expired' : 'Active' }}" disabled>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.promo.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>

@endsection
