<?php

namespace App\Http\Controllers;

use App\Models\AsmaulHusna; // Import the AsmaulHusna model
use Illuminate\Http\Request;
// Removed: use Illuminate\Support\Facades\File;

class AsmaulHusnaController extends Controller
{
    public function index()
    {
        // Fetch data from the database using the AsmaulHusna model
        $asmaulHusna = AsmaulHusna::all();

        return view('asmaul_husna', ['asmaulHusna' => $asmaulHusna]);
    }
}
