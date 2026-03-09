<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title',
        'image',
        'url',
        'position',
        'pages',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'pages'     => 'array',
            'is_active' => 'boolean',
        ];
    }

    // Scope: iklan aktif saja
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: filter per halaman
    public function scopeForPage($query, string $page)
    {
        return $query->where(function ($q) use ($page) {
            $q->whereJsonContains('pages', 'all')
              ->orWhereJsonContains('pages', $page);
        });
    }

    // Helper: url gambar
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }
}