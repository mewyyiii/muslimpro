<nav x-data="{ 
    open: false, 
    megaMenuOpen: false
}" class="relative bg-white shadow-md sticky top-0 z-50 border-b border-teal-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-lg flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                        <svg viewBox="0 0 120 120" class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- string -->
                            <path d="M60 8 Q65 12 60 16" stroke="white" stroke-width="3" fill="none"/>
                            <!-- beads -->
                            <circle cx="48" cy="22" r="6" fill="white"/>
                            <circle cx="60" cy="20" r="6" fill="white"/>
                            <circle cx="72" cy="22" r="6" fill="white"/>
                            <circle cx="44" cy="34" r="6" fill="white"/>
                            <circle cx="76" cy="34" r="6" fill="white"/>
                            <circle cx="46" cy="48" r="6" fill="white"/>
                            <circle cx="74" cy="48" r="6" fill="white"/>
                            <circle cx="52" cy="62" r="6" fill="white"/>
                            <circle cx="68" cy="62" r="6" fill="white"/>
                            <!-- tassel -->
                            <path d="M56 72 L54 84 M60 72 L60 88 M64 72 L66 84" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-teal-700 hidden sm:block">Al-Huda</span>
                </a>
            </div>

            <!-- Title Al-Huda di tengah — MOBILE ONLY -->
            <span class="md:hidden absolute left-1/2 -translate-x-1/2 pointer-events-none navbar-title-mobile text-teal-700">
                Al-Huda
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

                <!-- Al-Quran - ICON BARU ✖️ BOOK OPEN -->
                <a href="{{ route('quran.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 hover:text-teal-700 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Al-Quran
                </a>

                <!-- Resources (Mega Menu) -->
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

                    <!-- Mega Menu Dropdown -->
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
                                <!-- Column 1: Alat Ibadah -->
                                <div>
                                    <h3 class="text-xs font-bold text-teal-700 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                                        </svg>
                                        Alat Ibadah
                                    </h3>
                                    <ul class="space-y-1">
                                        <li>
                                            <a href="{{ route('asmaul-husna.index') }}" 
                                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-teal-50 transition-all duration-200 group {{ request()->routeIs('asmaul-husna.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-700' }}">
                                                <div class="w-9 h-9 bg-teal-50 group-hover:bg-teal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Asmaul Husna</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('doa.index') }}" 
                                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-teal-50 transition-all duration-200 group {{ request()->routeIs('doa.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-700' }}">
                                                <div class="w-9 h-9 bg-purple-50 group-hover:bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Doa Pendek</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('tasbih.index') }}" 
                                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-teal-50 transition-all duration-200 group {{ request()->routeIs('tasbih.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-700' }}">
                                                <div class="w-9 h-9 bg-amber-50 group-hover:bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Tasbih Digital</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Column 2: Tools -->
                                <div>
                                    <h3 class="text-xs font-bold text-teal-700 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                        </svg>
                                        Utilitas
                                    </h3>
                                    <ul class="space-y-1">
                                        <li>
                                            <a href="{{ route('qibla.index') }}" 
                                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-teal-50 transition-all duration-200 group {{ request()->routeIs('qibla.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-700' }}">
                                                <div class="w-9 h-9 bg-blue-50 group-hover:bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Arah Kiblat</span>
                                            </a>
                                        </li>
                                        
                                        <!-- SHALAT - ICON BARU ☁️ CLOUD -->
                                        <li>
                                            <a href="{{ route('prayer-tracking.index') }}" 
                                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-teal-50 transition-all duration-200 group {{ request()->routeIs('prayer-tracking.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-700' }}">
                                                <div class="w-9 h-9 bg-emerald-50 group-hover:bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Tracking Shalat</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dzikir.index') }}" 
                                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-teal-50 transition-all duration-200 group {{ request()->routeIs('dzikir.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-700' }}">
                                                <div class="w-9 h-9 bg-pink-50 group-hover:bg-pink-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Dzikir Harian</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Column 3: Lainnya -->
                                <div>
                                    <h3 class="text-xs font-bold text-teal-700 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                        </svg>
                                        Lainnya
                                    </h3>
                                    <ul class="space-y-1">
                                        <li>
                                            <a href="#" 
                                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-teal-50 transition-all duration-200 group text-gray-700">
                                                <div class="w-9 h-9 bg-indigo-50 group-hover:bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Kalender Hijriyah</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" 
                                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-teal-50 transition-all duration-200 group text-gray-700">
                                                <div class="w-9 h-9 bg-orange-50 group-hover:bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Panduan</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" 
                                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-teal-50 transition-all duration-200 group text-gray-700">
                                                <div class="w-9 h-9 bg-rose-50 group-hover:bg-rose-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Tentang</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side (User Menu) -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <div class="relative" x-data="{ showDropdown: false, showLogoutModal: false }">
                        <button @click="showDropdown = !showDropdown" 
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-teal-50 transition-all duration-200 group">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-teal-400 to-emerald-400 flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-gray-700 max-w-[120px] truncate">
                                {{ auth()->user()->name }}
                            </span>
                            <svg class="w-4 h-4 text-gray-500 transition-transform" :class="{'rotate-180': showDropdown}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="showDropdown"
                             @click.away="showDropdown = false"
                             x-transition
                             class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl overflow-hidden border border-teal-100 z-50"
                             style="display: none;">
                            <div class="p-3 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-emerald-50">
                                <p class="text-xs text-gray-500 mb-1">Logged in as</p>
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('profile.edit') }}" 
                                   class="flex items-center gap-3 px-4 py-2.5 hover:bg-teal-50 transition-colors group">
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-teal-700">Profil Saya</span>
                                </a>
                                <button @click="showLogoutModal = true; showDropdown = false" 
                                        class="w-full flex items-center gap-3 px-4 py-2.5 hover:bg-red-50 transition-colors group">
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-red-600">Keluar</span>
                                </button>
                            </div>
                        </div>

                        <!-- Logout Confirmation Modal -->
                        <div x-show="showLogoutModal"
                             x-transition
                             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                             @click.self="showLogoutModal = false"
                             style="display: none;">
                            <div x-show="showLogoutModal"
                                 x-transition
                                 class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-sm text-center">
                                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-gray-800 mb-2">Keluar dari Akun?</h4>
                                <p class="text-sm text-gray-500 mb-6">
                                    Kamu akan keluar dari sesi ini. Yakin ingin melanjutkan?
                                </p>
                                <div class="flex flex-col gap-3">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="w-full px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-xl transition-colors shadow-md">
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
                    <a href="{{ route('login') }}" 
                       class="px-4 py-2 text-gray-700 font-medium hover:text-teal-700 transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                       class="px-6 py-2 bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold rounded-lg hover:from-teal-600 hover:to-emerald-600 transition-all duration-200 shadow-md hover:shadow-lg">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="open = !open" 
                        class="inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:bg-teal-50 focus:outline-none transition-all duration-200">
                    <svg class="h-6 w-6" :class="{'hidden': open, 'block': !open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="h-6 w-6" :class="{'block': open, 'hidden': !open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="md:hidden border-t border-gray-100 bg-white"
         style="display: none;">
        <div class="px-4 pt-2 pb-4 space-y-1">
            <!-- Mobile Navigation Links -->
            <a href="{{ route('home') }}" 
               class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Beranda
            </a>

            <a href="{{ route('quran.index') }}" 
               class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Al-Quran
            </a>

            <!-- Mobile Submenu Items -->
            <div class="pl-4 space-y-1 border-l-2 border-teal-100 ml-3 mt-2">
                <a href="{{ route('asmaul-husna.index') }}" 
                   class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('asmaul-husna.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    Asmaul Husna
                </a>
                <a href="{{ route('doa.index') }}" 
                   class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('doa.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    Doa Pendek
                </a>
                <a href="{{ route('tasbih.index') }}" 
                   class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('tasbih.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    Tasbih Digital
                </a>
                <a href="{{ route('qibla.index') }}" 
                   class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('qibla.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    Arah Kiblat
                </a>
                <a href="{{ route('prayer-tracking.index') }}" 
                   class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('prayer-tracking.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    Tracking Shalat
                </a>
                <a href="{{ route('dzikir.index') }}" 
                   class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('dzikir.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    Dzikir Harian
                </a>
            </div>

            @auth
                <div class="border-t border-gray-100 pt-3 mt-3" x-data="{ showLogoutModalMobile: false }">
                    <div class="flex items-center gap-3 px-3 py-2 mb-2">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-400 flex items-center justify-center text-white font-bold shadow-md">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}" 
                       class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profil Saya
                    </a>
                    <button @click="showLogoutModalMobile = true" 
                            class="w-full text-left px-3 py-2 rounded-lg text-red-600 font-medium hover:bg-red-50 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Keluar
                    </button>

                    {{-- Modal Mobile --}}
                    <div x-show="showLogoutModalMobile"
                         x-transition
                         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                         @click.self="showLogoutModalMobile = false"
                         style="display: none;">
                        <div x-show="showLogoutModalMobile"
                             x-transition
                             class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-sm text-center">
                            <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Keluar dari Akun?</h4>
                            <p class="text-sm text-gray-500 mb-6">
                                Kamu akan keluar dari sesi ini. Yakin ingin melanjutkan?
                            </p>
                            <div class="flex flex-col gap-3">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-xl transition-colors shadow-md">
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
                <div class="border-t border-gray-100 pt-3 mt-3 space-y-1">
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold hover:from-teal-600 hover:to-emerald-600 transition-all duration-200 shadow-md">
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
        animation: fadeInDown 0.8s ease-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateX(-50%) translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    }
}

/* Smooth hover effects */
.nav-link {
    position: relative;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #14b8a6, #10b981);
    transform: translateX(-50%);
    transition: width 0.3s ease;
}

.nav-link:hover::after {
    width: 80%;
}
</style>