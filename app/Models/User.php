<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasProAccess; // ← tambah ini

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasProAccess; // ← tambah HasProAccess

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'is_pro',           // ← tambah
        'is_admin',         // ← tambah
        'pro_expires_at',   // ← tambah
        'pro_activated_by', // ← tambah
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_pro'            => 'boolean',  // ← tambah
            'is_admin'          => 'boolean',  // ← tambah
            'pro_expires_at'    => 'datetime', // ← tambah
        ];
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=14b8a6&color=fff&size=200&bold=true";
    }
}