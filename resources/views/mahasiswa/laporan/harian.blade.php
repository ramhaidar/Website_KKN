@section('subtitle', 'Laporan Harian')

@extends('mahasiswa._mahasiswa')

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
                                <input id="mode_halaman" name="mode_halaman" type="hidden" value="tambah">
                                <input id="id" name="id" type="hidden" value="">

                                <!-- Hari -->
                                <div class="mb-3">
                                    <label class="form-label" for="hari">Hari</label>
                                    <input class="form-control" id="hari" name="hari" type="text" readonly
                                        required>
                                </div>

                                <!-- Tanggal -->
                                <div class="mb-3">
                                    <label class="form-label" for="tanggal">Tanggal</label>
                                    <input class="form-control" id="tanggal" name="tanggal" value="" readonly
                                        required>
                                </div>

                                <!-- Jenis Kegiatan -->
                                <div class="mb-3">
                                    <label class="form-label" for="jenis_kegiatan">Jenis Kegiatan</label>
                                    <input class="form-control" id="jenis_kegiatan" name="jenis_kegiatan" type="text"
                                        required>
                                </div>

                                <!-- Tujuan -->
                                <div class="mb-3">
                                    <label class="form-label" for="tujuan">Tujuan</label>
                                    <textarea class="form-control" id="tujuan" name="tujuan" rows="3" required></textarea>
                                </div>

                                <!-- Sasaran -->
                                <div class="mb-3">
                                    <label class="form-label" for="sasaran">Sasaran</label>
                                    <textarea class="form-control" id="sasaran" name="sasaran" rows="3" required></textarea>
                                </div>

                                <!-- Hambatan -->
                                <div class="mb-3">
                                    <label class="form-label" for="hambatan">Hambatan</label>
                                    <textarea class="form-control" id="hambatan" name="hambatan" rows="3" required></textarea>
                                </div>

                                <!-- Solusi -->
                                <div class="mb-3">
                                    <label class="form-label" for="solusi">Solusi</label>
                                    <textarea class="form-control" id="solusi" name="solusi" rows="3" required></textarea>
                                </div>

                                <!-- Dokumentasi -->
                                <div class="d-flex w-100 align-content-center justify-content-center">
                                    <img class="img-fluid rounded-5 py-2 mb-2 shadow" id="PlaceholderDokumentasi"
                                        src="" alt="Responsive image" style="width: 80%; height: 75%;" hidden>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="dokumentasi">Dokumentasi (JPG/PNG) <sup>*Maksimal
                                            2MB</sup></label>
                                    <input class="form-control" id="dokumentasi" name="dokumentasi" type="file"
                                        accept="image/jpeg, image/png, image/jpg">
                                </div>

                                <!-- Tombol Hapus dan Simpan -->
                                <div class="d-flex justify-content-center pt-2">
                                    <button class="btn btn-danger text-center w-25 mx-2 shadow-sm" id="TombolHapus"
                                        data-bs-toggle="modal" data-bs-target="#ModalKonfirmasiHapus" type="button"
                                        disabled>
                                        <i class="bi bi-trash-fill me-2"></i>Hapus Laporan
                                    </button>

                                    <button class="btn btn-primary text-center w-25 mx-2 shadow-sm" id="TombolSimpan"
                                        type="submit">
                                        <i class="bi bi-save-fill me-2"></i>Simpan Laporan
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
            $('#hari').val(getDayName(selectedDate.getDay()));

            $('#mode_halaman').val('tambah');

            $('#TombolHapus').prop('disabled', true);

            fetchData(formattedDate);
        }
    </script>

    <script>
        // Function to fetch data and fill the form
        function fetchData(tanggal) {
            // Get the current user's ID
            var user_id = "{{ $user->id }}";

            // AJAX request to fetch data
            $.ajax({
                url: "/AmbilDataLaporan/", // Change this URL to your API endpoint
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

                        $('#mode_halaman').val('ubah');

                        $('#TombolHapus').removeAttr('disabled');
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
        var selectedDate = new Date(date.getFullYear(), date.getMonth(), hari_aktif + 1);
        var formattedDate = selectedDate.toISOString().split('T')[0];
        $('#tanggal').val(formattedDate);
        $('#hari').val(getDayName(selectedDate.getDay()));

        function renderCalendar() {
            $.get('/DapatkanBulan', {
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

                            $('#TombolSimpan').prop('disabled', true);

                        } else {
                            buttonClass = 'btn-primary';

                            $('#TombolSimpan').prop('disabled', false);
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
            $('#TombolSimpan').removeClass('btn-secondary btn-danger').addClass('btn-primary');
            $('#TombolSimpan').prop('disabled', false);

            // Update hari_aktif based on the clicked button's value
            hari_aktif = parseInt($(this).text());

            $('#FormLaporan').find('input:text, input:password, input:file, select, textarea').val('');
            $('#FormLaporan').find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
            $("#PlaceholderDokumentasi").attr("hidden", true);
            $("#PlaceholderDokumentasi").attr("src", '');

            // Update the active date and day based on the clicked button's value
            var selectedDate = new Date(date.getFullYear(), date.getMonth(), hari_aktif + 1);
            updateDateAndDay(selectedDate);
        });

        function getDayName(dayIndex) {
            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            // Adjust the day index to start from Monday (0 for Monday, 1 for Tuesday, and so on)
            return days[(dayIndex - 1) % 7];
        }

        $(document).ready(function() {
            renderCalendar();
        });
    </script>

    <script>
        $('#KeHariSekarang').click(function() {
            // Setel tanggal hari ini sebagai hari aktif
            date = new Date();
            hari_aktif = date.getDate();

            var selectedDate = new Date(date.getFullYear(), date.getMonth(), hari_aktif + 1);
            updateDateAndDay(selectedDate);

            // Render the calendar with today's date
            renderCalendar();
        });
    </script>

    <script>
        function submitForm() {
            $('#mode_halaman').val('hapus');


            document.getElementById("FormLaporan").submit();
        }
    </script>

@endsection
