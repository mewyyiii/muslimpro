@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
            <div class="bg-teal-100 text-teal-600 rounded-full p-3 text-2xl">👤</div>
            <div>
                <p class="text-sm text-gray-500">Total Users</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
            <div class="bg-emerald-100 text-emerald-600 rounded-full p-3 text-2xl">🛡️</div>
            <div>
                <p class="text-sm text-gray-500">Total Admins</p>
                <p class="text-3xl font-bold text="gray-800">{{ $stats['total_admins'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
            <div class="bg-blue-100 text-blue-600 rounded-full p-3 text-2xl">👥</div>
            <div>
                <p class="text-sm text-gray-500">Total Semua User</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] + $stats['total_admins'] }}</p>
            </div>
        </div>

    </div>

    {{-- Quick Links --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Menu Admin</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 bg-gray-50 hover:bg-teal-50 hover:text-teal-700 transition rounded-xl px-4 py-3 text-sm font-medium text-gray-600">
                👤 Manage Users
            </a>
            <a href="{{ route('admin.roles.index') }}" class="flex items-center gap-2 bg-gray-50 hover:bg-teal-50 hover:text-teal-700 transition rounded-xl px-4 py-3 text-sm font-medium text-gray-600">
                🛡️ Manage Roles
            </a>
            <a href="#" class="flex items-center gap-2 bg-gray-50 hover:bg-teal-50 hover:text-teal-700 transition rounded-xl px-4 py-3 text-sm font-medium text-gray-600">
                💳 Payment
            </a>
        </div>
    </div>

</div>
@endsection