<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoaPendek extends Model
{
    protected $table = 'doa_pendek';
    protected $primaryKey = 'id';
    public $incrementing = false; // Assuming 'id' comes from JSON and is not auto-incremented by DB
    protected $fillable = [
        'id',
        'title',
        'arabic',
        'transliteration',
        'translation',
    ];
}
