<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Merchant - Smart-Catalog UMKM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <b>Smart</b>-Catalog
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Daftar akun merchant</p>

            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input
                        type="text"
                        name="merchant_name"
                        class="form-control @error('merchant_name') is-invalid @enderror"
                        placeholder="Nama merchant"
                        value="{{ old('merchant_name') }}"
                        required
                        autofocus
                    >
                    @error('merchant_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Konfirmasi password"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            </form>

            <p class="mb-0 mt-3">
                <a href="{{ route('login') }}">Sudah punya akun?</a>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('partials.swal')
</body>
</html>
