<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasProAccess
{
    /**
     * Cek apakah user aktif Pro (mempertimbangkan expiry).
     */
    public function isProActive(): bool
    {
        if (!$this->is_pro) {
            return false;
        }

        // Kalau pro_expires_at null = lifetime
        if (is_null($this->pro_expires_at)) {
            return true;
        }

        return Carbon::now()->lessThan($this->pro_expires_at);
    }

    /**
     * Aktifkan Pro untuk user.
     * $days = null berarti lifetime.
     */
    public function activatePro(?int $days = 30, string $activatedBy = 'manual'): void
    {
        $this->update([
            'is_pro'           => true,
            'pro_expires_at'   => $days ? Carbon::now()->addDays($days) : null,
            'pro_activated_by' => $activatedBy,
        ]);
    }

    /**
     * Nonaktifkan Pro.
     */
    public function deactivatePro(): void
    {
        $this->update([
            'is_pro'           => false,
            'pro_expires_at'   => null,
            'pro_activated_by' => null,
        ]);
    }

    /**
     * Berapa hari tersisa Pro.
     * Return null jika lifetime atau tidak Pro.
     */
    public function proRemainingDays(): ?int
    {
        if (!$this->isProActive() || is_null($this->pro_expires_at)) {
            return null;
        }

        return (int) Carbon::now()->diffInDays($this->pro_expires_at, false);
    }
}