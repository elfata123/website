@extends('admin.layouts.app')

@section('title', 'Edit Produk')

@section('content')

<div class="card p-4">

    <h3 class="mb-4">Edit Produk</h3>

    <form action="{{ route('admin.products.update', $product->id) }}" 
          method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Counter</label>
            <select name="counter_id" class="form-control" required>
                @foreach ($counters as $c)
                    <option value="{{ $c->id }}" 
                        {{ $product->counter_id == $c->id ? 'selected' : '' }}>
                        {{ $c->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ $product->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $product->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control"
                   value="{{ $product->harga }}" required>
        </div>

        <div class="mb-3">
            <label>Gambar Produk</label> <br>

            @if ($product->gambar)
                <img src="{{ asset('upload/produk/' . $product->gambar) }}" 
                     width="120" class="rounded mb-2 d-block">
            @endif

            <input type="file" name="gambar" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>

        <a href="{{ route('admin.products.index') }}" 
           class="btn btn-secondary">Kembali</a>
    </form>

</div>

@endsection
