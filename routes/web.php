<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NavigationController;

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

Route::get (
    '/',
    function ()
    {
        return view ( 'login' );
    }
)
    ->name ( 'login' )
    ->middleware ( 'SudahLogin' );

Route::post (
    '/',
    [ 
        UserController::class,
        'login'
    ]
)
    ->name ( 'login' );

Route::get (
    '/beranda_admin',
    [ 
        NavigationController::class,
        'beranda_admin'
    ]
)
    ->name ( 'beranda_admin' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/beranda_mahasiswa',
    [ 
        NavigationController::class,
        'beranda_mahasiswa'
    ]
)
    ->name ( 'beranda_mahasiswa' )
    ->middleware ( 'BelumLogin' );

Route::get (
    '/beranda_dpl',
    [ 
        NavigationController::class,
        'beranda_dpl'
    ]
)
    ->name ( 'beranda_dpl' )
    ->middleware ( 'BelumLogin' );