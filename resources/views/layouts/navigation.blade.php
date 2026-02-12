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
                <!-- Beranda -->
                <a href="{{ route('home') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Beranda
                </a>

                <!-- Al-Quran -->
                <a href="{{ route('quran.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Al-Quran
                </a>

                <!-- Asmaul Husna - Angka 99 -->
                <a href="{{ route('asmaul-husna.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('asmaul-husna.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <text x="2" y="18" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="currentColor">99</text>
                    </svg>
                    Asmaul Husna
                </a>
                
                <!-- Doa-doa - Icon Tangan Berdoa -->
                <a href="{{ route('doa-pendek.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('doa-pendek.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 11 L8 18 C8 19 9 20 10 20 L10 21" stroke-linecap="round"/>
                        <path d="M8 14 L10 14" stroke-linecap="round"/>
                        <path d="M16 11 L16 18 C16 19 15 20 14 20 L14 21" stroke-linecap="round"/>
                        <path d="M16 14 L14 14" stroke-linecap="round"/>
                        <path d="M8 11 L8 7" stroke-linecap="round"/>
                        <path d="M16 11 L16 7" stroke-linecap="round"/>
                        <circle cx="12" cy="5" r="2" fill="currentColor"/>
                    </svg>
                    Doa Pendek
                </a>

                <!-- Tasbih - Icon Lingkaran Tasbih dengan Tassel (seperti gambar) -->
                <a href="{{ route('tasbih.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('tasbih.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                        <!-- Beads circle -->
                        <circle cx="3" cy="12" r="2"/>
                        <circle cx="5.5" cy="8" r="2"/>
                        <circle cx="9" cy="5.5" r="2"/>
                        <circle cx="12" cy="3" r="2"/>
                        <circle cx="15" cy="5.5" r="2"/>
                        <circle cx="18.5" cy="8" r="2"/>
                        <circle cx="21" cy="12" r="2"/>
                        <circle cx="18.5" cy="16" r="2"/>
                        <circle cx="15" cy="18.5" r="2"/>
                        <circle cx="12" cy="21" r="2"/>
                        <circle cx="9" cy="18.5" r="2"/>
                        <circle cx="5.5" cy="16" r="2"/>
                        <!-- Tassel -->
                        <rect x="11" y="21" width="2" height="3" rx="0.5"/>
                        <circle cx="12" cy="24.5" r="1"/>
                    </svg>
                    Tasbih
                </a>

                <!-- Kiblat - Icon Kompas dengan Ka'bah (seperti gambar 3) -->
                <a href="{{ route('qibla.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('qibla.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <!-- Kompas lingkaran -->
                        <circle cx="12" cy="12" r="10"/>
                        <!-- Jarum utara -->
                        <path d="M12 4 L13 12 L12 11.5 Z" fill="currentColor"/>
                        <!-- Ka'bah di tengah (kotak 3D sederhana) -->
                        <rect x="9" y="10" width="6" height="5" stroke-width="1.5" fill="none"/>
                        <path d="M9 10 L12 8 L15 10" stroke-width="1.5"/>
                        <line x1="12" y1="8" x2="12" y2="10" stroke-width="1.5"/>
                        <!-- Tanda arah N -->
                        <text x="12" y="3.5" text-anchor="middle" font-size="2.5" fill="currentColor" font-weight="bold">N</text>
                    </svg>
                    Kiblat
                </a>

                <!-- Tracking Shalat - Icon Kalender dengan Checklist (sederhana & masuk akal) -->
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
                    <div class="relative hidden md:block" x-data="{ userOpen: false, showLogoutModal: false }">
                        <button @click="userOpen = !userOpen" 
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-white hover:bg-white/20 transition-all duration-200">
                            {{-- Avatar Image atau Initial --}}
                            <div class="w-8 h-8 rounded-full overflow-hidden ring-2 ring-white/30 flex-shrink-0">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/'.auth()->user()->avatar) }}" 
                                         alt="{{ auth()->user()->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=14b8a6&color=fff&size=128" 
                                         alt="{{ auth()->user()->name }}"
                                         class="w-full h-full object-cover">
                                @endif
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
                             class="absolute right-0 mt-2 w-48 rounded-lg shadow-xl bg-white overflow-hidden z-50"
                             style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-teal-50 transition-colors">
                                <svg class="w-5 h-5 inline-block mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <button @click="userOpen = false; showLogoutModal = true" 
                                    class="w-full text-left px-4 py-3 text-gray-700 hover:bg-teal-50 transition-colors border-t border-gray-100">
                                <svg class="w-5 h-5 inline-block mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </div>

                        {{-- Modal Konfirmasi Logout --}}
                        <div x-show="showLogoutModal"
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                             @click.self="showLogoutModal = false"
                             style="display: none;">

                            <div x-show="showLogoutModal"
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0 scale-75 translate-y-8"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                                 class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-sm text-center">

                                {{-- Icon Logout --}}
                                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </div>

                                {{-- Title & Description --}}
                                <h4 class="text-xl font-bold text-gray-800 mb-2">Keluar dari Akun?</h4>
                                <p class="text-sm text-gray-500 mb-8">
                                    Kamu akan keluar dari sesi ini. Yakin ingin melanjutkan?
                                </p>

                                {{-- Buttons --}}
                                <div class="flex flex-col gap-3">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="w-full px-6 py-3 bg-teal-500 hover:bg-teal-600 text-white font-semibold rounded-xl transition-colors shadow-md">
                                            Ya, Keluar
                                        </button>
                                    </form>
                                    <button type="button"
                                            @click="showLogoutModal = false"
                                            class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="hidden md:flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-white text-teal-600 font-semibold hover:bg-white/90 transition-all duration-200 shadow-md">
                            Register
                        </a>
                    </div>
                @endauth

                <!-- Mobile Burger Menu -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg text-white hover:bg-white/20 transition-all duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="open" 
             @click.away="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="md:hidden py-3 space-y-1">
            
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
                    <text x="2" y="18" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="currentColor">99</text>
                </svg>
                Asmaul Husna
            </a>
            <a href="{{ route('doa-pendek.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('doa-pendek.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M8 11 L8 18 C8 19 9 20 10 20 L10 21" stroke-linecap="round"/>
                    <path d="M8 14 L10 14" stroke-linecap="round"/>
                    <path d="M16 11 L16 18 C16 19 15 20 14 20 L14 21" stroke-linecap="round"/>
                    <path d="M16 14 L14 14" stroke-linecap="round"/>
                    <path d="M8 11 L8 7" stroke-linecap="round"/>
                    <path d="M16 11 L16 7" stroke-linecap="round"/>
                    <circle cx="12" cy="5" r="2" fill="currentColor"/>
                </svg>
                Doa-doa
            </a>
            <a href="{{ route('tasbih.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('tasbih.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                    <circle cx="3" cy="12" r="2"/>
                    <circle cx="5.5" cy="8" r="2"/>
                    <circle cx="9" cy="5.5" r="2"/>
                    <circle cx="12" cy="3" r="2"/>
                    <circle cx="15" cy="5.5" r="2"/>
                    <circle cx="18.5" cy="8" r="2"/>
                    <circle cx="21" cy="12" r="2"/>
                    <circle cx="18.5" cy="16" r="2"/>
                    <circle cx="15" cy="18.5" r="2"/>
                    <circle cx="12" cy="21" r="2"/>
                    <circle cx="9" cy="18.5" r="2"/>
                    <circle cx="5.5" cy="16" r="2"/>
                    <rect x="11" y="21" width="2" height="3" rx="0.5"/>
                    <circle cx="12" cy="24.5" r="1"/>
                </svg>
                Tasbih Digital
            </a>
            <a href="{{ route('qibla.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('qibla.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 4 L13 12 L12 11.5 Z" fill="currentColor"/>
                    <rect x="9" y="10" width="6" height="5" stroke-width="1.5" fill="none"/>
                    <path d="M9 10 L12 8 L15 10" stroke-width="1.5"/>
                    <line x1="12" y1="8" x2="12" y2="10" stroke-width="1.5"/>
                    <text x="12" y="3.5" text-anchor="middle" font-size="2.5" fill="currentColor" font-weight="bold">N</text>
                </svg>
                Arah Kiblat
            </a>
            <a href="{{ route('prayer-tracking.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('prayer-tracking.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                Tracking Shalat
            </a>

            @auth
                <div class="border-t border-white/20 pt-3 mt-3" x-data="{ showLogoutModalMobile: false }">
                    {{-- Avatar + Name di Mobile --}}
                    <div class="flex items-center gap-3 px-3 py-2 mb-2">
                        <div class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-white/30 flex-shrink-0">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/'.auth()->user()->avatar) }}" 
                                     alt="{{ auth()->user()->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=14b8a6&color=fff&size=128" 
                                     alt="{{ auth()->user()->name }}"
                                     class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="text-white/90 text-sm font-medium">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile
                    </a>
                    <button @click="showLogoutModalMobile = true" 
                            class="w-full text-left px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>

                    {{-- Modal Konfirmasi Logout Mobile --}}
                    <div x-show="showLogoutModalMobile"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                         @click.self="showLogoutModalMobile = false"
                         style="display: none;">

                        <div x-show="showLogoutModalMobile"
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0 scale-75 translate-y-8"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                             class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-sm text-center">

                            {{-- Icon Logout --}}
                            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </div>

                            {{-- Title & Description --}}
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Keluar dari Akun?</h4>
                            <p class="text-sm text-gray-500 mb-8">
                                Kamu akan keluar dari sesi ini. Yakin ingin melanjutkan?
                            </p>

                            {{-- Buttons --}}
                            <div class="flex flex-col gap-3">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full px-6 py-3 bg-teal-500 hover:bg-teal-600 text-white font-semibold rounded-xl transition-colors shadow-md">
                                        Ya, Keluar
                                    </button>
                                </form>
                                <button type="button"
                                        @click="showLogoutModalMobile = false"
                                        class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
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
            navTitleEntrance 5s cubic-bezier(0.22, 1, 0.36, 1) both,
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