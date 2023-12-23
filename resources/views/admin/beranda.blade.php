@extends('admin._admin')

@section('subtitle', 'Beranda')

@section('dashboard_content')
    <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
        style="background-color: transparent">

        <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
            <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                    <div class="card-header fw-bolder fs-3 text-center">Dosen Pembimbing Lapangan</div>
                    <div class="card-body text-white flex-grow-1">
                        <h5 class="card-title fs-6 pb-3">Jumlah Dosen Pembimbing Lapangan: <i
                                class="bi bi-person-lines-fill ms-2"></i>
                            {{ $jumlah_dpl }} DPL</h5>
                        <table class="table table-dark table-bordered border-secondary table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Dosen</th>
                                    <th scope="col">E-Mail</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col">Fakultas</th>
                                    <th scope="col">Nama Ketua Kelompok</th>
                                </tr>
                            </thead>
                            <tbody id="IsiLewatJQuery_02">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container-fluid py-3 w-100" style="background-color: transparent">
                <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                    <div class="card-header fw-bolder fs-3 text-center">Mahasiswa</div>
                    <div class="card-body text-white flex-grow-1">
                        <h5 class="card-title pb-3 fs-6">Jumlah Kelompok Mahasiswa: <i class="bi bi-people-fill ms-2"></i>
                            {{ $jumlah_mahasiswa }} Kelompok</h5>
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
                                </tr>
                            </thead>
                            <tbody id="IsiLewatJQuery_01">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('Body_JS')
    <script>
        function loadData() {
            $.ajax({
                url: "{{ route('DataBerandaAdmin') }}",
                type: 'get',
                dataType: 'json',
                beforeSend: function() {
                    // You can add a loading spinner here
                    console.log("Fetching Data...");
                },
                success: function(data) {
                    console.log(data);
                    // This is where you handle the data returned from the server
                    $('#IsiLewatJQuery_01').empty();
                    $.each(data.last5_mahasiswa, function(index, item) {
                        var anggota_kelompok = item.anggota_kelompok ? item.anggota_kelompok.replace(/\n/g, '<br>') : "[ Belum Ada ]";
                        var nama_dosen = item.dpl ? item.dpl.nama_dosen : "[ Belum Ada ]";
                        $('#IsiLewatJQuery_01').append('<tr>' +
                            '<th scope="row">' + item.id + '</th>' +
                            '<td>' + item.nama_ketua + '</td>' +
                            '<td>' + item.user.email + '</td>' +
                            '<td>' + anggota_kelompok + '</td>' +
                            '<td>' + item.nim + '</td>' +
                            '<td>' + item.prodi + '</td>' +
                            '<td>' + item.fakultas + '</td>' +
                            '<td>' + nama_dosen + '</td>' +
                            '</tr>');
                    });

                    $('#IsiLewatJQuery_02').empty();
                    $.each(data.last5_dpl, function(index, item) {
                        var nama_ketua = item.mahasiswa ? item.mahasiswa.nama_ketua : "[ Belum Ada ]";
                        $('#IsiLewatJQuery_02').append('<tr>' +
                            '<th scope="row">' + item.id + '</th>' +
                            '<td>' + item.nama_dosen + '</td>' +
                            '<td>' + item.user.email + '</td>' +
                            '<td>' + item.nip + '</td>' +
                            '<td>' + item.prodi + '</td>' +
                            '<td>' + item.fakultas + '</td>' +
                            '<td>' + nama_ketua + '</td>' +
                            '</tr>');
                    });

                    document.querySelector('#Loader').style.display = 'none';
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            loadData();
        });
    </script>
@endsection
