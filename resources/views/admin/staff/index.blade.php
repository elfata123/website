@extends('admin.layouts.app')

@section('title', 'Data Staff')

@section('content')
<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="card-title mb-0">Data Staff</h3>

        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm">
            <i class="mdi mdi-plus"></i> Tambah Staff
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Counter</th>
                    <th style="width: 180px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($staff as $s)
                <tr>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->jabatan }}</td>

                    <td>
                        @if ($s->counter)
                            <span class="badge badge-info">{{ $s->counter->nama }}</span>
                        @else
                            <span class="badge badge-secondary">Staff Umum</span>
                        @endif
                    </td>

                    <td>

                        <a href="{{ route('admin.staff.edit', $s->id) }}" 
                           class="btn btn-warning btn-sm me-1">
                            <i class="mdi mdi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('admin.staff.destroy', $s->id) }}"
                              method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus staff?')">
                                <i class="mdi mdi-delete"></i> Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection


@push('scripts')
<style>
    thead.bg-dark th {
        background-color: #000 !important;
        color: #fff !important;
    }
</style>
@endpush
