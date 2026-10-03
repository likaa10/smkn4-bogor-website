@extends('layouts.app')
@section('title', $major->name.' - SMKN 4 Kota Bogor')

@section('content')
<style>
    .major-hero{
        position:relative; min-height:260px; display:flex; align-items:flex-end;
        background:linear-gradient(90deg, rgba(10,20,60,.75) 20%, rgba(10,20,60,.25) 100%),
                   url('{{ $major->image ? asset('storage/'.$major->image) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1400&q=80' }}') center/cover;
        color:#fff; padding:30px 0 26px;
    }
    .major-hero .crumb a{ color:#cfd8ea; text-decoration:none; }
    .major-hero .crumb span{ color:var(--gold); }
    .major-hero h1{ font-weight:800; font-size:2.6rem; margin-bottom:4px; }
    .about-icon{ width:64px; height:64px; border-radius:50%; background:#eaf0ff; color:var(--navy); display:flex; align-items:center; justify-content:center; font-size:1.4rem; flex-shrink:0; }
    .learn-card{ border:1px solid #e6e9f2; border-radius:12px; padding:22px 16px; text-align:center; height:100%; }
    .learn-icon{ width:52px; height:52px; border-radius:50%; background:var(--navy); color:#fff; display:flex; align-items:center; justify-content:center; margin:0 auto 12px; font-size:1.1rem; }
    .learn-card h6{ font-weight:700; color:#1c2b52; }
</style>

<div class="major-hero">
    <div class="container">
        <p class="crumb small mb-2">
            <a href="{{ route('home') }}">Beranda</a> &raquo;
            <a href="{{ route('home') }}#jurusan">Jurusan</a> &raquo;
            <span>{{ $major->name }}</span>
        </p>
        <h1>{{ $major->name }}</h1>
        <p class="mb-0">{{ $major->tagline }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row align-items-center g-4 mb-5">
        <div class="col-md-1">
            <div class="about-icon"><i class="fa-solid fa-code"></i></div>
        </div>
        <div class="col-md-6">
            <h4 style="color:var(--navy)">Tentang {{ $major->name }}</h4>
            <p class="text-muted mb-0">{{ $major->description }}</p>
        </div>
        <div class="col-md-5">
            <img src="{{ $major->image ? asset('storage/'.$major->image) : 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=700&q=80' }}"
                 class="img-fluid rounded-3 shadow-sm" alt="{{ $major->name }}">
        </div>
    </div>

    @if($major->points && count($major->points))
        <h4 class="section-title">Apa yang Dipelajari di {{ $major->name }}?</h4>
        <div class="row g-3 mb-5">
            @php
                $learnIcons = ['fa-code','fa-display','fa-database','fa-mobile-screen','fa-gamepad','fa-bug'];
            @endphp
            @foreach($major->points as $title => $desc)
                <div class="col-md-4 col-6">
                    <div class="learn-card">
                        <div class="learn-icon"><i class="fa-solid {{ $learnIcons[$loop->index % count($learnIcons)] }}"></i></div>
                        <h6>{{ $title }}</h6>
                        <p class="small text-muted mb-0">{{ $desc }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <h4 class="section-title">Galeri {{ $major->name }}</h4>
    <div class="row g-3">
        @forelse($galleries as $g)
            <div class="col-md-3 col-6">
                <img src="{{ asset('storage/'.$g->image) }}" class="img-fluid rounded shadow-sm" style="height:150px;width:100%;object-fit:cover;">
            </div>
        @empty
            <p class="text-muted text-center">Belum ada foto untuk jurusan ini.</p>
        @endforelse
    </div>
</div>
@endsection