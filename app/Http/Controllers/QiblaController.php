<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QiblaController extends Controller
{
    /**
     * Display the Qibla compass page
     */
    public function index()
    {
        return view('qibla.index');
    }
}