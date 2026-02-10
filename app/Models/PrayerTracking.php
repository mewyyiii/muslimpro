<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prayer_name',
        'prayer_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'prayer_date' => 'date',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope: filter by status
    public function scopePerformed($query)
    {
        return $query->where('status', 'performed');
    }

    public function scopeForDate($query, string $date)
    {
        return $query->where('prayer_date', $date);
    }
}