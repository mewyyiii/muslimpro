<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DoaPendekController extends Controller
{
    public function index()
    {
        $path = storage_path('app/doapendek.json');
        $json = File::get($path);
        $doapendek = json_decode($json, true);

        return view('doa_pendek', ['doapendek' => $doapendek]);
    }
}
