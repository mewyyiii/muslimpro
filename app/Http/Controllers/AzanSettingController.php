<?php

namespace App\Http\Controllers;

use App\Models\AzanSetting;
use Illuminate\Http\Request;

class AzanSettingController extends Controller
{
    public function show()
    {
        $setting = AzanSetting::getForUser(auth()->id());

        return response()->json([
            'success'    => true,
            'setting'    => $setting,
            'audio_urls' => AzanSetting::audioUrls(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'azan_enabled'    => 'required|boolean',
            'muadzin'         => 'required|in:makkah,madinah,mesir',
            'fajr_enabled'    => 'required|boolean',
            'dhuhr_enabled'   => 'required|boolean',
            'asr_enabled'     => 'required|boolean',
            'maghrib_enabled' => 'required|boolean',
            'isha_enabled'    => 'required|boolean',
        ]);

        $setting = AzanSetting::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan azan berhasil disimpan',
            'setting' => $setting,
        ]);
    }
}