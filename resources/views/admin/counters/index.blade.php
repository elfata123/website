@extends('admin.layouts.app')

@section('title', 'Data Counter')

@section('content')

<div class="card p-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Data Counter</h3>

        <a href="{{ route('admin.counters.create') }}" class="btn btn-primary btn-sm">
            <i class="mdi mdi-plus"></i> Tambah Counter
        </a>
    </div>

    {{-- TABLE --}}
    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nama Counter</th>
                <th>Lokasi</th>
                <th>Jumlah Staff</th>
                <th style="width: 30%">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($counters as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->lokasi }}</td>

                    <td>
                        <span class="badge bg-info text-light">
                            {{ $item->staff->count() }} Staff
                        </span>
                    </td>

                    <td>

                        {{-- (PENTING) Fungsi aslinya tidak diubah --}}
                        <a href="{{ route('admin.counters.detail', $item->id) }}"
                           class="btn btn-primary btn-sm">
                            <i class="mdi mdi-eye"></i> Lihat Produk
                        </a>

                        <a href="{{ route('admin.counters.detail', $item->id) }}"
                           class="btn btn-info btn-sm">
                            <i class="mdi mdi-account-group"></i> Lihat Staff
                        </a>

                        <a href="{{ route('admin.counters.edit', $item->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('admin.counters.destroy', $item->id) }}"
                              method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus counter?')"
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
