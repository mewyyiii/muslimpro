<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AzanSetting extends Model
{
    protected $fillable = [
        'user_id',
        'azan_enabled',
        'muadzin',
        'fajr_enabled',
        'dhuhr_enabled',
        'asr_enabled',
        'maghrib_enabled',
        'isha_enabled',
    ];

    protected $casts = [
        'azan_enabled'    => 'boolean',
        'fajr_enabled'    => 'boolean',
        'dhuhr_enabled'   => 'boolean',
        'asr_enabled'     => 'boolean',
        'maghrib_enabled' => 'boolean',
        'isha_enabled'    => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getForUser(int $userId): self
    {
        return self::firstOrCreate(
            ['user_id' => $userId],
            [
                'azan_enabled'    => true,
                'muadzin'         => 'makkah',
                'fajr_enabled'    => true,
                'dhuhr_enabled'   => true,
                'asr_enabled'     => true,
                'maghrib_enabled' => true,
                'isha_enabled'    => true,
            ]
        );
    }

    public static function muadzinList(): array
    {
        return [
            'makkah'  => ['label' => 'Makkah',    'emoji' => '🕋', 'muadzin' => 'Sheikh Ali Ahmed Mullah',       'desc' => 'Muadzin resmi Masjidil Haram sejak 1975'],
            'madinah' => ['label' => 'Madinah',   'emoji' => '🕌', 'muadzin' => 'Sheikh Essam Ali Khan',         'desc' => 'Muadzin resmi Masjid Nabawi sejak 2009'],
            'afasy'   => ['label' => 'Al-Afasy',  'emoji' => '🌍', 'muadzin' => 'Sheikh Mishary Rashid Al-Afasy','desc' => 'Muadzin Kuwait, paling populer di dunia'],
        ];
    }

    public static function audioUrls(): array
    {
        return [
            'makkah'  => 'https://www.islamcan.com/audio/adhan/azan1.mp3',
            'madinah' => 'https://www.islamcan.com/audio/adhan/azan2.mp3',
            'afasy'   => 'https://www.islamcan.com/audio/adhan/azan3.mp3',
        ];
    }
}