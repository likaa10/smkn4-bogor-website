<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMKN 4 Kota Bogor')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root{
            --navy:#0f2557;
            --navy-dark:#0a1a3d;
            --gold:#f2b90c;
        }
        body { font-family:'Segoe UI', sans-serif; color:#28324a; }
        .navbar-brand strong{ color:var(--navy); display:block; line-height:1.1; }
        .navbar-brand small{ color:#8a93a8; font-size:.65rem; letter-spacing:.5px; }
        .navbar-brand img{
            width:44px; height:44px; border-radius:50%;
            object-fit:cover; border:2px solid var(--gold);
        }
        .nav-link{ color:#3a4256 !important; font-weight:500; }
        .nav-link.active{ color:var(--navy) !important; border-bottom:2px solid var(--navy); }
        .btn-navy{ background:var(--navy); border-color:var(--navy); color:#fff; }
        .btn-navy:hover{ background:var(--navy-dark); border-color:var(--navy-dark); color:#fff; }
        .section-title{ font-weight:700; color:var(--navy); text-align:center; position:relative; padding-bottom:12px; margin-bottom:35px; }
        .section-title:after{ content:''; position:absolute; bottom:0; left:50%; transform:translateX(-50%); width:60px; height:3px; background:var(--gold); border-radius:3px; }
        .section-title.text-start:after{ left:0; transform:none; }
        footer.site-footer{ background:var(--navy); color:#dfe4f2; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo SMKN 4 Bogor">
            <span>
                <strong>SMKN 4 KOTA BOGOR</strong>
                <small>SMK PUSAT KEUNGGULAN</small>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="nav">
            <ul class="navbar-nav align-items-lg-center gap-lg-4">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#jurusan">Jurusan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#informasi">Artikel</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Galeri</a></li>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item"><a class="btn btn-navy btn-sm px-3" href="{{ route('admin.dashboard') }}">Panel Admin</a></li>
                    @else
                        <li class="nav-item"><a class="btn btn-navy btn-sm px-3" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    @endif
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-secondary btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="btn btn-navy btn-sm px-4" href="{{ route('login') }}">Masuk <i class="fa-solid fa-arrow-right ms-1"></i></a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="toast-notif position-fixed top-0 start-50 translate-middle-x mt-3 alert alert-success shadow-sm" style="z-index:1080;" id="flashToast">
        <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
    </div>
    <script>
        setTimeout(function () {
            var t = document.getElementById('flashToast');
            if (t) {
                t.style.transition = 'opacity .5s ease';
                t.style.opacity = '0';
                setTimeout(function () { t.remove(); }, 500);
            }
        }, 2500);
    </script>
@endif

@yield('content')

<footer class="site-footer py-3">
    <div class="container text-center small mb-0">
        &copy; {{ date('Y') }} SMKN 4 Bogor. All Rights Reserved.
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>