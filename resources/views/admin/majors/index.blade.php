@extends('layouts.admin')
@section('title', 'Daftar Jurusan')
@section('subtitle', 'Kelola informasi jurusan di SMKN 4 Bogor')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.majors.create') }}" class="btn btn-primary btn-sm">+ Tambah Jurusan</a>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="list-group">
            @foreach($majors as $m)
                <div class="list-group-item d-flex justify-content-between align-items-stretch p-0 {{ $active && $active->id === $m->id ? 'active' : '' }}">
                    <a href="{{ route('admin.majors.index', ['active' => $m->id]) }}"
                       class="flex-grow-1 px-3 py-2 text-decoration-none {{ $active && $active->id === $m->id ? 'text-white' : 'text-dark' }}">
                        {{ $m->name }}
                    </a>
                    <a href="{{ route('admin.galleries.index', ['major_id' => $m->id]) }}"
                       title="Kelola foto galeri jurusan {{ $m->name }}"
                       class="px-3 py-2 d-flex align-items-center text-decoration-none {{ $active && $active->id === $m->id ? 'text-white' : 'text-dark' }}"
                       style="border-left:1px solid rgba(0,0,0,.075);">
                        <i class="fa-solid fa-chevron-right small"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-9">
        <div class="card card-stat p-4">
            @if($active)
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5>{{ $active->name }}</h5>
                    <div>
                        <a href="{{ route('admin.galleries.index', ['major_id' => $active->id]) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa-solid fa-images"></i> Kelola Galeri
                        </a>
                        <a href="{{ route('admin.majors.edit', $active) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.majors.destroy', $active) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jurusan ini beserta relasi galerinya?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
                <label class="text-muted small">DESKRIPSI JURUSAN</label>
                <div class="bg-light rounded p-3">
                    {{ $active->tagline ?: $active->description ?: '-' }}
                </div>
                <p class="text-muted small mt-3 mb-0">
                    Klik tanda panah <i class="fa-solid fa-chevron-right"></i> di sebelah kiri, atau tombol
                    <strong>Kelola Galeri</strong>/<strong>Kelola Prestasi</strong> di atas, untuk menambah/mengelola
                    konten jurusan ini. Otomatis tampil di halaman jurusan pada frontend.
                </p>
            @else
                <p class="text-muted mb-0">Belum ada jurusan. Tambahkan jurusan baru untuk mulai mengelola konten.</p>
            @endif
        </div>
    </div>
</div>
@endsection