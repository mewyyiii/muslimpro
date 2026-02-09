<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\AsmaulHusnaController;
use App\Http\Controllers\DoaPendekController; // Tambahkan ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk halaman utama (daftar surah)
Route::get('/', [QuranController::class, 'index']);

// Route untuk halaman detail surah
Route::get('/surah/{nomor}', [QuranController::class, 'show']);

// Route untuk halaman Asmaul Husna
Route::get('/asmaul-husna', [AsmaulHusnaController::class, 'index'])->name('asmaul-husna.index');

// Route untuk halaman Doa-doa Pendek
Route::get('/doa-pendek', [DoaPendekController::class, 'index'])->name('doa-pendek.index');