<nav x-data="{ 
    open: false, 
    megaMenuOpen: false
}" class="relative bg-white shadow-md sticky top-0 z-50 border-b border-teal-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-lg overflow-hidden shadow-md group-hover:scale-110 transition-transform flex-shrink-0">
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
                    <span class="text-xl font-bold text-teal-700 hidden sm:block">NurSteps</span>
                </a>
            </div>

            <!-- Title NurSteps di tengah — MOBILE ONLY -->
            <span class="md:hidden absolute left-1/2 -translate-x-1/2 pointer-events-none navbar-title-mobile text-teal-700">
                NurSteps
            </span>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                <!-- Beranda -->
                <a href="{{ route('home') }}"
                   class="nav-link px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 hover:text-teal-700 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-teal-50 text-teal-700' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Beranda
                </a>

                <!-- Al-Quran -->
                <a href="{{ route('quran.index') }}"
                   class="nav-link px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 hover:text-teal-700 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    <div class="icon">
                        <!-- SVG Icon Quran -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="currentColor">
                            <path d="M80 210 L200 140 L256 180 L256 230 L200 200 L110 250 Z"/>
                            <path d="M432 210 L312 140 L256 180 L256 230 L312 200 L402 250 Z"/>
                            <path d="M60 220 L190 130 L200 140 L80 210 Z"/>
                            <path d="M452 220 L322 130 L312 140 L432 210 Z"/>
                            <path d="M220 260 L130 350 L170 360 L250 280 Z"/>
                            <path d="M292 260 L382 350 L342 360 L262 280 Z"/>
                            <path d="M250 280 L256 270 L262 280 L256 300 Z"/>
                        </svg>
                    </div>
                    Al-Quran
                </a>

                <!-- Fitur Mega Menu -->
                <div class="relative"
                     @mouseenter="megaMenuOpen = true"
                     @mouseleave="megaMenuOpen = false">
                    <button class="nav-link px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 hover:text-teal-700 transition-all duration-200 flex items-center gap-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Fitur
                        <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': megaMenuOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="megaMenuOpen"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="absolute left-0 mt-2 w-[520px] bg-white rounded-xl shadow-2xl overflow-hidden border border-teal-100"
                         style="display: none;">
                        <div class="p-4">
                            <div class="grid grid-cols-3 gap-4">
                                <!-- Alat Ibadah -->
                                <div>
                                    <h3 class="text-xs font-bold text-teal-700 uppercase tracking-wider mb-3">Alat Ibadah</h3>
                                    <ul class="space-y-1">
                                        <li>
                                            <a href="{{ route('doa-pendek.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700">🌙 Doa Pendek</div>
                                                <div class="text-[10px] text-gray-500">Kumpulan doa harian</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('tasbih.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700">📿 Tasbih Digital</div>
                                                <div class="text-[10px] text-gray-500">Hitung dzikir</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('qibla.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700">🧭 Arah Kiblat</div>
                                                <div class="text-[10px] text-gray-500">Temukan arah kiblat</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Pembelajaran -->
                                <div>
                                    <h3 class="text-xs font-bold text-teal-700 uppercase tracking-wider mb-3">Pembelajaran</h3>
                                    <ul class="space-y-1">
                                        <li>
                                            <a href="{{ route('asmaul-husna.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700">✨ Asmaul Husna</div>
                                                <div class="text-[10px] text-gray-500">99 Nama Allah</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('quran.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700">📖 Al-Quran</div>
                                                <div class="text-[10px] text-gray-500">Baca Al-Quran</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Akses Cepat -->
                                <div>
                                    <h3 class="text-xs font-bold text-teal-700 uppercase tracking-wider mb-3">Akses Cepat</h3>
                                    <ul class="space-y-1">
                                        <li>
                                            <a href="{{ route('prayer-tracking.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700">🕌 Waktu Shalat</div>
                                                <div class="text-[10px] text-gray-500">Jadwal & tracking</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tracking Shalat -->
                <a href="{{ route('prayer-tracking.index') }}"
                   class="nav-link px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 hover:text-teal-700 transition-all duration-200 {{ request()->routeIs('prayer-tracking.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" viewBox="0 0 463 463" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M397.886,238.967c-1.202-2.712-3.89-4.46-6.856-4.46h-32.162c-3.413-9.876-12.071-31.572-28.48-53.45c-29.019-38.692-68.521-59.229-114.27-59.44c-6.534-1.114-56.24-8.741-81.407,12.237c-9.696,8.083-14.613,19.147-14.613,32.886c0,20.927,28.343,64.929,43.219,86.583H108.78c-2.546,0-7.078-2.654-11.076-4.997c-6.04-3.538-12.887-7.548-20.285-7.548c-18.66,0-19.558,25.105-20.04,38.594c-0.161,4.508-1.549,8.055-3.018,11.81c-1.602,4.096-3.259,8.331-3.259,13.547c0,5.921,3.306,11.342,9.07,14.873c5.603,3.432,13.516,5.172,23.519,5.172c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5c-1.374,0-2.627-0.047-3.813-0.118c3.929-7.999,9.833-13.734,12.735-16.243h12.241l2.743,24.689c0.422,3.798,3.633,6.672,7.454,6.672H221.68c5.604,0,10.723-2.208,14.804-6.385c6.74-6.899,9.872-18.609,11.318-28.744c17.999,21.989,30.988,32.73,31.86,33.441c1.349,1.1,3.025,1.688,4.739,1.688c0.43,0,0.862-0.037,1.292-0.112c2.145-0.375,4.02-1.663,5.139-3.529l0.003-0.005c3.584,2.37,7.781,3.646,12.176,3.646h94.291c3.353,0,6.298-2.225,7.214-5.45C404.979,317.696,415.638,279.012,397.886,238.967z"/>
                        <path d="M395.195,67.805C351.471,24.08,293.336,0,231.5,0S111.529,24.08,67.805,67.805S0,169.664,0,231.5s24.08,119.971,67.805,163.695S169.664,463,231.5,463s119.971-24.08,163.695-67.805S463,293.336,463,231.5S438.92,111.529,395.195,67.805z M384.589,384.589C343.697,425.48,289.329,448,231.5,448s-112.197-22.52-153.089-63.411C37.52,343.697,15,289.329,15,231.5S37.52,119.303,78.411,78.411C119.303,37.52,173.671,15,231.5,15s112.197,22.52,153.089,63.411C425.48,119.303,448,173.671,448,231.5S425.48,343.697,384.589,384.589z"/>
                    </svg>
                    Waktu Shalat
                </a>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-2">
                @auth
                    <!-- Desktop User Dropdown -->
                    <div class="relative hidden md:block" x-data="{ userOpen: false, showLogoutModal: false }">
                        <button @click="userOpen = !userOpen"
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-teal-50 transition-all duration-200">
                            <div class="w-8 h-8 rounded-full overflow-hidden ring-2 ring-teal-100 flex-shrink-0">
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
                            <div class="hidden lg:flex items-center gap-1.5">
                                <span class="font-medium text-sm">{{ auth()->user()->name }}</span>
                                @if(auth()->user()->hasRole('pro'))
                                    <span class="text-xs bg-gradient-to-r from-teal-500 to-emerald-500 text-white px-2 py-0.5 rounded-full font-semibold">PRO</span>
                                @endif
                                @if(auth()->user()->hasRole('admin'))
                                    <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-semibold">ADMIN</span>
                                @endif
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': userOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="userOpen"
                             @click.away="userOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-52 rounded-xl shadow-xl bg-white overflow-hidden z-50 border border-gray-100"
                             style="display: none;">

                            {{-- Upgrade Pro — hanya untuk role user --}}
                            @if(auth()->user()->hasRole('user'))
                            <a href="{{ route('payment.upgrade') }}"
                               class="block px-4 py-3 bg-gradient-to-r from-teal-50 to-emerald-50 hover:from-teal-100 hover:to-emerald-100 transition-colors border-b border-teal-100">
                                <span class="text-sm font-semibold text-teal-700">✨ Upgrade Pro</span>
                                <span class="block text-xs text-teal-500 mt-0.5">Bebas iklan selamanya</span>
                            </a>
                            @endif

                            {{-- Admin Panel — hanya untuk admin --}}
                            @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}"
                               class="block px-4 py-3 bg-gradient-to-r from-red-50 to-orange-50 hover:from-red-100 hover:to-orange-100 transition-colors border-b border-red-100">
                                <span class="text-sm font-semibold text-red-600">🛡️ Admin Panel</span>
                                <span class="block text-xs text-red-400 mt-0.5">Kelola aplikasi</span>
                            </a>
                            @endif

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-teal-50 transition-colors">
                                <svg class="w-4 h-4 inline-block mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profil
                            </a>
                            <button @click="userOpen = false; showLogoutModal = true"
                                    class="w-full text-left px-4 py-3 text-gray-700 hover:bg-teal-50 transition-colors border-t border-gray-100">
                                <svg class="w-4 h-4 inline-block mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Keluar
                            </button>
                        </div>

                        {{-- Modal Konfirmasi Logout --}}
                        <div x-show="showLogoutModal"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-gray-800 mb-2">Keluar dari Akun?</h4>
                                <p class="text-sm text-gray-500 mb-6">Kamu akan keluar dari sesi ini. Yakin ingin melanjutkan?</p>
                                <div class="flex flex-col gap-3">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-xl transition-colors shadow-md">
                                            Ya, Keluar
                                        </button>
                                    </form>
                                    <button type="button" @click="showLogoutModal = false"
                                            class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="hidden md:flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold hover:from-teal-600 hover:to-emerald-600 transition-all duration-200 shadow-md">Register</a>
                    </div>
                @endauth

                <!-- Mobile Burger -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-teal-50 transition-all duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="open"
             @click.away="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="md:hidden py-3 space-y-1 border-t border-gray-100">

            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-teal-50 text-teal-700' : '' }}">
                🏠 Beranda
            </a>
            <a href="{{ route('quran.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                📖 Al-Quran
            </a>
            <a href="{{ route('asmaul-husna.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('asmaul-husna.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                ✨ Asmaul Husna
            </a>
            <a href="{{ route('doa-pendek.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('doa-pendek.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                🌙 Doa Pendek
            </a>
            <a href="{{ route('tasbih.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('tasbih.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                📿 Tasbih Digital
            </a>
            <a href="{{ route('qibla.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('qibla.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                🧭 Arah Kiblat
            </a>
            <a href="{{ route('prayer-tracking.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('prayer-tracking.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                🕌 Waktu Shalat
            </a>

            @auth
                <div class="border-t border-gray-100 pt-3 mt-3" x-data="{ showLogoutModalMobile: false }">

                    {{-- Info User --}}
                    <div class="flex items-center gap-3 px-3 py-2 mb-2">
                        <div class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-teal-100 flex-shrink-0">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=14b8a6&color=fff&size=128" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-gray-700 text-sm font-medium">{{ auth()->user()->name }}</span>
                                @if(auth()->user()->hasRole('pro'))
                                    <span class="text-xs bg-gradient-to-r from-teal-500 to-emerald-500 text-white px-2 py-0.5 rounded-full font-semibold">PRO</span>
                                @endif
                                @if(auth()->user()->hasRole('admin'))
                                    <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-semibold">ADMIN</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    {{-- Upgrade Pro --}}
                    @if(auth()->user()->hasRole('user'))
                    <a href="{{ route('payment.upgrade') }}"
                       class="block mx-1 mb-2 px-3 py-2.5 rounded-xl bg-gradient-to-r from-teal-50 to-emerald-50 border border-teal-100 transition-all duration-200">
                        <span class="text-sm font-semibold text-teal-700">✨ Upgrade Pro</span>
                        <span class="block text-xs text-teal-500 mt-0.5">Bebas iklan selamanya</span>
                    </a>
                    @endif

                    {{-- Admin Panel --}}
                    @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}"
                       class="block mx-1 mb-2 px-3 py-2.5 rounded-xl bg-gradient-to-r from-red-50 to-orange-50 border border-red-100 transition-all duration-200">
                        <span class="text-sm font-semibold text-red-600">🛡️ Admin Panel</span>
                        <span class="block text-xs text-red-400 mt-0.5">Kelola aplikasi</span>
                    </a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200">
                        👤 Profil
                    </a>

                    <button @click="showLogoutModalMobile = true"
                            class="w-full text-left px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200">
                        🚪 Keluar
                    </button>

                    {{-- Modal Logout Mobile --}}
                    <div x-show="showLogoutModalMobile"
                         x-transition
                         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                         @click.self="showLogoutModalMobile = false"
                         style="display: none;">
                        <div x-show="showLogoutModalMobile" x-transition
                             class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-sm text-center">
                            <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Keluar dari Akun?</h4>
                            <p class="text-sm text-gray-500 mb-6">Kamu akan keluar dari sesi ini. Yakin ingin melanjutkan?</p>
                            <div class="flex flex-col gap-3">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-xl transition-colors shadow-md">
                                        Ya, Keluar
                                    </button>
                                </form>
                                <button type="button" @click="showLogoutModalMobile = false"
                                        class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="border-t border-gray-100 pt-3 mt-3 space-y-1">
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200">Login</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold hover:from-teal-600 hover:to-emerald-600 transition-all duration-200 shadow-md">Register</a>
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
        animation: fadeInDown 0.8s ease-out;
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateX(-50%) translateY(-10px); }
        to   { opacity: 1; transform: translateX(-50%) translateY(0); }
    }
}
.nav-link { position: relative; }
.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0; left: 50%;
    width: 0; height: 2px;
    background: linear-gradient(90deg, #14b8a6, #10b981);
    transform: translateX(-50%);
    transition: width 0.3s ease;
}
.nav-link:hover::after { width: 80%; }
</style>