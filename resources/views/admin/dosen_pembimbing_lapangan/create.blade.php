@extends('admin._admin')

@section('subtitle', 'Data DPL')

@section('dashboard_content')
<div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
    style="background-color: transparent">

    <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
        <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
            <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                <div class="card-header fw-bolder fs-3 text-center">
                    <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center">

                        <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                            <a class="btn btn-secondary col-1 text-decoration-none shadow-sm border border-3 border-light-subtle"
                                type="button" href="{{ url()->previous() }}">
                                <i class="bi bi-caret-left-fill pe-2" style="font-style: normal;"></i>Kembali
                            </a>
                            <div class="text-center"
                                style="position: absolute; left: 50%; transform: translateX(-50%);">Tambah
                                Dosen Pembimbing Lapangan</div>
                            <div></div>
                        </div>

                    </div>
                </div>

                <form method="POST" action="{{ route('admin.dosen_pembimbing_lapangan.store') }}">
                    @csrf
                    <div class="card-body text-white flex-grow-1">
                        <h5 class="pt-2 pb-3 ps-1">Masukkan Data Dosen Pembimbing Lapangan</h5>

                        <input name="mode_halaman" type="hidden" value="tambah">

                        <div class="form-floating mb-3">
                            <input class="form-control" id="NamaDPL___" name="NamaDPL___" type="text"
                                value="{{ old('NamaDPL___') }}" required placeholder="Almira Nababan">
                            <label for="NamaDPL___">Nama Dosen</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Email___" name="Email___" type="email___"
                                value="{{ old('Email___') }}" required placeholder="name@example.com">
                            <label for="Email___">Email address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Password___" name="Password___" type="password"
                                autocomplete="disable" required placeholder="Password___" minlength="6">
                            <label for="Password___">Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="NIP___" name="NIP___" type="text"
                                value="{{ old('NIP___') }}" required placeholder="8103027">
                            <label for="NIP___">NIP</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Prodi___" name="Prodi___" type="text"
                                value="{{ old('Prodi___') }}" required placeholder="Sistem Informasi">
                            <label for="Prodi___">Prodi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Fakultas___" name="Fakultas___" type="text"
                                value="{{ old('Fakultas___') }}" required placeholder="Fakultas Teknik">
                            <label for="Fakultas___">Fakultas</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="KetuaKelompok___" name="KetuaKelompok___"
                                aria-label="Floating label select example">
                                <option value=""
                                    {{ old('KetuaKelompok___') == 'null' ? 'selected' : '' }}>[ Belum
                                    Ada ]</option>
                                @foreach ($mahasiswa_kosong as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('KetuaKelompok___') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_ketua }} ({{ $item->nim }} - {{ $item->prodi }} -
                                        {{ $item->fakultas }})
                                    </option>
                                @endforeach
                            </select>
                            <label for="KetuaKelompok___">Nama Ketua</label>
                        </div>

                        <div class="d-flex justify-content-center pt-2">
                            <button
                                class="btn btn-primary text-center w-25 shadow-sm border border-3 border-light-subtle"
                                type="submit"><i class="bi bi-person-plus-fill me-2"></i>Tambah Data</button>
                        </div>
                    </div>
                </form>

                <div class="card-body text-white flex-grow-1"></div>
            </div>
        </div>
    </div>
</div>
@endsection
