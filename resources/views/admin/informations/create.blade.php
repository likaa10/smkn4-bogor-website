@extends('layouts.admin')
@section('title', 'Tambah Informasi')
@section('content')
<div class="card card-stat p-4" style="max-width:650px;">
    <form action="{{ route('admin.informations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.informations.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
