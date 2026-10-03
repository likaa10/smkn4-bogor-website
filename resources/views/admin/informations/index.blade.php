@extends('layouts.admin')
@section('title', 'Informasi Sekolah')
@section('subtitle', 'Kelola pengumuman dan kabar terbaru sekolah')

@section('content')
<div class="card card-stat p-3">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.informations.create') }}" class="btn btn-primary btn-sm">+ Tambah Informasi</a>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>No</th><th>Judul</th><th>Foto</th><th>Deskripsi</th><th class="text-center" style="width:110px;">Aksi</th></tr></thead>
            <tbody>
            @forelse($informations as $i => $info)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $info->title }}</td>
                    <td>
                        @if($info->image)<img src="{{ asset('storage/'.$info->image) }}" width="50" height="50" style="object-fit:cover;border-radius:6px;">@endif
                    </td>
                    <td>{{ Str::limit($info->description, 60) }}</td>
                    <td class="text-nowrap">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('admin.informations.edit', $info) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.informations.destroy', $info) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection