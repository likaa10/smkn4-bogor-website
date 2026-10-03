@extends('layouts.admin')
@section('title', 'Dashboard')
@section('subtitle', 'Selamat datang, Admin!')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted"><i class="fa-solid fa-bullhorn text-primary"></i> Informasi</small>
            <h3 class="mb-0">{{ $informationCount }} Data</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted"><i class="fa-solid fa-graduation-cap text-success"></i> Jurusan</small>
            <h3 class="mb-0">{{ $majorCount }} Jurusan</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted"><i class="fa-solid fa-images text-warning"></i> Galeri</small>
            <h3 class="mb-0">{{ $galleryCount }} Foto</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted"><i class="fa-solid fa-envelope text-danger"></i> Pesan Masuk</small>
            <h3 class="mb-0">{{ $messageCount }} Pesan</h3>
        </div>
    </div>
</div>

<div class="card card-stat p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0">Informasi Sekolah</h6>
        <a href="{{ route('admin.informations.create') }}" class="btn btn-primary btn-sm">+ Tambah Informasi</a>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr><th>No</th><th>Judul</th><th>Foto</th><th>Deskripsi</th><th class="text-center" style="width:110px;">Aksi</th></tr>
            </thead>
            <tbody>
            @forelse($informations as $i => $info)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $info->title }}</td>
                    <td>
                        @if($info->image)
                            <img src="{{ asset('storage/'.$info->image) }}" width="50" height="50" style="object-fit:cover;border-radius:6px;">
                        @endif
                    </td>
                    <td>{{ Str::limit($info->description, 60) }}</td>
                    <td class="text-nowrap">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('admin.informations.edit', $info) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.informations.destroy', $info) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus informasi ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada informasi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection