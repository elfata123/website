@extends('admin.layouts.app')

@section('title', 'Detail Counter')

@section('content')

<div class="card p-4">

    {{-- TITLE + ADD STAFF --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Detail Counter</h3>

        <a href="{{ route('admin.counters.staff.create', $counter->id) }}" 
           class="btn btn-primary btn-sm">
            <i class="mdi mdi-plus"></i> Tambah Staff
        </a>
    </div>

    {{-- COUNTER INFO --}}
    <div class="bg-light p-3 rounded mb-4">
        <h4 class="mb-2">{{ $counter->nama }}</h4>
        <p class="mb-0">
            <strong>Lokasi:</strong> {{ $counter->lokasi }}
        </p>
    </div>

    {{-- STAFF LIST --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Staff</h4>

        <a href="{{ route('admin.counters.staff.create', $counter->id) }}" 
           class="btn btn-primary btn-sm">
            <i class="mdi mdi-plus"></i> Tambah Staff
        </a>
    </div>

    @if ($counter->staff->count() == 0)
        <p class="text-muted">Belum ada staff terdaftar.</p>
    @else
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nama Staff</th>
                    <th>Jabatan</th>
                    <th width="25%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($counter->staff as $s)
                    <tr>
                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->jabatan }}</td>

                        <td>
                            <a href="{{ route('admin.staff.edit', $s->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="mdi mdi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('admin.staff.destroy', $s->id) }}" 
                                  method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus staff ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-delete"></i> Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif


    {{-- PRODUCTS SECTION --}}
    <hr class="my-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Produk</h4>

        <a href="{{ route('admin.counters.products.create', $counter->id) }}" 
           class="btn btn-primary btn-sm">
            <i class="mdi mdi-plus"></i> Tambah Produk
        </a>
    </div>

    @if ($counter->products->count() == 0)
        <p class="text-muted">Belum ada produk terdaftar.</p>
    @else
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th width="15%">Gambar</th>
                    <th>Nama Produk</th>
                    <th width="20%">Harga</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($counter->products as $p)
                    <tr>

                        <td>
                            @if ($p->gambar)
                                <img src="{{ asset('upload/produk/' . $p->gambar) }}" 
                                     width="80" class="rounded">
                            @else
                                <small class="text-muted">Tidak ada</small>
                            @endif
                        </td>

                        <td>{{ $p->nama }}</td>

                        <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>

                        <td>
                            <a href="{{ route('admin.products.edit', $p->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="mdi mdi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('admin.products.destroy', $p->id) }}" 
                                  method="POST" style="display:inline-block">
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
    @endif

</div>

@endsection
