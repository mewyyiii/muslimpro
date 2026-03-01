<?php

namespace App\Http\Controllers;

use App\Models\PrayerTracking;
use App\Services\PrayerTimeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrayerTrackingController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $selectedDate = $request->get('date', now()->toDateString());

        // ==============================
        // 📍 GET USER LOCATION
        // ==============================
        $userLat  = session('user_lat');
        $userLng  = session('user_lng');

        // FIX: kalau pakai koordinat, tampilkan nama kota dari session 'user_city_name'
        // kalau pakai nama kota, tampilkan dari session 'user_city'
        // default Jakarta hanya kalau benar-benar tidak ada session apapun
        if ($userLat && $userLng) {
            $userCity = session('user_city_name', 'Lokasi GPS');
        } else {
            $userCity = session('user_city', 'Jakarta');
        }

        $formattedDate = Carbon::parse($selectedDate)->format('d-m-Y');

        // ==============================
        // 🕌 GET PRAYER TIMES
        // ==============================
        if ($userLat && $userLng) {
            $prayerTimesData = PrayerTimeService::getPrayerTimes(
                $userLat,
                $userLng,
                $formattedDate
            );
        } else {
            $prayerTimesData = PrayerTimeService::getPrayerTimesByCity(
                $userCity,
                'Indonesia',
                $formattedDate
            );
        }

        $prayerTimes      = $prayerTimesData['timings'] ?? [];
        $locationTimezone = $prayerTimesData['timezone'] ?? config('app.timezone');

        // ==============================
        // 🌙 IMSAK & BUKA
        // ==============================
        $imsakTime = Carbon::createFromFormat('H:i', $prayerTimes['fajr'])
            ->subMinutes(10)
            ->format('H:i');

        $bukaTime = $prayerTimes['maghrib'];

        // ==============================
        // ⏰ CURRENT TIME BASED ON LOCATION
        // ==============================
        $currentServerTime = Carbon::now($locationTimezone)->format('H:i');

        $prayers = ['fajr', 'dhuhr', 'asr', 'maghrib', 'isha'];
        $prayerNames = [
            'fajr'    => 'Subuh',
            'dhuhr'   => 'Dzuhur',
            'asr'     => 'Ashar',
            'maghrib' => 'Maghrib',
            'isha'    => 'Isya',
        ];

        $todayPrayers = PrayerTracking::where('user_id', $user->id)
            ->where('prayer_date', $selectedDate)
            ->get()
            ->keyBy('prayer_name');

        $todayPerformed = $todayPrayers->where('status', 'performed')->count();
        $todayPercent   = ($todayPerformed / 5) * 100;

        $streak = $this->calculateStreak($user->id);

        $monthTotal = PrayerTracking::where('user_id', $user->id)
            ->whereYear('prayer_date', now()->year)
            ->whereMonth('prayer_date', now()->month)
            ->where('status', 'performed')
            ->count();

        $weeklyStats = $this->getWeeklyStats($user->id);

        $nextPrayer = PrayerTimeService::getNextPrayer($prayerTimes, $currentServerTime);

        return view('prayer_tracking', compact(
            'prayers',
            'prayerNames',
            'todayPrayers',
            'todayPerformed',
            'todayPercent',
            'streak',
            'monthTotal',
            'weeklyStats',
            'selectedDate',
            'prayerTimes',
            'currentServerTime',
            'userCity',
            'nextPrayer',
            'locationTimezone',
            'imsakTime',
            'bukaTime'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prayer_name' => 'required|in:fajr,dhuhr,asr,maghrib,isha',
            'status'      => 'required|in:performed,qada,missed,remove',
            'prayer_date' => 'required|date',
        ]);

        $user = auth()->user();

        if ($validated['status'] === 'remove') {
            PrayerTracking::where('user_id', $user->id)
                ->where('prayer_name', $validated['prayer_name'])
                ->where('prayer_date', $validated['prayer_date'])
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Catatan shalat berhasil dihapus',
            ]);
        }

        PrayerTracking::updateOrCreate(
            [
                'user_id'      => $user->id,
                'prayer_name'  => $validated['prayer_name'],
                'prayer_date'  => $validated['prayer_date'],
            ],
            ['status' => $validated['status']]
        );

        return response()->json([
            'success' => true,
            'message' => 'Status shalat berhasil disimpan',
        ]);
    }

    public function summary()
    {
        $user  = auth()->user();
        $today = now()->toDateString();

        $todayPrayers = PrayerTracking::where('user_id', $user->id)
            ->where('prayer_date', $today)
            ->get()
            ->keyBy('prayer_name');

        $performed = $todayPrayers->where('status', 'performed')->count();
        $percent   = ($performed / 5) * 100;
        $streak    = $this->calculateStreak($user->id);

        $todayData = [];
        foreach (['fajr', 'dhuhr', 'asr', 'maghrib', 'isha'] as $prayer) {
            $record = $todayPrayers->get($prayer);
            $todayData[$prayer] = ['status' => $record ? $record->status : null];
        }

        return response()->json([
            'performed'  => $performed,
            'total'      => 5,
            'percent'    => round($percent),
            'streak'     => $streak,
            'today_data' => $todayData,
        ]);
    }

    /**
     * Set user location
     * FIX: simpan juga nama kota ke session 'user_city_name' saat pakai koordinat
     */
    public function setLocation(Request $request)
    {
        $validated = $request->validate([
            'city'      => 'nullable|string',
            'latitude'  => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if (!empty($validated['latitude']) && !empty($validated['longitude'])) {
            // Simpan koordinat
            session([
                'user_lat'       => $validated['latitude'],
                'user_lng'       => $validated['longitude'],
                // FIX: simpan nama kota agar bisa ditampilkan di UI
                'user_city_name' => $validated['city'] ?? 'Lokasi GPS',
            ]);

            session()->forget('user_city');

        } elseif (!empty($validated['city'])) {
            session(['user_city' => $validated['city']]);
            session()->forget(['user_lat', 'user_lng', 'user_city_name']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Lokasi berhasil disimpan',
        ]);
    }

    /**
     * Search cities (autocomplete)
     */
    public function searchCities(Request $request)
    {
        $query  = $request->get('q', '');
        $cities = PrayerTimeService::searchCities($query);

        return response()->json($cities);
    }

    private function calculateStreak($userId)
    {
        $streak = 0;
        $date   = now();

        while (true) {
            $count = PrayerTracking::where('user_id', $userId)
                ->where('prayer_date', $date->toDateString())
                ->where('status', 'performed')
                ->count();

            if ($count === 5) {
                $streak++;
                $date->subDay();
            } else {
                break;
            }

            if ($streak > 365) break;
        }

        return $streak;
    }

    private function getWeeklyStats($userId)
    {
        $stats    = [];
        $dayNames = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

        for ($i = 6; $i >= 0; $i--) {
            $date      = now()->subDays($i);
            $performed = PrayerTracking::where('user_id', $userId)
                ->where('prayer_date', $date->toDateString())
                ->where('status', 'performed')
                ->count();

            $stats[] = [
                'date'      => $date->toDateString(),
                'day'       => $dayNames[$date->dayOfWeek],
                'performed' => $performed,
                'percent'   => ($performed / 5) * 100,
                'is_today'  => $date->isToday(),
            ];
        }

        return $stats;
    }
}