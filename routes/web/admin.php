<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\DosenPembimbingLapanganController;
use App\Http\Controllers\Admin\KelompokMahasiswaController;
use App\Http\Controllers\Admin\LaporanAkhirController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LaporanHarianController;
use App\Http\Controllers\Admin\PendaftaranMahasiswaController;
use App\Http\Controllers\Admin\SertifikatController;

// Beranda
Route::group ( [ 'prefix' => 'beranda' ], function ()
{
    Route::get ( '', [ BerandaController::class, 'index' ] )->name ( 'beranda' );
    Route::get ( '/get_data', [ BerandaController::class, 'getData' ] )->name ( 'beranda.getData' );
} );

// Kelompok Mahasiswa
Route::get ( 'kelompok_mahasiswa/get_data', [ KelompokMahasiswaController::class, 'getData' ] )->name ( 'kelompok_mahasiswa.getData' );
Route::get ( 'kelompok_mahasiswa/find_data', [ KelompokMahasiswaController::class, 'findData' ] )->name ( 'kelompok_mahasiswa.findData' );
Route::get ( 'kelompok_mahasiswa/last_data', [ KelompokMahasiswaController::class, 'lastData' ] )->name ( 'kelompok_mahasiswa.lastData' );
Route::resource ( 'kelompok_mahasiswa', KelompokMahasiswaController::class, [ 'parameters' => [ 'kelompok_mahasiswa' => 'mahasiswa' ] ] );

// Laporan Harian
Route::group ( [ 'prefix' => 'kelompok_mahasiswa/{mahasiswa}' ], function ()
{
    Route::get ( 'laporan_harian/get_month', [ LaporanHarianController::class, 'getMonth' ] )->name ( 'laporan_harian.getMonth' );
    Route::get ( 'laporan_harian/get_data', [ LaporanHarianController::class, 'getData' ] )->name ( 'laporan_harian.getData' );
    Route::get ( 'laporan_harian/find_data', [ LaporanHarianController::class, 'findData' ] )->name ( 'laporan_harian.findData' );
    Route::get ( 'laporan_harian/last_data', [ LaporanHarianController::class, 'lastData' ] )->name ( 'laporan_harian.lastData' );
    Route::resource ( 'laporan_harian', LaporanHarianController::class, [ 'only' => [ 'index' ] ] );
} );
Route::get ( 'laporan_harian/export-csv', [ LaporanHarianController::class, 'export' ] )->name ( 'laporan_harian.export-csv' );

// Laporan Akhir
Route::group ( [ 'prefix' => 'kelompok_mahasiswa/{mahasiswa}' ], function ()
{
    Route::resource ( 'laporan_akhir', LaporanAkhirController::class, [ 'only' => [ 'index', 'destroy' ] ] );
} );

// Dosen Pembimbing Lapangan
Route::get ( 'dosen_pembimbing_lapangan/get_data', [ DosenPembimbingLapanganController::class, 'getData' ] )->name ( 'dosen_pembimbing_lapangan.getData' );
Route::get ( 'dosen_pembimbing_lapangan/find_data', [ DosenPembimbingLapanganController::class, 'findData' ] )->name ( 'dosen_pembimbing_lapangan.findData' );
Route::get ( 'dosen_pembimbing_lapangan/last_data', [ DosenPembimbingLapanganController::class, 'lastData' ] )->name ( 'dosen_pembimbing_lapangan.lastData' );
Route::resource ( 'dosen_pembimbing_lapangan', DosenPembimbingLapanganController::class, [ 'parameters' => [ 'dosen_pembimbing_lapangan' => 'dpl' ] ] );

// Sertifikat
Route::group ( [ 'prefix' => 'sertifikat' ], function ()
{
    Route::get ( '', [ SertifikatController::class, 'index' ] )->name ( 'sertifikat.index' );
    Route::get ( '/{mahasiswa}', [ SertifikatController::class, 'show' ] )->name ( 'sertifikat.show' );
    Route::get ( '/{mahasiswa}/download', [ SertifikatController::class, 'download' ] )->name ( 'sertifikat.download' );
} );

// Laporan
Route::group ( [ 'prefix' => 'laporan' ], function ()
{
    Route::get ( '', [ LaporanController::class, 'index' ] )->name ( 'laporan.index' );
} );

// Account
Route::group ( [ 'prefix' => 'account' ], function ()
{
    Route::get ( '', [ AccountController::class, 'showAccountForm' ] )->name ( 'account.index' );
    Route::post ( '', [ AccountController::class, 'updateAccount' ] )->name ( 'account.update' );
} );

// Pendaftaran Mahasiswa
Route::get ( 'pendaftaran_mahasiswa/get_data', [ PendaftaranMahasiswaController::class, 'getData' ] )->name ( 'pendaftaran_mahasiswa.getData' );
Route::get ( 'pendaftaran_mahasiswa/find_data', [ PendaftaranMahasiswaController::class, 'findData' ] )->name ( 'pendaftaran_mahasiswa.findData' );
Route::get ( 'pendaftaran_mahasiswa/last_data', [ PendaftaranMahasiswaController::class, 'lastData' ] )->name ( 'pendaftaran_mahasiswa.lastData' );
Route::get ( 'pendaftaran_mahasiswa/export-csv', [ PendaftaranMahasiswaController::class, 'export' ] )->name ( 'pendaftaran_mahasiswa.export-csv' );
Route::resource ( 'pendaftaran_mahasiswa', PendaftaranMahasiswaController::class, [ 'parameters' => [ 'pendaftaran_mahasiswa' => 'mahasiswa' ] ] );
