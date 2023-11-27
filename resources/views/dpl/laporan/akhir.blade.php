@section('subtitle', 'Laporan Akhir')

@extends('dpl._dpl')

@if ($sudah_punya_dpl == true)
    @section('dashboard_content')
        <div class="modal fade" id="ModalKonfirmasiRevisi" aria-labelledby="ModalKonfirmasiRevisiLabel" aria-hidden="true"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalKonfirmasiRevisiLabel">Revisi Laporan Akhir</h5>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menyimpan Revisi untuk Laporan Akhir Ini?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button"><i
                                class="bi bi-x-lg me-2"></i>Batal</button>
                        <input id="id_hapus" name="id_hapus" type="hidden" value="">

                        <button class="btn btn-warning" type="button" onclick="submitRevisiForm()"><i
                                class="bi bi-pencil-square me-2"></i>Revisi</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ModalKonfirmasiApprove" aria-labelledby="ModalKonfirmasiApprove" aria-hidden="true"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalKonfirmasiApprove">Approve Laporan Akhir</h5>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin melakukan Approve untuk Laporan Akhir Ini?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button"><i
                                class="bi bi-x-lg me-2"></i>Batal</button>
                        <input id="id_hapus" name="id_hapus" type="hidden" value="">

                        <button class="btn btn-success" type="button" onclick="submitApproveForm()"><i
                                class="bi bi-check-circle-fill me-2"></i>Approve</button>
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
                                        value="{{ $user->dpl->mahasiswa_id }}">
                                    <input id="dpl_id" name="dpl_id" type="hidden" value="{{ $user->dpl_id }}">

                                    <!-- Tombol Revisi dan Approve -->
                                    <div class="d-flex justify-content-center pt-2">
                                        <button
                                            class="btn btn-warning text-center w-25 mx-2 shadow-sm border border-3 border-light-subtle"
                                            id="TombolRevisi" data-bs-toggle="modal" data-bs-target="#ModalKonfirmasiRevisi"
                                            type="button"
                                            {{ ($laporan_akhir == null ? 'disabled' : ($laporan_akhir->file_path == null ? 'disabled' : $laporan_akhir->approved)) ? 'disabled' : '' }}>
                                            <i class="bi bi-pencil-square me-2"></i>Revisi Laporan
                                        </button>

                                        <button
                                            class="btn btn-success text-center w-25 mx-2 shadow-sm border border-3 border-light-subtle"
                                            id="TombolAksi" data-bs-toggle="{{ $laporan_akhir == null ? '' : 'modal' }}"
                                            data-bs-target="#ModalKonfirmasiApprove" type="button"
                                            {{ ($laporan_akhir == null ? 'disabled' : ($laporan_akhir->file_path == null ? 'disabled' : $laporan_akhir->approved)) ? 'disabled' : '' }}>
                                            <i class="bi bi-check-circle-fill me-2"></i>Approve Laporan
                                        </button>
                                    </div>

                                    <!-- Status Laporan Akhir -->
                                    <div class="mb-3">
                                        <label class="form-label" for="status_laporan">Status Laporan Akhir</label>
                                        <input
                                            class="form-control {{ ($laporan_akhir == null ? 'bg-secondary text-white' : $laporan_akhir->file_path == null) ? 'bg-danger text-white' : ($laporan_akhir->approved ? 'bg-success text-white' : 'bg-warning text-dark') }}"
                                            id="status_laporan" name="status_laporan" type="text"
                                            value="{{ (($laporan_akhir == null ? 'Belum mengunggah Laporan Akhir.' : $laporan_akhir->file_path == null) ? 'Belum melakukan pengunggahan Laporan Akhir.' : $laporan_akhir->file_path == null) ? 'Mahasiswa belum melakukan pengunggahan Laporan Akhir.' : ($laporan_akhir->approved ? 'Anda telah menyetujui Laporan Akhir Mahasiswa.' : 'Mahasiswa telah melakukan pengunggahan Laporan Akhir, silakan lakukan Revisi atau Approve.') }}"
                                            readonly disabled>
                                    </div>

                                    <!-- Textarea for supervisor's revision -->
                                    <div class="container-fluid p-0 m-0 mb-3 mt-4">
                                        <label class="form-label" for="revisi_pembimbing">Revisi Dosen
                                            Pembimbing</label>
                                        <textarea class="form-control" id="revisi_pembimbing" name="revisi_pembimbing" required>{{ ($laporan_akhir == null ? 'Belum ada Revisi.' : $laporan_akhir->revisi == null) ? 'Belum ada Revisi.' : $laporan_akhir->revisi }}</textarea>
                                    </div>

                                    @if (isset($laporan_akhir->file_path))
                                        <div class="container-fluid p-0 m-0 mt-4">
                                            <embed src="{{ asset('storage/' . $laporan_akhir->file_path) }}#view=Fit"
                                                type="application/pdf" width="100%" height="600px" />
                                        </div>
                                    @endif

                                </form>

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
            function submitApproveForm() {
                $('#mode_halaman').val('approve');

                document.getElementById("FormLaporan").submit();
            }

            function submitRevisiForm() {
                $('#mode_halaman').val('revisi');

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
