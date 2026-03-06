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
            'makkah'  => ['label' => 'Makkah',  'emoji' => '🕋'],
            'madinah' => ['label' => 'Madinah', 'emoji' => '🕌'],
            'mesir'   => ['label' => 'Mesir',   'emoji' => '🇪🇬'],
        ];
    }

    public static function audioUrls(): array
    {
        return [
            'makkah'  => 'https://www.islamcan.com/audio/adhan/azan1.mp3',
            'madinah' => 'https://www.islamcan.com/audio/adhan/azan2.mp3',
            'mesir'   => 'https://www.islamcan.com/audio/adhan/azan3.mp3',
        ];
    }
}