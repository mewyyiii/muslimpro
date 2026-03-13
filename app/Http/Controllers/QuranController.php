<?php

namespace App\Http\Controllers;

use App\Models\QuranTracking;
use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuranController extends Controller
{
    public function index()
    {
        $surahs = Surah::all();

        // Ambil semua tracking user saat ini, di-map per surah_number
        $trackingMap = [];
        if (Auth::check()) {
            $trackings = QuranTracking::where('user_id', Auth::id())->get();
            foreach ($trackings as $t) {
                $trackingMap[$t->surah_number] = $t;
            }
        }

        return view('index', compact('surahs', 'trackingMap'));
    }

    public function show($id)
    {
        $surah = Surah::with('verses')->where('number', $id)->first();

        if (!$surah) {
            abort(404);
        }

        $prevSurah = Surah::where('number', $id - 1)->first();
        $nextSurah = Surah::where('number', $id + 1)->first();

        return view('surah', compact('surah', 'prevSurah', 'nextSurah'));
    }
}