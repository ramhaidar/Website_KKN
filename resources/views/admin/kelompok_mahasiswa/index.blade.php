@section('subtitle', 'Data Kelompok Mahasiswa')

@extends('admin._admin')

@section('Head_CSS')
    <style>
        .action_button {
            width: 7.5vw;
            height: 4vh;
        }
    </style>
@endsection

@section('dashboard_content')
    <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
        style="background-color: transparent">
        <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
            <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                    <div class="card-header fw-bolder fs-3 text-center">Kelompok Mahasiswa</div>
                    <div class="card-body text-white flex-grow-1">
                        <div class="container-fluid p-0 m-0 w-100 h-100">
                            <div class="row justify-content-between px-3 mb-3">
                                <div class="col p-0 m-0">
                                    <h5 class="card-title pb-3 fs-6">Jumlah Kelompok Mahasiswa: <i
                                            class="bi bi-people-fill ms-2"></i>
                                        {{ $jumlah_mahasiswa }} Kelompok</h5>
                                </div>
                                <div class="col p-0 m-0">
                                    {{-- <div class="d-flex" role="search"> --}}
                                    <div class="row justify-content-end w-100px-3 mb-3">
                                        <div class="col">
                                            <input class="form-control me-2" id="SearchForm" type="search"
                                                aria-label="Search" placeholder='Pencarian (25 Data)'>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('admin.kelompok_mahasiswa.create') }}"
                                                class="btn btn-success shadow-sm border border-3 border-light-subtle">
                                                <i class="bi bi-person-plus-fill me-2"></i>
                                                Tambah Kelompok Mahasiswa
                                            </a>
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

@section('Modal')
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
                <form method="POST" action="" id="form-delete-mahasiswa">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger shadow-sm border border-3 border-light-subtle" type="submit"><i
                            class="bi bi-trash3-fill me-2"></i>Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Body_JS')
    <script>
        var baseUrl = "{{ route('admin.kelompok_mahasiswa.index') }}";
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
                        let buttonEdit = '<a href="'+baseUrl+"/"+item.id+'/edit" class="btn btn-primary action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle"><i class="bi bi-pencil-square me-2"></i>Ubah</a>';
                        let buttonDelete = '<a data-delete="'+baseUrl+"/"+item.id+'" class="btn btn-danger action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle btn-delete" data-bs-toggle="modal" data-bs-target="#ModalKonfirmasiHapus"><i class="bi bi-trash me-2"></i>Hapus</a>';
                        $('#IsiLewatJQuery').append('<tr>' +
                            '<th scope="row">' + item.id + '</th>' +
                            '<td>' + item.nama_ketua + '</td>' +
                            '<td>' + item.user.email + '</td>' +
                            '<td>' + anggota_kelompok + '</td>' +
                            '<td>' + item.nim + '</td>' +
                            '<td>' + item.prodi + '</td>' +
                            '<td>' + item.fakultas + '</td>' +
                            '<td>' + nama_dosen + '</td>' +
                            '<td>' + buttonEdit + buttonDelete + '</td>' +
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

        $(document).ready(function() {
            $(document).on("click", ".btn-delete", function () {
                let action = $(this).data('delete');
                $("#form-delete-mahasiswa").attr("action", action);
            });
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
                                // This is where you handle the data returned from the server
                                $('#IsiLewatJQuery').empty();

                                $.each(data.DataMahasiswa, function(index, item) {
                                    var anggota_kelompok = item.anggota_kelompok ? item.anggota_kelompok
                                        .replace(/\n/g, '<br>') : "[ Belum Ada ]";
                                    var nama_dosen = item.dpl ? item.dpl.nama_dosen : "[ Belum Ada ]";
                                    let buttonEdit = '<a href="'+baseUrl+"/"+item.id+'/edit" class="btn btn-primary action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle"><i class="bi bi-pencil-square me-2"></i>Ubah</a>';
                                    let buttonDelete = '<a data-delete="'+baseUrl+"/"+item.id+'" class="btn btn-danger action_button my-1 fw-bold shadow-sm border border-3 border-light-subtle btn-delete" data-bs-toggle="modal" data-bs-target="#ModalKonfirmasiHapus"><i class="bi bi-trash me-2"></i>Hapus</a>';
                                    $('#IsiLewatJQuery').append('<tr>' +
                                        '<th scope="row">' + item.id + '</th>' +
                                        '<td>' + item.nama_ketua + '</td>' +
                                        '<td>' + item.user.email + '</td>' +
                                        '<td>' + anggota_kelompok + '</td>' +
                                        '<td>' + item.nim + '</td>' +
                                        '<td>' + item.prodi + '</td>' +
                                        '<td>' + item.fakultas + '</td>' +
                                        '<td>' + nama_dosen + '</td>' +
                                        '<td>' + buttonEdit + buttonDelete + '</td>' +
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

        $(document).on('click', '.action_button', function() {
            var id = $(this).attr('data-id');
            $('#delete-id').val(id);
        });
    </script>
@endsection
