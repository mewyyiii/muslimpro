<nav x-data="{ open: false }" class="relative bg-gradient-to-r from-teal-500 to-emerald-500 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                        <svg
                            viewBox="0 0 120 120"
                            class="w-6 h-6"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <!-- string -->
                            <path d="M60 8 Q65 12 60 16" stroke="#48bb78" stroke-width="3" fill="none"/>

                            <!-- beads -->
                            <circle cx="48" cy="22" r="6" fill="#48bb78"/>
                            <circle cx="60" cy="20" r="6" fill="#48bb78"/>
                            <circle cx="72" cy="22" r="6" fill="#48bb78"/>

                            <circle cx="44" cy="34" r="6" fill="#48bb78"/>
                            <circle cx="76" cy="34" r="6" fill="#48bb78"/>

                            <circle cx="46" cy="48" r="6" fill="#48bb78"/>
                            <circle cx="74" cy="48" r="6" fill="#48bb78"/>

                            <circle cx="52" cy="62" r="6" fill="#48bb78"/>
                            <circle cx="68" cy="62" r="6" fill="#48bb78"/>

                            <!-- tassel -->
                            <path
                                d="M56 72 L54 84
                                M60 72 L60 88
                                M64 72 L66 84"
                                stroke="#48bb78"
                                stroke-width="2"
                                stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white hidden sm:block">Al-Huda</span>
                </a>
            </div>

            <!-- Title Al-Huda di tengah — MOBILE ONLY -->
            <span class="md:hidden absolute left-1/2 -translate-x-1/2 pointer-events-none navbar-title-mobile">
                Al-Huda
            </span>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Beranda
                </a>
                <a href="{{ route('quran.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Al-Quran
                </a>
                <a href="{{ route('asmaul-husna.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('asmaul-husna.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    Asmaul Husna
                </a>
                <a href="{{ route('doa-pendek.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('doa-pendek.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    Doa-doa
                </a>

                {{-- ★ BARU: Tracking Shalat --}}
                <a href="{{ route('prayer-tracking.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('prayer-tracking.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Shalat
                </a>
            </div>

            <!-- User Menu & Burger Button -->
            <div class="flex items-center space-x-2">
                @auth
                    <!-- Desktop User Dropdown -->
                    <div class="relative hidden md:block" x-data="{ userOpen: false }">
                        <button @click="userOpen = !userOpen" 
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-white hover:bg-white/20 transition-all duration-200">
                            <div class="w-8 h-8 rounded-full bg-white/30 flex items-center justify-center">
                                <span class="text-sm font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden lg:block font-medium">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': userOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="userOpen" 
                             @click.away="userOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-lg shadow-xl bg-white overflow-hidden z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-teal-50 transition-colors">
                                <svg class="w-5 h-5 inline-block mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-gray-700 hover:bg-teal-50 transition-colors">
                                    <svg class="w-5 h-5 inline-block mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hidden md:block px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="hidden md:block px-4 py-2 rounded-lg bg-white text-teal-600 font-semibold hover:bg-white/90 transition-all duration-200 shadow-md">
                        Register
                    </a>
                @endauth

                <!-- Burger Menu Button -->
                <button @click="open = !open" 
                        class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/20 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="md:hidden bg-teal-600">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Beranda
            </a>
            <a href="{{ route('quran.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Al-Quran
            </a>
            <a href="{{ route('asmaul-husna.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('asmaul-husna.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
                Asmaul Husna
            </a>
            <a href="{{ route('doa-pendek.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('doa-pendek.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                Doa-doa
            </a>

            {{-- ★ BARU: Tracking Shalat (Mobile) --}}
            <a href="{{ route('prayer-tracking.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('prayer-tracking.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                Tracking Shalat
            </a>

            @auth
                <!-- Mobile User Menu -->
                <div class="border-t border-white/20 pt-3 mt-3">
                    <div class="px-3 py-2 text-white/80 text-sm font-medium">
                        {{ auth()->user()->name }}
                    </div>
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                            <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-white/20 pt-3 mt-3 space-y-1">
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg bg-white text-teal-600 font-semibold hover:bg-white/90 transition-all duration-200">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<style>
@media (max-width: 767px) {
    .navbar-title-mobile {
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.06em;

        /* Shimmer gradient text */
        background: linear-gradient(
            90deg,
            rgba(255,255,255,0.6) 0%,
            rgba(255,255,255,1)   30%,
            rgba(255,255,255,0.6) 50%,
            rgba(255,255,255,1)   70%,
            rgba(255,255,255,0.6) 100%
        );
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;

        /* Fade + slide up saat pertama load */
        animation:
            navTitleEntrance 1.2s cubic-bezier(0.22, 1, 0.36, 1) both,
            navTitleShimmer  3s linear 1.2s infinite;

        /* Glow effect */
        filter: drop-shadow(0 0 8px rgba(255,255,255,0.4));
        white-space: nowrap;
    }

    /* Animasi 1: Fade + slide up */
    @keyframes navTitleEntrance {
        from {
            opacity: 0;
            transform: translateX(-50%) translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    }

    /* Animasi 2: Shimmer berkelanjutan */
    @keyframes navTitleShimmer {
        0%   { background-position: 200% center; }
        100% { background-position: -200% center; }
    }
}
</style>