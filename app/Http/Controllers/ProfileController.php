<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profile
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Statistik shalat bulan ini
        $prayerStats = \App\Models\PrayerTracking::where('user_id', $user->id)
            ->whereMonth('prayer_date', now()->month)
            ->whereYear('prayer_date', now()->year)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $prayerPerformed = $prayerStats['performed'] ?? 0;
        $prayerTotal     = now()->day * 5;
        $prayerPercent   = $prayerTotal > 0 ? round(($prayerPerformed / $prayerTotal) * 100) : 0;

        // Streak shalat
        $streak = 0;
        for ($i = 0; $i < 30; $i++) {
            $checkDate = now()->subDays($i)->toDateString();
            $count     = \App\Models\PrayerTracking::where('user_id', $user->id)
                ->where('prayer_date', $checkDate)
                ->where('status', 'performed')
                ->count();
            if ($count === 5) {
                $streak++;
            } else {
                if ($i > 0) break;
            }
        }

        // ═══════════════════════════════════════════════════════════
        // TRACKING AL-QURAN (BARU)
        // ═══════════════════════════════════════════════════════════
        $quranTrackings = \App\Models\QuranTracking::where('user_id', $user->id)->get();
        $totalSurahCompleted = $quranTrackings->where('is_completed', true)->count();
        $totalSurah = 114;
        $quranPercent = $totalSurah > 0 ? round(($totalSurahCompleted / $totalSurah) * 100) : 0;
        $totalVersesRead = $quranTrackings->sum('last_verse');
        
        $lastReadQuran = \App\Models\QuranTracking::with('surah')
            ->where('user_id', $user->id)
            ->orderBy('last_read_date', 'desc')
            ->first();
        
        $quranStreak = $this->calculateQuranStreak($user->id);
        
        $readQuranToday = \App\Models\QuranTracking::where('user_id', $user->id)
            ->whereDate('last_read_date', Carbon::today())
            ->exists();

        return view('profile.edit', compact(
            'user',
            'prayerPerformed',
            'prayerTotal',
            'prayerPercent',
            'streak',
            'totalSurahCompleted',
            'totalSurah',
            'quranPercent',
            'totalVersesRead',
            'lastReadQuran',
            'quranStreak',
            'readQuranToday'
        ));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function deleteAvatar(Request $request): RedirectResponse
    {
        $user = $request->user();
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null;
            $user->save();
        }
        return Redirect::route('profile.edit')->with('status', 'avatar-deleted');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // Method untuk hitung streak Al-Quran
    private function calculateQuranStreak(int $userId): int
    {
        $streak = 0;
        $date = Carbon::today();

        while (true) {
            $hasRead = \App\Models\QuranTracking::where('user_id', $userId)
                ->whereDate('last_read_date', $date->toDateString())
                ->exists();

            if ($hasRead) {
                $streak++;
                $date->subDay();
            } else {
                if ($date->isToday()) {
                    $date->subDay();
                    continue;
                }
                break;
            }
        }

        return $streak;
    }
}