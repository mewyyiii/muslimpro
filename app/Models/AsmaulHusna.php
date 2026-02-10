<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsmaulHusna extends Model
{
    protected $table = 'asmaul_husna';
    protected $primaryKey = 'id';
    public $incrementing = false; // Assuming 'id' comes from JSON and is not auto-incremented by DB
    protected $fillable = [
        'id',
        'arabic',
        'transliteration',
        'meaning_id',
        'meaning_en',
    ];
}
