<?php

namespace App\Http\Controllers;

use App\Models\DoaPendek; // Import the DoaPendek model
use Illuminate\Http\Request;
// Removed: use Illuminate\Support\Facades\File;

class DoaPendekController extends Controller
{
    public function index()
    {
        // Fetch data from the database using the DoaPendek model
        $doapendek = DoaPendek::all();

        return view('doa_pendek', ['doapendek' => $doapendek]);
    }
}
