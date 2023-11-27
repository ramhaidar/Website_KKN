<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DPLDataController;
use App\Http\Controllers\AdminDataController;
use App\Http\Controllers\DPLNavigationController;
use App\Http\Controllers\MahasiswaDataController;
use App\Http\Controllers\AdminNavigationController;
use App\Http\Controllers\MahasiswaNavigationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* ====== [START] Sign In Route [START] ====== */

Route::get (
    '/',
    function ()
    {
        return view ( 'signin' );
    }
)
    ->name ( 'signin' )
    ->middleware ( 'SudahLogin' );

Route::post (
    '/',
    [ 
        UserController::class,
        'signin'
    ]
)
    ->name ( 'signin' )
    ->middleware ( 'SudahLogin' );

Route::get (
    '/signout',
    [ 
        UserController::class,
        'signout'
    ]
)
    ->name ( 'signout' )
    ->middleware ( 'BelumLogin' );

/* ====== [END] Sign In Route [END] ====== */

/* ====== [START] Admin Route [START] ====== */

Route::get (
    '/beranda_admin',
    [ 
        AdminNavigationController::class,
        'beranda_admin'
    ]
)
    ->name ( 'beranda_admin' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::get (
    '/DataBerandaAdmin',
    [ 
        AdminDataController::class,
        'DataBerandaAdmin'
    ]
)
    ->name ( 'DataBerandaAdmin' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::get (
    '/admin_data_kelompok_mahasiswa',
    [ 
        AdminNavigationController::class,
        'admin_data_kelompok_mahasiswa'
    ]
)
    ->name ( 'admin_data_kelompok_mahasiswa' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::post (
    '/admin_data_kelompok_mahasiswa',
    [ 
        AdminNavigationController::class,
        'admin_data_kelompok_mahasiswa'
    ]
)
    ->name ( 'admin_data_kelompok_mahasiswa' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::get (
    '/AmbilDataMahasiswa',
    [ 
        AdminDataController::class,
        'AmbilDataMahasiswa'
    ]
)
    ->name ( 'AmbilDataMahasiswa' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/DapatkanHalamanTerakhirMahasiswa',
    [ 
        AdminDataController::class,
        'DapatkanHalamanTerakhirMahasiswa'
    ]
)
    ->name ( 'DapatkanHalamanTerakhirMahasiswa' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/CariDataMahasiswa',
    [ 
        AdminDataController::class,
        'CariDataMahasiswa'
    ]
)
    ->name ( 'CariDataMahasiswa' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/admin_data_dpl',
    [ 
        AdminNavigationController::class,
        'admin_data_dpl'
    ]
)
    ->name ( 'admin_data_dpl' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::post (
    '/admin_data_dpl',
    [ 
        AdminNavigationController::class,
        'admin_data_dpl'
    ]
)
    ->name ( 'admin_data_dpl' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::get (
    '/AmbilDataDPL',
    [ 
        AdminDataController::class,
        'AmbilDataDPL'
    ]
)
    ->name ( 'AmbilDataDPL' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/DapatkanHalamanTerakhirDPL',
    [ 
        AdminDataController::class,
        'DapatkanHalamanTerakhirDPL'
    ]
)
    ->name ( 'DapatkanHalamanTerakhirDPL' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/CariDataDPL',
    [ 
        AdminDataController::class,
        'CariDataDPL'
    ]
)
    ->name ( 'CariDataDPL' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/admin_laporan_harian',
    [ 
        AdminNavigationController::class,
        'admin_laporan_harian'
    ]
)
    ->name ( 'admin_laporan_harian' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::get (
    '/admin_laporan_akhir',
    [ 
        AdminNavigationController::class,
        'admin_laporan_akhir'
    ]
)
    ->name ( 'admin_laporan_akhir' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::get (
    '/admin_sertifikat',
    [ 
        AdminNavigationController::class,
        'admin_sertifikat'
    ]
)
    ->name ( 'admin_sertifikat' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::get (
    '/admin_akun',
    [ 
        AdminNavigationController::class,
        'admin_akun'
    ]
)
    ->name ( 'admin_akun' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::post (
    '/admin_akun',
    [ 
        AdminNavigationController::class,
        'admin_akun'
    ]
)
    ->name ( 'admin_akun' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

/* ====== [END] Admin Route [END] ====== */

/* ====== [START] Mahasiswa Route [START] ====== */

Route::get (
    '/beranda_mahasiswa',
    [ 
        MahasiswaNavigationController::class,
        'beranda_mahasiswa'
    ]
)
    ->name ( 'beranda_mahasiswa' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

Route::get (
    '/mahasiswa_laporan_harian',
    [ 
        MahasiswaNavigationController::class,
        'mahasiswa_laporan_harian'
    ]
)
    ->name ( 'mahasiswa_laporan_harian' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

Route::post (
    '/mahasiswa_laporan_harian',
    [ 
        MahasiswaNavigationController::class,
        'mahasiswa_laporan_harian'
    ]
)
    ->name ( 'mahasiswa_laporan_harian' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

Route::get (
    '/mahasiswa_laporan_akhir',
    [ 
        MahasiswaNavigationController::class,
        'mahasiswa_laporan_akhir'
    ]
)
    ->name ( 'mahasiswa_laporan_akhir' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

Route::post (
    '/mahasiswa_laporan_akhir',
    [ 
        MahasiswaNavigationController::class,
        'mahasiswa_laporan_akhir'
    ]
)
    ->name ( 'mahasiswa_laporan_akhir' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

Route::get (
    '/mahasiswa_sertifikat',
    [ 
        MahasiswaNavigationController::class,
        'mahasiswa_sertifikat'
    ]
)
    ->name ( 'mahasiswa_sertifikat' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

Route::get (
    '/mahasiswa_akun',
    [ 
        MahasiswaNavigationController::class,
        'mahasiswa_akun'
    ]
)
    ->name ( 'mahasiswa_akun' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

Route::post (
    '/mahasiswa_akun',
    [ 
        MahasiswaNavigationController::class,
        'mahasiswa_akun'
    ]
)
    ->name ( 'mahasiswa_akun' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

Route::get (
    '/DownloadSertifikatMahasiswa',
    [ 
        MahasiswaDataController::class,
        'DownloadSertifikatMahasiswa'
    ]
)
    ->name ( 'DownloadSertifikatMahasiswa' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

Route::get (
    '/DapatkanBulanLaporanHarianMahasiswa',
    [ 
        MahasiswaDataController::class,
        'DapatkanBulanLaporanHarianMahasiswa'
    ]
)
    ->name ( 'DapatkanBulanLaporanHarianMahasiswa' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

Route::get (
    '/AmbilDataLaporanHarianMahasiswa',
    [ 
        MahasiswaDataController::class,
        'AmbilDataLaporanHarianMahasiswa'
    ]
)
    ->name ( 'AmbilDataLaporanHarianMahasiswa' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckMahasiswa' );

/* ====== [END] Mahasiswa Route [END] ====== */

/* ====== [START] DPL Route [START] ====== */

Route::get (
    '/beranda_dpl',
    [ 
        DPLNavigationController::class,
        'beranda_dpl'
    ]
)
    ->name ( 'beranda_dpl' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );

Route::get (
    '/dpl_akun',
    [ 
        DPLNavigationController::class,
        'dpl_akun'
    ]
)
    ->name ( 'dpl_akun' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );

Route::post (
    '/dpl_akun',
    [ 
        DPLNavigationController::class,
        'dpl_akun'
    ]
)
    ->name ( 'dpl_akun' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );


Route::get (
    '/dpl_laporan_harian',
    [ 
        DPLNavigationController::class,
        'dpl_laporan_harian'
    ]
)
    ->name ( 'dpl_laporan_harian' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );

Route::post (
    '/dpl_laporan_harian',
    [ 
        DPLNavigationController::class,
        'dpl_laporan_harian'
    ]
)
    ->name ( 'dpl_laporan_harian' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );

Route::get (
    '/dpl_laporan_akhir',
    [ 
        DPLNavigationController::class,
        'dpl_laporan_akhir'
    ]
)
    ->name ( 'dpl_laporan_akhir' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );

Route::post (
    '/dpl_laporan_akhir',
    [ 
        DPLNavigationController::class,
        'dpl_laporan_akhir'
    ]
)
    ->name ( 'dpl_laporan_akhir' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );

Route::get (
    '/dpl_sertifikat',
    [ 
        DPLNavigationController::class,
        'dpl_sertifikat'
    ]
)
    ->name ( 'dpl_sertifikat' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );


Route::get (
    '/DownloadSertifikatDPL',
    [ 
        DPLDataController::class,
        'DownloadSertifikatDPL'
    ]
)
    ->name ( 'DownloadSertifikatDPL' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );

Route::get (
    '/DapatkanBulanLaporanHarianDPL',
    [ 
        DPLDataController::class,
        'DapatkanBulanLaporanHarianDPL'
    ]
)
    ->name ( 'DapatkanBulanLaporanHarianDPL' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );

Route::get (
    '/AmbilDataLaporanHarianDPL',
    [ 
        DPLDataController::class,
        'AmbilDataLaporanHarianDPL'
    ]
)
    ->name ( 'AmbilDataLaporanHarianDPL' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDPL' );
/* ====== [END] DPL Route [END] ====== */