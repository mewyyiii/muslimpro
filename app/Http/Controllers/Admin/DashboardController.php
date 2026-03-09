<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::whereHas('role', fn($q) => $q->where('name', 'user'))->count(),
            'total_admins' => User::whereHas('role', fn($q) => $q->where('name', 'admin'))->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}