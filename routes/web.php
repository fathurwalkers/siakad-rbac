<?php

use App\Http\Controllers\BackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/dashboard'], function () {
    // DASHBOARD ROUTE
    Route::get('/', [BackController::class, 'index'])->name('dashboard');
});
