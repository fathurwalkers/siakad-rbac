<?php

use App\Http\Controllers\BackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [BackController::class, 'login_siswa'])->name('login-siswa');
Route::get('/login-admin', [BackController::class, 'login_admin'])->name('login-admin');

Route::group(['prefix' => '/dashboard'], function () {
    // DASHBOARD ROUTE
    Route::get('/', [BackController::class, 'index'])->name('dashboard');
});
