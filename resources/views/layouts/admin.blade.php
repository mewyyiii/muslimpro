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
<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: false, showLogoutModal: false }">
<div class="flex h-screen overflow-hidden">

    {{-- ── Sidebar ─────────────────────────────────────────── --}}
    <aside
        class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-teal-800 to-teal-900 text-white transform transition-transform duration-200 ease-in-out
               lg:relative lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-teal-700">
            <div class="w-10 h-10 rounded-lg overflow-hidden shadow-md flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" class="w-full h-full">
                    <defs>
                        <radialGradient id="bgGradAppNav" cx="50%" cy="45%" r="65%">
                            <stop offset="0%" stop-color="#2ecf8e"/>
                            <stop offset="100%" stop-color="#1aaa72"/>
                        </radialGradient>
                        <filter id="glowAppNav" x="-40%" y="-40%" width="180%" height="180%">
                            <feGaussianBlur in="SourceGraphic" stdDeviation="28" result="blur1"/>
                            <feGaussianBlur in="SourceGraphic" stdDeviation="12" result="blur2"/>
                            <feColorMatrix in="blur1" type="matrix"
                                values="0 0 0 0 0.5
                                        0 0 0 0 1
                                        0 0 0 0 0.7
                                        0 0 0 0.6 0" result="colorBlur"/>
                            <feMerge>
                                <feMergeNode in="colorBlur"/>
                                <feMergeNode in="blur2"/>
                                <feMergeNode in="SourceGraphic"/>
                            </feMerge>
                        </filter>
                        <filter id="diamondGlowAppNav" x="-80%" y="-80%" width="360%" height="360%">
                            <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"/>
                            <feMerge>
                                <feMergeNode in="blur"/>
                                <feMergeNode in="SourceGraphic"/>
                            </feMerge>
                        </filter>
                        <filter id="sparkleGlowAppNav" x="-100%" y="-100%" width="400%" height="400%">
                            <feGaussianBlur in="SourceGraphic" stdDeviation="4" result="blur"/>
                            <feMerge>
                                <feMergeNode in="blur"/>
                                <feMergeNode in="SourceGraphic"/>
                            </feMerge>
                        </filter>
                        <radialGradient id="centerGlowAppNav" cx="52%" cy="48%" r="35%">
                            <stop offset="0%" stop-color="white" stop-opacity="0.08"/>
                            <stop offset="100%" stop-color="transparent" stop-opacity="0"/>
                        </radialGradient>
                    </defs>
                    <rect width="1024" height="1024" fill="url(#bgGradAppNav)"/>
                    <rect width="1024" height="1024" fill="url(#centerGlowAppNav)"/>
                    <text x="510" y="570" text-anchor="middle" dominant-baseline="middle"
                        font-family="'Noto Naskh Arabic', 'Arabic Typesetting', 'Traditional Arabic', 'Geeza Pro', serif"
                        font-size="430" font-weight="bold" fill="white" direction="rtl"
                        filter="url(#glowAppNav)">نور</text>
                    <rect x="668" y="168" width="46" height="46" rx="4" ry="4" fill="white"
                        transform="rotate(45, 691, 191)" filter="url(#diamondGlowAppNav)"/>
                    <g transform="translate(952, 952)" filter="url(#sparkleGlowAppNav)" fill="white" opacity="0.75">
                        <polygon points="0,-16 4,-4 16,0 4,4 0,16 -4,4 -16,0 -4,-4"/>
                    </g>
                </svg>
            </div>
            <div>
                <p class="font-bold text-lg leading-none">NurSteps</p>
                <p class="text-teal-300 text-xs">Panel Admin</p>
            </div>
        </div>

        {{-- Nav Links --}}
        <nav class="px-4 py-6 space-y-1">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.dashboard') ? 'bg-teal-600 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            {{-- Users --}}
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.users.*') ? 'bg-teal-600 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Kelola Pengguna
            </a>

            {{-- Roles --}}
            <a href="{{ route('admin.roles.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.roles.*') ? 'bg-teal-600 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Kelola Peran
            </a>

            {{-- Iklan --}}
            <a href="{{ route('admin.ads.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.ads.*') ? 'bg-teal-600 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Kelola Iklan
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
            <form method="POST" action="{{ route('logout') }}" id="admin-logout-form">
            @csrf
            </form>
            <button @click="showLogoutModal = true"
                class="w-full flex items-center gap-2 px-4 py-2 rounded-xl text-sm text-teal-100 hover:bg-teal-700 transition">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
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
            <span class="bg-teal-100 text-teal-700 text-xs font-semibold px-3 py-1 rounded-full" style="display:inline-flex;align-items:center;gap:4px;">
                <svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Admin
            </span>

        </header>

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>

    </div>

