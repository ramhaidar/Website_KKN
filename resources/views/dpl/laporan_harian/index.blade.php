@section('subtitle', 'Laporan Harian')

@extends('dpl._dpl')

@if ($sudah_punya_mahasiswa == true)
    @section('dashboard_content')
        <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
            style="background-color: transparent">

            <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
                <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                    <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                        <div class="card-header fw-bolder fs-3 text-center">Laporan Harian Mahasiswa</div>
                        <div class="card-body text-white flex-grow-1">
                            <div class="container-fluid p-0 m-0 w-100 h-100">
                                <div class="row justify-content-between px-3 mb-3">
                                    <div class="col p-0 m-0">
                                        {{-- <div class="d-flex" role="search"> --}}
                                        <div class="row justify-content-end w-100px-3 mb-3">
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
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Ketua</th>
                                        <th>Hambatan</th>
                                        <th>Solusi</th>
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
        var baseUrl = "{{ route('dosen.laporan_harian.index') }}";

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
                url: "{{ route('dosen.laporan_harian.getData') }}" + '?page=' + page,
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

                    $.each(data.bimbingan, function(index, item) {
                        let solusi = item.solusi ? item.solusi : "[ Belum Ada ]";
                        let buttonSolusi = '\
                            <a class="btn btn-primary action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle"\
                                href="'+ baseUrl + '/' + item.id +'/solusi">\
                                <i class="bi bi-pencil-square me-2"></i>Beikan Solusi\
                            </a>';
                        $('#IsiLewatJQuery').append('<tr>' +
                            '<th scope="row">' + item.id + '</th>' +
                            '<th scope="row">' + item.hari + ", " + item.tanggal + '</th>' +
                            '<td>' + item.mahasiswa.nama_ketua + '</td>' +
                            '<td>' + item.hambatan + '</td>' +
                            '<td>' + solusi + '</td>' +
                            '<td>' + buttonSolusi + '</td>' +
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
