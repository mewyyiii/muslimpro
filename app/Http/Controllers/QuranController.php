<?php

namespace App\Http\Controllers;

use App\Models\Surah; // Import the Surah model
use Illuminate\Http\Request;
// Removed: use Illuminate\Support\Facades\File;

class QuranController extends Controller
{
    public function index()
    {
        // Fetch all surahs from the database
        $surahs = Surah::all();

        return view('index', ['surahs' => $surahs]);
    }

    public function show($id)
    {
        // Fetch the specific surah with its verses from the database
        $surah = Surah::with('verses')->where('number', $id)->first();

        if (!$surah) {
            abort(404);
        }

        return view('surah', ['surah' => $surah]);
    }
}