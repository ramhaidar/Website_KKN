@extends('layouts.auth')

@section('title', 'Daftar')

@section('Head_CSS')
<style>
    .form-register {
        max-width: 720px;
        padding: 1rem;
    }
</style>
@endsection

@section('content')
<main class="form-register w-100 m-auto">
    <h2 class="fw-semibold py-2 text-center">Aplikasi KKN</h2>
    <div class="text-center">
        <img class="mb-4 pt-2" src="{{ asset('favicon.png') }}" alt="" width="128" height="128">
    </div>
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="container-fluid alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="container-fluid alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <h1 class="h3 mb-3 fw-normal text-center">Daftar</h1>
            <form method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nim" placeholder="NIM" required>
                            <label for="floatingInput">NIM</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating mb-3">
                            {{-- <select name="fakultas" class="form-control" required>
                                <option value="">-- Pilih --</option>
                            </select> --}}
                            <input type="text" class="form-control" name="fakultas" placeholder="Fakultas" required>
                            <label for="floatingInput">Fakultas</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating mb-3">
                            {{-- <select name="prodi" class="form-control" required>
                                <option value="">-- Pilih --</option>
                            </select> --}}
                            <input type="text" class="form-control" name="prodi" placeholder="Program Studi" required>
                            <label for="floatingInput">Program Studi</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nama_ketua" placeholder="Nama Lengkap" required>
                            <label for="floatingInput">Nama Lengkap</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Password" required>
                            <label for="floatingPassword">Konfirmasi Password</label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary w-100 mb-3" type="submit">Daftar</button>
                <div class="mt-2 text-center">
                    <a href="{{ route('login') }}">Sudah punya akun? Yuk, Login</a>
                </div>
                <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2023</p>
            </form>
        </div>
    </div>
</main>
@endsection
