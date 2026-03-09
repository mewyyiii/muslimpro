<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsmaulHusnaController;
use App\Http\Controllers\DoaPendekController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\PrayerTrackingController;
use App\Http\Controllers\TasbihController;
use App\Http\Controllers\QiblaController;
use App\Http\Controllers\QuranTrackingController;
use App\Http\Controllers\AzanSettingController;
// use App\Http\Controllers\Admin\AdController;       // ★ BARU
// use App\Http\Controllers\ProController;            // ★ BARU
// use App\Http\Controllers\IbadahReportController;   // ★ BARU

Route::view('/', 'welcome')->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/home', fn() => view('home'))->name('home');

    // ── Halaman Upgrade Pro ──────────────────────────────────────────
    // Route::get('/pro/upgrade', [ProController::class, 'upgrade'])->name('pro.upgrade');

    // ── PRO: Statistik Laporan Ibadah ────────────────────────────────
    // Route::get('/ibadah-report', [IbadahReportController::class, 'index'])
    //     ->middleware('pro')
    //     ->name('ibadah-report.index');

    // ── Prayer Tracking ──────────────────────────────────────────────
    Route::get('/prayer-tracking', [PrayerTrackingController::class, 'index'])
        ->name('prayer-tracking.index');
    Route::post('/prayer-tracking', [PrayerTrackingController::class, 'store'])
        ->name('prayer-tracking.store');
    Route::get('/prayer-tracking/summary', [PrayerTrackingController::class, 'summary'])
        ->name('prayer-tracking.summary');
    Route::post('/prayer-tracking/set-location', [PrayerTrackingController::class, 'setLocation'])
        ->name('prayer-tracking.set-location');
    Route::get('/prayer-tracking/search-cities', [PrayerTrackingController::class, 'searchCities'])
        ->name('prayer-tracking.search-cities');

    // ── Azan Setting ─────────────────────────────────────────────────
    Route::get('/azan-settings',  [AzanSettingController::class, 'show'])->name('azan-settings.show');
    Route::post('/azan-settings', [AzanSettingController::class, 'store'])->name('azan-settings.store');

    // ── Al-Quran ─────────────────────────────────────────────────────
    Route::get('/al-quran', [QuranController::class, 'index'])->name('quran.index');
    Route::get('/surah/{number}', [QuranController::class, 'show'])->name('quran.show');

    // ── Quran Tracking (BUGFIX: dipindah ke dalam auth) ───────────────
    Route::get('/quran-tracking', [QuranTrackingController::class, 'index'])
        ->name('quran-tracking.index');
    Route::get('/quran-tracking/summary', [QuranTrackingController::class, 'summary'])
        ->name('quran-tracking.summary');
    Route::post('/quran-tracking/update', [QuranTrackingController::class, 'updateProgress'])
        ->name('quran-tracking.update');
    Route::post('/quran-tracking/reset', [QuranTrackingController::class, 'resetSurah'])
        ->name('quran-tracking.reset');

    // ── Fitur Lainnya ────────────────────────────────────────────────
    Route::get('/asmaul-husna', [AsmaulHusnaController::class, 'index'])->name('asmaul-husna.index');
    Route::get('/doa-pendek',   [DoaPendekController::class, 'index'])->name('doa-pendek.index');
    Route::get('/qibla',        [QiblaController::class, 'index'])->name('qibla.index');

    Route::get('/tasbih',       [TasbihController::class, 'index'])->name('tasbih.index');
    Route::get('/tasbih/stats', [TasbihController::class, 'getStats'])->name('tasbih.stats');
    Route::post('/tasbih/save', [TasbihController::class, 'saveCount'])->name('tasbih.save');

    // ── Profile ──────────────────────────────────────────────────────
    Route::get('/profile',          [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',        [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',       [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar',[ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
    Route::post('/profile/verify-password', [ProfileController::class, 'verifyPassword'])->name('profile.destroy.verify');

    // ── Record klik iklan ─────────────────────────────────────────────
//     Route::post('/ads/{ad}/click', [AdController::class, 'click'])->name('ads.click');

//     // ── Admin ─────────────────────────────────────────────────────────
//     // ✅ BERSIH
// Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
//     Route::resource('ads', AdController::class);
//     Route::post('ads/{ad}/toggle', [AdController::class, 'toggle'])->name('ads.toggle');
// });

});

require __DIR__.'/auth.php';