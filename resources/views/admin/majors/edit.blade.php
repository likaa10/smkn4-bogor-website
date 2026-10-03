@extends('layouts.admin')
@section('title', 'Edit Jurusan')

@section('content')
<div class="card card-stat p-4" style="max-width:750px;">
    <form action="{{ route('admin.majors.update', $major) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Jurusan</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $major->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tagline / Deskripsi Singkat</label>
            <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $major->tagline) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi Lengkap (bagian "Tentang Jurusan")</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $major->description) }}</textarea>
        </div>
        @if($major->image)
            <img src="{{ asset('storage/'.$major->image) }}" width="90" class="mb-2 rounded">
        @endif
        <div class="mb-3">
            <label class="form-label">Ganti Gambar Jurusan (foto utama di halaman jurusan)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <hr>
        <label class="form-label fw-semibold">Apa yang Dipelajari di Jurusan Ini?</label>
        <p class="text-muted small">Poin materi yang tampil sebagai kartu di halaman jurusan. Kosongkan judul untuk menghapus poin.</p>
        <div id="points-wrapper">
            @forelse($major->points ?? [] as $title => $desc)
                <div class="row g-2 mb-2 point-row">
                    <div class="col-md-4">
                        <input type="text" name="point_title[]" class="form-control" value="{{ $title }}" placeholder="Judul poin">
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="point_desc[]" class="form-control" value="{{ $desc }}" placeholder="Deskripsi singkat poin">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger w-100 remove-point">&times;</button>
                    </div>
                </div>
            @empty
                <div class="row g-2 mb-2 point-row">
                    <div class="col-md-4">
                        <input type="text" name="point_title[]" class="form-control" placeholder="Judul poin">
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="point_desc[]" class="form-control" placeholder="Deskripsi singkat poin">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger w-100 remove-point">&times;</button>
                    </div>
                </div>
            @endforelse
        </div>
        <button type="button" id="add-point" class="btn btn-sm btn-outline-primary mb-4">+ Tambah Poin</button>

        <div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<template id="point-row-template">
    <div class="row g-2 mb-2 point-row">
        <div class="col-md-4">
            <input type="text" name="point_title[]" class="form-control" placeholder="Judul poin">
        </div>
        <div class="col-md-7">
            <input type="text" name="point_desc[]" class="form-control" placeholder="Deskripsi singkat poin">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-outline-danger w-100 remove-point">&times;</button>
        </div>
    </div>
</template>
@endsection

@section('scripts')
<script>
    document.getElementById('add-point').addEventListener('click', function () {
        const template = document.getElementById('point-row-template').content.cloneNode(true);
        document.getElementById('points-wrapper').appendChild(template);
    });
    document.getElementById('points-wrapper').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-point')) {
            e.target.closest('.point-row').remove();
        }
    });
</script>
@endsection