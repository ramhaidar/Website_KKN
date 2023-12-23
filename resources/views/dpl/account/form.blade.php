@section('subtitle', 'Akun')

@extends('dpl._dpl')

@section('dashboard_content')
    <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
        style="background-color: transparent">

        <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
            <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                    <div class="card-header fw-bolder fs-3 text-center">Akun</div>

                    <form method="POST" action="{{ route('dosen.account.update') }}">
                        @csrf
                        <div class="card-body text-white flex-grow-1">
                            <h5 class="pt-2 pb-3 ps-1">Detail Akun</h5>

                            <input name="mode_halaman" type="hidden" value="ubah">
                            <input name="id" type="hidden" value="{{ $user->id }}">

                            <div class="form-floating mb-3">
                                <input class="form-control" id="NamaDosen___" name="NamaDosen___" type="text"
                                    value="{{ $user->dpl->nama_dosen }}" required placeholder="Almira Nababan">
                                <label for="NamaDosen___">Nama</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="Email___" name="Email___" type="email___"
                                    value="{{ $user->email }}" required placeholder="name@example.com">
                                <label for="Email___">Email address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="NIP___" name="NIP___" type="text"
                                    value="{{ $user->dpl->nip }}" required placeholder="NIP___">
                                <label for="NIP___">NIP</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="Prodi___" name="Prodi___" type="text"
                                    value="{{ $user->dpl->prodi }}" required placeholder="Prodi___">
                                <label for="Prodi___">Prodi</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="Fakultas___" name="Fakultas___" type="text"
                                    value="{{ $user->dpl->fakultas }}" required placeholder="Fakultas___">
                                <label for="Fakultas___">Fakultas</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="PasswordLama___" name="PasswordLama___" type="password"
                                    autocomplete="disable" placeholder="PasswordLama___" minlength="6">
                                <label for="PasswordLama___">Password Lama (Jangan isi jika tidak ingin mengubah
                                    password)</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="PasswordBaru___" name="PasswordBaru___" type="password"
                                    autocomplete="disable" placeholder="PasswordBaru___" minlength="6">
                                <label for="PasswordBaru___">Password Baru (Jangan isi jika tidak ingin mengubah
                                    password)</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="PasswordBaruKonfirmasi___" name="PasswordBaruKonfirmasi___"
                                    type="password" autocomplete="disable" placeholder="PasswordBaruKonfirmasi___"
                                    minlength="6">
                                <label for="PasswordBaruKonfirmasi___">Konfirmasi Password Baru (Jangan isi jika tidak ingin
                                    mengubah password)</label>
                            </div>

                            <div class="d-flex justify-content-center pt-2">
                                <button
                                    class="btn btn-primary text-center w-25 shadow-sm border border-3 border-light-subtle"
                                    type="submit">
                                    <i class="bi bi-pencil-square me-2"></i>Ubah Data</button>
                            </div>
                        </div>
                    </form>

                    <div class="card-body text-white flex-grow-1"></div>
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
