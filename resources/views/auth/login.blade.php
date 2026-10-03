<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height:100vh; display:flex; align-items:center; justify-content:center;
            background:linear-gradient(rgba(10,20,50,.5),rgba(10,20,50,.5)), url('{{ asset('images/login-bg.jpg') }}') center/cover;
        }
        .login-card { max-width:380px; width:100%; border-radius:16px; padding:35px; background:rgba(255,255,255,.95); }
    </style>
</head>
<body>
    <div class="login-card shadow">
        <div class="text-center mb-3">
            <h5 class="fw-bold mb-0">LOGIN</h5>
            <small class="text-muted">Sistem Sekolah SMKN 4 Kota Bogor</small>
        </div>

        @if(session('error'))
            <div class="alert alert-danger py-2">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.attempt') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                @error('username')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>
        <p class="text-center small text-muted mt-3 mb-0">&copy; {{ date('Y') }} SMKN 4 Bogor. All Rights Reserved.</p>
    </div>
</body>
</html>