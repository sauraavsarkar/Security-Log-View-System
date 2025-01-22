<?php

use App\Http\Controllers\AntivirusController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Antivirus route handled by AntivirusController
Route::get('/antivirus', [AntivirusController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('antivirus');

// Routes requiring authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes (login, register, etc.)
require __DIR__.'/auth.php';
