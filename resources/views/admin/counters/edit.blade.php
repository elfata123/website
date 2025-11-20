@extends('admin.layouts.app')

@section('content')
<div class="card p-4">
    <h3>Edit Counter</h3>

    <form action="{{ route('admin.counters.update', $counter->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Counter</label>
            <input type="text" name="nama" value="{{ $counter->nama }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ $counter->lokasi }}" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.counters.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
