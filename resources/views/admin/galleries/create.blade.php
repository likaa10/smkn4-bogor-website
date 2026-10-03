@extends('layouts.admin')
@section('title', 'Tambah Foto Galeri')
@section('content')
<div class="card card-stat p-4" style="max-width:650px;">
    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Jurusan (opsional)</label>
            <select name="major_id" class="form-select">
                <option value="">-- Umum --</option>
                @foreach($majors as $m)
                    <option value="{{ $m->id }}" {{ (old('major_id', $selectedMajorId) == $m->id) ? 'selected' : '' }}>
                        {{ $m->name }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Foto akan otomatis tampil di halaman jurusan terkait pada frontend.</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input type="text" name="caption" class="form-control" value="{{ old('caption') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.galleries.index', $selectedMajorId ? ['major_id' => $selectedMajorId] : []) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection