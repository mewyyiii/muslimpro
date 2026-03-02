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
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // ═══════════════════════════════════════════════════════════
        // PRAYER TRACKING STATS
        // ═══════════════════════════════════════════════════════════
        $prayerStats = \App\Models\PrayerTracking::where('user_id', $user->id)
            ->whereMonth('prayer_date', now()->month)
            ->whereYear('prayer_date', now()->year)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $prayerPerformed = $prayerStats['performed'] ?? 0;
        $prayerTotal = now()->daysInMonth * 5;  // Maret 31 hari → 155
        $prayerPercent   = $prayerTotal > 0 ? round(($prayerPerformed / $prayerTotal) * 100) : 0;

        // Prayer streak calculation
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
        // QURAN TRACKING STATS
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

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Handle avatar upload
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

    /**
     * Delete the user's avatar.
     */
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

    /**
     * Delete the user's account.
     */
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

    /**
     * Calculate Quran reading streak.
     */
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