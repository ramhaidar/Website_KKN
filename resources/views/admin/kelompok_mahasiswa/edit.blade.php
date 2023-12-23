@extends('admin._admin')

@section('subtitle', 'Data Kelompok Mahasiswa')

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
                                Kelompok Mahasiswa</div>
                            <div></div>
                        </div>

                    </div>
                </div>

                <form method="POST" action="{{ route('admin.kelompok_mahasiswa.update', $mahasiswa) }}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body text-white flex-grow-1">
                        <h5 class="pt-2 pb-3 ps-1">Ubah Data Kelompok</h5>

                        <input name="mode_halaman" type="hidden" value="ubah">
                        <input name="id" type="hidden" value="{{ $mahasiswa->id }}">

                        <div class="form-floating mb-3">
                            <input class="form-control" id="NamaKetua___" name="NamaKetua___" type="text"
                                value="{{ $mahasiswa->nama_ketua }}" required placeholder="Almira Nababan">
                            <label for="NamaKetua___">Nama Ketua</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Email___" name="Email___" type="email___"
                                value="{{ $mahasiswa->user->email }}" required
                                placeholder="name@example.com">
                            <label for="Email___">Email address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Password___" name="Password___" type="password"
                                autocomplete="disable" minlength="6" placeholder="Password___">
                            <label for="Password___">Password (Jangan isi jika tidak ingin mengubah
                                password)</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="AnggotaKelompok___" name="AnggotaKelompok___" type="text" required
                                placeholder="Leave a comment here">{{ $mahasiswa->anggota_kelompok }}</textarea>
                            <label for="AnggotaKelompok___">Anggota Kelompok</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="NIM___" name="NIM___" type="text"
                                value="{{ $mahasiswa->nim }}" value="{{ old('NIM___') }}" required
                                placeholder="8103027">
                            <label for="NIM___">NIM</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Prodi___" name="Prodi___" type="text"
                                value="{{ $mahasiswa->prodi }}" value="{{ old('Prodi___') }}" required
                                placeholder="Sistem Informasi">
                            <label for="Prodi___">Prodi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="Fakultas___" name="Fakultas___" type="text"
                                value="{{ $mahasiswa->fakultas }}" value="{{ old('Fakultas___') }}" required
                                placeholder="Fakultas Teknik">
                            <label for="Fakultas___">Fakultas</label>
                        </div>

                        <input name="DPL_Sebelumnya___" type="hidden"
                            value="{{ isset($dpl_sekarang) ? $dpl_sekarang->id : 'null' }}">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="DPL___" name="DPL___"
                                aria-label="Floating label select example">
                                @if ($dpl_sekarang)
                                    <option value="{{ $dpl_sekarang->id }}"
                                        {{ old('DPL___', $mahasiswa->DPL___) == $dpl_sekarang->id ? 'selected' : '' }}>
                                        {{ $dpl_sekarang->nama_dosen }} ({{ $dpl_sekarang->nip }} -
                                        {{ $dpl_sekarang->prodi }} - {{ $dpl_sekarang->fakultas }})
                                    </option>
                                @else
                                    <option value="null" selected>[ Belum Ada ]</option>
                                @endif
                                @foreach ($dpl_kosong as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('DPL___', $mahasiswa->DPL___) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_dosen }} ({{ $item->nip }} - {{ $item->prodi }} -
                                        {{ $item->fakultas }})
                                    </option>
                                @endforeach
                                @if ($dpl_sekarang)
                                    <option value="null">[ Kosongkan ]</option>
                                @endif
                            </select>
                            <label for="DPL___">Dosen Pembimbing Lapangan (Kosongkan Jika Belum Ada)</label>
                        </div>

                        <div class="d-flex justify-content-center pt-2">
                            <button
                                class="btn btn-primary text-center w-25 shadow-sm border border-3 border-light-subtle"
                                type="submit"><i class="bi bi-pencil-square me-2"></i>Ubah Data</button>
                        </div>
                    </div>
                </form>

                <div class="card-body text-white flex-grow-1"></div>
            </div>
        </div>
    </div>
</div>
@endsection
