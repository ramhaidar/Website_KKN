@section('subtitle', 'Laporan Akhir')

@extends('admin._admin')

@section('dashboard_content')
    <div class="modal fade" id="ModalKonfirmasiReset" aria-labelledby="ModalKonfirmasiResetLabel" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalKonfirmasiResetLabel">Hapus Data</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin melakukan reset Data Laporan Akhir Ini?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button"><i
                            class="bi bi-x-lg me-2"></i>Batal</button>
                    <input id="id_hapus" name="id_hapus" type="hidden" value="">

                    <button class="btn btn-danger" type="button"
                    onclick="event.preventDefault(); document.getElementById('reset-form').submit();">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset</button>
                </div>
                <form id="reset-form" action="{{ route('admin.laporan_akhir.destroy', [$mahasiswa, $laporan_akhir]) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
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
                                    value="reset_laporan_akhir">
                                <input id="mahasiswa_id" name="mahasiswa_id" type="hidden"
                                    value="{{ $user->mahasiswa->id }}">
                                <input id="dpl_id" name="dpl_id" type="hidden"
                                    value="{{ $user->mahasiswa->dpl_id }}">
                            </form>

                            <!-- Tombol Revisi dan Approve -->
                            <div class="d-flex justify-content-center pt-2">
                                <button
                                    class="btn btn-danger text-center w-25 mx-2 shadow-sm border border-3 border-light-subtle"
                                    id="TombolAksi" data-bs-toggle="{{ $laporan_akhir == null ? '' : 'modal' }}"
                                    data-bs-target="#ModalKonfirmasiReset" type="button">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i>Reset Laporan
                                </button>
                            </div>

                            <!-- Status Laporan Akhir -->
                            <div class="mb-3">
                                <label class="form-label" for="status_laporan">Status Laporan Akhir</label>
                                <input
                                    class="form-control {{ ($laporan_akhir == null ? 'bg-primary text-white' : $laporan_akhir->file_path == null) ? 'bg-danger text-white' : ($laporan_akhir->approved ? 'bg-success text-white' : 'bg-warning text-dark') }}"
                                    id="status_laporan" name="status_laporan" type="text"
                                    value="{{ ($laporan_akhir == null ? 'Belum mengunggah Laporan Akhir.' : $laporan_akhir->file_path == null) ? 'Belum melakukan pengunggahan Laporan Akhir.' : ($laporan_akhir->approved ? 'Laporan Akhir telah disetujui oleh Dosen Pembimbing Lapangan.' : 'Laporan Akhir telah diunggah dan saat ini sedang menunggu Approval atau Revisi dari Dosen Pembimbing Lapangan.') }}"
                                    readonly disabled>
                            </div>

                            <!-- Textarea for supervisor's revision -->
                            <div class="container-fluid p-0 m-0 mb-3 mt-4">
                                <label class="form-label" for="revisi_pembimbing">Revisi Dosen Pembimbing</label>
                                @if ($laporan_akhir == null)
                                    @php $content = 'Belum ada Revisi.' @endphp
                                @elseif ($laporan_akhir->revisi == null)
                                    @php $content = 'Silakan tunggu Dosen Pembimbing Lapangan melakukan Approve atau memberikan Revisi...' @endphp
                                @else
                                    @php $content = $laporan_akhir->revisi @endphp
                                @endif

                                <textarea class="form-control" id="revisi_pembimbing" name="revisi_pembimbing" disabled readonly>{{ $content }}</textarea>
                            </div>

                            @if (isset($laporan_akhir->file_path))
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
        function submitResetForm() {
            $('#mode_halaman').val('reset_laporan_akhir');

            document.getElementById("FormLaporan").submit();
        }
    </script>
@endsection
