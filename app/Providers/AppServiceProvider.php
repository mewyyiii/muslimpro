<?php

namespace App\Providers;

use App\Services\MidtransService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;  // ← tambah ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MidtransService::class, function () {
            return new MidtransService();
        });
    }

    public function boot(): void
    {
        if (request()->header('x-forwarded-proto') === 'https') {
            URL::forceScheme('https');
        }

        // ← tambah ini: selalu ambil data user fresh dari DB tiap request
        if (!app()->runningInConsole() && Auth::check()) {
            $freshUser = Auth::user()->fresh();
            if ($freshUser) {
                Auth::setUser($freshUser);
            }
        }
    }
}