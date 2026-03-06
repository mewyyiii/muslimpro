<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProController extends Controller
{
    /**
     * Halaman upgrade ke Pro.
     */
    public function upgrade()
    {
        $user = auth()->user();

        return view('pro.upgrade', [
            'isPro'         => $user->isProActive(),
            'remainingDays' => $user->proRemainingDays(),
            'expiresAt'     => $user->pro_expires_at,
        ]);
    }

    /**
     * Aktifkan Pro secara manual (untuk dev/testing).
     * Hapus atau lindungi route ini di production!
     */
    public function activate(Request $request)
    {
        $days = $request->get('days', 30);
        auth()->user()->activatePro((int) $days, 'manual');

        return redirect()->back()->with('success', "Pro aktif selama {$days} hari!");
    }
}