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

        $cacheKey = "prayer_times_{$latitude}_{$longitude}_{$date}";
        $cachedData = Cache::get($cacheKey);

        if ($cachedData && isset($cachedData['timings']) && isset($cachedData['timezone'])) {
            return $cachedData;
        }

        try {
            $response = Http::timeout(10)->get('http://api.aladhan.com/v1/timings/' . $date, [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'method' => 20,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['data']) && isset($data['data']['timings']) && isset($data['data']['meta']['timezone'])) {
                    $timings = $data['data']['timings'];
                    $timezone = $data['data']['meta']['timezone'];

                    $result = [
                        'timings' => [
                            'fajr'    => substr($timings['Fajr'], 0, 5),
                            'dhuhr'   => substr($timings['Dhuhr'], 0, 5),
                            'asr'     => substr($timings['Asr'], 0, 5),
                            'maghrib' => substr($timings['Maghrib'], 0, 5),
                            'isha'    => substr($timings['Isha'], 0, 5),
                        ],
                        'timezone' => $timezone,
                    ];
                    Cache::put($cacheKey, $result, now()->addHours(6));
                    return $result;
                } else {
                    Log::error('Prayer Time API: Missing data for lat: ' . $latitude . ', lng: ' . $longitude . ', date: ' . $date . '. Response: ' . json_encode($data));
                }
            } else {
                Log::error('Prayer Time API: Unsuccessful response for lat: ' . $latitude . ', lng: ' . $longitude . ', date: ' . $date . '. Status: ' . $response->status() . '. Response: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Prayer Time API Error: ' . $e->getMessage() . ' for lat: ' . $latitude . ', lng: ' . $longitude . ', date: ' . $date);
        }

        return self::getDefaultTimes();
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
        $cachedData = Cache::get($cacheKey);

        if ($cachedData && isset($cachedData['timings']) && isset($cachedData['timezone'])) {
            return $cachedData;
        }

        // Coba lookup koordinat dari daftar kabupaten/kota
        $allRegions = self::getAllRegions();
        $cityLower  = strtolower($city);
        $matched    = null;

        foreach ($allRegions as $region) {
            if (strtolower($region['name']) === $cityLower) {
                $matched = $region;
                break;
            }
        }

        // Kalau ketemu koordinat, pakai endpoint timings (lebih akurat)
        if ($matched) {
            return self::getPrayerTimes($matched['lat'], $matched['lng'], $date);
        }

        // Fallback ke timingsByCity API
        try {
            $response = Http::timeout(10)->get('http://api.aladhan.com/v1/timingsByCity/' . $date, [
                'city'    => $city,
                'country' => $country,
                'method'  => 20,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['data']) && isset($data['data']['timings']) && isset($data['data']['meta']['timezone'])) {
                    $timings  = $data['data']['timings'];
                    $timezone = $data['data']['meta']['timezone'];

                    $result = [
                        'timings' => [
                            'fajr'    => substr($timings['Fajr'], 0, 5),
                            'dhuhr'   => substr($timings['Dhuhr'], 0, 5),
                            'asr'     => substr($timings['Asr'], 0, 5),
                            'maghrib' => substr($timings['Maghrib'], 0, 5),
                            'isha'    => substr($timings['Isha'], 0, 5),
                        ],
                        'timezone' => $timezone,
                    ];
                    Cache::put($cacheKey, $result, now()->addHours(6));
                    return $result;
                } else {
                    Log::error('Prayer Time City API: Missing data for city: ' . $city . ', date: ' . $date . '. Response: ' . json_encode($data));
                }
            } else {
                Log::error('Prayer Time City API: Unsuccessful for city: ' . $city . '. Status: ' . $response->status() . '. Response: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Prayer Time City API Error: ' . $e->getMessage() . ' for city: ' . $city);
        }

        return self::getDefaultTimes();
    }

    /**
     * Search kabupaten/kota (autocomplete)
     * Mengembalikan array berisi name, lat, lng
     *
     * @param string $query
     * @return array
     */
    public static function searchCities($query)
    {
        $query   = strtolower(trim($query));
        $regions = self::getAllRegions();

        if ($query === '') {
            return array_slice($regions, 0, 20);
        }

        $results = array_values(array_filter($regions, function ($region) use ($query) {
            return str_contains(strtolower($region['name']), $query);
        }));

        return array_slice($results, 0, 30);
    }

    /**
     * Daftar lengkap kabupaten/kota Indonesia beserta koordinat
     *
     * @return array
     */
    private static function getAllRegions()
    {
        return [
            // ── ACEH ──────────────────────────────────────────────────────────
            ['name' => 'Banda Aceh',              'lat' =>  5.5577,  'lng' => 95.3222],
            ['name' => 'Sabang',                   'lat' =>  5.8933,  'lng' => 95.3191],
            ['name' => 'Langsa',                   'lat' =>  4.4683,  'lng' => 97.9683],
            ['name' => 'Lhokseumawe',              'lat' =>  5.1801,  'lng' => 97.1500],
            ['name' => 'Subulussalam',             'lat' =>  2.6500,  'lng' => 98.0000],
            ['name' => 'Kab. Aceh Besar',          'lat' =>  5.4500,  'lng' => 95.5000],
            ['name' => 'Kab. Pidie',               'lat' =>  4.9667,  'lng' => 96.1333],
            ['name' => 'Kab. Aceh Utara',          'lat' =>  5.1167,  'lng' => 97.1667],
            ['name' => 'Kab. Bireuen',             'lat' =>  5.2000,  'lng' => 96.7000],
            ['name' => 'Kab. Aceh Timur',          'lat' =>  4.6167,  'lng' => 97.7667],
            ['name' => 'Kab. Aceh Tenggara',       'lat' =>  3.6833,  'lng' => 97.6500],
            ['name' => 'Kab. Aceh Selatan',        'lat' =>  3.0667,  'lng' => 97.3667],
            ['name' => 'Kab. Aceh Barat',          'lat' =>  4.0833,  'lng' => 96.2500],
            ['name' => 'Kab. Simeulue',            'lat' =>  2.6500,  'lng' => 96.1000],
            ['name' => 'Kab. Nagan Raya',          'lat' =>  4.0000,  'lng' => 96.4000],
            ['name' => 'Kab. Aceh Jaya',           'lat' =>  4.5667,  'lng' => 95.5667],
            ['name' => 'Kab. Pidie Jaya',          'lat' =>  5.1833,  'lng' => 96.2667],
            ['name' => 'Kab. Gayo Lues',           'lat' =>  3.8333,  'lng' => 97.0833],
            ['name' => 'Kab. Aceh Singkil',        'lat' =>  2.3167,  'lng' => 97.7833],
            ['name' => 'Kab. Bener Meriah',        'lat' =>  4.7167,  'lng' => 96.8667],
            ['name' => 'Kab. Aceh Tamiang',        'lat' =>  4.3333,  'lng' => 98.0000],
            ['name' => 'Kab. Aceh Tengah',         'lat' =>  4.5500,  'lng' => 96.7167],

            // ── SUMATERA UTARA ────────────────────────────────────────────────
            ['name' => 'Medan',                    'lat' =>  3.5952,  'lng' => 98.6722],
            ['name' => 'Binjai',                   'lat' =>  3.6003,  'lng' => 98.4859],
            ['name' => 'Pematangsiantar',          'lat' =>  2.9595,  'lng' => 99.0687],
            ['name' => 'Tebing Tinggi',            'lat' =>  3.3289,  'lng' => 99.1625],
            ['name' => 'Tanjung Balai',            'lat' =>  2.9667,  'lng' => 99.8000],
            ['name' => 'Padang Sidempuan',         'lat' =>  1.3833,  'lng' => 99.2667],
            ['name' => 'Gunungsitoli',             'lat' =>  1.2833,  'lng' => 97.6000],
            ['name' => 'Sibolga',                  'lat' =>  1.7333,  'lng' => 98.7833],
            ['name' => 'Kab. Deli Serdang',        'lat' =>  3.5000,  'lng' => 98.8000],
            ['name' => 'Kab. Langkat',             'lat' =>  3.8333,  'lng' => 98.2500],
            ['name' => 'Kab. Karo',                'lat' =>  3.1833,  'lng' => 98.5000],
            ['name' => 'Kab. Simalungun',          'lat' =>  3.0000,  'lng' => 99.0833],
            ['name' => 'Kab. Asahan',              'lat' =>  2.8667,  'lng' => 99.6000],
            ['name' => 'Kab. Labuhanbatu',         'lat' =>  2.1333,  'lng' => 100.0833],
            ['name' => 'Kab. Tapanuli Utara',      'lat' =>  2.2167,  'lng' => 98.9167],
            ['name' => 'Kab. Tapanuli Tengah',     'lat' =>  1.8333,  'lng' => 98.7500],
            ['name' => 'Kab. Tapanuli Selatan',    'lat' =>  1.5500,  'lng' => 99.2000],
            ['name' => 'Kab. Mandailing Natal',    'lat' =>  0.8333,  'lng' => 99.3667],
            ['name' => 'Kab. Nias',                'lat' =>  1.1000,  'lng' => 97.5333],
            ['name' => 'Kab. Toba Samosir',        'lat' =>  2.6000,  'lng' => 98.9667],
            ['name' => 'Kab. Humbang Hasundutan',  'lat' =>  2.3500,  'lng' => 98.6333],
            ['name' => 'Kab. Samosir',             'lat' =>  2.5500,  'lng' => 98.7833],
            ['name' => 'Kab. Pakpak Bharat',       'lat' =>  3.0000,  'lng' => 98.2000],
            ['name' => 'Kab. Padang Lawas',        'lat' =>  1.3833,  'lng' => 99.7667],
            ['name' => 'Kab. Batubara',            'lat' =>  3.0667,  'lng' => 99.5167],
            ['name' => 'Kab. Nias Selatan',        'lat' =>  0.5333,  'lng' => 97.6500],
            ['name' => 'Kab. Nias Utara',          'lat' =>  1.3833,  'lng' => 97.4333],
            ['name' => 'Kab. Nias Barat',          'lat' =>  0.9167,  'lng' => 97.3167],
            ['name' => 'Kab. Serdang Bedagai',     'lat' =>  3.3167,  'lng' => 99.0000],
            ['name' => 'Kab. Labuhanbatu Utara',   'lat' =>  2.5000,  'lng' => 99.8333],
            ['name' => 'Kab. Labuhanbatu Selatan', 'lat' =>  1.8333,  'lng' => 100.0000],
            ['name' => 'Kab. Padang Lawas Utara',  'lat' =>  1.6667,  'lng' => 99.6333],

            // ── SUMATERA BARAT ────────────────────────────────────────────────
            ['name' => 'Padang',                   'lat' => -0.9492,  'lng' => 100.3542],
            ['name' => 'Bukittinggi',              'lat' => -0.3061,  'lng' => 100.3692],
            ['name' => 'Padang Panjang',           'lat' => -0.4667,  'lng' => 100.4000],
            ['name' => 'Payakumbuh',               'lat' => -0.2167,  'lng' => 100.6333],
            ['name' => 'Sawahlunto',               'lat' => -0.6833,  'lng' => 100.7833],
            ['name' => 'Solok',                    'lat' => -0.7833,  'lng' => 100.6500],
            ['name' => 'Pariaman',                 'lat' => -0.6333,  'lng' => 100.1167],
            ['name' => 'Kab. Agam',                'lat' => -0.2667,  'lng' => 100.1333],
            ['name' => 'Kab. Limapuluh Kota',      'lat' => -0.3500,  'lng' => 100.6667],
            ['name' => 'Kab. Pasaman',             'lat' =>  0.2500,  'lng' => 100.0833],
            ['name' => 'Kab. Solok',               'lat' => -0.9000,  'lng' => 100.6333],
            ['name' => 'Kab. Pesisir Selatan',     'lat' => -1.7500,  'lng' => 100.5667],
            ['name' => 'Kab. Tanah Datar',         'lat' => -0.4500,  'lng' => 100.5000],
            ['name' => 'Kab. Sijunjung',           'lat' => -0.6833,  'lng' => 100.9667],
            ['name' => 'Kab. Padang Pariaman',     'lat' => -0.5667,  'lng' => 100.2333],
            ['name' => 'Kab. Dharmasraya',         'lat' => -1.2167,  'lng' => 101.5333],
            ['name' => 'Kab. Solok Selatan',       'lat' => -1.5833,  'lng' => 101.2333],
            ['name' => 'Kab. Pasaman Barat',       'lat' =>  0.0833,  'lng' => 99.8333],
            ['name' => 'Kab. Kepulauan Mentawai',  'lat' => -2.0000,  'lng' => 99.5833],

            // ── RIAU ──────────────────────────────────────────────────────────
            ['name' => 'Pekanbaru',                'lat' =>  0.5333,  'lng' => 101.4500],
            ['name' => 'Dumai',                    'lat' =>  1.6667,  'lng' => 101.4500],
            ['name' => 'Kab. Kampar',              'lat' =>  0.3667,  'lng' => 101.1500],
            ['name' => 'Kab. Bengkalis',           'lat' =>  1.4833,  'lng' => 102.1000],
            ['name' => 'Kab. Rokan Hulu',          'lat' =>  0.9833,  'lng' => 100.5667],
            ['name' => 'Kab. Rokan Hilir',         'lat' =>  2.1500,  'lng' => 101.0333],
            ['name' => 'Kab. Siak',                'lat' =>  1.1167,  'lng' => 102.1333],
            ['name' => 'Kab. Pelalawan',           'lat' =>  0.2000,  'lng' => 102.1333],
            ['name' => 'Kab. Indragiri Hulu',      'lat' => -0.3333,  'lng' => 102.3500],
            ['name' => 'Kab. Indragiri Hilir',     'lat' => -0.3667,  'lng' => 103.0667],
            ['name' => 'Kab. Kuantan Singingi',    'lat' => -0.5167,  'lng' => 101.4667],
            ['name' => 'Kab. Kepulauan Meranti',   'lat' =>  1.1167,  'lng' => 102.7500],

            // ── KEPULAUAN RIAU ────────────────────────────────────────────────
            ['name' => 'Batam',                    'lat' =>  1.1000,  'lng' => 104.0167],
            ['name' => 'Tanjungpinang',            'lat' =>  0.9189,  'lng' => 104.4589],
            ['name' => 'Kab. Bintan',              'lat' =>  1.1333,  'lng' => 104.5167],
            ['name' => 'Kab. Karimun',             'lat' =>  1.0333,  'lng' => 103.4500],
            ['name' => 'Kab. Lingga',              'lat' =>  0.2000,  'lng' => 104.6167],
            ['name' => 'Kab. Natuna',              'lat' =>  3.9833,  'lng' => 108.3500],
            ['name' => 'Kab. Kepulauan Anambas',   'lat' =>  3.3500,  'lng' => 106.1500],

            // ── JAMBI ─────────────────────────────────────────────────────────
            ['name' => 'Jambi',                    'lat' => -1.6000,  'lng' => 103.6167],
            ['name' => 'Sungai Penuh',             'lat' => -2.0667,  'lng' => 101.6500],
            ['name' => 'Kab. Batanghari',          'lat' => -1.5833,  'lng' => 103.0833],
            ['name' => 'Kab. Bungo',               'lat' => -1.4833,  'lng' => 102.1667],
            ['name' => 'Kab. Merangin',            'lat' => -2.1333,  'lng' => 102.2667],
            ['name' => 'Kab. Muaro Jambi',         'lat' => -1.6167,  'lng' => 103.9167],
            ['name' => 'Kab. Sarolangun',          'lat' => -2.2167,  'lng' => 102.7000],
            ['name' => 'Kab. Tebo',                'lat' => -1.3667,  'lng' => 102.3833],
            ['name' => 'Kab. Kerinci',             'lat' => -2.0833,  'lng' => 101.4833],
            ['name' => 'Kab. Tanjung Jabung Barat','lat' => -1.1167,  'lng' => 103.5333],
            ['name' => 'Kab. Tanjung Jabung Timur','lat' => -1.0667,  'lng' => 104.1000],

            // ── SUMATERA SELATAN ──────────────────────────────────────────────
            ['name' => 'Palembang',                'lat' => -2.9167,  'lng' => 104.7458],
            ['name' => 'Prabumulih',               'lat' => -3.4333,  'lng' => 104.2333],
            ['name' => 'Pagar Alam',               'lat' => -4.0167,  'lng' => 103.2500],
            ['name' => 'Lubuklinggau',             'lat' => -3.3000,  'lng' => 102.8667],
            ['name' => 'Kab. Ogan Komering Ulu',   'lat' => -4.0000,  'lng' => 104.0000],
            ['name' => 'Kab. Ogan Komering Ilir',  'lat' => -3.5000,  'lng' => 105.0833],
            ['name' => 'Kab. Muara Enim',          'lat' => -3.6667,  'lng' => 103.7667],
            ['name' => 'Kab. Musi Banyuasin',      'lat' => -2.6500,  'lng' => 103.7500],
            ['name' => 'Kab. Musi Rawas',          'lat' => -3.1167,  'lng' => 103.0500],
            ['name' => 'Kab. Lahat',               'lat' => -3.7833,  'lng' => 103.5333],
            ['name' => 'Kab. Banyuasin',           'lat' => -2.7667,  'lng' => 104.6167],
            ['name' => 'Kab. Ogan Ilir',           'lat' => -3.2833,  'lng' => 104.6833],
            ['name' => 'Kab. Ogan Komering Ulu Timur','lat' => -4.2500,'lng' => 104.3833],
            ['name' => 'Kab. Ogan Komering Ulu Selatan','lat' => -4.5167,'lng' => 103.8333],
            ['name' => 'Kab. Empat Lawang',        'lat' => -3.9000,  'lng' => 103.2500],
            ['name' => 'Kab. Musi Rawas Utara',    'lat' => -2.7833,  'lng' => 103.1000],
            ['name' => 'Kab. Penukal Abab Lematang Ilir','lat' => -3.4833,'lng' => 103.9833],

            // ── BENGKULU ──────────────────────────────────────────────────────
            ['name' => 'Bengkulu',                 'lat' => -3.8000,  'lng' => 102.2667],
            ['name' => 'Kab. Bengkulu Utara',      'lat' => -3.3333,  'lng' => 101.9833],
            ['name' => 'Kab. Bengkulu Selatan',    'lat' => -4.4500,  'lng' => 103.0000],
            ['name' => 'Kab. Rejang Lebong',       'lat' => -3.4167,  'lng' => 102.5000],
            ['name' => 'Kab. Kepahiang',           'lat' => -3.6667,  'lng' => 102.5833],
            ['name' => 'Kab. Lebong',              'lat' => -3.1167,  'lng' => 102.3333],
            ['name' => 'Kab. Mukomuko',            'lat' => -2.5333,  'lng' => 101.1167],
            ['name' => 'Kab. Seluma',              'lat' => -4.0000,  'lng' => 102.5333],
            ['name' => 'Kab. Kaur',                'lat' => -4.8667,  'lng' => 103.3500],
            ['name' => 'Kab. Bengkulu Tengah',     'lat' => -3.7167,  'lng' => 102.3833],

            // ── LAMPUNG ───────────────────────────────────────────────────────
            ['name' => 'Bandar Lampung',           'lat' => -5.4294,  'lng' => 105.2615],
            ['name' => 'Metro',                    'lat' => -5.1167,  'lng' => 105.3000],
            ['name' => 'Kab. Lampung Selatan',     'lat' => -5.7333,  'lng' => 105.5000],
            ['name' => 'Kab. Lampung Tengah',      'lat' => -4.8333,  'lng' => 105.2333],
            ['name' => 'Kab. Lampung Utara',       'lat' => -4.8333,  'lng' => 104.9167],
            ['name' => 'Kab. Lampung Barat',       'lat' => -5.0833,  'lng' => 104.1167],
            ['name' => 'Kab. Lampung Timur',       'lat' => -5.1667,  'lng' => 105.6667],
            ['name' => 'Kab. Tulang Bawang',       'lat' => -4.3833,  'lng' => 105.5500],
            ['name' => 'Kab. Tanggamus',           'lat' => -5.3667,  'lng' => 104.6167],
            ['name' => 'Kab. Way Kanan',           'lat' => -4.5000,  'lng' => 104.5000],
            ['name' => 'Kab. Pringsewu',           'lat' => -5.3500,  'lng' => 104.9833],
            ['name' => 'Kab. Pesawaran',           'lat' => -5.3667,  'lng' => 105.1500],
            ['name' => 'Kab. Mesuji',              'lat' => -3.9833,  'lng' => 105.8333],
            ['name' => 'Kab. Tulang Bawang Barat', 'lat' => -4.4167,  'lng' => 105.2667],
            ['name' => 'Kab. Pesisir Barat',       'lat' => -4.9167,  'lng' => 103.8333],

            // ── BANGKA BELITUNG ───────────────────────────────────────────────
            ['name' => 'Pangkalpinang',            'lat' => -2.1333,  'lng' => 106.1167],
            ['name' => 'Kab. Bangka',              'lat' => -2.1667,  'lng' => 105.7500],
            ['name' => 'Kab. Bangka Barat',        'lat' => -1.8833,  'lng' => 105.2833],
            ['name' => 'Kab. Bangka Tengah',       'lat' => -2.5167,  'lng' => 106.2500],
            ['name' => 'Kab. Bangka Selatan',      'lat' => -3.0333,  'lng' => 106.3000],
            ['name' => 'Kab. Belitung',            'lat' => -2.8667,  'lng' => 107.7000],
            ['name' => 'Kab. Belitung Timur',      'lat' => -2.9833,  'lng' => 108.2000],

            // ── DKI JAKARTA ───────────────────────────────────────────────────
            ['name' => 'Jakarta Pusat',            'lat' => -6.1744,  'lng' => 106.8294],
            ['name' => 'Jakarta Utara',            'lat' => -6.1381,  'lng' => 106.8614],
            ['name' => 'Jakarta Barat',            'lat' => -6.1683,  'lng' => 106.7636],
            ['name' => 'Jakarta Selatan',          'lat' => -6.2615,  'lng' => 106.8106],
            ['name' => 'Jakarta Timur',            'lat' => -6.2250,  'lng' => 106.9003],
            ['name' => 'Kep. Seribu',              'lat' => -5.6100,  'lng' => 106.5700],

            // ── BANTEN ────────────────────────────────────────────────────────
            ['name' => 'Serang',                   'lat' => -6.1203,  'lng' => 106.1503],
            ['name' => 'Tangerang',                'lat' => -6.1783,  'lng' => 106.6319],
            ['name' => 'Tangerang Selatan',        'lat' => -6.2881,  'lng' => 106.7111],
            ['name' => 'Cilegon',                  'lat' => -6.0028,  'lng' => 106.0042],
            ['name' => 'Kab. Tangerang',           'lat' => -6.2167,  'lng' => 106.6333],
            ['name' => 'Kab. Serang',              'lat' => -6.2667,  'lng' => 106.1833],
            ['name' => 'Kab. Lebak',               'lat' => -6.5667,  'lng' => 106.2500],
            ['name' => 'Kab. Pandeglang',          'lat' => -6.3000,  'lng' => 106.1000],

            // ── JAWA BARAT ────────────────────────────────────────────────────
            ['name' => 'Bandung',                  'lat' => -6.9147,  'lng' => 107.6098],
            ['name' => 'Bogor',                    'lat' => -6.5971,  'lng' => 106.8060],
            ['name' => 'Cimahi',                   'lat' => -6.8722,  'lng' => 107.5422],
            ['name' => 'Depok',                    'lat' => -6.4025,  'lng' => 106.7942],
            ['name' => 'Bekasi',                   'lat' => -6.2349,  'lng' => 106.9896],
            ['name' => 'Cirebon',                  'lat' => -6.7063,  'lng' => 108.5569],
            ['name' => 'Sukabumi',                 'lat' => -6.9264,  'lng' => 106.9297],
            ['name' => 'Tasikmalaya',              'lat' => -7.3286,  'lng' => 108.2186],
            ['name' => 'Banjar',                   'lat' => -7.3686,  'lng' => 108.5331],
            ['name' => 'Kab. Bandung',             'lat' => -7.0833,  'lng' => 107.5500],
            ['name' => 'Kab. Bandung Barat',       'lat' => -6.8500,  'lng' => 107.4833],
            ['name' => 'Kab. Bogor',               'lat' => -6.6500,  'lng' => 106.8167],
            ['name' => 'Kab. Bekasi',              'lat' => -6.3333,  'lng' => 107.1500],
            ['name' => 'Kab. Karawang',            'lat' => -6.3167,  'lng' => 107.3333],
            ['name' => 'Kab. Purwakarta',          'lat' => -6.5500,  'lng' => 107.4333],
            ['name' => 'Kab. Subang',              'lat' => -6.5667,  'lng' => 107.7500],
            ['name' => 'Kab. Sumedang',            'lat' => -6.8500,  'lng' => 108.1167],
            ['name' => 'Kab. Majalengka',          'lat' => -6.8333,  'lng' => 108.2333],
            ['name' => 'Kab. Cirebon',             'lat' => -6.7500,  'lng' => 108.4833],
            ['name' => 'Kab. Kuningan',            'lat' => -6.9667,  'lng' => 108.4833],
            ['name' => 'Kab. Indramayu',           'lat' => -6.3167,  'lng' => 108.3333],
            ['name' => 'Kab. Garut',               'lat' => -7.2167,  'lng' => 107.9000],
            ['name' => 'Kab. Tasikmalaya',         'lat' => -7.3500,  'lng' => 108.1167],
            ['name' => 'Kab. Ciamis',              'lat' => -7.3333,  'lng' => 108.3500],
            ['name' => 'Kab. Pangandaran',         'lat' => -7.6833,  'lng' => 108.6500],
            ['name' => 'Kab. Cianjur',             'lat' => -6.8167,  'lng' => 107.1333],
            ['name' => 'Kab. Sukabumi',            'lat' => -7.0833,  'lng' => 106.9333],

            // ── DI YOGYAKARTA ─────────────────────────────────────────────────
            ['name' => 'Yogyakarta',               'lat' => -7.7956,  'lng' => 110.3695],
            ['name' => 'Kab. Sleman',              'lat' => -7.7167,  'lng' => 110.3500],
            ['name' => 'Kab. Bantul',              'lat' => -7.8833,  'lng' => 110.3333],
            ['name' => 'Kab. Gunungkidul',         'lat' => -7.9500,  'lng' => 110.5833],
            ['name' => 'Kab. Kulon Progo',         'lat' => -7.8333,  'lng' => 110.1667],

            // ── JAWA TENGAH ───────────────────────────────────────────────────
            ['name' => 'Semarang',                 'lat' => -6.9932,  'lng' => 110.4203],
            ['name' => 'Solo',                     'lat' => -7.5758,  'lng' => 110.8243],
            ['name' => 'Magelang',                 'lat' => -7.4794,  'lng' => 110.2181],
            ['name' => 'Salatiga',                 'lat' => -7.3306,  'lng' => 110.5014],
            ['name' => 'Pekalongan',               'lat' => -6.8903,  'lng' => 109.6753],
            ['name' => 'Tegal',                    'lat' => -6.8694,  'lng' => 109.1403],
            ['name' => 'Kab. Semarang',            'lat' => -7.1667,  'lng' => 110.4833],
            ['name' => 'Kab. Kendal',              'lat' => -6.9333,  'lng' => 110.2000],
            ['name' => 'Kab. Demak',               'lat' => -6.9000,  'lng' => 110.6667],
            ['name' => 'Kab. Grobogan',            'lat' => -7.0667,  'lng' => 110.9167],
            ['name' => 'Kab. Pati',                'lat' => -6.7500,  'lng' => 111.0333],
            ['name' => 'Kab. Kudus',               'lat' => -6.8000,  'lng' => 110.8500],
            ['name' => 'Kab. Jepara',              'lat' => -6.5833,  'lng' => 110.6667],
            ['name' => 'Kab. Rembang',             'lat' => -6.7167,  'lng' => 111.3500],
            ['name' => 'Kab. Blora',               'lat' => -6.9667,  'lng' => 111.4167],
            ['name' => 'Kab. Boyolali',            'lat' => -7.5333,  'lng' => 110.5833],
            ['name' => 'Kab. Klaten',              'lat' => -7.7167,  'lng' => 110.6000],
            ['name' => 'Kab. Sukoharjo',           'lat' => -7.6833,  'lng' => 110.8333],
            ['name' => 'Kab. Wonogiri',            'lat' => -7.8167,  'lng' => 111.0000],
            ['name' => 'Kab. Karanganyar',         'lat' => -7.5667,  'lng' => 111.0333],
            ['name' => 'Kab. Sragen',              'lat' => -7.4333,  'lng' => 111.0167],
            ['name' => 'Kab. Magelang',            'lat' => -7.5333,  'lng' => 110.2000],
            ['name' => 'Kab. Temanggung',          'lat' => -7.3167,  'lng' => 110.1667],
            ['name' => 'Kab. Wonosobo',            'lat' => -7.3667,  'lng' => 109.9000],
            ['name' => 'Kab. Purworejo',           'lat' => -7.7000,  'lng' => 110.0167],
            ['name' => 'Kab. Kebumen',             'lat' => -7.6667,  'lng' => 109.6500],
            ['name' => 'Kab. Banjarnegara',        'lat' => -7.3833,  'lng' => 109.7000],
            ['name' => 'Kab. Purbalingga',         'lat' => -7.4167,  'lng' => 109.3667],
            ['name' => 'Kab. Banyumas',            'lat' => -7.5333,  'lng' => 109.2667],
            ['name' => 'Kab. Cilacap',             'lat' => -7.7333,  'lng' => 109.0167],
            ['name' => 'Kab. Brebes',              'lat' => -6.8833,  'lng' => 109.0333],
            ['name' => 'Kab. Tegal',               'lat' => -7.0333,  'lng' => 109.1500],
            ['name' => 'Kab. Pemalang',            'lat' => -6.9000,  'lng' => 109.3833],
            ['name' => 'Kab. Pekalongan',          'lat' => -7.1000,  'lng' => 109.6500],
            ['name' => 'Kab. Batang',              'lat' => -6.9167,  'lng' => 109.7333],
            ['name' => 'Kab. Wonosobo',            'lat' => -7.3667,  'lng' => 109.9000],

            // ── JAWA TIMUR ────────────────────────────────────────────────────
            ['name' => 'Surabaya',                 'lat' => -7.2575,  'lng' => 112.7521],
            ['name' => 'Malang',                   'lat' => -7.9797,  'lng' => 112.6304],
            ['name' => 'Batu',                     'lat' => -7.8694,  'lng' => 112.5286],
            ['name' => 'Kediri',                   'lat' => -7.8161,  'lng' => 112.0111],
            ['name' => 'Blitar',                   'lat' => -8.0958,  'lng' => 112.1608],
            ['name' => 'Mojokerto',                'lat' => -7.4703,  'lng' => 112.4344],
            ['name' => 'Madiun',                   'lat' => -7.6297,  'lng' => 111.5239],
            ['name' => 'Pasuruan',                 'lat' => -7.6431,  'lng' => 112.9064],
            ['name' => 'Probolinggo',              'lat' => -7.7544,  'lng' => 113.2153],
            ['name' => 'Kab. Gresik',              'lat' => -7.1667,  'lng' => 112.5667],
            ['name' => 'Kab. Sidoarjo',            'lat' => -7.4500,  'lng' => 112.7167],
            ['name' => 'Kab. Mojokerto',           'lat' => -7.5333,  'lng' => 112.4167],
            ['name' => 'Kab. Jombang',             'lat' => -7.5500,  'lng' => 112.2333],
            ['name' => 'Kab. Nganjuk',             'lat' => -7.5833,  'lng' => 111.9167],
            ['name' => 'Kab. Kediri',              'lat' => -7.8167,  'lng' => 112.0167],
            ['name' => 'Kab. Tulungagung',         'lat' => -8.0667,  'lng' => 111.9000],
            ['name' => 'Kab. Blitar',              'lat' => -8.1000,  'lng' => 112.1667],
            ['name' => 'Kab. Malang',              'lat' => -8.1667,  'lng' => 112.6500],
            ['name' => 'Kab. Pasuruan',            'lat' => -7.7500,  'lng' => 112.9000],
            ['name' => 'Kab. Probolinggo',         'lat' => -7.8667,  'lng' => 113.2167],
            ['name' => 'Kab. Lumajang',            'lat' => -8.1333,  'lng' => 113.2167],
            ['name' => 'Kab. Jember',              'lat' => -8.1667,  'lng' => 113.7000],
            ['name' => 'Kab. Banyuwangi',          'lat' => -8.2167,  'lng' => 114.3667],
            ['name' => 'Kab. Situbondo',           'lat' => -7.7500,  'lng' => 113.9667],
            ['name' => 'Kab. Bondowoso',           'lat' => -7.9167,  'lng' => 113.8167],
            ['name' => 'Kab. Bangkalan',           'lat' => -7.0500,  'lng' => 112.7333],
            ['name' => 'Kab. Sampang',             'lat' => -7.2000,  'lng' => 113.2167],
            ['name' => 'Kab. Pamekasan',           'lat' => -7.1667,  'lng' => 113.4667],
            ['name' => 'Kab. Sumenep',             'lat' => -7.0000,  'lng' => 113.8500],
            ['name' => 'Kab. Lamongan',            'lat' => -7.1167,  'lng' => 112.4167],
            ['name' => 'Kab. Bojonegoro',          'lat' => -7.1500,  'lng' => 111.8833],
            ['name' => 'Kab. Tuban',               'lat' => -6.9000,  'lng' => 112.0500],
            ['name' => 'Kab. Madiun',              'lat' => -7.6500,  'lng' => 111.5333],
            ['name' => 'Kab. Magetan',             'lat' => -7.6500,  'lng' => 111.3500],
            ['name' => 'Kab. Ngawi',               'lat' => -7.4000,  'lng' => 111.4500],
            ['name' => 'Kab. Ponorogo',            'lat' => -7.8667,  'lng' => 111.4667],
            ['name' => 'Kab. Trenggalek',          'lat' => -8.0500,  'lng' => 111.7167],
            ['name' => 'Kab. Pacitan',             'lat' => -8.1833,  'lng' => 111.1167],

            // ── BALI ──────────────────────────────────────────────────────────
            ['name' => 'Denpasar',                 'lat' => -8.6500,  'lng' => 115.2167],
            ['name' => 'Kab. Badung',              'lat' => -8.6667,  'lng' => 115.1667],
            ['name' => 'Kab. Gianyar',             'lat' => -8.5333,  'lng' => 115.3333],
            ['name' => 'Kab. Tabanan',             'lat' => -8.5333,  'lng' => 115.1167],
            ['name' => 'Kab. Buleleng',            'lat' => -8.1167,  'lng' => 115.0833],
            ['name' => 'Kab. Jembrana',            'lat' => -8.3667,  'lng' => 114.6167],
            ['name' => 'Kab. Bangli',              'lat' => -8.4500,  'lng' => 115.3500],
            ['name' => 'Kab. Klungkung',           'lat' => -8.5333,  'lng' => 115.4000],
            ['name' => 'Kab. Karangasem',          'lat' => -8.4500,  'lng' => 115.6167],

            // ── NUSA TENGGARA BARAT ───────────────────────────────────────────
            ['name' => 'Mataram',                  'lat' => -8.5833,  'lng' => 116.1167],
            ['name' => 'Bima',                     'lat' => -8.4667,  'lng' => 118.7167],
            ['name' => 'Kab. Lombok Barat',        'lat' => -8.6167,  'lng' => 116.0667],
            ['name' => 'Kab. Lombok Tengah',       'lat' => -8.7333,  'lng' => 116.2500],
            ['name' => 'Kab. Lombok Timur',        'lat' => -8.5667,  'lng' => 116.5667],
            ['name' => 'Kab. Lombok Utara',        'lat' => -8.3833,  'lng' => 116.1333],
            ['name' => 'Kab. Sumbawa',             'lat' => -8.5000,  'lng' => 117.4167],
            ['name' => 'Kab. Sumbawa Barat',       'lat' => -8.7833,  'lng' => 116.8833],
            ['name' => 'Kab. Dompu',               'lat' => -8.5333,  'lng' => 118.4667],
            ['name' => 'Kab. Bima',                'lat' => -8.5833,  'lng' => 118.7000],

            // ── NUSA TENGGARA TIMUR ───────────────────────────────────────────
            ['name' => 'Kupang',                   'lat' => -10.1667, 'lng' => 123.5833],
            ['name' => 'Kab. Kupang',              'lat' => -10.0833, 'lng' => 123.6667],
            ['name' => 'Kab. Timor Tengah Selatan','lat' => -9.9000,  'lng' => 124.2167],
            ['name' => 'Kab. Timor Tengah Utara',  'lat' => -9.4667,  'lng' => 124.5000],
            ['name' => 'Kab. Belu',                'lat' => -9.5833,  'lng' => 125.1667],
            ['name' => 'Kab. Flores Timur',        'lat' => -8.3500,  'lng' => 122.9833],
            ['name' => 'Kab. Ende',                'lat' => -8.8500,  'lng' => 121.6667],
            ['name' => 'Kab. Ngada',               'lat' => -8.6667,  'lng' => 120.9000],
            ['name' => 'Kab. Manggarai',           'lat' => -8.6667,  'lng' => 120.4500],
            ['name' => 'Kab. Manggarai Barat',     'lat' => -8.5833,  'lng' => 119.8833],
            ['name' => 'Kab. Manggarai Timur',     'lat' => -8.7167,  'lng' => 120.7833],
            ['name' => 'Kab. Sumba Timur',         'lat' => -9.6667,  'lng' => 120.2667],
            ['name' => 'Kab. Sumba Barat',         'lat' => -9.5000,  'lng' => 119.4000],
            ['name' => 'Kab. Sikka',               'lat' => -8.6500,  'lng' => 122.2000],
            ['name' => 'Kab. Lembata',             'lat' => -8.4167,  'lng' => 123.4833],
            ['name' => 'Kab. Alor',                'lat' => -8.2167,  'lng' => 124.5167],
            ['name' => 'Kab. Rote Ndao',           'lat' => -10.7333, 'lng' => 123.0833],
            ['name' => 'Kab. Nagekeo',             'lat' => -8.9000,  'lng' => 121.3333],
            ['name' => 'Kab. Sumba Tengah',        'lat' => -9.6833,  'lng' => 119.6167],
            ['name' => 'Kab. Sumba Barat Daya',    'lat' => -9.7667,  'lng' => 119.2833],
            ['name' => 'Kab. Sabu Raijua',         'lat' => -10.4667, 'lng' => 121.8333],
            ['name' => 'Kab. Malaka',              'lat' => -9.5167,  'lng' => 125.0333],

            // ── KALIMANTAN BARAT ──────────────────────────────────────────────
            ['name' => 'Pontianak',                'lat' => -0.0333,  'lng' => 109.3333],
            ['name' => 'Singkawang',               'lat' =>  0.9000,  'lng' => 108.9833],
            ['name' => 'Kab. Kubu Raya',           'lat' => -0.2833,  'lng' => 109.3667],
            ['name' => 'Kab. Mempawah',            'lat' =>  0.3667,  'lng' => 109.0667],
            ['name' => 'Kab. Landak',              'lat' =>  0.3500,  'lng' => 109.8500],
            ['name' => 'Kab. Sanggau',             'lat' =>  0.1333,  'lng' => 110.6000],
            ['name' => 'Kab. Sekadau',             'lat' =>  0.0167,  'lng' => 110.9500],
            ['name' => 'Kab. Melawi',              'lat' => -0.8667,  'lng' => 111.4500],
            ['name' => 'Kab. Sintang',             'lat' =>  0.0667,  'lng' => 111.4833],
            ['name' => 'Kab. Kapuas Hulu',         'lat' =>  0.8833,  'lng' => 112.9667],
            ['name' => 'Kab. Ketapang',            'lat' => -1.8500,  'lng' => 110.0000],
            ['name' => 'Kab. Kayong Utara',        'lat' => -1.3167,  'lng' => 110.0000],
            ['name' => 'Kab. Sambas',              'lat' =>  1.3333,  'lng' => 109.3667],
            ['name' => 'Kab. Bengkayang',          'lat' =>  0.8667,  'lng' => 109.5833],

            // ── KALIMANTAN TENGAH ─────────────────────────────────────────────
            ['name' => 'Palangkaraya',             'lat' => -2.2100,  'lng' => 113.9137],
            ['name' => 'Kab. Kotawaringin Barat',  'lat' => -2.5333,  'lng' => 111.5667],
            ['name' => 'Kab. Kotawaringin Timur',  'lat' => -2.0833,  'lng' => 112.4833],
            ['name' => 'Kab. Kapuas',              'lat' => -2.4667,  'lng' => 114.3833],
            ['name' => 'Kab. Barito Utara',        'lat' => -1.0333,  'lng' => 114.8667],
            ['name' => 'Kab. Barito Selatan',      'lat' => -1.7833,  'lng' => 114.7833],
            ['name' => 'Kab. Barito Timur',        'lat' => -1.6667,  'lng' => 115.3833],
            ['name' => 'Kab. Pulang Pisau',        'lat' => -2.7167,  'lng' => 114.0833],
            ['name' => 'Kab. Gunung Mas',          'lat' => -1.3500,  'lng' => 113.8833],
            ['name' => 'Kab. Katingan',            'lat' => -1.6167,  'lng' => 113.1333],
            ['name' => 'Kab. Seruyan',             'lat' => -2.1500,  'lng' => 112.1500],
            ['name' => 'Kab. Sukamara',            'lat' => -2.5167,  'lng' => 111.2000],
            ['name' => 'Kab. Lamandau',            'lat' => -2.0833,  'lng' => 111.4667],
            ['name' => 'Kab. Murung Raya',         'lat' =>  0.1167,  'lng' => 114.8000],

            // ── KALIMANTAN SELATAN ────────────────────────────────────────────
            ['name' => 'Banjarmasin',              'lat' => -3.3194,  'lng' => 114.5908],
            ['name' => 'Banjarbaru',               'lat' => -3.4333,  'lng' => 114.8333],
            ['name' => 'Kab. Banjar',              'lat' => -3.5333,  'lng' => 115.0167],
            ['name' => 'Kab. Barito Kuala',        'lat' => -3.0833,  'lng' => 114.5833],
            ['name' => 'Kab. Tapin',               'lat' => -3.2667,  'lng' => 115.2000],
            ['name' => 'Kab. Hulu Sungai Selatan', 'lat' => -2.9167,  'lng' => 115.3833],
            ['name' => 'Kab. Hulu Sungai Tengah',  'lat' => -2.5833,  'lng' => 115.5333],
            ['name' => 'Kab. Hulu Sungai Utara',   'lat' => -2.0667,  'lng' => 115.2833],
            ['name' => 'Kab. Balangan',            'lat' => -2.2833,  'lng' => 115.6500],
            ['name' => 'Kab. Tabalong',            'lat' => -2.0333,  'lng' => 115.5000],
            ['name' => 'Kab. Tanah Bumbu',         'lat' => -3.5667,  'lng' => 116.0333],
            ['name' => 'Kab. Kotabaru',            'lat' => -3.2833,  'lng' => 116.2000],
            ['name' => 'Kab. Tanah Laut',          'lat' => -3.8500,  'lng' => 115.0833],

            // ── KALIMANTAN TIMUR ──────────────────────────────────────────────
            ['name' => 'Samarinda',                'lat' => -0.5000,  'lng' => 117.1500],
            ['name' => 'Balikpapan',               'lat' => -1.2675,  'lng' => 116.8289],
            ['name' => 'Bontang',                  'lat' =>  0.1333,  'lng' => 117.5000],
            ['name' => 'Kab. Kutai Kartanegara',   'lat' => -0.4167,  'lng' => 117.0000],
            ['name' => 'Kab. Kutai Barat',         'lat' =>  0.1167,  'lng' => 115.8667],
            ['name' => 'Kab. Kutai Timur',         'lat' =>  1.3500,  'lng' => 117.4667],
            ['name' => 'Kab. Berau',               'lat' =>  2.1500,  'lng' => 117.5000],
            ['name' => 'Kab. Paser',               'lat' => -1.6667,  'lng' => 116.0000],
            ['name' => 'Kab. Penajam Paser Utara', 'lat' => -1.2667,  'lng' => 116.4333],
            ['name' => 'Kab. Mahakam Ulu',         'lat' =>  0.5000,  'lng' => 115.5000],

            // ── KALIMANTAN UTARA ──────────────────────────────────────────────
            ['name' => 'Tarakan',                  'lat' =>  3.3000,  'lng' => 117.6333],
            ['name' => 'Kab. Bulungan',            'lat' =>  2.8500,  'lng' => 117.3167],
            ['name' => 'Kab. Malinau',             'lat' =>  3.5833,  'lng' => 116.6333],
            ['name' => 'Kab. Nunukan',             'lat' =>  3.8833,  'lng' => 117.0667],
            ['name' => 'Kab. Tana Tidung',         'lat' =>  3.5000,  'lng' => 117.1667],

            // ── SULAWESI UTARA ────────────────────────────────────────────────
            ['name' => 'Manado',                   'lat' =>  1.4748,  'lng' => 124.8421],
            ['name' => 'Tomohon',                  'lat' =>  1.3333,  'lng' => 124.8333],
            ['name' => 'Bitung',                   'lat' =>  1.4500,  'lng' => 125.1833],
            ['name' => 'Kotamobagu',               'lat' =>  0.7333,  'lng' => 124.3167],
            ['name' => 'Kab. Minahasa',            'lat' =>  1.2667,  'lng' => 124.8500],
            ['name' => 'Kab. Minahasa Utara',      'lat' =>  1.5667,  'lng' => 124.9667],
            ['name' => 'Kab. Minahasa Selatan',    'lat' =>  0.9000,  'lng' => 124.5500],
            ['name' => 'Kab. Minahasa Tenggara',   'lat' =>  0.9000,  'lng' => 124.7833],
            ['name' => 'Kab. Bolaang Mongondow',   'lat' =>  0.5667,  'lng' => 124.0167],
            ['name' => 'Kab. Bolaang Mongondow Utara','lat' => 1.0667,'lng' => 124.4167],
            ['name' => 'Kab. Bolaang Mongondow Timur','lat' => 0.5667,'lng' => 124.4500],
            ['name' => 'Kab. Bolaang Mongondow Selatan','lat' => 0.3333,'lng' => 123.9500],
            ['name' => 'Kab. Kepulauan Sangihe',   'lat' =>  3.5667,  'lng' => 125.5167],
            ['name' => 'Kab. Kepulauan Talaud',    'lat' =>  4.3333,  'lng' => 126.8167],
            ['name' => 'Kab. Kepulauan Sitaro',    'lat' =>  2.7167,  'lng' => 125.4667],

            // ── SULAWESI TENGAH ───────────────────────────────────────────────
            ['name' => 'Palu',                     'lat' => -0.9000,  'lng' => 119.8667],
            ['name' => 'Kab. Donggala',            'lat' => -0.6667,  'lng' => 119.8333],
            ['name' => 'Kab. Sigi',                'lat' => -1.2500,  'lng' => 119.9333],
            ['name' => 'Kab. Parigi Moutong',      'lat' => -0.6500,  'lng' => 120.3333],
            ['name' => 'Kab. Poso',                'lat' => -1.4000,  'lng' => 120.7500],
            ['name' => 'Kab. Morowali',            'lat' => -2.5000,  'lng' => 121.6333],
            ['name' => 'Kab. Morowali Utara',      'lat' => -1.6500,  'lng' => 121.4167],
            ['name' => 'Kab. Tojo Una-Una',        'lat' => -1.2000,  'lng' => 121.6500],
            ['name' => 'Kab. Banggai',             'lat' => -1.5333,  'lng' => 122.8333],
            ['name' => 'Kab. Banggai Laut',        'lat' => -1.7333,  'lng' => 123.5167],
            ['name' => 'Kab. Banggai Kepulauan',   'lat' => -1.6000,  'lng' => 123.4000],
            ['name' => 'Kab. Tolitoli',            'lat' =>  1.0667,  'lng' => 120.8167],
            ['name' => 'Kab. Buol',                'lat' =>  1.2000,  'lng' => 121.4500],

            // ── SULAWESI SELATAN ──────────────────────────────────────────────
            ['name' => 'Makassar',                 'lat' => -5.1477,  'lng' => 119.4327],
            ['name' => 'Parepare',                 'lat' => -4.0167,  'lng' => 119.6333],
            ['name' => 'Palopo',                   'lat' => -3.0000,  'lng' => 120.2000],
            ['name' => 'Kab. Gowa',                'lat' => -5.3167,  'lng' => 119.7167],
            ['name' => 'Kab. Maros',               'lat' => -5.0000,  'lng' => 119.5667],
            ['name' => 'Kab. Takalar',             'lat' => -5.4333,  'lng' => 119.4500],
            ['name' => 'Kab. Jeneponto',           'lat' => -5.6833,  'lng' => 119.7000],
            ['name' => 'Kab. Bulukumba',           'lat' => -5.5500,  'lng' => 120.2000],
            ['name' => 'Kab. Bantaeng',            'lat' => -5.5500,  'lng' => 119.9333],
            ['name' => 'Kab. Selayar',             'lat' => -6.1167,  'lng' => 120.4167],
            ['name' => 'Kab. Sinjai',              'lat' => -5.1167,  'lng' => 120.2500],
            ['name' => 'Kab. Bone',                'lat' => -4.5333,  'lng' => 120.3333],
            ['name' => 'Kab. Wajo',                'lat' => -3.9833,  'lng' => 120.1833],
            ['name' => 'Kab. Soppeng',             'lat' => -4.3500,  'lng' => 119.8833],
            ['name' => 'Kab. Barru',               'lat' => -4.4000,  'lng' => 119.6167],
            ['name' => 'Kab. Pangkajene',          'lat' => -4.8333,  'lng' => 119.5500],
            ['name' => 'Kab. Pinrang',             'lat' => -3.7833,  'lng' => 119.6333],
            ['name' => 'Kab. Enrekang',            'lat' => -3.5667,  'lng' => 119.7833],
            ['name' => 'Kab. Sidrap',              'lat' => -3.9167,  'lng' => 119.8500],
            ['name' => 'Kab. Luwu',                'lat' => -2.9500,  'lng' => 120.5167],
            ['name' => 'Kab. Luwu Utara',          'lat' => -2.2167,  'lng' => 120.5667],
            ['name' => 'Kab. Luwu Timur',          'lat' => -2.5500,  'lng' => 121.3167],
            ['name' => 'Kab. Tana Toraja',         'lat' => -3.0333,  'lng' => 119.8167],
            ['name' => 'Kab. Toraja Utara',        'lat' => -2.8667,  'lng' => 119.9000],

            // ── SULAWESI TENGGARA ─────────────────────────────────────────────
            ['name' => 'Kendari',                  'lat' => -3.9500,  'lng' => 122.5167],
            ['name' => 'Baubau',                   'lat' => -5.4667,  'lng' => 122.6167],
            ['name' => 'Kab. Konawe',              'lat' => -3.8667,  'lng' => 122.5000],
            ['name' => 'Kab. Konawe Selatan',      'lat' => -4.2833,  'lng' => 122.4333],
            ['name' => 'Kab. Konawe Utara',        'lat' => -3.1833,  'lng' => 122.3833],
            ['name' => 'Kab. Konawe Kepulauan',    'lat' => -3.7833,  'lng' => 123.0500],
            ['name' => 'Kab. Kolaka',              'lat' => -4.0500,  'lng' => 121.5833],
            ['name' => 'Kab. Kolaka Utara',        'lat' => -3.1833,  'lng' => 121.4167],
            ['name' => 'Kab. Kolaka Timur',        'lat' => -4.2833,  'lng' => 122.0333],
            ['name' => 'Kab. Muna',                'lat' => -4.8833,  'lng' => 122.5667],
            ['name' => 'Kab. Muna Barat',          'lat' => -4.8833,  'lng' => 122.3500],
            ['name' => 'Kab. Buton',               'lat' => -5.1667,  'lng' => 122.8833],
            ['name' => 'Kab. Buton Tengah',        'lat' => -5.0000,  'lng' => 122.7667],
            ['name' => 'Kab. Buton Selatan',       'lat' => -5.5000,  'lng' => 122.8000],
            ['name' => 'Kab. Buton Utara',         'lat' => -4.7500,  'lng' => 122.9167],
            ['name' => 'Kab. Bombana',             'lat' => -4.9667,  'lng' => 121.9167],
            ['name' => 'Kab. Wakatobi',            'lat' => -5.4000,  'lng' => 123.6333],

            // ── SULAWESI BARAT ────────────────────────────────────────────────
            ['name' => 'Mamuju',                   'lat' => -2.6833,  'lng' => 118.8833],
            ['name' => 'Kab. Polewali Mandar',     'lat' => -3.4167,  'lng' => 119.3500],
            ['name' => 'Kab. Mamasa',              'lat' => -2.9500,  'lng' => 119.3667],
            ['name' => 'Kab. Majene',              'lat' => -3.5333,  'lng' => 118.9667],
            ['name' => 'Kab. Mamuju Tengah',       'lat' => -2.1500,  'lng' => 119.2500],
            ['name' => 'Kab. Pasangkayu',          'lat' => -1.3500,  'lng' => 119.8500],

            // ── GORONTALO ─────────────────────────────────────────────────────
            ['name' => 'Gorontalo',                'lat' =>  0.5333,  'lng' => 123.0667],
            ['name' => 'Kab. Gorontalo',           'lat' =>  0.5667,  'lng' => 122.8833],
            ['name' => 'Kab. Gorontalo Utara',     'lat' =>  0.8667,  'lng' => 122.8667],
            ['name' => 'Kab. Bone Bolango',        'lat' =>  0.5667,  'lng' => 123.2833],
            ['name' => 'Kab. Boalemo',             'lat' =>  0.4500,  'lng' => 122.4167],
            ['name' => 'Kab. Pohuwato',            'lat' =>  0.3667,  'lng' => 122.1333],

            // ── MALUKU ────────────────────────────────────────────────────────
            ['name' => 'Ambon',                    'lat' => -3.6956,  'lng' => 128.1814],
            ['name' => 'Tual',                     'lat' => -5.6667,  'lng' => 132.7500],
            ['name' => 'Kab. Maluku Tengah',       'lat' => -3.3167,  'lng' => 129.3167],
            ['name' => 'Kab. Maluku Tenggara',     'lat' => -5.6167,  'lng' => 132.7167],
            ['name' => 'Kab. Maluku Tenggara Barat','lat' => -7.6500, 'lng' => 131.3500],
            ['name' => 'Kab. Buru',                'lat' => -3.3833,  'lng' => 126.7000],
            ['name' => 'Kab. Buru Selatan',        'lat' => -3.8667,  'lng' => 126.5000],
            ['name' => 'Kab. Seram Bagian Barat',  'lat' => -3.0833,  'lng' => 128.1500],
            ['name' => 'Kab. Seram Bagian Timur',  'lat' => -3.0833,  'lng' => 130.5667],
            ['name' => 'Kab. Kepulauan Aru',       'lat' => -6.2167,  'lng' => 134.5167],
            ['name' => 'Kab. Maluku Barat Daya',   'lat' => -7.8500,  'lng' => 127.1500],

            // ── MALUKU UTARA ──────────────────────────────────────────────────
            ['name' => 'Ternate',                  'lat' =>  0.7833,  'lng' => 127.3667],
            ['name' => 'Tidore Kepulauan',         'lat' =>  0.6833,  'lng' => 127.4333],
            ['name' => 'Kab. Halmahera Barat',     'lat' =>  1.3833,  'lng' => 127.5667],
            ['name' => 'Kab. Halmahera Utara',     'lat' =>  1.8833,  'lng' => 128.0833],
            ['name' => 'Kab. Halmahera Timur',     'lat' =>  1.1667,  'lng' => 128.3500],
            ['name' => 'Kab. Halmahera Selatan',   'lat' => -0.5833,  'lng' => 127.7500],
            ['name' => 'Kab. Halmahera Tengah',    'lat' =>  0.5167,  'lng' => 128.1333],
            ['name' => 'Kab. Kepulauan Sula',      'lat' => -1.9167,  'lng' => 125.4167],
            ['name' => 'Kab. Pulau Taliabu',       'lat' => -1.8333,  'lng' => 124.7500],
            ['name' => 'Kab. Pulau Morotai',       'lat' =>  2.3333,  'lng' => 128.4167],

            // ── PAPUA BARAT ───────────────────────────────────────────────────
            ['name' => 'Manokwari',                'lat' => -0.8667,  'lng' => 134.0833],
            ['name' => 'Sorong',                   'lat' => -0.8833,  'lng' => 131.2500],
            ['name' => 'Kab. Sorong',              'lat' => -0.9500,  'lng' => 131.5000],
            ['name' => 'Kab. Raja Ampat',          'lat' => -0.5833,  'lng' => 130.2167],
            ['name' => 'Kab. Fakfak',              'lat' => -2.9167,  'lng' => 132.3000],
            ['name' => 'Kab. Kaimana',             'lat' => -3.6500,  'lng' => 133.7500],
            ['name' => 'Kab. Manokwari',           'lat' => -0.8833,  'lng' => 134.0500],
            ['name' => 'Kab. Manokwari Selatan',   'lat' => -1.5000,  'lng' => 134.0833],
            ['name' => 'Kab. Pegunungan Arfak',    'lat' => -1.5000,  'lng' => 133.5000],
            ['name' => 'Kab. Teluk Bintuni',       'lat' => -2.1167,  'lng' => 133.5333],
            ['name' => 'Kab. Teluk Wondama',       'lat' => -2.3833,  'lng' => 134.4667],
            ['name' => 'Kab. Tambrauw',            'lat' => -0.6667,  'lng' => 132.5833],
            ['name' => 'Kab. Maybrat',             'lat' => -1.3833,  'lng' => 132.3167],
            ['name' => 'Kab. Sorong Selatan',      'lat' => -1.7167,  'lng' => 132.1833],

            // ── PAPUA ─────────────────────────────────────────────────────────
            ['name' => 'Jayapura',                 'lat' => -2.5333,  'lng' => 140.7000],
            ['name' => 'Kab. Jayapura',            'lat' => -2.3667,  'lng' => 140.4333],
            ['name' => 'Kab. Keerom',              'lat' => -3.3167,  'lng' => 140.6167],
            ['name' => 'Kab. Sarmi',               'lat' => -1.8667,  'lng' => 138.7333],
            ['name' => 'Kab. Biak Numfor',         'lat' => -1.1667,  'lng' => 136.1167],
            ['name' => 'Kab. Supiori',             'lat' => -0.7667,  'lng' => 135.6333],
            ['name' => 'Kab. Mamberamo Raya',      'lat' => -2.0000,  'lng' => 137.8333],
            ['name' => 'Kab. Waropen',             'lat' => -2.7500,  'lng' => 136.2167],
            ['name' => 'Kab. Nabire',              'lat' => -3.3667,  'lng' => 135.5000],
            ['name' => 'Kab. Puncak Jaya',         'lat' => -3.7833,  'lng' => 137.1000],
            ['name' => 'Kab. Puncak',              'lat' => -3.8833,  'lng' => 137.6500],
            ['name' => 'Kab. Mimika',              'lat' => -4.5500,  'lng' => 136.4000],
            ['name' => 'Kab. Pegunungan Bintang',  'lat' => -4.8833,  'lng' => 140.3333],
            ['name' => 'Kab. Yahukimo',            'lat' => -4.5000,  'lng' => 139.5833],
            ['name' => 'Kab. Tolikara',            'lat' => -3.7667,  'lng' => 138.6833],
            ['name' => 'Kab. Lanny Jaya',          'lat' => -3.9333,  'lng' => 138.1667],
            ['name' => 'Kab. Yalimo',              'lat' => -3.8333,  'lng' => 139.2000],
            ['name' => 'Kab. Jayawijaya',          'lat' => -4.0833,  'lng' => 138.9500],
            ['name' => 'Kab. Nduga',               'lat' => -4.5667,  'lng' => 138.2333],
            ['name' => 'Kab. Dogiyai',             'lat' => -4.0000,  'lng' => 136.1667],
            ['name' => 'Kab. Intan Jaya',          'lat' => -3.7500,  'lng' => 136.1667],
            ['name' => 'Kab. Deiyai',              'lat' => -3.9667,  'lng' => 136.3167],
            ['name' => 'Kab. Merauke',             'lat' => -8.4833,  'lng' => 140.4000],
            ['name' => 'Kab. Boven Digoel',        'lat' => -5.8000,  'lng' => 140.1167],
            ['name' => 'Kab. Asmat',               'lat' => -5.7167,  'lng' => 138.5167],
            ['name' => 'Kab. Mappi',               'lat' => -6.1667,  'lng' => 139.7000],
            ['name' => 'Kab. Paniai',              'lat' => -3.8500,  'lng' => 136.4667],
            ['name' => 'Kab. Kepulauan Yapen',     'lat' => -1.8167,  'lng' => 136.2167],
            ['name' => 'Kab. Mamberamo Tengah',    'lat' => -3.6167,  'lng' => 138.3333],
        ];
    }

    /**
     * Default prayer times (fallback)
     *
     * @return array
     */
    private static function getDefaultTimes()
    {
        return [
            'timings' => [
                'fajr'    => '04:30',
                'dhuhr'   => '12:00',
                'asr'     => '15:15',
                'maghrib' => '18:00',
                'isha'    => '19:15',
            ],
            'timezone' => 'Asia/Jakarta',
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

        return null;
    }

    /**
     * Get next prayer name and time
     *
     * @param array $prayerTimes
     * @param string $currentTime
     * @return array
     */
    public static function getNextPrayer($prayerTimes, $currentTime)
    {
        $current = Carbon::createFromFormat('H:i', $currentTime);

        foreach (['fajr', 'dhuhr', 'asr', 'maghrib', 'isha'] as $prayer) {
            $prayerTime = Carbon::createFromFormat('H:i', $prayerTimes[$prayer]);

            if ($current->lt($prayerTime)) {
                return [
                    'name'              => $prayer,
                    'time'              => $prayerTimes[$prayer],
                    'remaining_minutes' => $current->diffInMinutes($prayerTime, false),
                ];
            }
        }

        $fajrTomorrow = Carbon::createFromFormat('H:i', $prayerTimes['fajr'])->addDay();

        return [
            'name'              => 'fajr',
            'time'              => $prayerTimes['fajr'],
            'remaining_minutes' => $current->diffInMinutes($fajrTomorrow, false),
        ];
    }
}