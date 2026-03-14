@extends('layouts.admin')

@section('title', 'Panel Kontrol')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
            <div class="bg-teal-100 text-teal-600 rounded-full p-3">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Pengguna</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
            <div class="bg-emerald-100 text-emerald-600 rounded-full p-3">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Admin</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_admins'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
            <div class="bg-blue-100 text-blue-600 rounded-full p-3">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Semua Pengguna</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] + $stats['total_admins'] }}</p>
            </div>
        </div>

    </div>

    {{-- Quick Links --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Menu Admin</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 bg-gray-50 hover:bg-teal-50 hover:text-teal-700 transition rounded-xl px-4 py-3 text-sm font-medium text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Kelola Pengguna
            </a>
            <a href="{{ route('admin.roles.index') }}" class="flex items-center gap-2 bg-gray-50 hover:bg-teal-50 hover:text-teal-700 transition rounded-xl px-4 py-3 text-sm font-medium text-gray-medium text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Kelola Peran
            </a>
            <a href="{{ route('admin.payments.index') }}" class="flex items-center gap-2 bg-gray-50 hover:bg-teal-50 hover:text-teal-700 transition rounded-xl px-4 py-3 text-sm font-medium text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                Pembayaran
            </a>
        </div>
    </div>

</div>
@endsection