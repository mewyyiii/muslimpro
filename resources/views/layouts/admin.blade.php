<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'NurSteps') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: false }">

<div class="flex h-screen overflow-hidden">

    {{-- ── Sidebar ─────────────────────────────────────────── --}}
    <aside
        class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-teal-800 to-teal-900 text-white transform transition-transform duration-200 ease-in-out
               lg:relative lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-teal-700">
            <span class="text-2xl">🕌</span>
            <div>
                <p class="font-bold text-lg leading-none">NurSteps</p>
                <p class="text-teal-300 text-xs">Admin Panel</p>
            </div>
        </div>

        {{-- Nav Links --}}
        <nav class="px-4 py-6 space-y-1">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.dashboard') ? 'bg-teal-600 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                <span>📊</span> Dashboard
            </a>

            {{-- Users --}}
            <a href="#"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.users.*') ? 'bg-teal-600 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                <span>👤</span> Manage Users
            </a>

            {{-- Roles --}}
            <a href="#"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.roles.*') ? 'bg-teal-600 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                <span>🛡️</span> Manage Roles
            </a>

            {{-- sudah ada sebelumnya --}}
<a href="{{ route('admin.ads.index') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
          {{ request()->routeIs('admin.ads.*') ? 'bg-teal-600 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
    <span>🖼️</span> Manage Iklan
</a>

<a href="{{ route('admin.users.index') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
          {{ request()->routeIs('admin.users.*') ? 'bg-teal-600 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
    <span>👤</span> Manage Users
</a>

        </nav>

        {{-- User Info + Logout --}}
        <div class="absolute bottom-0 left-0 right-0 px-4 py-4 border-t border-teal-700">
            <div class="flex items-center gap-3 mb-3 px-2">
                <img src="{{ Auth::user()->avatar_url }}" class="w-8 h-8 rounded-full object-cover">
                <div class="overflow-hidden">
                    <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                    <p class="text-teal-300 text-xs truncate">{{ Auth::user()->role->name }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2 px-4 py-2 rounded-xl text-sm text-teal-100 hover:bg-teal-700 transition">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Overlay mobile --}}
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/50 lg:hidden"
    ></div>

    {{-- ── Main Content ────────────────────────────────────── --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Topbar --}}
        <header class="bg-white shadow-sm px-6 py-4 flex items-center gap-4">

            {{-- Hamburger (mobile) --}}
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Page Title --}}
            <h1 class="text-gray-700 font-semibold text-lg flex-1">
                @yield('title', 'Dashboard')
            </h1>

            {{-- Admin badge --}}
            <span class="bg-teal-100 text-teal-700 text-xs font-semibold px-3 py-1 rounded-full">
                🛡️ Admin
            </span>

        </header>

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>

    </div>

</div>

@stack('scripts')
</body>
</html>