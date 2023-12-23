<?php

use App\Http\Controllers\DPLDataController;
use App\Http\Controllers\DPLNavigationController;
use App\Http\Controllers\Dosen\AccountController;
use App\Http\Controllers\Dosen\BerandaController;
use App\Http\Controllers\Dosen\LaporanAkhirController;
use App\Http\Controllers\Dosen\LaporanHarianController;
use App\Http\Controllers\Dosen\SertifikatController;
use Illuminate\Support\Facades\Route;

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

Route::get('laporan_harian/get_data', [LaporanHarianController::class, 'getData'])
    ->name('laporan_harian.getData');
Route::get('laporan_harian/{laporan_harian}/solusi', [LaporanHarianController::class, 'edit'])
    ->name('laporan_harian.solusi');
Route::resource('laporan_harian', LaporanHarianController::class, ['only' => ['index', 'update']]);

Route::post('laporan_akhir/{laporan_akhir}/approve', [LaporanAkhirController::class, 'approve'])
    ->name('laporan_akhir.approve');
Route::resource('laporan_akhir', LaporanAkhirController::class, ['only' => ['index', 'update']]);

Route::group(['prefix' => 'sertifikat'], function () {
    Route::get('', [SertifikatController::class, 'index'])->name('sertifikat.index');
    Route::get('/{mahasiswa}/download', [SertifikatController::class, 'download'])->name('sertifikat.download');
});

Route::group(['prefix' => 'account'], function () {
    Route::get('', [AccountController::class, 'showAccountForm'])->name('account.index');
    Route::post('', [AccountController::class, 'updateAccount'])->name('account.update');
});

Route::get (
    '/dpl_laporan_harian',
    [DPLNavigationController::class, 'dpl_laporan_harian']
)->name ( 'dpl_laporan_harian' );

Route::get(
    '/AmbilDataBimbinganHarian',
    [DPLDataController::class, 'AmbilDataBimbinganHarian']
)->name('AmbilDataBimbinganHarian');

Route::post (
    '/dpl_laporan_harian',
    [DPLNavigationController::class, 'dpl_laporan_harian']
)->name ( 'dpl_laporan_harian' );

Route::get (
    '/DapatkanBulanLaporanHarianDPL',
    [DPLDataController::class, 'DapatkanBulanLaporanHarianDPL']
)->name ( 'DapatkanBulanLaporanHarianDPL' );

Route::get (
    '/AmbilDataLaporanHarianDPL',
    [DPLDataController::class, 'AmbilDataLaporanHarianDPL']
)->name ( 'AmbilDataLaporanHarianDPL' );
