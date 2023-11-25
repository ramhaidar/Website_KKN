@extends('app')

@section('title')
    @hasSection('subtitle')
        @yield('subtitle') | Dashboard DPL
    @else
    @endif
@endsection

@section('content')
    <div class="modal fade" id="ModalKonfirmasiSignOut" aria-labelledby="ModalKonfirmasiSignOutLabel" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalKonfirmasiSignOutLabel">Sign Out</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin ingin Sign Out?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button"><i
                            class="bi bi-x-lg me-2"></i>Batal</button>
                    <a class="btn btn-danger" href="{{ route('signout') }}"><i class="bi bi-door-closed me-2"></i>Sign
                        Out</a>
                </div>
            </div>
        </div>
    </div>

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
                            <span class="py-0 fw-bold text-uppercase" style="font-size: 20px">Dashboard<br>DPL</span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-0 mt-0 mx-2">

                            <li class="nav-item py-1">
                                <a class="nav-link d-flex align-items-center rounded-3 py-3 {{ $navActiveItem == 'beranda' ? 'active' : '' }}"
                                    href="{{ route('beranda_dpl') }}">
                                    <i class="bi bi-house-fill me-3"
                                        style="font-size: 20px; border-radius: 35%; padding: 4.75px; min-width: 35px; text-align: center;"></i>
                                    <span class="fw-semibold" style="color: white">Beranda</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown py-1">
                                <a class="nav-link d-flex align-items-center rounded-3 py-3 {{ $navActiveItem == 'laporan_harian' || $navActiveItem == 'laporan_akhir' ? 'active' : '' }}"
                                    data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <i class="bi bi-file-earmark-text me-3"
                                        style="font-size: 20px; border-radius: 35%; padding: 4.75px; min-width: 35px; text-align: center;"></i>
                                    <span class="fw-semibold" style="color: white">Laporan</span>
                                    <i class="bi bi-caret-down-fill ms-3"></i>
                                </a>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dpl_laporan_harian') }}">
                                            <i class="bi bi-people-fill me-2"></i>
                                            Harian
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dpl_laporan_akhir') }}">
                                            <i class="bi bi-person-lines-fill me-2"></i>
                                            Akhir
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item py-1">
                                <a class="nav-link d-flex align-items-center rounded-3 py-3 {{ $navActiveItem == 'sertifikat' ? 'active' : '' }}"
                                    href="{{ route('dpl_sertifikat') }}">
                                    <i class="bi bi-award-fill me-3"
                                        style="font-size: 20px; border-radius: 35%; padding: 4.75px; min-width: 35px; text-align: center;"></i>
                                    <span class="fw-semibold" style="color: white">Sertifikat</span>
                                </a>
                            </li>

                        </ul>
                        <hr class="mt-0 align-items-start">
                        <ul class="nav nav-pills align-items-start flex-column mt-0 pb-3 mx-2">
                            <li class="nav-item py-1 w-100">
                                <a class="nav-link d-flex align-items-center rounded-3 py-3 {{ $navActiveItem == 'akun' ? 'active' : '' }}"
                                    href="{{ route('dpl_akun') }}">
                                    <i class="bi bi-person-fill me-3"
                                        style="font-size: 20px; border-radius: 35%; padding: 4.75px; min-width: 35px; text-align: center;"></i>
                                    <span class="fw-semibold" style="color: white">Akun</span>
                                </a>
                            </li>
                        </ul>
                        <hr class="mt-0 align-items-start">
                        <ul class="nav nav-pills align-items-start flex-column mt-0 mx-2">
                            <li class="nav-item py-1 w-100">
                                <button
                                    class="nav-link d-flex align-items-center rounded-3 py-3 bg-light-subtle shadow w-100"
                                    data-bs-toggle="modal" data-bs-target="#ModalKonfirmasiSignOut" type="button">
                                    <i class="bi bi-door-closed me-3"
                                        style="font-size: 20px; border-radius: 35%; padding: 4.75px; min-width: 35px; text-align: center;"></i>
                                    <span class="fw-semibold" style="color: white">Sign Out</span>
                                </button>
                            </li>
                        </ul>
                        <ul class="nav nav-pills flex-column mx-2 mt-auto">
                            <li class="nav-item py-1 ">
                                <div class="nav-link d-flex align-items-center justify-content-center rounded-3 py-3"
                                    href="#">
                                    <span class="" style="color: white">
                                        <p class="mt-5 mb-3 text-body-secondary">© 2023</p>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col p-0 m-0"
                    style="background-color: transparent; overflow: auto; height: 100vh; width: 100vw;">

                    @if (session('success'))
                        <div class="d-flex alert alert-success mx-4 mt-5">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="d-flex alert alert-danger mx-4 mt-5">
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

                    <div class="container-fluid w-100 h-100 p-0 m-0" style="background-color: transparent">
                        <div class="container-fluid p-3">
                            @yield('dashboard_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
