<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->admin_id !== null) {
            $role = 'admin';
        } elseif (Auth::user()->dpl_id !== null) {
            $role = 'dpl';
        } else {
            $role = 'mahasiswa';
        }

        $route = sprintf('%s.beranda', $role);
    } else {
        $route = 'login';
    }

    return redirect()->route($route);
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/signout', [LoginController::class, 'logout'])->name('signout');

    Route::group(['middleware' => ['CheckAdmin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        require base_path('routes/web/admin.php');
    });

    Route::group(['middleware' => ['CheckDpl'], 'prefix' => 'dosen', 'as' => 'dosen.'], function () {
        require base_path('routes/web/dpl.php');
    });

    Route::group(['middleware' => ['CheckMahasiswa'], 'prefix' => 'mahasiswa', 'as' => 'mahasiswa.'], function () {
        require base_path('routes/web/mahasiswa.php');
    });
});
