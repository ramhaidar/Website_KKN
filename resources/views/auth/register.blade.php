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
                @if ($errors->any())
                    <div class="d-flex alert alert-danger mx-4 mt-5">
                        @if (count($errors) > 1)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ $errors->first() }}
                        @endif
                    </div>
                @endif
                <h1 class="h3 mb-3 fw-normal text-center">Daftar</h1>
                <form method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="Nama___" type="text" placeholder="Nama" required>
                                <label for="floatingInput">Nama</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="NIM___" type="text" placeholder="NIM" required>
                                <label for="floatingInput">NIM</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="Prodi___" type="text" placeholder="Prodi" required>
                                <label for="floatingInput">Prodi</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="Fakultas___" type="text" placeholder="Fakultas"
                                    required>
                                <label for="floatingInput">Fakultas</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="Periode___" type="text" placeholder="Periode" required>
                                <label for="floatingInput">Periode</label>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="Email___" type="Email" placeholder="Email" required>
                                <label for="floatingInput">Email</label>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="Password___" type="password" placeholder="Password"
                                    required>
                                <label for="floatingPassword">Password</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="Password_Konfirmasi___" type="password"
                                    placeholder="Password" required>
                                <label for="floatingPassword">Konfirmasi Password</label>
                            </div>
                        </div>
                    </div> --}}
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
