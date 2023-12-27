<?php

use App\Http\Controllers\Mahasiswa\AccountController;
use App\Http\Controllers\Mahasiswa\BerandaController;
use App\Http\Controllers\Mahasiswa\LaporanAkhirController;
use App\Http\Controllers\Mahasiswa\LaporanHarianController;
use App\Http\Controllers\Mahasiswa\SertifikatController;
use Illuminate\Support\Facades\Route;

Route::group ( [ 'prefix' => 'beranda' ], function ()
{
    Route::get ( '', [ BerandaController::class, 'index' ] )->name ( 'beranda' );
    Route::get ( '/get_data', [ BerandaController::class, 'getData' ] )->name ( 'beranda.getData' );
} );

Route::get ( 'laporan_harian/get_month', [ LaporanHarianController::class, 'getMonth' ] )
    ->name ( 'laporan_harian.getMonth' );
Route::get ( 'laporan_harian/get_data', [ LaporanHarianController::class, 'getData' ] )
    ->name ( 'laporan_harian.getData' );
Route::get ( 'laporan_harian/find_data', [ LaporanHarianController::class, 'findData' ] )
    ->name ( 'laporan_harian.findData' );
Route::get ( 'laporan_harian/last_data', [ LaporanHarianController::class, 'lastData' ] )
    ->name ( 'laporan_harian.lastData' );
Route::resource ( 'laporan_harian', LaporanHarianController::class);

Route::get ( 'laporan_akhir/get_data', [ LaporanAkhirController::class, 'getData' ] )
    ->name ( 'laporan_akhir.getData' );
Route::get ( 'laporan_akhir/find_data', [ LaporanAkhirController::class, 'findData' ] )
    ->name ( 'laporan_akhir.findData' );
Route::get ( 'laporan_akhir/last_data', [ LaporanAkhirController::class, 'lastData' ] )
    ->name ( 'laporan_akhir.lastData' );
Route::resource ( 'laporan_akhir', LaporanAkhirController::class);

Route::group ( [ 'prefix' => 'sertifikat' ], function ()
{
    Route::get ( '', [ SertifikatController::class, 'index' ] )->name ( 'sertifikat.index' );
    Route::get ( '/{mahasiswa}', [ SertifikatController::class, 'show' ] )->name ( 'sertifikat.show' );
    Route::get ( '/{mahasiswa}/download', [ SertifikatController::class, 'download' ] )->name ( 'sertifikat.download' );
} );

Route::group ( [ 'prefix' => 'account' ], function ()
{
    Route::get ( '', [ AccountController::class, 'showAccountForm' ] )->name ( 'account.index' );
    Route::post ( '', [ AccountController::class, 'updateAccount' ] )->name ( 'account.update' );
} );
