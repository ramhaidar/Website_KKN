@section('subtitle', 'Beranda')

@extends('dpl._dpl')

@section('dashboard_content')
    <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
        style="background-color: transparent">

        <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
            <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                    <div class="card-header fw-bolder fs-3 text-center">Beranda</div>
                    <div class="card-body text-white flex-grow-1 mx-2">

                        <div class="container-fluid m-0 p-0 w-100 h-100">
                            <h5 class="fw-bold pt-2 pb-2">Data Dosen Pembimbing Kelompok</h5>
                            <div class="table-responsive">
                                <table
                                    class="table table-dark table-borderless border-transparent table-hover w-100 align-middle">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="fw-normal">Nama Dosen</th>
                                            <th class="fw-normal">
                                                {{ $user->dpl->nama_dosen }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>E-Mail</td>
                                            <td>{{ $user->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NIP</td>
                                            <td>{{ $user->dpl->nip }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prodi</td>
                                            <td>{{ $user->dpl->prodi }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fakultas</td>
                                            <td>{{ $user->dpl->fakultas }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="container-fluid p-0 m-0 pt-1 w-100 h-100"></div>
                            <hr class="align-items-start">
                            <div class="container-fluid p-0 m-0 pb-4 w-100 h-100"></div>

                            <h5 class="fw-bold pb-2">Data Kelompok Mahasiswa</h5>
                            <div class="table-responsive">
                                <table
                                    class="table table-dark table-borderless border-transparent table-hover w-100 align-middle">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="fw-normal">Nama Ketua Kelompok</th>
                                            <th class="fw-normal">
                                                {{ $user->dpl->mahasiswa ? $user->dpl->mahasiswa->nama_ketua : '[ Belum Ada ]' }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>E-Mail</td>
                                            <td> {{ $user->dpl->mahasiswa ? $user->email : '[ Belum Ada ]' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Anggota Kelompok</td>
                                            <td>{!! $user->dpl->mahasiswa ? nl2br(e($user->dpl->mahasiswa->anggota_kelompok)) : '[ Belum Ada ]' !!}</td>
                                        </tr>
                                        <tr>
                                            <td>NIM</td>
                                            <td>{{ $user->dpl->mahasiswa ? $user->dpl->mahasiswa->nim : '[ Belum Ada ]' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Prodi</td>
                                            <td>{{ $user->dpl->mahasiswa ? $user->dpl->mahasiswa->prodi : '[ Belum Ada ]' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fakultas</td>
                                            <td>{{ $user->dpl->mahasiswa ? $user->dpl->mahasiswa->fakultas : '[ Belum Ada ]' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
