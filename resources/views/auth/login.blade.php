@extends('layouts.auth')

@section('title', 'Masuk')

@section('Head_CSS')
<style>
    .form-login {
        max-width: 360px;
        padding: 1rem;
    }
</style>
@endsection

@section('content')
<main class="form-login w-100 m-auto">
    <h2 class="fw-semibold py-2 text-center">Aplikasi KKN</h2>
    <div class="text-center">
        <img class="mb-4 pt-2" src="{{ asset('favicon.png') }}" alt="" width="128" height="128">
    </div>
    <div class="card">
        <div class="card-body">
            @error('login')
                <div class="container-fluid alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
            <form method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
                        placeholder="name@example.com" required>
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        minlength="6" required>
                    <label for="password">Password</label>
                </div>
                <div class="form-check text-start mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                </div>
                <button class="btn btn-primary w-100 mb-3" type="submit">Login</button>
                <div class="mt-2 text-center">
                    <a href="{{ route('register') }}">Belum punya akun? Yuk, Daftar</a>
                </div>
                <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2023</p>
            </form>
        </div>
    </div>
</main>
@endsection
