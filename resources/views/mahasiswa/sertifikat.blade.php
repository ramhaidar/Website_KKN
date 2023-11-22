@section('subtitle', 'Sertifikat')

@extends('mahasiswa._mahasiswa')

@if (isset($laporan_akhir))
    {{-- @if (isset($laporan_akhir) and $jumlah_laporan_harian >= 30) --}}
    @section('dashboard_content')
        <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
            style="background-color: transparent">

            <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
                <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                    <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                        <div class="card-header fw-bolder fs-3 text-center">Sertifikat</div>
                        <div class="card-body text-white flex-grow-1">

                            <div class="container-fluid bg-light shadow p-4 my-5 mx-auto text-center text-dark"
                                id="Sertifikat" style="max-width: 800px; border: 2px solid #000; padding: 50px;">

                                <h1 class="text-dark mb-4 fw-bolder" style="font-family: 'Arial', sans-serif; ">
                                    Sertifikat Penyelesaian
                                </h1>

                                <img class="img-fluid p-0 m-0 mb-5" id="PlaceholderFavicon" src="{{ asset('favicon.ico') }}"
                                    alt="Responsive image" style="width: 25%; height: auto;">

                                <p class="px-5 py-2" style="font-family: 'Arial', sans-serif;">Selamat kepada
                                    mahasiswa berikut ini atas penyelesaian Kerja Praktik dengan sukses! Prestasi Anda patut
                                    diapresiasi.</p>

                                <div class="pt-4 mb-4 text-start">
                                    <h4 class="text-dark mb-4 fw-bold" style="font-family: 'Arial', sans-serif;">Kelompok
                                        Mahasiswa</h4>
                                    <p class="ps-3"><strong class="fw-semibold">Ketua Kelompok:</strong>
                                        {{ $user->mahasiswa->nama_ketua }}
                                    </p>
                                    <p class="ps-3"><strong class="fw-semibold">NIM Ketua Kelompok:</strong>
                                        {{ $user->mahasiswa->nim }}</p>
                                    <p class="ps-3"><strong class="fw-semibold">E-Mail Ketua Kelompok:</strong>
                                        {{ $user->email }}</p>
                                </div>

                                <div class="mb-4 text-start">
                                    <p class="ps-3"><strong class="fw-semibold">Anggota Kelompok:</strong></p>
                                    <p class="ps-5">{!! nl2br(e($user->mahasiswa->anggota_kelompok)) !!}</p>
                                </div>

                                <p class="text-start ps-3"><strong class="fw-semibold">Prodi Kelompok:</strong>
                                    {{ $user->mahasiswa->prodi }}</p>
                                <p class="text-start ps-3"><strong class="fw-semibold">Fakultas Kelompok:</strong>
                                    {{ $user->mahasiswa->fakultas }}</p>
                                <p class="text-start ps-3"><strong class="fw-semibold">Laporan Akhir:</strong>
                                    <a class="text-decoration-none fw-bold text-primary"
                                        href="{{ asset('/storage/' . $laporan_akhir->file_path) }}#view=Fit"
                                        target="_blank">Link</a>
                                </p>

                                <div class="pt-4 mb-4 text-start">
                                    <h4 class="text-dark mb-4 fw-bold" style="font-family: 'Arial', sans-serif;">Dosen
                                        Pembimbing Lapangan</h4>
                                    <p class="ps-3"><strong class="fw-semibold">Nama:</strong>
                                        {{ $user->mahasiswa->dpl->nama_dosen }}</p>
                                    <p class="ps-3"><strong class="fw-semibold">E-Mail:</strong>
                                        {{ $user->mahasiswa->dpl->user->email }}</p>
                                    <p class="ps-3"><strong class="fw-semibold">NIP:</strong>
                                        {{ $user->mahasiswa->dpl->nip }}</p>
                                    <p class="ps-3"><strong class="fw-semibold">Prodi:</strong>
                                        {{ $user->mahasiswa->dpl->prodi }}</p>
                                    <p class="ps-3"><strong class="fw-semibold">Fakultas:</strong>
                                        {{ $user->mahasiswa->dpl->fakultas }}</p>
                                </div>

                                <div class="container-fluid pt-2">
                                    <div class="text-start d-flex flex-column align-items-start float-end" id="TandaTangan">
                                        <h6 class="fw-bold" style="font-family: 'Arial', sans-serif;">Rabu, 29 November 2023
                                        </h6>
                                        <h6 class="fw-bold" style="font-family: 'Arial', sans-serif;">Rektor UNIPDU</h6>
                                        <img src="{{ asset('signature.png') }}" alt="Signature"
                                            style="width: 200px; height: auto;">
                                        <p class="fw-semibold">Dr. dr. H.M. Zulfikar As'ad, M.MR.</p>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('Body_JS')
        <script>
            $(document).ready(function() {
                document.querySelector('#Loader').style.display = 'none';
            });
        </script>
    @endsection
@else
    @section('dashboard_content')
        <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
            style="background-color: transparent">

            <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
                <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                    <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                        <div class="card-header fw-bolder fs-3 text-center">Sertifikat</div>
                        <div class="card-body text-white flex-grow-1">

                            @if ($jumlah_laporan_harian < 30)
                                <div class="container-fluid p-0 m-0 pb-3">
                                    <h2 class="text-danger fw-bolder text-center">Anda belum mengisi Laporan Harian
                                        selama minimal 30 Hari.</h2>
                                </div>
                            @endif
                            @if ($laporan_akhir == null)
                                <div class="container-fluid p-0 m-0">
                                    <h2 class="text-danger fw-bolder text-center">Anda belum melakukan unggah Laporan Akhir.
                                    </h2>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('Body_JS')
        <script>
            $(document).ready(function() {
                document.querySelector('#Loader').style.display = 'none';
            });
        </script>
    @endsection
@endif
