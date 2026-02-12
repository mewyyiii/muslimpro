<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuranTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'surah_number',
        'last_verse',
        'is_completed',
        'duration_seconds',
        'last_read_date',
    ];

    protected $casts = [
        'is_completed'   => 'boolean',
        'last_read_date' => 'date',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke surah
    public function surah()
    {
        return $this->belongsTo(Surah::class, 'surah_number', 'number');
    }

    // Helper: progress dalam persen
    public function getProgressPercentAttribute(): int
    {
        if (!$this->surah || !$this->last_verse) return 0;
        return round(($this->last_verse / $this->surah->total_verses) * 100);
    }

    // Helper: format durasi
    public function getFormattedDurationAttribute(): string
    {
        $seconds = $this->duration_seconds;
        $hours   = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        
        if ($hours > 0) {
            return "{$hours}j {$minutes}m";
        }
        return "{$minutes} menit";
    }
}