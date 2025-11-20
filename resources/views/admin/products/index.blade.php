@extends('admin.layouts.app')

@section('title', 'Data Produk')

@section('content')

<div class="card p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Produk</h3>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
            <i class="mdi mdi-plus"></i> Tambah Produk
        </a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Counter</th>
                <th>Harga</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td>
                        @if ($p->gambar)
                            <img src="{{ asset('upload/produk/' . $p->gambar) }}" 
                                 width="60" class="rounded">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>{{ $p->nama }}</td>

                    <td>{{ $p->counter->nama }}</td>

                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>

                    <td>
                        <a href="{{ route('admin.products.edit', $p->id) }}" 
                           class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST"
                              style="display:inline-block">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus produk ini?')" 
                                    class="btn btn-danger btn-sm">
                                <i class="mdi mdi-delete"></i> Hapus
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
