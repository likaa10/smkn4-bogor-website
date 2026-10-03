<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background:#f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .sidebar { min-height:100vh; background:#1e2a4a; width:230px; }
        .sidebar .brand { padding:20px; color:#fff; border-bottom:1px solid rgba(255,255,255,.1); }
        .sidebar .brand small { color:#9fb3d9; display:block; font-size:.7rem; }
        .sidebar a { color:#cfd8ea; padding:12px 20px; display:flex; align-items:center; gap:10px; text-decoration:none; }
        .sidebar a.active, .sidebar a:hover { background:#2a3b66; color:#fff; }
        .topbar { background:#fff; padding:10px 25px; border-bottom:1px solid #e5e5e5; }
        .card-stat { border:none; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,.05); }
        .main-content { flex:1; padding:25px; }
        .wrapper { display:flex; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="sidebar d-flex flex-column">
        <div class="brand">
            <strong>SMKN 4 BOGOR</strong>
            <small>ADMIN PANEL</small>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a href="{{ route('admin.informations.index') }}" class="{{ request()->routeIs('admin.informations.*') ? 'active' : '' }}">
            <i class="fa-solid fa-bullhorn"></i> Informasi Sekolah
        </a>
        <a href="{{ route('admin.majors.index') }}" class="{{ request()->routeIs('admin.majors.*') ? 'active' : '' }}">
            <i class="fa-solid fa-graduation-cap"></i> Jurusan
        </a>
        <a href="{{ route('admin.galleries.index') }}" class="{{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
            <i class="fa-solid fa-images"></i> Galeri
        </a>
        <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <i class="fa-solid fa-envelope"></i> Pesan Masuk
        </a>
        <div class="mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-link text-decoration-none w-100 text-start" style="color:#cfd8ea; padding:12px 20px;">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0">@yield('title')</h4>
                <small class="text-muted">@yield('subtitle')</small>
            </div>
            <div class="text-end">
                <i class="fa-solid fa-circle-user fa-lg"></i> {{ auth()->user()->name }}
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success" id="flashToastAdmin">{{ session('success') }}</div>
            <script>
                setTimeout(function () {
                    var t = document.getElementById('flashToastAdmin');
                    if (t) {
                        t.style.transition = 'opacity .5s ease';
                        t.style.opacity = '0';
                        setTimeout(function () { t.remove(); }, 500);
                    }
                }, 2500);
            </script>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>