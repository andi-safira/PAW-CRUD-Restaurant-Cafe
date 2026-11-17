<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('menu.index');
});


// Menu Routes (Everyone can view)
Route::get('/menu', [MenuController::class, 'index'])
    ->name('menu.index');

// Admin Only Routes
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/menu/create', [MenuController::class, 'create'])
        ->name('menu.create');

    Route::post('/menu', [MenuController::class, 'store'])
        ->name('menu.store');

    Route::get('/menu/{menu}/edit', [MenuController::class, 'edit'])
        ->name('menu.edit');

    Route::put('/menu/{menu}', [MenuController::class, 'update'])
        ->name('menu.update');

    Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])
        ->name('menu.destroy');

});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

    // Registration Routes
Route::get('/register', [RegisterController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.process');