<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Surah extends Model
{
    protected $primaryKey = 'number';
    public $incrementing = false;
    protected $fillable = [
        'number',
        'name',
        'arabic_name',
        'translation',
        'total_verses',
        'audio_url',
    ];

    /**
     * Get the verses for the surah.
     */
    public function verses(): HasMany
    {
        return $this->hasMany(Verse::class, 'surah_number', 'number');
    }
}
