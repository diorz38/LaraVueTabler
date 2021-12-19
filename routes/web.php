<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JafungController;
use App\Http\Controllers\Auth\LoginController;

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/packages-info', function () {
    $metadata = json_decode(file_get_contents(base_path('package-lock.json')));
    $metaKeys = collect($metadata->dependencies);

    return $appInfo = [
        'phpVersion' => 'PHP v'.PHP_VERSION,
        'laravelVersion' => 'Laravel v'.Application::VERSION,
        'vueVersion' => 'Vue v'.$metaKeys["vue"]->version,
        'inertiaVersion' => 'Inertiajs v'.$metaKeys["@inertiajs/inertia"]->version,
        'tablerVersion' => 'Tabler v'.$metaKeys["@tabler/core"]->version
    ];
})->name('packages.info');
