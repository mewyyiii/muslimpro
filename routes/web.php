<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsmaulHusnaController;
use App\Http\Controllers\DoaPendekController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\PrayerTrackingController;
use App\Http\Controllers\TasbihController;
use App\Http\Controllers\QiblaController; // ★ BARU
use App\Http\Controllers\QController; // ★ BARU

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // ★ Prayer Tracking Routes
    Route::get('/prayer-tracking', [PrayerTrackingController::class, 'index'])
        ->name('prayer-tracking.index');
    Route::post('/prayer-tracking', [PrayerTrackingController::class, 'store'])
        ->name('prayer-tracking.store');
    Route::get('/prayer-tracking/summary', [PrayerTrackingController::class, 'summary'])
        ->name('prayer-tracking.summary');

    // Al-Quran Routes
    Route::get('/al-quran', [QuranController::class, 'index'])->name('quran.index');
    Route::get('/surah/{number}', [QuranController::class, 'show'])->name('quran.show');

    // Asmaul Husna Routes
    Route::get('/asmaul-husna', [AsmaulHusnaController::class, 'index'])->name('asmaul-husna.index');

    // Doa Pendek Routes
    Route::get('/doa-pendek', [DoaPendekController::class, 'index'])->name('doa-pendek.index');

    // ★ Tasbih Routes
    Route::get('/tasbih', [TasbihController::class, 'index'])->name('tasbih.index');
    Route::get('/tasbih/stats', [TasbihController::class, 'getStats'])->name('tasbih.stats');
    Route::post('/tasbih/save', [TasbihController::class, 'saveCount'])->name('tasbih.save');

    // ★ BARU: Qibla Routes
    Route::get('/qibla', [QiblaController::class, 'index'])->name('qibla.index');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Quran Tracking Routes
    Route::get('/quran-tracking', [QuranTrackingController::class, 'index'])
        ->name('quran-tracking.index');
    Route::get('/quran-tracking/summary', [QuranTrackingController::class, 'summary'])
        ->name('quran-tracking.summary');
    Route::post('/quran-tracking/update', [QuranTrackingController::class, 'updateProgress'])
        ->name('quran-tracking.update');
    Route::post('/quran-tracking/reset', [QuranTrackingController::class, 'resetSurah'])
        ->name('quran-tracking.reset');


require __DIR__.'/auth.php';