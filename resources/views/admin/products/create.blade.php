@extends('admin.layouts.app')

@section('title', 'Tambah Produk')

@section('content')

    <div class="card p-4">

        <h3 class="mb-4">Tambah Produk</h3>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if (isset($counter))
                <input type="hidden" name="counter_id" value="{{ $counter->id }}">

                <div class="mb-3">
                    <label>Counter</label>
                    <input type="text" class="form-control" value="{{ $counter->nama }}" disabled>
                </div>
            @else
                <div class="mb-3">
                    <label>Counter</label>
                    <select name="counter_id" class="form-control" required>
                        <option value="">-- Pilih Counter --</option>
                        @foreach ($counters as $c)
                            <option value="{{ $c->id }}">{{ $c->nama }}</option>
                        @endforeach
                    </select>
                </div>
            @endif


            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Gambar Produk</label>
                <input type="file" name="gambar" class="form-control">
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>

@endsection
