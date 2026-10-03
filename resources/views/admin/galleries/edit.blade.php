@extends('layouts.admin')
@section('title', 'Edit Foto Galeri')
@section('content')
<div class="card card-stat p-4" style="max-width:650px;">
    <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <select name="major_id" class="form-select">
                <option value="">-- Umum --</option>
                @foreach($majors as $m)
                    <option value="{{ $m->id }}" {{ $gallery->major_id == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input type="text" name="caption" class="form-control" value="{{ old('caption', $gallery->caption) }}">
        </div>
        <img src="{{ asset('storage/'.$gallery->image) }}" width="90" class="mb-2 rounded">
        <div class="mb-3">
            <label class="form-label">Ganti Foto</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.galleries.index', ['major_id' => $gallery->major_id]) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection