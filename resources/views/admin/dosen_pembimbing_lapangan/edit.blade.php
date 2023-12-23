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
                                style="position: absolute; left: 50%; transform: translateX(-50%);">Ubah
                                Dosen Pembimbing Lapangan</div>
                            <div></div>
                        </div>

                    </div>
                </div>

                <form method="POST" action="{{ route('admin.dosen_pembimbing_lapangan.update', $dpl) }}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body text-white flex-grow-1">
                        <h5 class="pt-2 pb-3 ps-1">Ubah Data Kelompok</h5>

                        <input name="mode_halaman" type="hidden" value="ubah">
                        <input name="id" type="hidden" value="{{ $dpl->id }}">

                        <div class="form-floating mb-3">
                            <input class="form-control" id="NamaDPL___" name="NamaDPL___" type="text"
                                value="{{ $dpl->nama_dosen }}" required placeholder="Almira Nababan">
                            <label for="NamaDPL___">Nama Dosen</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Email___" name="Email___" type="email___"
                                value="{{ $dpl->user->email }}" required placeholder="name@example.com">
                            <label for="Email___">Email address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Password___" name="Password___" type="password"
                                autocomplete="disable" minlength="6" placeholder="Password___">
                            <label for="Password___">Password (Jangan isi jika tidak ingin mengubah
                                password)</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="NIP___" name="NIP___" type="text"
                                value="{{ $dpl->nip }}" value="{{ old('NIP___') }}" required
                                placeholder="8103027">
                            <label for="NIP___">NIP</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Prodi___" name="Prodi___" type="text"
                                value="{{ $dpl->prodi }}" value="{{ old('Prodi___') }}" required
                                placeholder="Sistem Informasi">
                            <label for="Prodi___">Prodi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Fakultas___" name="Fakultas___" type="text"
                                value="{{ $dpl->fakultas }}" value="{{ old('Fakultas___') }}" required
                                placeholder="Fakultas Teknik">
                            <label for="Fakultas___">Fakultas</label>
                        </div>

                        <input name="KetuaKelompok_Sebelumnya___" type="hidden"
                            value="{{ isset($mahasiswa_sekarang) ? $mahasiswa_sekarang->id : 'null' }}">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="KetuaKelompok___" name="KetuaKelompok___"
                                aria-label="Floating label select example">
                                @if ($mahasiswa_sekarang)
                                    <option value="{{ $mahasiswa_sekarang->id }}"
                                        {{ old('KetuaKelompok___', $dpl->KetuaKelompok___) == $mahasiswa_sekarang->id ? 'selected' : '' }}>
                                        {{ $mahasiswa_sekarang->nama_ketua }} ({{ $mahasiswa_sekarang->nim }}
                                        -
                                        {{ $mahasiswa_sekarang->prodi }} -
                                        {{ $mahasiswa_sekarang->fakultas }})
                                    </option>
                                @else
                                    <option value="" selected>[ Belum Ada ]</option>
                                @endif
                                @foreach ($mahasiswa_kosong as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('KetuaKelompok___', $dpl->KetuaKelompok___) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_ketua }} ({{ $item->nim }} - {{ $item->prodi }} -
                                        {{ $item->fakultas }})
                                    </option>
                                @endforeach
                                @if ($mahasiswa_sekarang)
                                    <option value="">[ Kosongkan ]</option>
                                @endif
                            </select>
                            <label for="KetuaKelompok___">Ketua Kelompok (Kosongkan Jika Belum
                                Ada)</label>
                        </div>

                        <div class="d-flex justify-content-center pt-2">
                            <button
                                class="btn btn-primary text-center w-25 shadow-sm border border-3 border-light-subtle"
                                type="submit">
                                <i class="bi bi-pencil-square me-2"></i>Ubah Data</button>
                        </div>
                    </div>
                </form>

                <div class="card-body text-white flex-grow-1"></div>
            </div>
        </div>
    </div>
</div>
@endsection
