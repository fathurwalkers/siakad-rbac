<?php

use App\Http\Controllers\BackController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [BackController::class, 'login_siswa'])->name('login-siswa');
Route::get('/login-admin', [BackController::class, 'login_admin'])->name('login-admin');

Route::post('/proses-login', [BackController::class, 'post_login'])->name('post-login');
Route::post('/logout', [BackController::class, 'logout'])->name('logout');

Route::group(['prefix' => '/dashboard', 'middleware' => 'ceklogin'], function () {
    // DASHBOARD ROUTE
    Route::get('/', [BackController::class, 'index'])->name('dashboard');

    // SISWA ROUTE
    Route::get('/siswa/daftar-siswa', [SiswaController::class, 'daftar_siswa'])->name('daftar-siswa');

});
