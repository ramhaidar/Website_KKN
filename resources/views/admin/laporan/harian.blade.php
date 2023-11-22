@section('subtitle', 'Laporan Harian')

@extends('admin._admin')

@section('dashboard_content')
    <div class="d-flex p-0 m-0 align-items-center align-content-center justify-content-center w-100"
        style="background-color: transparent">

        <div class="container-fluid p-0 m-0 w-100" style="background-color: transparent">
            <div class="container-fluid py-3 pb-4 w-100" style="background-color: transparent">
                <div class="card border-secondary mb-3 flex-grow-1 d-flex flex-column p-0">
                    <div class="card-header fw-bolder fs-3 text-center">Laporan Harian</div>
                    <div class="card-body text-white flex-grow-1">

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
