@extends('layouts.admin')
@section('title', 'Edit Informasi')
@section('content')
<div class="card card-stat p-4" style="max-width:650px;">
    <form action="{{ route('admin.informations.update', $information) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $information->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $information->description) }}</textarea>
        </div>
        @if($information->image)
            <img src="{{ asset('storage/'.$information->image) }}" width="90" class="mb-2 rounded">
        @endif
        <div class="mb-3">
            <label class="form-label">Ganti Foto</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.informations.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
