<?php

namespace App\Http\Controllers;

use App\Models\PrayerTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PrayerTrackingController extends Controller
{
    // Urutan shalat 5 waktu
    private $prayers = ['fajr', 'dhuhr', 'asr', 'maghrib', 'isha'];

    private $prayerNames = [
        'fajr'    => 'Subuh',
        'dhuhr'   => 'Dzuhur',
        'asr'     => 'Ashar',
        'maghrib' => 'Maghrib',
        'isha'    => 'Isya',
    ];

    // Waktu shalat statis (jam:menit)
    private $prayerTimes = [
        'fajr'    => '04:30',
        'dhuhr'   => '12:00',
        'asr'     => '15:00',
        'maghrib' => '18:00',
        'isha'    => '19:15',
    ];

    /**
     * Halaman utama tracking shalat
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $today  = Carbon::today();

        // Ambil tanggal yang dipilih (default hari ini)
        $selectedDate = $request->get('date', $today->toDateString());
        $selectedCarbon = Carbon::parse($selectedDate);

        // Data shalat hari ini / tanggal dipilih
        $todayPrayers = PrayerTracking::where('user_id', $userId)
            ->where('prayer_date', $selectedDate)
            ->get()
            ->keyBy('prayer_name');

        // Hitung streak (berturut-turut shalat lengkap 5 waktu)
        $streak = $this->calculateStreak($userId);

        // Statistik 7 hari terakhir
        $weeklyStats = $this->getWeeklyStats($userId);

        // Statistik 30 hari terakhir
        $monthlyStats = $this->getMonthlyStats($userId);

        // Total shalat bulan ini
        $monthTotal = PrayerTracking::where('user_id', $userId)
            ->where('status', 'performed')
            ->whereYear('prayer_date', $today->year)
            ->whereMonth('prayer_date', $today->month)
            ->count();

        // Persentase hari ini
        $todayPerformed = $todayPrayers->where('status', 'performed')->count();
        $todayPercent   = round(($todayPerformed / 5) * 100);

        $currentServerTime = Carbon::now()->format('H:i'); // Get current time in HH:MM format

        return view('prayer_tracking', compact(
            'todayPrayers',
            'selectedDate',
            'selectedCarbon',
            'streak',
            'weeklyStats',
            'monthlyStats',
            'monthTotal',
            'todayPerformed',
            'todayPercent',
            'currentServerTime'
        ))->with('prayers', $this->prayers)
          ->with('prayerNames', $this->prayerNames)
          ->with('prayerTimes', $this->prayerTimes);
    }

    /**
     * Simpan / update status shalat
     */
    public function store(Request $request)
    {
        $request->validate([
            'prayer_name' => 'required|in:fajr,dhuhr,asr,maghrib,isha',
            'prayer_date' => 'required|date',
            'status'      => 'required|in:performed,missed,qada',
            'notes'       => 'nullable|string|max:255',
        ]);

        $prayerName = $request->prayer_name;
        $prayerDate = Carbon::parse($request->prayer_date);
        $currentDateTime = Carbon::now();

        // Backend validation for current day only
        if ($prayerDate->isToday()) {
            $prayerIndex = array_search($prayerName, $this->prayers);
            if ($prayerIndex === false) {
                // Should not happen due to 'in' validation rule, but as a safeguard
                return response()->json(['success' => false, 'message' => 'Invalid prayer name.'], 400);
            }

            $prayerStartTime = Carbon::parse($this->prayerTimes[$prayerName]);

            // Determine end time for the current prayer (start of next prayer, or end of day for Isha)
            $nextPrayerStartTime = null;
            if ($prayerIndex < count($this->prayers) - 1) {
                $nextPrayerName = $this->prayers[$prayerIndex + 1];
                $nextPrayerStartTime = Carbon::parse($this->prayerTimes[$nextPrayerName]);
            } else {
                // For Isha, the window ends at midnight
                $nextPrayerStartTime = Carbon::parse('23:59');
            }

            // If the submission is outside the allowed time, reject it
            if ($currentDateTime->lt($prayerStartTime) || $currentDateTime->gte($nextPrayerStartTime)) {
                return response()->json(['success' => false, 'message' => 'Tidak bisa mencatat shalat di luar waktu yang ditentukan.'], 200);
            }
        }

        PrayerTracking::updateOrCreate(
            [
                'user_id'     => Auth::id(),
                'prayer_date' => $request->prayer_date,
                'prayer_name' => $request->prayer_name,
            ],
            [
                'status' => $request->status,
                'notes'  => $request->notes,
            ]
        );

        return response()->json(['success' => true, 'message' => 'Shalat berhasil dicatat!']);
    }

    /**
     * Ringkasan untuk widget di home (dipanggil via route terpisah)
     */
    public function summary()
    {
        $userId = Auth::id();
        $today  = Carbon::today()->toDateString();

        $todayPrayers = PrayerTracking::where('user_id', $userId)
            ->where('prayer_date', $today)
            ->get()
            ->keyBy('prayer_name');

        $performed = $todayPrayers->where('status', 'performed')->count();
        $streak    = $this->calculateStreak($userId);

        return response()->json([
            'performed'    => $performed,
            'total'        => 5,
            'percent'      => round(($performed / 5) * 100),
            'streak'       => $streak,
            'prayers'      => $this->prayers,
            'prayer_names' => $this->prayerNames,
            'today_data'   => $todayPrayers->toArray(),
        ]);
    }

    // ─── Private helpers ────────────────────────────────────────────────────────

    private function calculateStreak(int $userId): int
    {
        $streak = 0;
        $date   = Carbon::today();

        // Cek mundur hari per hari
        while (true) {
            $count = PrayerTracking::where('user_id', $userId)
                ->where('prayer_date', $date->toDateString())
                ->where('status', 'performed')
                ->count();

            if ($count === 5) {
                $streak++;
                $date->subDay();
            } else {
                // Jika hari ini belum lengkap tapi belum selesai, tetap lanjut
                if ($date->isToday() && $count > 0) {
                    $date->subDay();
                    continue;
                }
                break;
            }
        }

        return $streak;
    }

    private function getWeeklyStats(int $userId): array
    {
        $stats = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $performed = PrayerTracking::where('user_id', $userId)
                ->where('prayer_date', $date->toDateString())
                ->where('status', 'performed')
                ->count();

            $stats[] = [
                'date'      => $date->toDateString(),
                'day'       => $date->locale('id')->isoFormat('ddd'),
                'performed' => $performed,
                'percent'   => round(($performed / 5) * 100),
                'is_today'  => $date->isToday(),
            ];
        }
        return $stats;
    }

    private function getMonthlyStats(int $userId): array
    {
        $today     = Carbon::today();
        $startDate = $today->copy()->startOfMonth();
        $stats     = [];

        for ($date = $startDate->copy(); $date->lte($today); $date->addDay()) {
            $performed = PrayerTracking::where('user_id', $userId)
                ->where('prayer_date', $date->toDateString())
                ->where('status', 'performed')
                ->count();

            $stats[] = [
                'date'      => $date->toDateString(),
                'day'       => $date->day,
                'performed' => $performed,
                'is_today'  => $date->isToday(),
            ];
        }
        return $stats;
    }
}