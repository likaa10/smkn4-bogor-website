@extends('layouts.app')
@section('title', 'Beranda - SMKN 4 Kota Bogor')

@section('content')
<style>
    .hero{
        position:relative;
        min-height:420px;
        display:flex; align-items:center;
        background:linear-gradient(90deg, rgba(10,20,60,.75) 0%, rgba(10,20,60,.35) 60%, rgba(10,20,60,.15) 100%),
                   url('{{ asset('images/hero.jpg') }}') center/cover;
        color:#fff;
    }
    .hero p.eyebrow{ letter-spacing:1px; font-size:1.1rem; margin-bottom:0; opacity:.9;}
    .hero h1{ font-weight:800; font-size:2.6rem; }
    .stats-bar{ background:var(--navy); color:#fff; }
    .stats-bar .stat-icon{ width:46px; height:46px; border-radius:50%; background:rgba(255,255,255,.12); display:flex; align-items:center; justify-content:center; }
    .about-photo{ border-radius:14px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,.15); }
    .vmm-card{ border:1px solid #e6e9f2; border-radius:14px; box-shadow:0 8px 20px rgba(15,37,87,.06); text-align:center; padding:22px 16px; height:100%; }
    .vmm-card h6{ color:var(--navy); font-weight:700; }
    .major-card{ border:1px solid #e6e9f2; border-radius:14px; padding:24px 16px; text-align:center; height:100%; transition:.2s; }
    .major-card:hover{ box-shadow:0 10px 25px rgba(15,37,87,.1); transform:translateY(-3px); }
    .major-logo{ width:72px; height:72px; border-radius:50%; margin:0 auto 14px; display:flex; align-items:center; justify-content:center; font-size:1.6rem; color:#fff; }
    .info-card{ border:1px solid #e6e9f2; border-radius:14px; overflow:hidden; height:100%; }
    .info-card img{ height:170px; object-fit:cover; width:100%; }
    .contact-icon{ width:42px; height:42px; border-radius:50%; background:#eaf0ff; color:var(--navy); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .social-icon{ width:38px; height:38px; border-radius:50%; background:var(--navy); color:#fff; display:flex; align-items:center; justify-content:center; text-decoration:none; }
    .map-box{ border-radius:14px; overflow:hidden; box-shadow:0 8px 20px rgba(15,37,87,.08); }
</style>

<div class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <p class="eyebrow">Selamat Datang di</p>
                <h1>SMKN 4 KOTA BOGOR</h1>
                <p class="mb-0">Mewujudkan generasi unggul, berkarakter, dan kompeten di bidang teknologi dan kejuruan.</p>
            </div>
        </div>
    </div>
</div>

<div class="stats-bar py-4">
    <div class="container">
        <div class="row text-center g-3">
            <div class="col-md-4 d-flex align-items-center justify-content-center gap-3">
                <div class="stat-icon"><i class="fa-solid fa-user-graduate"></i></div>
                <div class="text-start">
                    <h5 class="mb-0 fw-bold">1280+</h5>
                    <small>Siswa Aktif</small>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center gap-3">
                <div class="stat-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                <div class="text-start">
                    <h5 class="mb-0 fw-bold">50+</h5>
                    <small>Guru Profesional</small>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center gap-3">
                <div class="stat-icon"><i class="fa-solid fa-globe"></i></div>
                <div class="text-start">
                    <h5 class="mb-0 fw-bold">{{ $majors->count() }}</h5>
                    <small>Jurusan Unggul</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5" id="tentang">
    <h2 class="section-title">Tentang SMKN 4 KOTA BOGOR</h2>
    <div class="row align-items-center g-4">
        <div class="col-md-5">
            <img src="{{ asset('images/tentang.jpg') }}" class="img-fluid about-photo" alt="Gedung sekolah">
        </div>
        <div class="col-md-7">
            <p>SMK Negeri 4 Kota Bogor merupakan sekolah menengah kejuruan negeri
                 yang berfokus pada bidang Teknologi Informasi dan Komunikasi serta
                  Teknologi dan Rekayasa. Berdiri pada tahun 2008 dan mulai beroperasi pada tahun 2009,
                   SMKN 4 Bogor kini telah berakreditasi A
                 dan dikenal dengan jargon KR4BAT (Kejuruan Empat Hebat).</p>
        </div>
    </div>
    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <div class="vmm-card">
                <h6>Visi</h6>
                <p class="small text-muted mb-0">Mewujudkan generasi unggul, berkarakter, dan kompeten di bidang teknologi dan kejuruan.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="vmm-card">
                <h6>Misi</h6>
                <p class="small text-muted mb-0">Menyelenggarakan pendidikan kejuruan bermutu sesuai standar industri.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="vmm-card">
                <h6>Moto</h6>
                <p class="small text-muted mb-0">“Akhlak Terpuji, Ilmu Terkaji, Terampil dan Teruji.”</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5">
    <div class="container">
        <h2 class="section-title">Jurusan Unggul SMKN 4 KOTA BOGOR</h2>
        <div class="row g-4">
            @php
                $colors = ['#2f6fed', '#6b7280', '#0fb37e', '#e0a30d'];
                $icons = ['fa-code', 'fa-network-wired', 'fa-car', 'fa-house-chimney'];
            @endphp
            @foreach($majors as $i => $m)
                <div class="col-md-3 col-6">
                    <a href="{{ route('major.show', $m->slug) }}" class="text-decoration-none text-dark">
                        <div class="major-card">
                            <div class="major-logo" style="background:{{ $colors[$i % 4] }}">
                                <i class="fa-solid {{ $icons[$i % 4] }}"></i>
                            </div>
                            <strong>{{ $m->name }}</strong>
                            <p class="small text-muted mt-2 mb-0">{{ $m->tagline ?: '"Unggul & Berprestasi"' }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="container py-5" id="informasi">
    <h2 class="section-title">Informasi SMKN 4 KOTA BOGOR</h2>
    <div class="row g-4">
        @forelse($informations as $info)
            <div class="col-md-4">
                <div class="info-card">
                    <img src="{{ $info->image ? asset('storage/'.$info->image) : asset('images/informasi-default.jpg') }}" alt="{{ $info->title }}">
                    <div class="p-3">
                        <h6 class="mb-1">{{ $info->title }}</h6>
                        <p class="small text-muted mb-0">{{ Str::limit($info->description, 90) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada informasi.</p>
        @endforelse
    </div>
    <div class="text-end mt-3">
        <a href="{{ route('gallery') }}" class="text-decoration-none fw-semibold" style="color:var(--navy)">Informasi lainnya <i class="fa-solid fa-angle-right"></i></a>
    </div>
</div>

<div class="container py-5" id="kontak">
    <h2 class="section-title text-start">Hubungi Kami</h2>
    <div class="row g-4">
        <div class="col-md-5">
            <div class="d-flex gap-3 mb-4">
                <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div>
                    <strong>Alamat</strong>
                    <p class="small text-muted mb-0">Jalan Raya Tajur, Kampung Buntar RT.02/RW.08, Kelurahan Muarasari, Kecamatan Bogor Selatan, Kota Bogor, Jawa Barat 16137</p>
                </div>
            </div>
            <div class="d-flex gap-3 mb-4">
                <div class="contact-icon"><i class="fa-solid fa-phone"></i></div>
                <div>
                    <strong>Telepon</strong>
                    <p class="small text-muted mb-0">+62 821 226 2442</p>
                </div>
            </div>
            <div class="d-flex gap-3 mb-4">
                <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
                <div>
                    <strong>Email</strong>
                    <p class="small text-muted mb-0">smkn4@smkn4bogor.sch.id</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="https://www.facebook.com/SMK Negri 4 Bogor" target="_blank" rel="noopener" class="social-icon" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
<a href="https://www.youtube.com/@SMK NEGRI 4 BOGOR" target="_blank" rel="noopener" class="social-icon" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
<a href="https://www.instagram.com/smkn4kotabogor" target="_blank" rel="noopener" class="social-icon" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        <div class="col-md-7">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('contact.send') }}" method="POST" class="border rounded-4 p-4">
                @csrf
                <div class="mb-3">
                    <label class="form-label small">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small">Pesan</label>
                    <textarea name="message" class="form-control" rows="4" placeholder="Tulis pesan Anda" required>{{ old('message') }}</textarea>
                </div>
                <button class="btn btn-navy w-100">Kirim Pesan</button>
            </form>
        </div>
    </div>

    <div class="map-box mt-5">
        <iframe src="https://www.google.com/maps?q=SMKN%204%20Kota%20Bogor&output=embed" width="100%" height="320" style="border:0;" allowfullscreen loading="lazy"></iframe>
    </div>
</div>
@endsection