@extends('app')

@section('title')
    @hasSection('subtitle')
        @yield('subtitle') | Dashboard Admin
    @else
    @endif
@endsection

@section('content')
    <main class="h-100 w-100 p-0 m-0" style="min-height: 100vh; background-color: transparent">

        <div class="container" style="background-color: transparent; min-height: 100vh; min-width: 100vw">
            <div class="row" style="background-color: transparent; min-height: 100vh; min-width: 100vw">
                <div class="col-2 px-0 py-0 mx-0 my-0 bg-secondary-subtle"
                    style="background-color: transparent; min-height: 100vh">
                    <div class="flex-column flex-shrink-0 p-3 h-100 d-flex flex-column"
                        style="background-color: transparent; min-height: 100vh">
                        <a class="d-flex w-100 align-items-center align-content-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
                            href="{{ url()->current() }}">
                            <i class="bi bi-gear-wide-connected pe-3" style="font-size: 30px;"></i>
                            <span class="py-0 fw-bold text-uppercase" style="font-size: 20px">Dashboard<br>Admin</span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-0 mt-0 mx-2">
                            <li class="nav-item py-1">
                                <a class="nav-link d-flex align-items-center rounded-3 py-3" href="#">
                                    <i class="bi bi-house-fill me-3"
                                        style="font-size: 20px; border-radius: 35%; padding: 4.75px; min-width: 35px; text-align: center;"></i>
                                    <span class="fw-semibold" style="color: white">Beranda</span>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a class="nav-link d-flex align-items-center rounded-3 py-3" href="#">
                                    <i class="bi bi-table me-3"
                                        style="font-size: 20px; border-radius: 35%; padding: 4.75px; min-width: 35px; text-align: center;"></i>
                                    <span class="fw-semibold" style="color: white">Data</span>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a class="nav-link d-flex align-items-center rounded-3 py-3" href="#">
                                    <i class="bi bi-file-earmark-text me-3"
                                        style="font-size: 20px; border-radius: 35%; padding: 4.75px; min-width: 35px; text-align: center;"></i>
                                    <span class="fw-semibold" style="color: white">Laporan</span>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a class="nav-link d-flex align-items-center rounded-3 py-3" href="#">
                                    <i class="bi bi-award-fill me-3"
                                        style="font-size: 20px; border-radius: 35%; padding: 4.75px; min-width: 35px; text-align: center;"></i>
                                    <span class="fw-semibold" style="color: white">Sertifikat</span>
                                </a>
                            </li>
                        </ul>
                        <hr class="mt-0 align-items-start">
                        <ul class="nav nav-pills align-items-start flex-column mb-auto mt-0 mx-2">
                            <li class="nav-item py-1">
                                <a class="nav-link d-flex align-items-center rounded-3 py-3" href="#">
                                    <i class="bi bi-person-fill me-3"
                                        style="font-size: 20px; border-radius: 35%; padding: 4.75px; min-width: 35px; text-align: center;"></i>
                                    <span class="fw-semibold" style="color: white">Akun</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-pills flex-column mx-2 mt-auto">
                            <li class="nav-item py-1">
                                <a class="nav-link d-flex align-items-center justify-content-center rounded-3 py-3"
                                    href="#">
                                    <span class="" style="color: white">
                                        <p class="mt-5 mb-3 text-body-secondary">© 2023</p>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col"
                    style="background-color: transparent; overflow-x: hidden; overflow-y: auto; min-height: 100vh">

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

                    @yield('dashboard_content')
                </div>
            </div>
        </div>

    </main>
@endsection
