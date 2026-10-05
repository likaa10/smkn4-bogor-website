@extends('layouts.admin')
@section('title', 'Galeri')
@section('subtitle', $activeMajor ? 'Kelola foto galeri jurusan '.$activeMajor->name : 'Kelola semua foto galeri sekolah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        @if($activeMajor)
            <a href="{{ route('admin.majors.index', ['active' => $activeMajor->id]) }}" class="btn btn-sm btn-outline-secondary">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Jurusan
            </a>
        @endif
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <select class="form-select form-select-sm" style="width:auto;" onchange="location.href=this.value">
            <option value="{{ route('admin.galleries.index') }}" {{ !$activeMajor ? 'selected' : '' }}>Semua Jurusan</option>
            @foreach($majors as $m)
                <option value="{{ route('admin.galleries.index', ['major_id' => $m->id]) }}" {{ $activeMajor && $activeMajor->id === $m->id ? 'selected' : '' }}>
                    {{ $m->name }}
                </option>
            @endforeach
        </select>
        <select class="form-select form-select-sm" style="width:auto;" onchange="location.href=this.value">
            <option value="{{ route('admin.galleries.index', array_filter(['major_id' => $activeMajor->id ?? null])) }}" {{ !$activeCategory ? 'selected' : '' }}>Semua Kategori Produk</option>
            @foreach($categories as $cat)
                <option value="{{ route('admin.galleries.index', array_filter(['major_id' => $activeMajor->id ?? null, 'category' => $cat])) }}" {{ $activeCategory === $cat ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>
        <a href="{{ route('admin.galleries.create', $activeMajor ? ['major_id' => $activeMajor->id] : []) }}" class="btn btn-primary btn-sm">
            + Tambah Foto{{ $activeMajor ? ' untuk '.$activeMajor->name : '' }}
        </a>
    </div>
</div>

<div class="row g-3">
    @forelse($galleries as $g)
        <div class="col-md-3">
            <div class="card card-stat p-2">
                <img src="{{ asset('storage/'.$g->image) }}" class="rounded mb-2" style="height:140px;object-fit:cover;">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">{{ $g->major->name ?? 'Umum' }}</small>
                    @if($g->category)
                        <span class="badge bg-primary-subtle text-primary">{{ $g->category }}</span>
                    @endif
                </div>
                <p class="small mb-2">{{ $g->caption }}</p>
                <div class="d-flex gap-1">
                    <a href="{{ route('admin.galleries.edit', $g) }}" class="btn btn-sm btn-primary w-100">Edit</a>
                    <form action="{{ route('admin.galleries.destroy', $g) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')" class="w-100">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger w-100">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">
            Belum ada foto{{ $activeMajor ? ' untuk jurusan '.$activeMajor->name : '' }}{{ $activeCategory ? ' pada kategori '.$activeCategory : '' }}.
            Klik "Tambah Foto" untuk menambahkan.
        </p>
    @endforelse
</div>
@endsection