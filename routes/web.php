<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MatapelajaranController;
use App\Http\Controllers\NilaiController;
use App\Models\Matapelajaran;

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

    // GURU ROUTE
    Route::get('/guru/daftar-guru', [GuruController::class, 'daftar_guru'])->name('daftar-guru');

    // KELAS ROUTE
    Route::get('/kelas/daftar-kelas', [KelasController::class, 'daftar_kelas'])->name('daftar-kelas');

    // NILAI ROUTE
    Route::get('/nilai/daftar-nilai', [NilaiController::class, 'daftar_nilai'])->name('daftar-nilai');
    Route::get('/nilai/lihat-nilai/{id}', [NilaiController::class, 'lihat_nilai'])->name('lihat-nilai');

    // MATA PELAJARAN ROUTE
    Route::get('/matapelajaran/daftar-matapelajaran', [MatapelajaranController::class, 'daftar_matapelajaran'])->name('daftar-matapelajaran');
    Route::post('matapelajaran/tambah-matapelajaran', [MatapelajaranController::class, 'post_tambah_matapelajaran'])->name('post-tambah-matapelajaran');
    Route::post('matapelajaran/ubah-matapelajaran/{id}', [MatapelajaranController::class, 'post_ubah_matapelajaran'])->name('post-ubah-matapelajaran');
    Route::post('matapelajaran/hapus-matapelajaran/{id}', [MatapelajaranController::class, 'post_hapus_matapelajaran'])->name('post-hapus-matapelajaran');
});

Route::get('/generate', [GenerateController::class, 'generate_all'])->name('generate-all');
Route::get('/generate-siswa', [GenerateController::class, 'generate_siswa'])->name('generate-siswa');
Route::get('/generate-guru', [GenerateController::class, 'generate_guru'])->name('generate-guru');
Route::get('/generate-nilai', [GenerateController::class, 'generate_nilai'])->name('generate-nilai');
