<?php

use App\Http\Controllers\AbsenController;
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
    return redirect('/dashboard');
});

Route::get('/login', [BackController::class, 'login_siswa'])->name('login');
Route::get('/login-admin', [BackController::class, 'login_admin'])->name('login-admin');

Route::post('/proses-login', [BackController::class, 'post_login'])->name('post-login');
Route::post('/logout', [BackController::class, 'logout'])->name('logout');

Route::group(['prefix' => '/dashboard', 'middleware' => 'ceklogin'], function () {
    // DASHBOARD ROUTE
    Route::get('/', [BackController::class, 'index'])->name('dashboard');

    // SISWA ROUTE
    Route::get('/siswa/daftar-siswa', [SiswaController::class, 'daftar_siswa'])->name('daftar-siswa');
    Route::post('/siswa/tambah-siswa', [SiswaController::class, 'tambah_siswa'])->name('tambah-siswa');
    Route::post('/siswa/hapus-siswa/{id}', [SiswaController::class, 'hapus_siswa'])->name('hapus-siswa');
    Route::post('/siswa/post-ubah-siswa/{id}', [SiswaController::class, 'post_ubah_siswa'])->name('post-ubah-siswa');

    // GURU ROUTE
    Route::get('/guru/daftar-guru', [GuruController::class, 'daftar_guru'])->name('daftar-guru');
    Route::post('/guru/tambah-guru', [GuruController::class, 'tambah_guru'])->name('tambah-guru');
    Route::post('/guru/hapus-guru/{id}', [GuruController::class, 'hapus_guru'])->name('hapus-guru');
    Route::post('/guru/post-ubah-guru/{id}', [GuruController::class, 'post_ubah_guru'])->name('post-ubah-guru');

    // KELAS ROUTE
    Route::get('/kelas/daftar-kelas', [KelasController::class, 'daftar_kelas'])->name('daftar-kelas');
    Route::get('/kelas/lihat-kelas/{id}', [KelasController::class, 'lihat_kelas'])->name('lihat-kelas');

    // NILAI ROUTE
    Route::get('/nilai/daftar-nilai', [NilaiController::class, 'daftar_nilai'])->name('daftar-nilai');
    Route::get('/nilai/lihat-nilai/{id}', [NilaiController::class, 'lihat_nilai'])->name('lihat-nilai');

    // ABSENSI ROUTE
    Route::get('/absen/daftar-absen', [AbsenController::class, 'daftar_absen'])->name('daftar-absen');
    Route::get('/absen/lihat-absen-kelas/{id}', [AbsenController::class, 'lihat_absen_kelas'])->name('lihat-absen-kelas');
    Route::get('/absen/lihat-absen-siswa/{id}', [AbsenController::class, 'lihat_absen_siswa'])->name('lihat-absen-siswa');

    // MATA PELAJARAN ROUTE
    Route::get('/matapelajaran/daftar-matapelajaran', [MatapelajaranController::class, 'daftar_matapelajaran'])->name('daftar-matapelajaran');
    Route::post('matapelajaran/tambah-matapelajaran', [MatapelajaranController::class, 'post_tambah_matapelajaran'])->name('post-tambah-matapelajaran');
    Route::post('matapelajaran/ubah-matapelajaran/{id}', [MatapelajaranController::class, 'post_ubah_matapelajaran'])->name('post-ubah-matapelajaran');
    Route::post('matapelajaran/hapus-matapelajaran/{id}', [MatapelajaranController::class, 'post_hapus_matapelajaran'])->name('post-hapus-matapelajaran');

    // AKUN ROUTE
    Route::get('/akun/daftar-akun', [BackController::class, 'daftar_akun'])->name('daftar-akun');

});

Route::get('/generate', [GenerateController::class, 'generate_all'])->name('generate-all');

Route::get('/generate-siswa', [GenerateController::class, 'generate_siswa'])->name('generate-siswa');
Route::get('/generate-default-siswa', [GenerateController::class, 'generate_default_siswa'])->name('generate-default-siswa');
Route::get('/generate-siswa-perkelas', [GenerateController::class, 'generate_siswa_perkelas'])->name('generate-siswa-perkelas');

Route::get('/generate-guru', [GenerateController::class, 'generate_guru'])->name('generate-guru');
Route::get('/generate-default-guru', [GenerateController::class, 'generate_default_guru'])->name('generate-default-guru');
Route::get('/generate-kepsek', [GenerateController::class, 'generate_kepsek'])->name('generate-kepsek');

Route::get('/generate-nilai', [GenerateController::class, 'generate_nilai'])->name('generate-nilai');

Route::get('/generate-absen', [GenerateController::class, 'generate_absen'])->name('generate-absen');
