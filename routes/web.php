<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\AsmaulHusnaController;
use App\Http\Controllers\DoaPendekController;

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

// Route untuk halaman beranda (home)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk halaman Al-Quran (daftar surah)
Route::get('/al-quran', [QuranController::class, 'index'])->name('al-quran.index');

// Route untuk halaman detail surah
Route::get('/surah/{nomor}', [QuranController::class, 'show'])->name('surah.show');

// Route untuk halaman Asmaul Husna
Route::get('/asmaul-husna', [AsmaulHusnaController::class, 'index'])->name('asmaul-husna.index');

// Route untuk halaman Doa-doa Pendek
Route::get('/doa-pendek', [DoaPendekController::class, 'index'])->name('doa-pendek.index');

// Routes untuk fitur yang akan datang (coming soon)
// Route::get('/waktu-shalat', [WaktuShalatController::class, 'index'])->name('waktu-shalat.index');
// Route::get('/arah-kiblat', [ArahKiblatController::class, 'index'])->name('arah-kiblat.index');
// Route::get('/jadwal-puasa', [JadwalPuasaController::class, 'index'])->name('jadwal-puasa.index');