@section('subtitle', 'Sertifikat Mahasiswa')

@extends('admin._admin')

@section('Head_CSS')
    <style>
        .action_button {
            width: 7.5vw;
            height: 4vh;
        }
    </style>
@endsection

@if (!isset($mode_halaman))

    @section('dashboard_content')
        <div class="modal fade" id="ModalKonfirmasiHapus" aria-labelledby="ModalKonfirmasiHapusLabel" aria-hidden="true"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalKonfirmasiHapusLabel">Hapus Data</h5>
                        <button class="btn-close shadow-sm border border-3 border-light-subtle" data-bs-dismiss="modal"
                            type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus Kelompok Mahasiswa ini?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary shadow-sm border border-3 border-light-subtle"
                            data-bs-dismiss="modal" type="button"><i class="bi bi-x-lg me-2"></i>Batal</button>
                        <form method="POST" action="{{ route('admin.kelompok_mahasiswa.destroy', 'xx') }}">
                            @csrf
                            <input name="mode_halaman" type="hidden" value="hapus">
                            <input id="delete-id" name="id" type="hidden">
                            <button class="btn btn-danger shadow-sm border border-3 border-light-subtle" type="submit"><i
                                    class="bi bi-trash3-fill me-2"></i>Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
            style="background-color: transparent">

            <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
                <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                    <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                        <div class="card-header fw-bolder fs-3 text-center">Sertifikat</div>
                        <div class="card-body text-white flex-grow-1">

                            <div class="container-fluid p-0 m-0 w-100 h-100">
                                <div class="row justify-content-between px-3 mb-3">
                                    <div class="col p-0 m-0">

                                        <div class="table-responsive p-0 m-0 me-3">
                                            <table class="table table-hover table-dark table-borderless p-0 m-0">
                                                <tbody>
                                                    <tr class="p-0 m-0">
                                                        <th class="p-1 m-0" scope="row">Jumlah Kelompok Mahasiswa:</th>
                                                        <td class="p-1 m-0"><i class="bi bi-people-fill ms-2"></i>
                                                            {{ $jumlah_mahasiswa }} Kelompok</td>
                                                    </tr>
                                                    <tr class="p-0 m-0">
                                                        <th class="p-1 m-0" scope="row">Jumlah Dosen Pembimbing Lapangan:
                                                        </th>
                                                        <td class="p-1 m-0"><i class="bi bi-people-fill ms-2"></i>
                                                            {{ $jumlah_dpl }} DPL</td>
                                                    </tr>
                                                    <tr class="p-0 m-0">
                                                        <th class="p-1 m-0" scope="row">Jumlah Sertifikat:
                                                        </th>
                                                        <td class="p-1 m-0"><i class="bi bi-patch-check-fill ms-2"></i>
                                                            {{ $jumlah_sertifikat }} Sertifikat</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col d-flex w-100 p-0 m-0">
                                        {{-- <div class="d-flex" role="search"> --}}
                                        <div
                                            class="row w-100 justify-content-end align-content-center align-items-center w-100px-3 mb-3">
                                            <div class="col">
                                                <input class="form-control me-2" id="SearchForm" type="search"
                                                    aria-label="Search" placeholder='Pencarian (25 Data)'>
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid w-100 text-center">
                                <div class="row justify-content-center mb-2">
                                    <div class="col-1 p-0 m-0 mx-2">
                                        <button
                                            class="container-fluid btn btn-info shadow-sm border border-3 border-light-subtle"
                                            id="FirstButtonUpper" type="button">
                                            <i class="bi bi-chevron-double-left"></i>
                                        </button>
                                    </div>
                                    <div class="col-1 p-0 m-0 mx-2">
                                        <button
                                            class="container-fluid btn btn-info shadow-sm border border-3 border-light-subtle"
                                            id="BackButtonUpper" type="button">
                                            <i class="bi bi-chevron-left"></i>
                                        </button>
                                    </div>
                                    <div class="col-1 p-0 m-0 mx-2">
                                        <div class="container-fluid btn btn-outline-info shadow-sm border border-3 border-light-subtle"
                                            style="pointer-events: none;">
                                            <p class="p-0 m-0 fw-bold" id="PageIndicatorUpper">Page: 1</p>
                                        </div>
                                    </div>
                                    <div class="col-1 p-0 m-0 mx-2">
                                        <button
                                            class="container-fluid btn btn-info shadow-sm border border-3 border-light-subtle"
                                            id="NextButtonUpper" type="button">
                                            <i class="bi bi-chevron-right"></i>
                                        </button>
                                    </div>
                                    <div class="col-1 p-0 m-0 mx-2">
                                        <button
                                            class="container-fluid btn btn-info shadow-sm border border-3 border-light-subtle"
                                            id="LastButtonUpper" type="button">
                                            <i class="bi bi-chevron-double-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-dark table-bordered border-secondary table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama Ketua</th>
                                        <th scope="col">E-Mail</th>
                                        <th scope="col">Nama Anggota</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Fakultas</th>
                                        <th scope="col">Nama DPL</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="IsiLewatJQuery">
                                </tbody>
                            </table>

                            <div class="container-fluid w-100 text-center">
                                <div class="row justify-content-center mb-2">
                                    <div class="col-1 p-0 m-0 mx-2">
                                        <button
                                            class="container-fluid btn btn-info shadow-sm border border-3 border-light-subtle"
                                            id="FirstButtonLower" type="button">
                                            <i class="bi bi-chevron-double-left"></i>
                                        </button>
                                    </div>
                                    <div class="col-1 p-0 m-0 mx-2">
                                        <button
                                            class="container-fluid btn btn-info shadow-sm border border-3 border-light-subtle"
                                            id="BackButtonLower" type="submit">
                                            <i class="bi bi-chevron-left"></i>
                                        </button>
                                    </div>
                                    <div class="col-1 p-0 m-0 mx-2">
                                        <div class="container-fluid btn btn-outline-info shadow-sm border border-3 border-light-subtle"
                                            style="pointer-events: none;">
                                            <p class="p-0 m-0 fw-bold" id="PageIndicatorLower">Page: 1</p>
                                        </div>
                                    </div>
                                    <div class="col-1 p-0 m-0 mx-2">
                                        <button
                                            class="container-fluid btn btn-info shadow-sm border border-3 border-light-subtle"
                                            id="NextButtonLower" type="submit">
                                            <i class="bi bi-chevron-right"></i>
                                        </button>
                                    </div>
                                    <div class="col-1 p-0 m-0 mx-2">
                                        <button
                                            class="container-fluid btn btn-info shadow-sm border border-3 border-light-subtle"
                                            id="LastButtonLower" type="button">
                                            <i class="bi bi-chevron-double-right"></i>
                                        </button>
                                    </div>
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
            var currentPage = 1; // Initialize current page to 1

            // Update the page indicators
            function updatePageIndicators(page) {
                $('#PageIndicatorUpper').text('Page: ' + page);
                $('#PageIndicatorLower').text('Page: ' + page);
            }

            // Enable or disable the navigation buttons based on the current page
            function updateNavigationButtons(page, lastPage) {
                $('#BackButtonUpper, #BackButtonLower').prop('disabled', page <= 1);
                $('#NextButtonUpper, #NextButtonLower').prop('disabled', page >= data.last_page);
            }
        </script>

        <script>
            function loadData(page) {
                $.ajax({
                    url: "{{ route('admin.kelompok_mahasiswa.getData') }}?page=" + page,
                    type: 'get',
                    dataType: 'json',
                    beforeSend: function() {
                        console.log("Fetching Data...");
                        document.querySelector('#Loader').style.display = '';
                    },
                    success: function(data) {
                        console.log(data);
                        // This is where you handle the data returned from the server
                        $('#IsiLewatJQuery').empty();

                        if (data.nextExists == true) {
                            document.querySelector('#NextButtonUpper').disabled = false;
                            document.querySelector('#NextButtonLower').disabled = false;

                            document.querySelector('#LastButtonUpper').disabled = false;
                            document.querySelector('#LastButtonLower').disabled = false;
                        } else {
                            document.querySelector('#NextButtonUpper').disabled = true;
                            document.querySelector('#NextButtonLower').disabled = true;

                            document.querySelector('#LastButtonUpper').disabled = true;
                            document.querySelector('#LastButtonLower').disabled = true;
                        }

                        $.each(data.DataMahasiswa, function(index, item) {
                            var anggota_kelompok = item.anggota_kelompok ? item.anggota_kelompok.replace(/\n/g, '<br>') : "[ Belum Ada ]";
                            var nama_dosen = item.dpl ? item.dpl.nama_dosen : "[ Belum Ada ]";

                            if (item.laporan_akhir) {
                                var akhirButton = item.laporan_akhir.approved ?
                                    '<button class="btn btn-success action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle" type="submit"><i class="bi bi-eye-fill me-2"></i>Lihat</button>' :
                                    '<button class="btn btn-success action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle disabled" type="submit"><i class="bi bi-eye-fill me-2"></i>Lihat</button>'
                            } else {
                                var akhirButton =
                                    '<button class="btn btn-success action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle disabled" type="submit"><i class="bi bi-eye-fill me-2"></i>Lihat</button>'
                            }

                            $('#IsiLewatJQuery').append('<tr>' +
                                '<th scope="row">' + item.id + '</th>' +
                                '<td>' + item.nama_ketua + '</td>' +
                                '<td>' + item.user.email + '</td>' +
                                '<td>' + anggota_kelompok + '</td>' +
                                '<td>' + item.nim + '</td>' +
                                '<td>' + item.prodi + '</td>' +
                                '<td>' + item.fakultas + '</td>' +
                                '<td>' + nama_dosen + '</td>' +
                                '<td>' +
                                '<form method="POST" action="">' +
                                '@csrf' +
                                '<input name="ID_Mahasiswa" type="hidden" value="' + item.id + '">' +
                                '<input name="mode_halaman" type="hidden" value="lihat_sertifikat">' +
                                akhirButton +
                                '</form>' +
                                '</td>' +
                                '</tr>'
                            );
                        });

                        // Update the page indicators and the navigation buttons
                        updatePageIndicators(page);

                        if (currentPage > 1) {
                            document.querySelector('#BackButtonUpper').disabled = false;
                            document.querySelector('#BackButtonLower').disabled = false;

                            document.querySelector('#FirstButtonUpper').disabled = false;
                            document.querySelector('#FirstButtonLower').disabled = false;
                        } else if (currentPage == 1) {
                            document.querySelector('#BackButtonUpper').disabled = true;
                            document.querySelector('#BackButtonLower').disabled = true;

                            document.querySelector('#FirstButtonUpper').disabled = true;
                            document.querySelector('#FirstButtonLower').disabled = true;
                        }

                        document.querySelector('#Loader').style.display = 'none';
                    }
                });
            }
        </script>

        <script>
            $(document).ready(function() {
                loadData(currentPage); // Load the first page

                document.querySelector('#BackButtonUpper').disabled = true;
                document.querySelector('#BackButtonLower').disabled = true;

                document.querySelector('#NextButtonUpper').disabled = true;
                document.querySelector('#NextButtonLower').disabled = true;

                document.querySelector('#FirstButtonUpper').disabled = true;
                document.querySelector('#FirstButtonLower').disabled = true;

                document.querySelector('#LastButtonUpper').disabled = true;
                document.querySelector('#LastButtonLower').disabled = true;

                // Handle the click event of the "Next" buttons
                $('#NextButtonUpper, #NextButtonLower').click(function() {
                    currentPage++;
                    loadData(currentPage);
                });

                // Handle the click event of the "Back" buttons
                $('#BackButtonUpper, #BackButtonLower').click(function() {
                    currentPage--;
                    loadData(currentPage);
                });

                $('#FirstButtonUpper, #FirstButtonLower').click(function() {
                    currentPage = 1; // Set the current page to the first page
                    loadData(currentPage);
                });

                $('#LastButtonUpper, #LastButtonLower').click(function() {
                    $.ajax({
                        url: "{{ route('admin.kelompok_mahasiswa.lastData') }}", // The endpoint that returns the last page number
                        type: 'get',
                        success: function(response) {
                            currentPage = response
                                .lastPage; // Set the current page to the last page
                            loadData(currentPage);
                        }
                    });
                });

                $('#SearchForm').on('input', function() {
                    var searchQuery = $(this).val().toLowerCase();

                    if (searchQuery === '') {
                        currentPage = 1; // Reset the current page
                        loadData(currentPage); // Load the first page of data
                    }
                });

                $('#SearchForm').on('keyup', function(e) {
                    var searchQuery = $(this).val().toLowerCase();

                    if (searchQuery === '') {
                        currentPage = 1;
                        loadData(currentPage);
                    }

                    if (e.keyCode === 13) { // 13 is the key code for Enter
                        e.preventDefault(); // Prevent the default form submission

                        if (searchQuery != '') {
                            document.querySelector('#BackButtonUpper').disabled = true;
                            document.querySelector('#BackButtonLower').disabled = true;

                            document.querySelector('#NextButtonUpper').disabled = true;
                            document.querySelector('#NextButtonLower').disabled = true;

                            document.querySelector('#FirstButtonUpper').disabled = true;
                            document.querySelector('#FirstButtonLower').disabled = true;

                            document.querySelector('#LastButtonUpper').disabled = true;
                            document.querySelector('#LastButtonLower').disabled = true;

                            $('#PageIndicatorUpper').text('Page: -');
                            $('#PageIndicatorLower').text('Page: -');

                            $.ajax({
                                url: "{{ route('admin.kelompok_mahasiswa.findData') }}?query=" + searchQuery,
                                type: 'get',
                                dataType: 'json',
                                beforeSend: function() {
                                    console.log("Fetching Data...");
                                    document.querySelector('#Loader').style.display = '';
                                },
                                success: function(data) {
                                    console.log(data);
                                    // This is where you handle the data returned from the server
                                    $('#IsiLewatJQuery').empty();

                                    $.each(data.DataMahasiswa, function(index, item) {
                                        var anggota_kelompok = item.anggota_kelompok ? item.anggota_kelompok
                                            .replace(/\n/g, '<br>') : "[ Belum Ada ]";
                                        var nama_dosen = item.dpl ? item.dpl.nama_dosen :
                                            "[ Belum Ada ]";
                                        $('#IsiLewatJQuery').append('<tr>' +
                                            '<th scope="row">' + item.id + '</th>' +
                                            '<td>' + item.nama_ketua + '</td>' +
                                            '<td>' + item.user.email + '</td>' +
                                            '<td>' + anggota_kelompok + '</td>' +
                                            '<td>' + item.nim + '</td>' +
                                            '<td>' + item.prodi + '</td>' +
                                            '<td>' + item.fakultas + '</td>' +
                                            '<td>' + nama_dosen + '</td>' +
                                            '<td>' +
                                            '<form method="POST" action="">' +
                                            '@csrf' +
                                            '<input name="ID_Ubah" type="hidden" value="' +
                                            item.id + '">' +
                                            '<input name="mode_halaman" type="hidden" value="ubah">' +
                                            '<button class="btn btn-primary action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle" type="submit"><i class="bi bi-pencil-square me-2"></i>Ubah</button>' +
                                            '</form>' +
                                            '<input name="ID_Hapus" type="hidden" value="' +
                                            item.id + '">' +
                                            '<button class="btn btn-danger action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle" type="button" data-bs-toggle="modal" data-bs-target="#ModalKonfirmasiHapus" data-id="' +
                                            item.id +
                                            '"><i class="bi bi-trash me-2"></i>Hapus</button>' +
                                            '</td>' +
                                            '</tr>'
                                        );
                                    });

                                    document.querySelector('#Loader').style.display = 'none';
                                }
                            });
                        }
                    }
                });
            });
        </script>

        <script>
            $(document).on('click', '.action_button', function() {
                var id = $(this).attr('data-id');
                $('#delete-id').val(id);
            });
        </script>
    @endsection
@elseif ($mode_halaman == 'lihat_sertifikat')
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
                                    action="{{ route('admin.DownloadSertifikatAdmin') }}" method="GET">
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
                            @if ($laporan_akhir->revisi == null)
                                <div class="container-fluid p-0 m-0">
                                    <h2 class="text-danger fw-bolder text-center">Anda belum melakukan unggah Laporan
                                        Akhir.
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
