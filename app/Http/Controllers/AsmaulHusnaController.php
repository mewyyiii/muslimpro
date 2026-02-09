<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AsmaulHusnaController extends Controller
{
    public function index()
    {
        $path = storage_path('app/asmaul_husna.json');
        $json = File::get($path);
        $asmaulHusna = json_decode($json, true);

        return view('asmaul_husna', ['asmaulHusna' => $asmaulHusna]);
    }
}
