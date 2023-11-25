@section('subtitle', 'Laporan Akhir')

@extends('mahasiswa._mahasiswa')

@if ($sudah_punya_dpl == true)
    @section('dashboard_content')
        <div class="modal fade" id="ModalKonfirmasiHapus" aria-labelledby="ModalKonfirmasiHapusLabel" aria-hidden="true"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalKonfirmasiHapusLabel">Hapus Data</h5>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus Data Laporan Akhir Ini?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button"><i
                                class="bi bi-x-lg me-2"></i>Batal</button>
                        <input id="id_hapus" name="id_hapus" type="hidden" value="">

                        <button class="btn btn-danger" type="button" onclick="submitHapusForm()"><i
                                class="bi bi-trash3-fill me-2"></i>Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ModalKonfirmasiUbah" aria-labelledby="ModalKonfirmasiUbah" aria-hidden="true"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalKonfirmasiUbah">Ubah Data</h5>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin mengubah Data Laporan Akhir Ini?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button"><i
                                class="bi bi-x-lg me-2"></i>Batal</button>
                        <input id="id_hapus" name="id_hapus" type="hidden" value="">

                        <button class="btn btn-success" type="button" onclick="submitUbahForm()"><i
                                class="bi bi-pencil-square me-2"></i>Ubah</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
            style="background-color: transparent">

            <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
                <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                    <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                        <div class="card-header fw-bolder fs-3 text-center">Laporan Akhir</div>
                        <div class="card-body text-white flex-grow-1">
                            <div class="container-fluid m-0 p-0 w-100 h-100">

                                <form class="container-fluid p-0 m-0 pt-1 w-100 h-100" id="FormLaporan"
                                    enctype="multipart/form-data" method="POST" action="">
                                    @csrf

                                    <input id="mode_halaman" name="mode_halaman" type="hidden"
                                        value="{{ $laporan_akhir == null ? 'tambah' : 'ubah' }}">
                                    <input id="mahasiswa_id" name="mahasiswa_id" type="hidden"
                                        value="{{ $user->mahasiswa->id }}">
                                    <input id="dpl_id" name="dpl_id" type="hidden"
                                        value="{{ $user->mahasiswa->dpl_id }}">

                                    <div class="mb-3">
                                        <label class="form-label" for="laporan_akhir">Laporan Akhir (PDF) <sup>*Maksimal
                                                10MB</sup></label>
                                        <input class="form-control" id="laporan_akhir" name="laporan_akhir" type="file"
                                            required accept="application/pdf">
                                    </div>

                                    <!-- Tombol Hapus dan Simpan -->
                                    <div class="d-flex justify-content-center pt-2">
                                        <button
                                            class="btn btn-danger text-center w-25 mx-2 shadow-sm {{ ($laporan_akhir == null ? '' : $laporan_akhir->approved) ? 'disabled' : '' }}"
                                            id="TombolHapus" data-bs-toggle="modal" data-bs-target="#ModalKonfirmasiHapus"
                                            type="button" {{ $laporan_akhir == null ? 'disabled' : '' }}>
                                            <i class="bi bi-trash-fill me-2"></i>Hapus Laporan
                                        </button>

                                        <button
                                            class="btn {{ $laporan_akhir == null ? 'btn-primary' : 'btn-success' }} {{ ($laporan_akhir == null ? '' : $laporan_akhir->approved) ? 'disabled' : '' }} text-center w-25 mx-2 shadow-sm"
                                            id="TombolAksi" data-bs-toggle="{{ $laporan_akhir == null ? '' : 'modal' }}"
                                            data-bs-target="#ModalKonfirmasiUbah"
                                            type="{{ $laporan_akhir == null ? 'submit' : 'button' }}"
                                            {{ $laporan_akhir == null ? '' : 'disabled' }}>
                                            <i
                                                class="bi bi-save-fill me-2"></i>{{ $laporan_akhir == null ? 'Tambah Laporan' : 'Ubah Laporan' }}
                                        </button>
                                    </div>

                                </form>

                                <!-- Status Laporan Akhir -->
                                <div class="mb-3">
                                    <label class="form-label" for="status_laporan">Status Laporan Akhir</label>
                                    <input
                                        class="form-control {{ $laporan_akhir == null ? 'bg-danger text-white' : ($laporan_akhir->approved ? 'bg-success text-white' : 'bg-warning text-dark') }}"
                                        id="status_laporan" name="status_laporan" type="text"
                                        value="{{ $laporan_akhir == null ? 'Belum melakukan unggah Laporan Akhir.' : ($laporan_akhir->approved ? 'Laporan Akhir sudah disetujui Dosen Pembimbing Lapangan.' : 'Sudah unggah Laporan Akhir menunggu persetujuan Dosen Pembimbing Lapangan.') }}"
                                        readonly disabled>
                                </div>

                                @if (isset($laporan_akhir))
                                    <!-- Textarea for supervisor's revision -->
                                    <div class="container-fluid p-0 m-0 mb-3 mt-4">
                                        <label class="form-label" for="revisi_pembimbing">Revisi Dosen Pembimbing</label>
                                        <textarea class="form-control" id="revisi_pembimbing" name="revisi_pembimbing" disabled readonly>{{ $laporan_akhir->revisi == null ? 'Silakan tunggu Dosen Pembimbing Lapangan melakukan Approve atau memberikan Revisi...' : $laporan_akhir->revisi }}</textarea>
                                    </div>

                                    <div class="container-fluid p-0 m-0 mt-4">
                                        <embed src="{{ asset('storage/' . $laporan_akhir->file_path) }}#view=Fit"
                                            type="application/pdf" width="100%" height="600px" />
                                    </div>
                                @endif

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
                $('textarea').on('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });

                document.querySelector('#Loader').style.display = 'none';
            });

            $('#laporan_akhir').change(function() {
                if ($(this).val() != '') {
                    $('#TombolAksi').prop('disabled', false);
                } else {
                    $('#TombolAksi').prop('disabled', true);
                }
            });
        </script>

        <script>
            function submitUbahForm() {
                $('#mode_halaman').val('ubah');

                document.getElementById("FormLaporan").submit();
            }

            function submitHapusForm() {
                $('#mode_halaman').val('hapus');

                document.getElementById("FormLaporan").submit();
            }
        </script>
    @endsection
@else
    @section('dashboard_content')
        <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
            style="background-color: transparent">

            <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
                <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                    <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                        <div class="card-header fw-bolder fs-3 text-center">Laporan Akhir</div>
                        <div class="card-body text-white flex-grow-1">
                            <div class="container-fluid m-0 p-0 w-100 h-100">

                                <div class="container-fluid p-0 m-0 pb-1">
                                    <h2 class="text-danger fw-bolder text-center">Anda belum memiliki Dosen Pembimbing
                                        Lapangan.</h2>
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
