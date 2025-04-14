<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'index'])->name('user.index');
    Route::post('/login', [UserController::class, 'store'])->name('user.store');
});

Route::middleware('auth')->group(function () {
    Route::resources(['profile' => \App\Http\Controllers\ProfileController::class]);
    Route::resources(['dashboard' => \App\Http\Controllers\DashboardController::class]);
    Route::resources(['admin' => \App\Http\Controllers\AdminController::class]);
    Route::resources(['student-organization' => \App\Http\Controllers\StudentOrganizationController::class]);
    Route::resources(['student-activity-unit' => \App\Http\Controllers\StudentActivityUnitController::class]);
    Route::resources(['news' => \App\Http\Controllers\NewsController::class]);
    Route::resources(['event' => \App\Http\Controllers\EventController::class]);
    Route::resources(['activity-report' => \App\Http\Controllers\ActivityReportController::class]);
    Route::resources(['administrative-document' => \App\Http\Controllers\AdministrativeDocumentController::class]);
    Route::post('/logout', [UserController::class, 'delete'])->name('user.delete');
});
