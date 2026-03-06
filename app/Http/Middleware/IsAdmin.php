<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless($request->user()?->is_admin, 403, 'Akses ditolak.');
        return $next($request);
    }
}