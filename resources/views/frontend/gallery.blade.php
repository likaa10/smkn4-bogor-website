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
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
        <a href="{{ route('gallery') }}" class="filter-pill {{ !request('major') ? 'active' : '' }}">Semua</a>
        @foreach($majors as $m)
            <a href="{{ route('gallery', ['major' => $m->slug]) }}" class="filter-pill {{ request('major') === $m->slug ? 'active' : '' }}">{{ $m->name }}</a>
        @endforeach
    </div>

    <div class="row g-4">
        @forelse($galleries as $g)
            <div class="col-md-3 col-6">
                <div class="gallery-card">
                    <img src="{{ asset('storage/'.$g->image) }}" alt="{{ $g->caption }}">
                    <div class="p-3">
                        <small class="text-muted">{{ $g->major->name ?? 'Umum' }}</small>
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