<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JafungController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::inertia('/', 'Home')->name('home');
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
    Route::inertia('/settings', 'Settings')->name('settings');

    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/create', [UsersController::class, 'create']);
    Route::get('/users/{id}/edit', [UsersController::class, 'edit']);
    Route::post('/users', [UsersController::class, 'store']);
    Route::put('/user', [UsersController::class, 'update']);

    Route::get('jafungs/{klas?}', [JafungController::class, 'index'])->name('jafung.index');
    Route::get('jafungs/{id}/show', [JafungController::class, 'show'])->name('jafung.show');

});
