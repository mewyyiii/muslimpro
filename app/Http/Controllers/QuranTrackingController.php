<?php

namespace App\Http\Controllers;

use App\Models\QuranTracking;
use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuranTrackingController extends Controller
{
    /**
     * Halaman tracking mengaji
     */
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua tracking user
        $trackings = QuranTracking::with('surah')
            ->where('user_id', $userId)
            ->orderBy('last_read_date', 'desc')
            ->get();

        // Statistik
        $totalSurahCompleted = $trackings->where('is_completed', true)->count();
        $totalSurah          = 114;
        $percentCompleted    = round(($totalSurahCompleted / $totalSurah) * 100);

        // Total ayat yang sudah dibaca
        $totalVersesRead = $trackings->sum('last_verse');

        // Total durasi baca
        $totalDuration = $trackings->sum('duration_seconds');
        $totalHours    = floor($totalDuration / 3600);
        $totalMinutes  = floor(($totalDuration % 3600) / 60);

        // Streak (hari berturut-turut baca)
        $streak = $this->calculateStreak($userId);

        // Baca hari ini?
        $readToday = $trackings->where('last_read_date', Carbon::today()->toDateString())->count() > 0;

        // Progress per juz (opsional, bisa dikembangkan nanti)
        $juzProgress = $this->calculateJuzProgress($userId);

        return view('quran_tracking', compact(
            'trackings',
            'totalSurahCompleted',
            'totalSurah',
            'percentCompleted',
            'totalVersesRead',
            'totalHours',
            'totalMinutes',
            'streak',
            'readToday',
            'juzProgress'
        ));
    }

    /**
     * API: Summary untuk widget di home
     */
    public function summary()
    {
        $userId = Auth::id();

        $totalCompleted = QuranTracking::where('user_id', $userId)
            ->where('is_completed', true)
            ->count();

        $streak = $this->calculateStreak($userId);

        $lastRead = QuranTracking::with('surah')
            ->where('user_id', $userId)
            ->orderBy('last_read_date', 'desc')
            ->first();

        return response()->json([
            'total_completed' => $totalCompleted,
            'total_surah'     => 114,
            'percent'         => round(($totalCompleted / 114) * 100),
            'streak'          => $streak,
            'last_read'       => $lastRead ? [
                'surah_name'   => $lastRead->surah->name,
                'surah_number' => $lastRead->surah_number,
                'last_verse'   => $lastRead->last_verse,
                'progress'     => $lastRead->progress_percent,
            ] : null,
        ]);
    }

    /**
     * Update progress baca (dipanggil dari halaman surah)
     */
    public function updateProgress(Request $request)
    {
        $request->validate([
            'surah_number'     => 'required|integer|min:1|max:114',
            'last_verse'       => 'required|integer|min:1',
            'duration_seconds' => 'nullable|integer|min:0',
        ]);

        $userId = Auth::id();
        $surah  = Surah::where('number', $request->surah_number)->first();

        if (!$surah) {
            return response()->json(['error' => 'Surah not found'], 404);
        }

        $isCompleted = $request->last_verse >= $surah->total_verses;

        $tracking = QuranTracking::updateOrCreate(
            [
                'user_id'      => $userId,
                'surah_number' => $request->surah_number,
            ],
            [
                'last_verse'       => $request->last_verse,
                'is_completed'     => $isCompleted,
                'duration_seconds' => ($request->duration_seconds ?? 0) + (QuranTracking::where('user_id', $userId)->where('surah_number', $request->surah_number)->value('duration_seconds') ?? 0),
                'last_read_date'   => Carbon::today(),
            ]
        );

        return response()->json([
            'success'      => true,
            'is_completed' => $isCompleted,
            'progress'     => $tracking->progress_percent,
            'message'      => $isCompleted ? 'MasyaAllah! Surah selesai!' : 'Progress tersimpan',
        ]);
    }

    /**
     * Reset progress surah tertentu
     */
    public function resetSurah(Request $request)
    {
        $request->validate([
            'surah_number' => 'required|integer|min:1|max:114',
        ]);

        QuranTracking::where('user_id', Auth::id())
            ->where('surah_number', $request->surah_number)
            ->delete();

        return response()->json(['success' => true, 'message' => 'Progress surah direset']);
    }

    // ─── Private Helpers ──────────────────────────────────────────────────────

    private function calculateStreak(int $userId): int
    {
        $streak = 0;
        $date   = Carbon::today();

        while (true) {
            $hasRead = QuranTracking::where('user_id', $userId)
                ->where('last_read_date', $date->toDateString())
                ->exists();

            if ($hasRead) {
                $streak++;
                $date->subDay();
            } else {
                // Jika hari ini belum baca, cek kemarin
                if ($date->isToday()) {
                    $date->subDay();
                    continue;
                }
                break;
            }
        }

        return $streak;
    }

    private function calculateJuzProgress(int $userId): array
    {
        // Simplified: hitung per juz (bisa dikembangkan lebih detail)
        // Untuk sekarang return array kosong, nanti bisa ditambah mapping surah ke juz
        return [];
    }
}