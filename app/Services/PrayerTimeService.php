<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PrayerTimeService
{
    /**
     * Get prayer times for a specific location and date
     * 
     * @param float $latitude
     * @param float $longitude
     * @param string|null $date Format: DD-MM-YYYY
     * @return array
     */
    public static function getPrayerTimes($latitude, $longitude, $date = null)
    {
        $date = $date ?? Carbon::now()->format('d-m-Y');
        
        // Cache key berdasarkan lokasi dan tanggal
        $cacheKey = "prayer_times_{$latitude}_{$longitude}_{$date}";
        
        return Cache::remember($cacheKey, now()->addHours(6), function () use ($latitude, $longitude, $date) {
            try {
                // Aladhan API - Free dan reliable
                $response = Http::timeout(10)->get('http://api.aladhan.com/v1/timings/' . $date, [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'method' => 20, // Method 20 = Indonesia (Kemenag)
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $timings = $data['data']['timings'];
                    $timezone = $data['data']['meta']['timezone'];

                    return [
                        'timings' => [
                            'fajr' => substr($timings['Fajr'], 0, 5),      // Format HH:MM
                            'dhuhr' => substr($timings['Dhuhr'], 0, 5),
                            'asr' => substr($timings['Asr'], 0, 5),
                            'maghrib' => substr($timings['Maghrib'], 0, 5),
                            'isha' => substr($timings['Isha'], 0, 5),
                        ],
                        'timezone' => $timezone,
                    ];
                }
            } catch (\Exception $e) {
                \Log::error('Prayer Time API Error: ' . $e->getMessage());
            }

            // Fallback ke waktu default jika API gagal
            return self::getDefaultTimes();
        });
    }

    /**
     * Get prayer times by city name
     * 
     * @param string $city
     * @param string $country
     * @param string|null $date
     * @return array
     */
    public static function getPrayerTimesByCity($city, $country = 'Indonesia', $date = null)
    {
        $date = $date ?? Carbon::now()->format('d-m-Y');
        $cacheKey = "prayer_times_city_{$city}_{$country}_{$date}";
        
        return Cache::remember($cacheKey, now()->addHours(6), function () use ($city, $country, $date) {
            try {
                $response = Http::timeout(10)->get('http://api.aladhan.com/v1/timingsByCity/' . $date, [
                    'city' => $city,
                    'country' => $country,
                    'method' => 20,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $timings = $data['data']['timings'];
                    $timezone = $data['data']['meta']['timezone'];

                    return [
                        'timings' => [
                            'fajr' => substr($timings['Fajr'], 0, 5),
                            'dhuhr' => substr($timings['Dhuhr'], 0, 5),
                            'asr' => substr($timings['Asr'], 0, 5),
                            'maghrib' => substr($timings['Maghrib'], 0, 5),
                            'isha' => substr($timings['Isha'], 0, 5),
                        ],
                        'timezone' => $timezone,
                    ];
                }
            } catch (\Exception $e) {
                \Log::error('Prayer Time City API Error: ' . $e->getMessage());
            }

            return self::getDefaultTimes();
        });
    }

    /**
     * Search cities (autocomplete)
     * 
     * @param string $query
     * @return array
     */
    public static function searchCities($query)
    {
        // List kota-kota besar Indonesia untuk autocomplete
        $indonesianCities = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang',
            'Makassar', 'Palembang', 'Tangerang', 'Depok', 'Bekasi',
            'Bogor', 'Batam', 'Pekanbaru', 'Bandar Lampung', 'Padang',
            'Malang', 'Denpasar', 'Samarinda', 'Tasikmalaya', 'Pontianak',
            'Cirebon', 'Balikpapan', 'Jambi', 'Surakarta', 'Serang',
            'Manado', 'Mataram', 'Yogyakarta', 'Cilegon', 'Kupang',
            'Banjarmasin', 'Bengkulu', 'Palu', 'Sukabumi', 'Cimahi',
            'Kediri', 'Pekalongan', 'Jayapura', 'Palangkaraya', 'Ambon'
        ];

        $query = strtolower($query);
        
        return array_values(array_filter($indonesianCities, function ($city) use ($query) {
            return str_contains(strtolower($city), $query);
        }));
    }

    /**
     * Default prayer times (fallback)
     * 
     * @return array
     */
    private static function getDefaultTimes()
    {
        // Default waktu shalat (Jakarta/Indonesia Barat)
        return [
            'fajr' => '04:30',
            'dhuhr' => '12:00',
            'asr' => '15:15',
            'maghrib' => '18:00',
            'isha' => '19:15',
        ];
    }

    /**
     * Get current prayer name based on time
     * 
     * @param array $prayerTimes
     * @param string $currentTime Format: HH:MM
     * @return string|null
     */
    public static function getCurrentPrayer($prayerTimes, $currentTime)
    {
        $current = Carbon::createFromFormat('H:i', $currentTime);
        
        foreach (['isha', 'maghrib', 'asr', 'dhuhr', 'fajr'] as $prayer) {
            $prayerTime = Carbon::createFromFormat('H:i', $prayerTimes[$prayer]);
            if ($current->gte($prayerTime)) {
                return $prayer;
            }
        }
        
        return null; // Before Fajr
    }

    /**
     * Get next prayer name and time
     * 
     * @param array $prayerTimes
     * @param string $currentTime
     * @return array ['name' => string, 'time' => string, 'remaining_minutes' => int]
     */
    public static function getNextPrayer($prayerTimes, $currentTime)
    {
        $current = Carbon::createFromFormat('H:i', $currentTime);
        
        foreach (['fajr', 'dhuhr', 'asr', 'maghrib', 'isha'] as $prayer) {
            $prayerTime = Carbon::createFromFormat('H:i', $prayerTimes[$prayer]);
            
            if ($current->lt($prayerTime)) {
                return [
                    'name' => $prayer,
                    'time' => $prayerTimes[$prayer],
                    'remaining_minutes' => $current->diffInMinutes($prayerTime, false)
                ];
            }
        }
        
        // If after Isha, next is Fajr tomorrow
        $fajrTomorrow = Carbon::createFromFormat('H:i', $prayerTimes['fajr'])->addDay();
        
        return [
            'name' => 'fajr',
            'time' => $prayerTimes['fajr'],
            'remaining_minutes' => $current->diffInMinutes($fajrTomorrow, false)
        ];
    }
}