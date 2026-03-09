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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

Route::view('/', 'welcome')->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ── Webhook Midtrans — di luar auth ──────────────────────────────────
Route::post('/webhook/midtrans', [PaymentController::class, 'webhook'])
    ->name('payment.webhook');

Route::middleware('auth')->group(function () {

    Route::get('/home', fn() => view('home'))->name('home');

    // ── Prayer Tracking ──────────────────────────────────────────────
    Route::get('/prayer-tracking', [PrayerTrackingController::class, 'index'])->name('prayer-tracking.index');
    Route::post('/prayer-tracking', [PrayerTrackingController::class, 'store'])->name('prayer-tracking.store');
    Route::get('/prayer-tracking/summary', [PrayerTrackingController::class, 'summary'])->name('prayer-tracking.summary');
    Route::post('/prayer-tracking/set-location', [PrayerTrackingController::class, 'setLocation'])->name('prayer-tracking.set-location');
    Route::get('/prayer-tracking/search-cities', [PrayerTrackingController::class, 'searchCities'])->name('prayer-tracking.search-cities');

    // ── Azan Setting ─────────────────────────────────────────────────
    Route::get('/azan-settings',  [AzanSettingController::class, 'show'])->name('azan-settings.show');
    Route::post('/azan-settings', [AzanSettingController::class, 'store'])->name('azan-settings.store');

    // ── Al-Quran ─────────────────────────────────────────────────────
    Route::get('/al-quran', [QuranController::class, 'index'])->name('quran.index');
    Route::get('/surah/{number}', [QuranController::class, 'show'])->name('quran.show');

    // ── Quran Tracking ───────────────────────────────────────────────
    Route::get('/quran-tracking', [QuranTrackingController::class, 'index'])->name('quran-tracking.index');
    Route::get('/quran-tracking/summary', [QuranTrackingController::class, 'summary'])->name('quran-tracking.summary');
    Route::post('/quran-tracking/update', [QuranTrackingController::class, 'updateProgress'])->name('quran-tracking.update');
    Route::post('/quran-tracking/reset', [QuranTrackingController::class, 'resetSurah'])->name('quran-tracking.reset');

    // ── Fitur Lainnya ────────────────────────────────────────────────
    Route::get('/asmaul-husna', [AsmaulHusnaController::class, 'index'])->name('asmaul-husna.index');
    Route::get('/doa-pendek',   [DoaPendekController::class, 'index'])->name('doa-pendek.index');
    Route::get('/qibla',        [QiblaController::class, 'index'])->name('qibla.index');
    Route::get('/tasbih',       [TasbihController::class, 'index'])->name('tasbih.index');
    Route::get('/tasbih/stats', [TasbihController::class, 'getStats'])->name('tasbih.stats');
    Route::post('/tasbih/save', [TasbihController::class, 'saveCount'])->name('tasbih.save');

    // ── Profile ──────────────────────────────────────────────────────
    Route::get('/profile',           [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',         [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',        [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
    Route::post('/profile/verify-password', [ProfileController::class, 'verifyPassword'])->name('profile.destroy.verify');

    // ── Payment ──────────────────────────────────────────────────────
    Route::get('/upgrade', [PaymentController::class, 'upgrade'])->name('payment.upgrade');
    Route::post('/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');

    // ── Admin ─────────────────────────────────────────────────────────
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
        Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
        Route::post('/ads', [AdController::class, 'store'])->name('ads.store');
        Route::post('/ads/{ad}/toggle', [AdController::class, 'toggle'])->name('ads.toggle');
        Route::delete('/ads/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);
    });

});

require __DIR__.'/auth.php';