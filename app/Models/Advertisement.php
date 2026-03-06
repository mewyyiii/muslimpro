<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Advertisement extends Model
{
    protected $fillable = [
        'title', 'image_path', 'url', 'position',
        'pages', 'is_active', 'starts_at', 'ends_at',
        'click_count', 'impression_count',
    ];

    protected $casts = [
        'pages'      => 'array',
        'is_active'  => 'boolean',
        'starts_at'  => 'datetime',
        'ends_at'    => 'datetime',
    ];

    // ── Scopes ───────────────────────────────────────────────────────────

    /**
     * Iklan yang sedang aktif saat ini.
     */
    public function scopeActive(Builder $query): Builder
    {
        $now = Carbon::now();

        return $query->where('is_active', true)
            ->where(fn($q) => $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now))
            ->where(fn($q) => $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now));
    }

    /**
     * Filter berdasarkan posisi.
     */
    public function scopeForPosition(Builder $query, string $position): Builder
    {
        return $query->where('position', $position);
    }

    /**
     * Filter berdasarkan halaman (pages null = tampil di semua halaman).
     */
    public function scopeForPage(Builder $query, string $page): Builder
    {
        return $query->where(function ($q) use ($page) {
            $q->whereNull('pages')
              ->orWhereJsonContains('pages', $page);
        });
    }

    // ── Helpers ──────────────────────────────────────────────────────────

    /**
     * Ambil 1 iklan aktif untuk posisi & halaman tertentu (random jika ada banyak).
     */
    public static function getForDisplay(string $position, string $page = 'all'): ?self
    {
        return static::active()
            ->forPosition($position)
            ->forPage($page)
            ->inRandomOrder()
            ->first();
    }

    /**
     * Tambah impression count.
     */
    public function recordImpression(): void
    {
        $this->increment('impression_count');
    }

    /**
     * Tambah click count.
     */
    public function recordClick(): void
    {
        $this->increment('click_count');
    }

    /**
     * URL gambar lengkap.
     */
    public function getImageUrlAttribute(): string
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : asset('images/ad-placeholder.png');
    }

    /**
     * Status label untuk admin.
     */
    public function getStatusLabelAttribute(): string
    {
        if (!$this->is_active) return 'Nonaktif';
        if ($this->ends_at && $this->ends_at->isPast()) return 'Expired';
        if ($this->starts_at && $this->starts_at->isFuture()) return 'Terjadwal';
        return 'Aktif';
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status_label) {
            'Aktif'     => 'green',
            'Terjadwal' => 'blue',
            'Expired'   => 'red',
            default     => 'gray',
        };
    }
}