<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::resources(['login', \App\Http\Controllers\LoginController::class]);
});

Route::middleware('auth')->group(function () {
    Route::resources(['dashboard', \App\Http\Controllers\DashboardController::class]);
    Route::resources(['admin', \App\Http\Controllers\AdminController::class]);
    Route::resources(['student', \App\Http\Controllers\StudentController::class]);
});
