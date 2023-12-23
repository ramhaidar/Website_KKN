<!DOCTYPE html>
<html data-bs-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" charset="utf-8"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Sertifikat | Website KKN</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons 1.11.1 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet" />

    <!-- Bootstrap 5.3.2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        #Loader {
            background-color: rgba(125, 125, 125, 0.5);
            position: fixed;
            z-index: 9999;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <style>
        /* #Sertifikat {
            aspect-ratio: 9 / 16;
        } */
        #ENAM {
            position: relative;
            width: 100%;
            padding-top: 70.71%;
            max-width: 2480px;
            max-height: 3508px;
        }
    </style>
</head>

<div class="container-fluid" id="Loader">
    <div class="center-content">
        <img src="{{ asset('Loading.gif') }}" />
    </div>
</div>

<body class="container p-0 m-0" id="ENAM">

    <div class="container w-100 h-100 p-5">
        <div class="container bg-light shadow text-center text-dark p-5 rounded-3 border-primary border border-5"
            id="Sertifikat">

            <h1 class="text-dark mb-4 fw-bolder fs-1" style="font-family: 'Arial', sans-serif; ">
                Sertifikat Penyelesaian
            </h1>

            <img class="img-fluid p-0 m-0 mb-5" id="PlaceholderFavicon" src="{{ asset('favicon.png') }}"
                alt="Responsive image" style="width: 25%; height: auto;">

            <p class="px-5 py-2 fs-4" style="font-family: 'Arial', sans-serif;">Selamat kepada
                mahasiswa berikut ini atas penyelesaian Kerja Praktik dengan sukses!<br /> Prestasi Anda patut
                diapresiasi.</p>

            <div class="pt-4 mb-4 text-start fs-5">
                <h4 class="text-dark mb-4 fw-bold fs-3" style="font-family: 'Arial', sans-serif;">Kelompok
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
                <h4 class="text-dark mb-4 fw-bold fs-3" style="font-family: 'Arial', sans-serif;">Dosen
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
                <div class="text-start d-flex flex-column align-items-start float-end" id="TandaTangan">
                    <h6 class="fw-bold fs-4" style="font-family: 'Arial', sans-serif;">Rabu, 29 November 2023
                    </h6>
                    <h6 class="fw-bold fs-4" style="font-family: 'Arial', sans-serif;">Rektor UNIPDU</h6>
                    <img src="{{ asset('signature.png') }}" alt="Signature" style="width: 200px; height: auto;">
                    <p class="fw-bold fs-4">Dr. dr. H.M. Zulfikar As'ad, M.MR.</p>
                </div>
                <div style="clear: both;"></div>
            </div>

        </div>
    </div>
    <!-- Bootstrap JS 5.3.2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <!-- JQuery JS 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- JSPDF JS Latest -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"
        integrity="sha512-z8IYLHO8bTgFqj+yrPyIJnzBDf7DDhWwiEsk4sY+Oe6J2M+WQequeGS7qioI5vT6rXgVRb4K1UVQC5ER7MKzKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"
        integrity="sha512-c3Nl8+7g4LMSTdrm621y7kf9v3SDPnhxLNhcjFJbKECVnmZHTdo+IRO05sNLTH/D3vA6u1X32ehoLC7WFVdheg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const {
            jsPDF
        } = jspdf;

        // function generatePDF() {
        //     html2canvas(document.body).then(function(canvas) {
        //         var imgData = canvas.toDataURL('image/png');

        //         // Create a new jsPDF instance
        //         var pdf = new jsPDF('p', 'mm', 'a4'); // A4 size page of PDF

        //         var width = pdf.internal.pageSize.getWidth();
        //         var height = pdf.internal.pageSize.getHeight();

        //         // Add the image data to the PDF
        //         pdf.addImage(imgData, 'PNG', 0, 0, width, height);

        //         // Save the PDF
        //         pdf.save('download.pdf');
        //     });
        // }

        // function generatePDF() {
        //     // Set the scale factor to fit the content within the PDF page
        //     var scaleFactor = 1; // You can adjust this value as needed

        //     // Create a new instance of jsPDF
        //     var pdf = new jsPDF('p', 'mm', 'a4', 'compress');

        //     // Use jsPDF's html method with the scaleFactor option
        //     pdf.html(document.body, {
        //         callback: function(pdf) {
        //             pdf.save('download.pdf');
        //         },
        //         html2canvas: {
        //             scale: scaleFactor,
        //             logging: true,
        //             dpi: 192,
        //             letterRendering: true
        //         },
        //     });
        // }

        // function generatePDF() {
        //     // Get the dimensions of the content
        //     var contentWidth = document.body.scrollWidth * 0.1;
        //     var contentHeight = document.body.scrollHeight * 0.1;

        //     // Create a new instance of jsPDF with content dimensions
        //     var pdf = new jsPDF({
        //         orientation: 'p',
        //         unit: 'px',
        //         // format: [contentWidth, contentHeight],
        //         format: [contentWidth, contentHeight],
        //         compress: true,
        //     });

        //     // Use jsPDF's html method
        //     pdf.html(document.body, {
        //         callback: function(pdf) {
        //             if (pdf.internal.getNumberOfPages() > 1) {
        //                 pdf.deletePage(2);
        //             }
        //             pdf.save('download.pdf');
        //         },
        //         html2canvas: {
        //             logging: true,
        //             dpi: 96,
        //             letterRendering: true
        //         },
        //     });
        // }

        function generatePDF() {
            // Get the dimensions of the content
            var contentWidth = document.body.scrollWidth;
            var contentHeight = document.body.scrollHeight;

            // Create a new instance of jsPDF with content dimensions
            var pdf = new jsPDF({
                orientation: 'p',
                unit: 'px',
                format: [contentWidth, contentHeight],
                compress: true,
            });

            // Use html2canvas to capture the screenshot of the body
            html2canvas(document.body, {
                logging: true,
                dpi: 320,
                letterRendering: true
            }).then(function(canvas) {
                // Convert the canvas to a data URL
                var imgData = canvas.toDataURL('image/png');

                // Add the image to the PDF
                pdf.addImage(imgData, 'PNG', 0, 0, contentWidth, contentHeight, 'NONE');

                // Save the PDF
                pdf.save('download.pdf');

                window.history.back();
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            document.querySelector('#Loader').style.display = 'none';

            generatePDF();
        });
    </script>
</body>

</html>
