@section('subtitle', 'Laporan Harian')

@extends('dpl._dpl')


@if ($sudah_punya_mahasiswa == true)
    @section('dashboard_content')
        <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
            style="background-color: transparent">

            <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
                <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                    <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                        <div class="card-header fw-bolder fs-3 text-center">Laporan Harian</div>
                        <div class="card-body text-white flex-grow-1">
                            <div class="container-fluid m-0 p-0 w-100 h-100">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Hari, Tanggal</th>
                                            <td>{{ $laporan_harian->hari }}, {{ $laporan_harian->tanggal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi Kegiatan</th>
                                            <td>{{ $laporan_harian->tempat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kegiatan</th>
                                            <td>{{ $laporan_harian->jenis_kegiatan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tujuan Kegiatan</th>
                                            <td>{{ $laporan_harian->tujuan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sasaran Kegiatan</th>
                                            <td>{{ $laporan_harian->sasaran }}</td>
                                        </tr>
                                        <tr>
                                            <th>Hambatan Kegiatan</th>
                                            <td>
                                                <div class="alert alert-warning mb-0">
                                                    {{ $laporan_harian->sasaran }}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form class="container-fluid p-0 m-0 pt-1 w-100 h-100" id="FormLaporan"
                                    enctype="multipart/form-data" method="POST" action="{{ route('dosen.laporan_harian.update', $laporan_harian) }}">
                                    @csrf
                                    @method('PATCH')

                                    <!-- Solusi -->
                                    <div class="mb-3">
                                        <label class="form-label" for="solusi">Solusi</label>
                                        <textarea name="solusi" cols="30" rows="10" class="form-control"
                                            placeholder="[ Belum memberikan solusi ]" required>{{ $laporan_harian->solusi }}</textarea>
                                    </div>

                                    @php
                                        $dokumentasi = $laporan_harian->dokumentasi_path
                                            ? asset($laporan_harian->dokumentasi_path) : '';
                                    @endphp
                                    <!-- Dokumentasi -->
                                    <div class="d-flex w-100 align-content-center justify-content-center">
                                        <img class="img-fluid rounded-5 py-2 mb-2 shadow" id="PlaceholderDokumentasi"
                                            src="{{ $dokumentasi }}" alt="Responsive image" style="width: 80%; height: 75%;"
                                            hidden>
                                    </div>

                                    <!-- Tombol Hapus dan Simpan -->
                                    <div class="d-flex justify-content-center pt-2">
                                        <button class="btn btn-primary text-center w-25 mx-2 shadow-sm" type="submit">
                                            <i class="bi bi-save-fill me-2"></i>Submit Solusi
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@else
    @section('dashboard_content')
        <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
            style="background-color: transparent">

            <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
                <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                    <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                        <div class="card-header fw-bolder fs-3 text-center">Laporan Harian</div>
                        <div class="card-body text-white flex-grow-1">
                            <div class="container-fluid m-0 p-0 w-100 h-100">

                                <div class="container-fluid p-0 m-0 pb-1">
                                    <h2 class="text-danger fw-bolder text-center">Anda belum memiliki Kelompok Mahasiswa
                                        Bimbingan.</h2>
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
@endif