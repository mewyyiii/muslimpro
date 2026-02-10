<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsmaulHusnaController; // Import AsmaulHusnaController
use App\Http\Controllers\DoaPendekController;   // Import DoaPendekController
use App\Http\Controllers\QuranController;      // Import QuranController

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/home', function () { // New route for home.blade.php
        return view('home');
    })->name('home'); // Named 'home' for redirection
    
    // Al-Quran Routes
    Route::get('/al-quran', [QuranController::class, 'index'])->name('quran.index');

    // Asmaul Husna Routes
    Route::get('/asmaul-husna', [AsmaulHusnaController::class, 'index'])->name('asmaul-husna.index');

    // Doa Pendek Routes
    Route::get('/doa-pendek', [DoaPendekController::class, 'index'])->name('doa-pendek.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
