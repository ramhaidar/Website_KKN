@extends('app')

@section('title', 'Login')

@section('content')
    <main class="container-fluid" style="background-color: transparent; min-height: 100vh">
        <div class="row align-items-center" style="background-color: transparent; min-height: 100vh">
            <div
                class="container-fluid h-75 w-25 px-4 py-4 bg-secondary-subtle rounded-5 text-center justify-content-center align-items-center">
                <form class="container-fluid mx-2 justify-content-center align-items-center" method="POST">
                    @csrf

                    <h2 class="fw-semibold py-2">Aplikasi KKN</h2>

                    <img class="mb-4 pt-2" src="{{ asset('favicon.png') }}" alt="" width="auto" height="225">

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

                    <h1 class="h3 mb-3 mt-3 fw-normal">Login</h1>

                    <div class="form-floating py-1">
                        <input class="form-control" id="floatingInput" name="email" type="email"
                            value="{{ old('email') }}" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating py-1">
                        <input class="form-control" id="floatingPassword" name="password" type="password" minlength="6"
                            required>
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="d-flex justify-content-center form-check text-start my-3">
                        <input class="form-check-input px-1" id="flexCheckDefault" name="remember-me" type="checkbox"
                            checked>
                        <label class="form-check-label px-1" for="flexCheckDefault">
                            Remember me
                        </label>
                    </div>

                    <button class="btn btn-primary w-100 py-2 my-1" type="submit">Sign in</button>
                    <p class="mt-5 mb-3 text-body-secondary">© 2023</p>
                </form>
            </div>
        </div>
    </main>
@endsection
