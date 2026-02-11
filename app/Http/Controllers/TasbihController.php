<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasbihController extends Controller
{
    public function index()
    {
        return view('tasbih.index');
    }

    /**
     * Get tasbih statistics (for future feature)
     */
    public function getStats()
    {
        // Placeholder untuk fitur statistik di masa depan
        // Bisa menggunakan database untuk menyimpan history
        return response()->json([
            'today_count' => 0,
            'total_count' => 0,
            'streak_days' => 0
        ]);
    }

    /**
     * Save tasbih count (for future feature)
     */
    public function saveCount(Request $request)
    {
        // Placeholder untuk menyimpan count ke database
        $validated = $request->validate([
            'count' => 'required|integer|min:0',
            'type' => 'required|string|max:50'
        ]);

        // Di sini bisa simpan ke database
        // TasbihHistory::create([...])

        return response()->json([
            'success' => true,
            'message' => 'Count saved successfully'
        ]);
    }
}