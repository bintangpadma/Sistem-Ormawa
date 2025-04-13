<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(\App\Http\Controllers\LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('login.index');
        Route::post('/login', 'store')->name('login.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::controller(\App\Http\Controllers\DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard.index');
    });
});
