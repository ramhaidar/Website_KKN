@extends('admin._admin')

@section('subtitle', 'Sertifikat Mahasiswa')

@section('dashboard_content')
<div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
    style="background-color: transparent">

    <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
        <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
            <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                <div class="card-header fw-bolder fs-3 text-center">Sertifikat</div>
                <div class="card-body text-white flex-grow-1">

                    <div class="container-fluid bg-light shadow p-4 mt-2 mb-4 mx-auto text-center text-dark"
                        id="Sertifikat" style="max-width: 800px; border: 2px solid #000; padding: 50px;">

                        <h1 class="text-dark mb-4 fw-bolder fs-1" style="font-family: 'Arial', sans-serif; ">
                            Sertifikat Penyelesaian
                        </h1>

                        <img class="img-fluid p-0 m-0 mb-5" id="PlaceholderFavicon"
                            src="{{ asset('favicon.png') }}" alt="Responsive image"
                            style="width: 25%; height: auto;">

                        <p class="px-5 py-2 fs-4" style="font-family: 'Arial', sans-serif;">Selamat kepada
                            mahasiswa berikut ini atas penyelesaian Kerja Praktik dengan sukses!<br /> Prestasi
                            Anda
                            patut
                            diapresiasi.</p>

                        <div class="pt-4 mb-4 text-start fs-5">
                            <h4 class="text-dark mb-4 fw-bold fs-3" style="font-family: 'Arial', sans-serif;">
                                Kelompok
                                Mahasiswa</h4>
                            <p class="ps-3"><strong class="fw-bold">Ketua Kelompok:</strong>
                                {{ $user->mahasiswa->nama_ketua }}
                            </p>
                            <p class="ps-3"><strong class="fw-bold">NIM Ketua Kelompok:</strong>
                                {{ $user->mahasiswa->nim }}</p>
                            <p class="ps-3"><strong class="fw-bold">E-Mail Ketua Kelompok:</strong>
                                {{ $user->email }}</p>
                        </div>

                        <div class="mb-4 text-start fs-5">
                            <p class="ps-3"><strong class="fw-bold">Anggota Kelompok:</strong></p>
                            <p class="ps-5">{!! nl2br(e($user->mahasiswa->anggota_kelompok)) !!}</p>
                        </div>

                        <p class="text-start ps-3 fs-5"><strong class="fw-bold">Prodi Kelompok:</strong>
                            {{ $user->mahasiswa->prodi }}</p>
                        <p class="text-start ps-3 fs-5"><strong class="fw-bold">Fakultas Kelompok:</strong>
                            {{ $user->mahasiswa->fakultas }}</p>

                        <div class="pt-4 mb-4 text-start fs-5">
                            <h4 class="text-dark mb-4 fw-bold fs-3" style="font-family: 'Arial', sans-serif;">
                                Dosen
                                Pembimbing Lapangan</h4>
                            <p class="ps-3"><strong class="fw-bold">Nama:</strong>
                                {{ $user->mahasiswa->dpl->nama_dosen }}</p>
                            <p class="ps-3"><strong class="fw-bold">E-Mail:</strong>
                                {{ $user->mahasiswa->dpl->user->email }}</p>
                            <p class="ps-3"><strong class="fw-bold">NIP:</strong>
                                {{ $user->mahasiswa->dpl->nip }}</p>
                            <p class="ps-3"><strong class="fw-bold">Prodi:</strong>
                                {{ $user->mahasiswa->dpl->prodi }}</p>
                            <p class="ps-3"><strong class="fw-bold">Fakultas:</strong>
                                {{ $user->mahasiswa->dpl->fakultas }}</p>
                        </div>

                        <div class="container-fluid pt-2">
                            <div class="text-start d-flex flex-column align-items-start float-end"
                                id="TandaTangan">
                                <h6 class="fw-bold fs-4" style="font-family: 'Arial', sans-serif;">Rabu, 29
                                    November
                                    2023
                                </h6>
                                <h6 class="fw-bold fs-4" style="font-family: 'Arial', sans-serif;">Rektor UNIPDU
                                </h6>
                                <img src="{{ asset('signature.png') }}" alt="Signature"
                                    style="width: 200px; height: auto;">
                                <p class="fw-bold fs-4">Dr. dr. H.M. Zulfikar As'ad, M.MR.</p>
                            </div>
                            <div style="clear: both;"></div>
                        </div>

                    </div>

                    <div
                        class="d-flex justify-content-center align-content-center align-items-center p-0 m-0 w-100">
                        <form
                            class="d-flex p-0 m-0 w-100 justify-content-center align-items-center align-content-center"
                            action="{{ route('admin.sertifikat.download', $user->mahasiswa) }}" method="GET">
                            @csrf

                            <input name="ID_Mahasiswa" type="hidden" value="{{ $user->mahasiswa->id }}">

                            <button class="btn btn-success text-center w-50" type="submit"><i
                                    class="bi bi-file-earmark-arrow-down-fill me-2"></i>Download
                                Sertifikat</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Body_JS')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- JSPDF JS Latest -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
@endsection
