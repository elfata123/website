@extends('admin.layouts.app')

@section('title', 'Promo')

@section('content')

<div class="card p-4">

    <div class="d-flex justify-content-between mb-4">
        <h3>Daftar Promo</h3>
        <a href="{{ route('admin.promo.create') }}" class="btn btn-primary btn-sm">
            <i class="mdi mdi-plus"></i> Tambah Promo
        </a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Produk</th>
                <th>Harga Asli</th>
                <th>Diskon</th>
                <th>Harga Promo</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($promos as $p)
            <tr class="{{ $p->isExpired() ? 'bg-light-pink' : '' }}">
                <td>{{ $p->product->nama }}</td>
                <td>Rp{{ number_format($p->harga_asli) }}</td>
                <td>{{ $p->diskon }}%</td>
                <td>Rp{{ number_format($p->harga_setelah_diskon) }}</td>
                <td>{{ $p->mulai }} - {{ $p->berakhir }}</td>

                <td>
                    @if ($p->isExpired())
                        <span class="badge bg-danger">Expired</span>
                    @else
                        <span class="badge bg-success">Active</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('admin.promo.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.promo.destroy', $p->id) }}" method="POST"
                          style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus promo?')" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<style>
.bg-light-pink {
    background-color: #ffe4e9 !important;
}
</style>

@endsection
