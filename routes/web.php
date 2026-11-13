<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'active', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Manajemen pengguna khusus Administrator
    Route::middleware('role:administrator')->prefix('admin')->name('admin.')->group(function () {

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::patch('/users/{user}/approve', [UserController::class, 'approve'])
            ->name('users.approve');

        Route::patch('/users/{user}/reject', [UserController::class, 'reject'])
            ->name('users.reject');

    });

});

require __DIR__.'/auth.php';
