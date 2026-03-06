<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePro
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isProActive()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error'   => 'Pro feature',
                    'message' => 'Fitur ini hanya tersedia untuk pengguna NurSteps Pro.',
                    'upgrade' => route('pro.upgrade'),
                ], 403);
            }

            return redirect()->route('pro.upgrade')
                ->with('pro_required', true);
        }

        return $next($request);
    }
}