</div>

@stack('scripts')

{{-- ══ GLOBAL CONFIRM DELETE MODAL ══════════════════════════════════ --}}
<div id="confirmModal"
     style="display:none; position:fixed; inset:0; z-index:9999; align-items:center; justify-content:center; padding:16px; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);">

    <div id="confirmModalBox"
         style="background:#fff; border-radius:20px; box-shadow:0 25px 60px rgba(0,0,0,0.2); width:100%; max-width:400px; overflow:hidden; transform:scale(0.95); transition:transform 0.15s ease;">

        <div style="padding:28px 28px 0; text-align:center;">
            <div style="width:56px; height:56px; background:#fef2f2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                <svg style="width:28px;height:28px;" fill="none" stroke="#ef4444" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h3 id="confirmTitle" style="font-size:18px; font-weight:700; color:#111827; margin:0 0 8px;">Hapus Data?</h3>
            <p id="confirmMessage" style="font-size:14px; color:#6b7280; margin:0; line-height:1.5;"></p>
        </div>

        <div style="margin:20px 28px 0; padding:10px 14px; background:#fef9ec; border:1px solid #fde68a; border-radius:10px; display:flex; align-items:center; gap:8px;">
            <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="#d97706" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <span style="font-size:12px; color:#92400e;">Tindakan ini tidak dapat dibatalkan.</span>
        </div>

        <div style="padding:20px 28px 28px; display:flex; gap:10px;">
            <button onclick="closeConfirmModal()"
                    style="flex:1; padding:11px; background:#f3f4f6; color:#374151; font-size:14px; font-weight:600; border:none; border-radius:12px; cursor:pointer;"
                    onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                Batal
            </button>
            <button id="confirmOkBtn"
                    style="flex:1; padding:11px; background:#ef4444; color:#fff; font-size:14px; font-weight:700; border:none; border-radius:12px; cursor:pointer;"
                    onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
let _confirmForm = null;

function confirmDelete(formId, itemName, itemType) {
    _confirmForm = document.getElementById(formId);
    const type = itemType || 'data';
    document.getElementById('confirmTitle').textContent   = 'Hapus ' + type + '?';
    document.getElementById('confirmMessage').textContent = 'Kamu akan menghapus ' + type.toLowerCase() + ' "' + itemName + '". Data akan dihapus permanen.';
    document.getElementById('confirmOkBtn').onclick = function () {
        this.textContent   = 'Menghapus...';
        this.style.opacity = '0.7';
        this.style.cursor  = 'not-allowed';
        _confirmForm.submit();
    };
    const modal = document.getElementById('confirmModal');
    const box   = document.getElementById('confirmModalBox');
    modal.style.display = 'flex';
    setTimeout(() => { box.style.transform = 'scale(1)'; }, 10);
    document.body.style.overflow = 'hidden';
}

function closeConfirmModal() {
    const box = document.getElementById('confirmModalBox');
    box.style.transform = 'scale(0.95)';
    setTimeout(() => {
        document.getElementById('confirmModal').style.display = 'none';
        document.body.style.overflow = '';
    }, 120);
}

document.getElementById('confirmModal').addEventListener('click', function(e) {
    if (e.target === this) closeConfirmModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeConfirmModal();
});
</script>
{{-- Modal Logout Admin --}}
<div x-show="showLogoutModal"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
     @click.self="showLogoutModal = false"
     style="display: none;">
    <div x-show="showLogoutModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-sm text-center">
        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
        </div>
        <h4 class="text-xl font-bold text-gray-800 mb-2">Keluar dari Akun?</h4>
        <p class="text-sm text-gray-500 mb-6">Kamu akan keluar dari sesi ini. Yakin ingin melanjutkan?</p>
        <div class="flex flex-col gap-3">
            <button type="button"
                    onclick="document.getElementById('admin-logout-form').submit()"
                    class="w-full px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-xl transition-colors shadow-md">
                Ya, Keluar
            </button>
            <button type="button" @click="showLogoutModal = false"
                    class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                Batal
            </button>
        </div>
    </div>
</div>
</body>
</html>