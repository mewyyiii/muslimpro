<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verse extends Model
{
    protected $fillable = [
        'surah_number',
        'number',
        'arabic',
        'translation',
        'transliteration',
    ];

    /**
     * Get the surah that owns the verse.
     */
    public function surah(): BelongsTo
    {
        return $this->belongsTo(Surah::class, 'surah_number', 'number');
    }
}
