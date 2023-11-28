@section('subtitle', 'Laporan')

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
        <div class="modal fade" id="ModalKonfirmasiReset" aria-labelledby="ModalKonfirmasiResetLabel" aria-hidden="true"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalKonfirmasiResetLabel">Hapus Data</h5>
                        <button class="btn-close shadow-sm border border-3 border-light-subtle" data-bs-dismiss="modal"
                            type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus Kelompok Mahasiswa ini?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary shadow-sm border border-3 border-light-subtle"
                            data-bs-dismiss="modal" type="button"><i class="bi bi-x-lg me-2"></i>Batal</button>
                        <form method="POST" action="{{ route('admin_data_kelompok_mahasiswa') }}">
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
                        <div class="card-header fw-bolder fs-3 text-center">Laporan Harian dan Laporan Akhir</div>
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
                                                        <th class="p-1 m-0" scope="row">Jumlah Laporan Harian:
                                                        </th>
                                                        <td class="p-1 m-0"><i class="bi bi-file-earmark-text ms-2"></i>
                                                            {{ $jumlah_laporan_harian }} Laporan</td>
                                                    </tr>
                                                    <tr class="p-0 m-0">
                                                        <th class="p-1 m-0" scope="row">Jumlah Laporan Akhir:
                                                        </th>
                                                        <td class="p-1 m-0"><i class="bi bi-file-earmark-check ms-2"></i>
                                                            {{ $jumlah_laporan_akhir }} Laporan</td>
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
                    url: '/AmbilDataMahasiswa?page=' + page,
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
                            var anggota_kelompok = item.anggota_kelompok.replace(/\n/g, '<br>');
                            var nama_dosen = item.dpl ? item.dpl.nama_dosen : "[ Belum Ada ]";
                            var harianButton = item.laporan_harians.length > 0 ?
                                '<button class="btn btn-primary action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle" type="submit"><i class="bi bi-file-earmark-plus me-2"></i>Harian</button>' :
                                '<button class="btn btn-primary action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle" type="submit" disabled><i class="bi bi-file-earmark-plus me-2"></i>Harian</button>';
                            var akhirButton = item.laporan_akhir ?
                                '<button class="btn btn-success action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle" type="submit"><i class="bi bi-file-earmark-check-fill me-2"></i>Akhir</button>' :
                                '<button class="btn btn-success action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle" type="submit" disabled><i class="bi bi-file-earmark-check-fill me-2"></i>Akhir</button>';
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
                                '<input name="mode_halaman" type="hidden" value="laporan_harian">' +
                                harianButton +
                                '</form>' +
                                '<form method="POST" action="">' +
                                '@csrf' +
                                '<input name="ID_Mahasiswa" type="hidden" value="' + item.id + '">' +
                                '<input name="mode_halaman" type="hidden" value="laporan_akhir">' +
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
                        url: '/DapatkanHalamanTerakhirMahasiswa', // The endpoint that returns the last page number
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
                                url: '/CariDataMahasiswa?query=' + searchQuery,
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
                                        var anggota_kelompok = item.anggota_kelompok
                                            .replace(/\n/g, '<br>');
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
                                            '<button class="btn btn-danger action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle" type="button" data-bs-toggle="modal" data-bs-target="#ModalKonfirmasiReset" data-id="' +
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
@elseif ($mode_halaman == 'laporan_harian')
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
                        Apakah Anda yakin ingin menghapus Data Laporan Harian Ini?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button"><i
                                class="bi bi-x-lg me-2"></i>Batal</button>
                        <input id="id_hapus" name="id_hapus" type="hidden" value="">

                        <button class="btn btn-danger" type="button" onclick="submitForm()"><i
                                class="bi bi-trash3-fill me-2"></i>Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
            style="background-color: transparent">

            <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
                <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                    <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                        <div class="card-header fw-bolder fs-3 text-center">Laporan Harian</div>
                        <div class="card-body text-white flex-grow-1">
                            <div class="container-fluid m-0 p-0 w-100 h-100">
                                <div
                                    class="d-flex justify-content-between align-items-center align-content-center p-0 m-0 w-100 h-100">
                                    <button class="btn btn-secondary" id="prev"><i
                                            class="bi bi-caret-left-fill pe-2"></i>Sebelumnya</button>
                                    <h4 class="text-center" id="Nama_Bulan"></h4>
                                    <button class="btn btn-secondary" id="next">Selanjutnya<i
                                            class="bi bi-caret-right-fill ps-2"></i></button>
                                </div>
                                <div class="container-fluid m-0 p-0 pt-3 w-100 h-100" id="calendar"></div>

                                <div class="d-flex justify-content-center pt-3">
                                    <button class="btn btn-primary" id="KeHariSekarang">
                                        <i class="bi bi-calendar-date pe-2"></i>Ke Hari Sekarang
                                    </button>
                                </div>

                                <hr class="mt-5 align-items-start">

                                <form class="container-fluid p-0 m-0 pt-1 w-100 h-100" id="FormLaporan"
                                    enctype="multipart/form-data" method="POST" action="">
                                    @csrf
                                    <!-- Mahasiswa ID (Hidden Input) -->
                                    <input name="mahasiswa_id" type="hidden" value="{{ $user->mahasiswa->id }}">
                                    <input id="mode_halaman" name="mode_halaman" type="hidden"
                                        value="tambah_laporan_harian">
                                    <input id="id" name="id" type="hidden" value="">

                                    <!-- Hari -->
                                    <div class="mb-3">
                                        <label class="form-label" for="hari">Hari</label>
                                        <input class="form-control" id="hari" name="hari" type="text"
                                            readonly required>
                                    </div>

                                    <!-- Tanggal -->
                                    <div class="mb-3">
                                        <label class="form-label" for="tanggal">Tanggal</label>
                                        <input class="form-control" id="tanggal" name="tanggal" value=""
                                            readonly required>
                                    </div>

                                    <!-- Jenis Kegiatan -->
                                    <div class="mb-3">
                                        <label class="form-label" for="jenis_kegiatan">Jenis Kegiatan</label>
                                        <input class="form-control" id="jenis_kegiatan" name="jenis_kegiatan"
                                            type="text" required>
                                    </div>

                                    <!-- Tujuan -->
                                    <div class="mb-3">
                                        <label class="form-label" for="tujuan">Tujuan</label>
                                        <textarea class="form-control" id="tujuan" name="tujuan" required></textarea>
                                    </div>

                                    <!-- Sasaran -->
                                    <div class="mb-3">
                                        <label class="form-label" for="sasaran">Sasaran</label>
                                        <textarea class="form-control" id="sasaran" name="sasaran" required></textarea>
                                    </div>

                                    <!-- Hambatan -->
                                    <div class="mb-3">
                                        <label class="form-label" for="hambatan">Hambatan</label>
                                        <textarea class="form-control" id="hambatan" name="hambatan" required></textarea>
                                    </div>

                                    <!-- Solusi -->
                                    <div class="mb-3">
                                        <label class="form-label" for="solusi">Solusi</label>
                                        <textarea class="form-control" id="solusi" name="solusi" required></textarea>
                                    </div>

                                    <!-- Dokumentasi -->
                                    <div class="d-flex w-100 align-content-center justify-content-center">
                                        <img class="img-fluid rounded-5 py-2 mb-2 shadow" id="PlaceholderDokumentasi"
                                            src="" alt="Responsive image" style="width: 80%; height: 75%;"
                                            hidden>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="dokumentasi">Dokumentasi (JPG/PNG) <sup>*Maksimal
                                                2MB</sup></label>
                                        <input class="form-control" id="dokumentasi" name="dokumentasi" type="file"
                                            required accept="image/jpeg, image/png, image/jpg">
                                    </div>

                                    <!-- Tombol Hapus dan Simpan -->
                                    <div class="d-flex justify-content-center pt-2">
                                        <button class="btn btn-danger text-center w-25 mx-2 shadow-sm" id="TombolHapus"
                                            data-bs-toggle="modal" data-bs-target="#ModalKonfirmasiHapus" type="button"
                                            disabled>
                                            <i class="bi bi-trash-fill me-2"></i>Hapus Laporan
                                        </button>

                                        <button class="btn btn-primary text-center w-25 mx-2 shadow-sm" id="TombolAksi"
                                            type="submit">
                                            <i class="bi bi-save-fill me-2"></i>Tambah Laporan
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

    @section('Body_JS')
        <script>
            function updateDateAndDay(selectedDate) {
                // Update the value of #tanggal input
                var formattedDate = selectedDate.toISOString().split('T')[0];
                $('#tanggal').val(formattedDate);

                // Update the value of #hari input
                var dayName = getDayName(selectedDate.getDay());
                $('#hari').val(dayName);

                $('#mode_halaman').val('tambah_laporan_harian');

                $('#TombolHapus').prop('disabled', true);

                fetchData(formattedDate);
            }
        </script>

        <script>
            // Function to fetch data and fill the form
            function fetchData(tanggal) {
                // Get the current user's ID
                var user_id = "{{ $user->id }}";
                console.log("{{ $user->id }}");


                // AJAX request to fetch data
                $.ajax({
                    url: "/AmbilDataLaporanHarianAdmin/", // Change this URL to your API endpoint
                    method: "GET",
                    data: {
                        id: user_id,
                        tanggal: tanggal,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.length > 0) {
                            // Fill the form with data from the database
                            var laporan = data[0]; // Assuming you only want the first record
                            $("#id").val(laporan.id);
                            $("#id_hapus").val(laporan.id);
                            $("#hari").val(laporan.hari);
                            $("#jenis_kegiatan").val(laporan.jenis_kegiatan);
                            $("#tanggal").val(laporan.tanggal);
                            $("#tujuan").val(laporan.tujuan);
                            $("#sasaran").val(laporan.sasaran);
                            $("#hambatan").val(laporan.hambatan);
                            $("#solusi").val(laporan.solusi);
                            // You may also want to handle the file input separately, depending on your requirements
                            // For example, you can display a link to the existing file and allow the user to replace it

                            if (laporan.dokumentasi_path) {
                                $("#PlaceholderDokumentasi").removeAttr("hidden");
                                $("#PlaceholderDokumentasi").attr("src", '/storage/' + laporan.dokumentasi_path);
                            } else {
                                $("#PlaceholderDokumentasi").attr("hidden", true);
                                $("#PlaceholderDokumentasi").attr("src", '');
                            }

                            $('#mode_halaman').val('ubah_laporan_harian');

                            $('#TombolHapus').removeAttr('disabled');

                            $('#TombolAksi').html('<i class="bi bi-pencil-square me-2"></i>Ubah Laporan');
                            $('#TombolAksi').removeClass('btn-primary').addClass('btn-success');

                            AutoHeightTextArea();
                        } else {
                            $('#TombolAksi').html('<i class="bi bi-save-fill me-2"></i>Tambah Laporan');
                            $('#TombolAksi').removeClass('btn-success').addClass('btn-primary');
                        }
                    },
                    error: function(error) {
                        console.error("Error fetching data:", error);
                    }
                });
            }
        </script>

        <script>
            var date = new Date();
            var hari_aktif = date.getDate();

            // Update the value of #tanggal input
            var selectedDate = new Date(date.getFullYear(), date.getMonth(), hari_aktif);
            // Convert to GMT+7 (WIB)
            selectedDate.setHours(selectedDate.getHours() + 7);
            var formattedDate = selectedDate.toISOString().split('T')[0];
            $('#tanggal').val(formattedDate);
            $('#hari').val(getDayName(selectedDate.getDay()));

            function renderCalendar() {
                $.get('/DapatkanBulanLaporanHarianAdmin', {
                    date: date.toISOString()
                }, function(data) {
                    $('#TombolHapus').prop('disabled', true);

                    var today = new Date();
                    var formattedDate = selectedDate.toISOString().split('T')[0];

                    var calendar =
                        '<table class="table"><thead><tr><th style="width: 14%">Senin</th><th style="width: 14%">Selasa</th><th style="width: 14%">Rabu</th><th style="width: 14%">Kamis</th><th style="width: 14%">Jumat</th><th style="width: 14%">Sabtu</th><th style="width: 14%">Minggu</th></tr></thead><tbody><tr>';
                    var dayCounter = 1;

                    var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                        "September", "Oktober", "November", "Desember"
                    ];

                    // Mengubah teks pada elemen dengan id 'Nama_Bulan'
                    $('#Nama_Bulan').text(monthNames[data.month - 1] + ' ' + data.year);

                    // Calculate the offset for the first day of the month
                    var offset = (data.firstDay - 1 + 7) % 7;

                    // Get the number of days in the previous month
                    var prevDate = new Date(date.getFullYear(), date.getMonth(), 0);
                    var prevMonthDays = prevDate.getDate();

                    // Start counting down from the number of days in the previous month
                    var dayNumber = prevMonthDays - offset + 1;

                    // Display the empty cells before the first day of the month
                    for (var i = 0; i < offset; i++) {
                        calendar +=
                            '<td><button class="btn bg-secondary-subtle border-secondary-subtle w-100" disabled>' +
                            dayNumber++ +
                            '</button></td>';
                        dayCounter++;
                    }

                    // Display the days of the month
                    for (var i = 1; i <= data.daysInMonth; i++) {
                        var buttonClass = 'btn-secondary';

                        if (today.getDate() == i && today.getMonth() + 1 == data.month && today.getFullYear() == data
                            .year) {
                            if (dayCounter % 7 === 0 || dayCounter % 7 === 6) {
                                if (dayCounter % 7 === 0) {
                                    buttonClass = 'btn-primary Sabtu disabled';
                                } else if (dayCounter % 7 === 6) {
                                    buttonClass = 'btn-primary Minggu disabled';
                                }
                                $('#FormLaporan').find('input:text, input:password, input:file, select, textarea').val(
                                    '');
                                $('#FormLaporan').find('input:radio, input:checkbox').removeAttr('checked').removeAttr(
                                    'selected');

                                $('#TombolAksi').prop('disabled', true);

                            } else {
                                buttonClass = 'btn-primary';

                                $('#TombolAksi').prop('disabled', false);
                            }
                        } else if (dayCounter % 7 === 0) {
                            buttonClass = 'btn-danger Sabtu disabled';
                        } else if (dayCounter % 7 === 6) {
                            buttonClass = 'btn-danger Minggu disabled';
                        }

                        calendar += '<td><button class="btn ' + buttonClass + ' w-100">' + i + '</button></td>';

                        // If the last day of the week, start a new row
                        if (dayCounter % 7 === 0) {
                            calendar += '</tr><tr>';
                        }

                        dayCounter++;
                    }

                    // Start counting up from 1 for the days of the next month
                    dayNumber = 1;

                    // Add empty <td> elements for the remaining days of the week
                    while (dayCounter % 7 !== 1) {
                        calendar +=
                            '<td><button class="btn bg-secondary-subtle border-secondary-subtle w-100" disabled>' +
                            dayNumber++ +
                            '</button></td>';
                        dayCounter++;
                    }

                    calendar += '</tr></tbody></table>';

                    $('#calendar').html(calendar);

                    // $('#FormLaporan').find('input:text, input:password, input:file, select, textarea').val('');
                    // $('#FormLaporan').find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');

                    // $('#tanggal').val(formattedDate);

                    // // Update the value of #hari input
                    // $('#hari').val(getDayName(selectedDate.getDay()));

                    // fetchData(formattedDate);

                    // Update the active date and day
                    updateDateAndDay(selectedDate);

                    document.querySelector('#Loader').style.display = 'none';
                });
            }

            $('#prev').click(function() {
                date.setMonth(date.getMonth() - 1);
                renderCalendar();
            });

            $('#next').click(function() {
                date.setMonth(date.getMonth() + 1);
                renderCalendar();
            });

            $('#calendar').on('click', 'button.btn-secondary, button.btn-primary, button.btn-danger', function() {
                var isWeekend = $(this).hasClass('Sabtu') || $(this).hasClass('Minggu');

                // Remove btn-primary and add btn-secondary for all buttons initially
                $('button.btn-primary').removeClass('btn-primary').addClass('btn-secondary');

                if (isWeekend) {
                    // Set the clicked weekend button to blue (btn-primary)
                    $(this).removeClass('btn-secondary btn-danger').addClass('btn-primary');
                    // Set other weekend buttons to red (btn-danger)
                    $('button.Sabtu:not(.btn-primary), button.Minggu:not(.btn-primary)').addClass('btn-danger');
                } else {
                    // Set the clicked weekday button to blue (btn-primary)
                    $(this).removeClass('btn-secondary').addClass('btn-primary');
                    // Set all weekend buttons to red (btn-danger)
                    $('button.Sabtu:not(.btn-primary), button.Minggu:not(.btn-primary)').addClass('btn-danger');
                }

                $('button.Sabtu.btn-primary').removeClass('btn-primary').removeClass('btn-secondary').addClass(
                    'btn-danger');

                $('button.Minggu.btn-primary').removeClass('btn-primary').removeClass('btn-secondary').addClass(
                    'btn-danger');

                // Update #KeHariSekarang button
                $('#KeHariSekarang').removeClass('btn-secondary btn-danger').addClass('btn-primary');
                $('#TombolAksi').removeClass('btn-secondary btn-danger').addClass('btn-primary');
                $('#TombolAksi').prop('disabled', false);

                // Update hari_aktif based on the clicked button's value
                hari_aktif = parseInt($(this).text());

                $('#FormLaporan').find('input:text, input:password, input:file, select, textarea').val('');
                $('#FormLaporan').find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
                $("#PlaceholderDokumentasi").attr("hidden", true);
                $("#PlaceholderDokumentasi").attr("src", '');


                // Update the active date and day based on the clicked button's value
                var selectedDate = new Date(date.getFullYear(), date.getMonth(), hari_aktif);
                // Convert to GMT+7 (WIB)
                selectedDate.setHours(selectedDate.getHours() + 7);
                updateDateAndDay(selectedDate);
            });

            function getDayName(dayIndex) {
                var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                // Adjust the day index to start from Monday (0 for Monday, 1 for Tuesday, and so on)
                return days[(dayIndex) % 7];
            }

            $(document).ready(function() {
                // Continue with the rest of your code...
                renderCalendar();
            });
        </script>

        <script>
            $('#KeHariSekarang').click(function() {
                // Setel tanggal hari ini sebagai hari aktif
                date = new Date();
                hari_aktif = date.getDate();

                var selectedDate = new Date(date.getFullYear(), date.getMonth(), hari_aktif);
                // Convert to GMT+7 (WIB)
                selectedDate.setHours(selectedDate.getHours() + 7);
                // updateDateAndDay(selectedDate);

                // Render the calendar with today's date
                renderCalendar();
            });
        </script>

        <script>
            function submitForm() {
                $('#mode_halaman').val('hapus_laporan_harian');

                document.getElementById("FormLaporan").submit();
            }
        </script>
    @endsection
@elseif ($mode_halaman == 'laporan_akhir')
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

                        <button class="btn btn-danger" type="button" onclick="submitResetForm()"><i
                                class="bi bi-arrow-counterclockwise me-2"></i>Reset</button>
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
@endif
