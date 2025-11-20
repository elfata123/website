@extends('admin.layouts.app')

@section('title', isset($counter) ? 'Tambah Staff: '.$counter->nama : 'Tambah Staff')

@section('content')

<div class="card p-4">

    <h3 class="mb-4">
        @if(isset($counter))
            Tambah Staff untuk Counter: <strong>{{ $counter->nama }}</strong>
        @else
            Tambah Staff
        @endif
    </h3>

    <form action="{{ route('admin.staff.store') }}" method="POST">
        @csrf

        @if(isset($counter))
            <input type="hidden" name="counter_id" value="{{ $counter->id }}">
        @else
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Counter</label>
                <select name="counter_id" class="form-control" required>
                    <option value="">-- Pilih Counter --</option>
                    @foreach($counters as $c)
                        <option value="{{ $c->id }}">{{ $c->nama }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Staff</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>

        @if(isset($counter))
            <a href="{{ route('admin.counters.detail', $counter->id) }}" 
               class="btn btn-secondary ms-1">Kembali</a>
        @else
            <a href="{{ route('admin.staff.index') }}" 
               class="btn btn-secondary ms-1">Kembali</a>
        @endif

    </form>

</div>

@endsection
