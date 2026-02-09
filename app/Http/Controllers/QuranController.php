<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class QuranController extends Controller
{
    public function index()
    {
        $path = storage_path('app/quran.json');
        $json = File::get($path);
        $data = json_decode($json, true);

        return view('index', ['surahs' => $data['surahs']]);
    }

    public function show($id)
    {
        $path = storage_path('app/quran.json');
        $json = File::get($path);
        $data = json_decode($json, true);

        $surah = collect($data['surahs'])->firstWhere('number', (int) $id);

        if (!$surah) {
            abort(404);
        }

        // For the audio feature later, we'll need to fetch audio URLs here.
        // For now, let's just pass the text data.

        return view('surah', ['surah' => $surah]);
    }
}