<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DplDataController;
use App\Http\Controllers\AdminDataController;
use App\Http\Controllers\DplNavigationController;
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
    '/AmbilDataDpl',
    [ 
        AdminDataController::class,
        'AmbilDataDpl'
    ]
)
    ->name ( 'AmbilDataDpl' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/DapatkanHalamanTerakhirDpl',
    [ 
        AdminDataController::class,
        'DapatkanHalamanTerakhirDpl'
    ]
)
    ->name ( 'DapatkanHalamanTerakhirDpl' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/CariDataDpl',
    [ 
        AdminDataController::class,
        'CariDataDpl'
    ]
)
    ->name ( 'CariDataDpl' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/admin_laporan',
    [ 
        AdminNavigationController::class,
        'admin_laporan'
    ]
)
    ->name ( 'admin_laporan' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::post (
    '/admin_laporan',
    [ 
        AdminNavigationController::class,
        'admin_laporan'
    ]
)
    ->name ( 'admin_laporan' )
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

Route::post (
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

Route::get (
    '/DownloadSertifikatAdmin',
    [ 
        AdminDataController::class,
        'DownloadSertifikatAdmin'
    ]
)
    ->name ( 'DownloadSertifikatAdmin' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::get (
    '/DapatkanBulanLaporanHarianAdmin',
    [ 
        AdminDataController::class,
        'DapatkanBulanLaporanHarianAdmin'
    ]
)
    ->name ( 'DapatkanBulanLaporanHarianAdmin' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckAdmin' );

Route::get (
    '/AmbilDataLaporanHarianAdmin',
    [ 
        AdminDataController::class,
        'AmbilDataLaporanHarianAdmin'
    ]
)
    ->name ( 'AmbilDataLaporanHarianAdmin' )
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

/* ====== [START] Dpl Route [START] ====== */

Route::get (
    '/beranda_dpl',
    [ 
        DplNavigationController::class,
        'beranda_dpl'
    ]
)
    ->name ( 'beranda_dpl' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );

Route::get (
    '/dpl_akun',
    [ 
        DplNavigationController::class,
        'dpl_akun'
    ]
)
    ->name ( 'dpl_akun' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );

Route::post (
    '/dpl_akun',
    [ 
        DplNavigationController::class,
        'dpl_akun'
    ]
)
    ->name ( 'dpl_akun' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );


Route::get (
    '/dpl_laporan_harian',
    [ 
        DplNavigationController::class,
        'dpl_laporan_harian'
    ]
)
    ->name ( 'dpl_laporan_harian' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );

Route::post (
    '/dpl_laporan_harian',
    [ 
        DplNavigationController::class,
        'dpl_laporan_harian'
    ]
)
    ->name ( 'dpl_laporan_harian' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );

Route::get (
    '/dpl_laporan_akhir',
    [ 
        DplNavigationController::class,
        'dpl_laporan_akhir'
    ]
)
    ->name ( 'dpl_laporan_akhir' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );

Route::post (
    '/dpl_laporan_akhir',
    [ 
        DplNavigationController::class,
        'dpl_laporan_akhir'
    ]
)
    ->name ( 'dpl_laporan_akhir' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );

Route::get (
    '/dpl_sertifikat',
    [ 
        DplNavigationController::class,
        'dpl_sertifikat'
    ]
)
    ->name ( 'dpl_sertifikat' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );

Route::get (
    '/DownloadSertifikatDpl',
    [ 
        DplDataController::class,
        'DownloadSertifikatDpl'
    ]
)
    ->name ( 'DownloadSertifikatDpl' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );

Route::get (
    '/DapatkanBulanLaporanHarianDpl',
    [ 
        DplDataController::class,
        'DapatkanBulanLaporanHarianDpl'
    ]
)
    ->name ( 'DapatkanBulanLaporanHarianDpl' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );

Route::get (
    '/AmbilDataLaporanHarianDpl',
    [ 
        DplDataController::class,
        'AmbilDataLaporanHarianDpl'
    ]
)
    ->name ( 'AmbilDataLaporanHarianDpl' )
    ->middleware ( 'BelumLogin' )
    ->middleware ( 'CheckDpl' );
/* ====== [END] Dpl Route [END] ====== */