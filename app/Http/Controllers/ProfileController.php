<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
        $prayerTotal     = now()->day * 5; // target bulan ini
        $prayerPercent   = $prayerTotal > 0 ? round(($prayerPerformed / $prayerTotal) * 100) : 0;

        // Streak shalat
        $streak = 0;
        $date   = now()->toDateString();
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

        return view('profile.edit', compact(
            'user',
            'prayerPerformed',
            'prayerTotal',
            'prayerPercent',
            'streak'
        ));
    }

    /**
     * Update profile info + avatar
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Handle upload avatar
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path         = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Hapus avatar jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}