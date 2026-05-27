<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [NoteController::class, 'index'])
        ->name('dashboard');

    Route::post('/notes', [NoteController::class, 'store'])
        ->name('notes.store');

    Route::put('/notes/{note}', [NoteController::class, 'update'])
        ->name('notes.update');

    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])
        ->name('notes.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

Route::view('/offline', 'offline');