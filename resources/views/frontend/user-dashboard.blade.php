@extends('layouts.app')
@section('title', 'Dashboard User')

@section('content')
<div class="container py-5">
    <h3>Halo, {{ auth()->user()->name }} 👋</h3>
    <p class="text-muted">Ini adalah area khusus akun User (bukan Admin).</p>

    <h5 class="mt-4">Jurusan</h5>
    <div class="row g-3 mb-4">
        @foreach($majors as $m)
            <div class="col-md-3">
                <a href="{{ route('major.show', $m->slug) }}" class="card p-3 text-decoration-none text-dark h-100">
                    <strong>{{ $m->name }}</strong>
                    <small class="text-muted">{{ $m->tagline }}</small>
                </a>
            </div>
        @endforeach
    </div>

    <h5>Informasi Terbaru</h5>
    <ul class="list-group">
        @forelse($informations as $info)
            <li class="list-group-item">
                <strong>{{ $info->title }}</strong>
                <p class="small text-muted mb-0">{{ Str::limit($info->description, 120) }}</p>
            </li>
        @empty
            <li class="list-group-item text-muted">Belum ada informasi.</li>
        @endforelse
    </ul>
</div>
@endsection