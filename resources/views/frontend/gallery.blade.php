@extends('layouts.app')
@section('title', 'Galeri - SMKN 4 Kota Bogor')

@section('content')
<style>
    .page-banner{
        background:linear-gradient(90deg, rgba(10,20,60,.8), rgba(10,20,60,.5)),
                   url('{{ asset('images/galeri-bg.jpg') }}') center/cover;
        color:#fff; padding:70px 0;
    }
    .filter-pill{ border:1px solid #dfe4f2; border-radius:30px; padding:6px 18px; text-decoration:none; color:#28324a; font-size:.85rem; }
    .filter-pill.active, .filter-pill:hover{ background:var(--navy); color:#fff; border-color:var(--navy); }
    .filter-pill.category.active, .filter-pill.category:hover{ background:var(--gold); color:#1c2b52; border-color:var(--gold); }
    .filter-label{ font-size:.75rem; text-transform:uppercase; letter-spacing:.5px; color:#8a93a8; width:100%; text-align:center; margin-bottom:8px; }
    .gallery-card{ border:1px solid #e6e9f2; border-radius:14px; overflow:hidden; height:100%; }
    .gallery-card img{ height:190px; object-fit:cover; width:100%; }
</style>

<div class="page-banner text-center">
    <div class="container">
        <p class="mb-1" style="letter-spacing:1px;">Galeri</p>
        <h1 class="fw-bold">Momen &amp; Kegiatan SMKN 4 Kota Bogor</h1>
    </div>
</div>

<div class="container py-5">
    <p class="filter-label">Filter Jurusan</p>
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-3">
        <a href="{{ route('gallery', array_filter(['category' => request('category')])) }}" class="filter-pill {{ !request('major') ? 'active' : '' }}">Semua</a>
        @foreach($majors as $m)
            <a href="{{ route('gallery', array_filter(['major' => $m->slug, 'category' => request('category')])) }}" class="filter-pill {{ request('major') === $m->slug ? 'active' : '' }}">{{ $m->name }}</a>
        @endforeach
    </div>

    <p class="filter-label">Filter Kategori Produk</p>
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
        <a href="{{ route('gallery', array_filter(['major' => request('major')])) }}" class="filter-pill category {{ !request('category') ? 'active' : '' }}">Semua</a>
        @foreach($categories as $cat)
            <a href="{{ route('gallery', array_filter(['major' => request('major'), 'category' => $cat])) }}" class="filter-pill category {{ request('category') === $cat ? 'active' : '' }}">{{ $cat }}</a>
        @endforeach
    </div>

    <div class="row g-4">
        @forelse($galleries as $g)
            <div class="col-md-3 col-6">
                <div class="gallery-card">
                    <img src="{{ asset('storage/'.$g->image) }}" alt="{{ $g->caption }}">
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <small class="text-muted">{{ $g->major->name ?? 'Umum' }}</small>
                            @if($g->category)
                                <span class="badge bg-primary-subtle text-primary">{{ $g->category }}</span>
                            @endif
                        </div>
                        <p class="small mb-0">{{ $g->caption ?: '-' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada foto di galeri.</p>
        @endforelse
    </div>
</div>
@endsection