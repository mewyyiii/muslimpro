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

                <!-- Al-Quran -->
                <a href="{{ route('quran.index') }}" 
                class="nav-link px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 hover:text-teal-700 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1"
                        viewBox="0 0 256 256"
                        fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                    <path fill-rule="evenodd" d="
                        /* =======================
                        BUKU (SILUET)
                        ======================= */
                        M26 58
                        C26 44 40 34 60 34
                        C86 34 108 42 128 56
                        C148 42 170 34 196 34
                        C216 34 230 44 230 58
                        L230 150
                        C230 162 220 170 206 170
                        C182 170 158 176 140 186
                        C136 188 132 186 132 182
                        L132 64
                        C132 62 131 60 128 58
                        C125 60 124 62 124 64
                        L124 182
                        C124 186 120 188 116 186
                        C98 176 74 170 50 170
                        C36 170 26 162 26 150
                        Z

                        /* bibir bawah halaman kiri */
                        M44 156
                        C68 146 96 146 116 156
                        C120 158 120 164 116 166
                        C96 158 68 158 44 168
                        C40 170 38 160 44 156
                        Z

                        /* bibir bawah halaman kanan */
                        M212 156
                        C188 146 160 146 140 156
                        C136 158 136 164 140 166
                        C160 158 188 158 212 168
                        C216 170 218 160 212 156
                        Z

                        /* =======================
                        REHAL (SILUET)
                        ======================= */
                        /* papan miring kiri & kanan (silang) */
                        M32 150 L124 196 L116 212 L24 166 Z
                        M224 150 L132 196 L140 212 L232 166 Z

                        /* kaki bawah kiri & kanan */
                        M54 228 L122 186 L134 198 L82 244 L62 244 Z
                        M202 228 L134 186 L122 198 L174 244 L194 244 Z

                        /* =======================
                        CUT-OUT (GARIS/LIPATAN)
                        ======================= */
                        /* garis lipatan tengah */
                        M127 60 L129 60 L129 186 L127 186 Z

                        /* garis lengkung dalam halaman kiri */
                        M56 90
                        C80 84 100 88 114 98
                        L110 106
                        C96 96 78 94 60 98
                        Z

                        /* garis lengkung dalam halaman kanan */
                        M200 90
                        C176 84 156 88 142 98
                        L146 106
                        C160 96 178 94 196 98
                        Z
                    "/>
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
                                            <a href="{{ route('doa-pendek.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-teal-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <defs>
                                                            <mask id="crescent-mask-mega">
                                                                <rect width="24" height="24" fill="white"/>
                                                                <circle cx="14.5" cy="9.5" r="6.8" fill="black"/>
                                                            </mask>
                                                        </defs>
                                                        <circle cx="10" cy="13.5" r="7.5" mask="url(#crescent-mask-mega)"/>
                                                        <polygon points="19,1.5 20.4,5.7 24.8,5.7 21.3,8.3 22.7,12.5 19,9.8 15.3,12.5 16.7,8.3 13.2,5.7 17.6,5.7"/>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700 truncate">Doa Pendek</div>
                                                        <div class="text-[10px] text-gray-500 truncate">Kumpulan doa harian</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('tasbih.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-teal-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
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
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700 truncate">Tasbih Digital</div>
                                                        <div class="text-[10px] text-gray-500 truncate">Hitung dzikir</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('qibla.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-teal-600 flex-shrink-0" fill="none" viewBox="0 0 24 24">
                                                        <circle cx="12" cy="12" r="9.5" stroke="currentColor" stroke-width="1.5"/>
                                                        <path d="M12 4 L12.8 11.2 L12 12 L11.2 11.2 Z" fill="currentColor"/>
                                                        <path d="M12 20 L11.2 12.8 L12 12 L12.8 12.8 Z" fill="currentColor" opacity="0.5"/>
                                                        <path d="M20 12 L12.8 11.2 L12 12 L12.8 12.8 Z" fill="currentColor" opacity="0.4"/>
                                                        <path d="M4 12 L11.2 12.8 L12 12 L11.2 11.2 Z" fill="currentColor" opacity="0.4"/>
                                                        <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
                                                        <text x="12" y="3.5" text-anchor="middle" font-size="2.2" font-weight="bold" fill="currentColor">N</text>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700 truncate">Arah Kiblat</div>
                                                        <div class="text-[10px] text-gray-500 truncate">Temukan arah kiblat</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Column 2: Pembelajaran -->
                                <div>
                                    <h3 class="text-xs font-bold text-teal-700 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                                        </svg>
                                        Pembelajaran
                                    </h3>
                                    <ul class="space-y-1">
                                        <li>
                                            <a href="{{ route('asmaul-husna.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <text x="2" y="18" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="currentColor">99</text>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700 truncate">Asmaul Husna</div>
                                                        <div class="text-[10px] text-gray-500 truncate">99 Nama Allah</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                        <div class="block px-2 py-1.5 rounded-lg opacity-50 cursor-not-allowed">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0"
                                                    viewBox="0 0 256 256"
                                                    fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true">

                                                <path fill-rule="evenodd" d="
                                                    /* =======================
                                                    BUKU (SILUET)
                                                    ======================= */
                                                    M26 58
                                                    C26 44 40 34 60 34
                                                    C86 34 108 42 128 56
                                                    C148 42 170 34 196 34
                                                    C216 34 230 44 230 58
                                                    L230 150
                                                    C230 162 220 170 206 170
                                                    C182 170 158 176 140 186
                                                    C136 188 132 186 132 182
                                                    L132 64
                                                    C132 62 131 60 128 58
                                                    C125 60 124 62 124 64
                                                    L124 182
                                                    C124 186 120 188 116 186
                                                    C98 176 74 170 50 170
                                                    C36 170 26 162 26 150
                                                    Z

                                                    /* bibir bawah kiri */
                                                    M44 156
                                                    C68 146 96 146 116 156
                                                    C120 158 120 164 116 166
                                                    C96 158 68 158 44 168
                                                    C40 170 38 160 44 156
                                                    Z

                                                    /* bibir bawah kanan */
                                                    M212 156
                                                    C188 146 160 146 140 156
                                                    C136 158 136 164 140 166
                                                    C160 158 188 158 212 168
                                                    C216 170 218 160 212 156
                                                    Z

                                                    /* =======================
                                                    REHAL
                                                    ======================= */
                                                    M32 150 L124 196 L116 212 L24 166 Z
                                                    M224 150 L132 196 L140 212 L232 166 Z

                                                    M54 228 L122 186 L134 198 L82 244 L62 244 Z
                                                    M202 228 L134 186 L122 198 L174 244 L194 244 Z

                                                    /* =======================
                                                    CUT-OUT (GARIS/LIPATAN)
                                                    ======================= */

                                                    /* lipatan tengah */
                                                    M127 60 L129 60 L129 186 L127 186 Z

                                                    /* lengkung kiri */
                                                    M56 90
                                                    C80 84 100 88 114 98
                                                    L110 106
                                                    C96 96 78 94 60 98
                                                    Z

                                                    /* lengkung kanan */
                                                    M200 90
                                                    C176 84 156 88 142 98
                                                    L146 106
                                                    C160 96 178 94 196 98
                                                    Z
                                                "/>
                                                </svg>
                                                <div class="flex-1 min-w-0">
                                                    <div class="text-xs font-medium text-gray-400 truncate">Al-Quran</div>
                                                    <div class="text-[10px] text-gray-400 truncate">Segera Hadir</div>
                                                </div>
                                            </div>
                                        </div>
                                        </li>
                                        <li>
                                            <div class="block px-2 py-1.5 rounded-lg opacity-50 cursor-not-allowed">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-400 truncate">Artikel Islami</div>
                                                        <div class="text-[10px] text-gray-400 truncate">Segera Hadir</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Column 3: Akses Cepat -->
                                <div>
                                    <h3 class="text-xs font-bold text-teal-700 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                                        </svg>
                                        Akses Cepat
                                    </h3>
                                    <ul class="space-y-1">
                                        <li>
                                            <a href="{{ route('prayer-tracking.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-teal-600 flex-shrink-0" 
                                                        viewBox="0 0 256 256" 
                                                        fill="currentColor" 
                                                        aria-hidden="true">

                                                        <!-- Badan + kaki -->
                                                        <path d="M16 182c0-8 7-15 15-15h72c10 0 19-5 25-13l16-22c15-20 38-32 63-32h4c21 0 41 9 55 25l18 20c6 7 15 11 24 11h12c8 0 15 7 15 15s-7 15-15 15h-44c-13 0-26-6-34-17l-11-15c-7-10-19-16-31-16h-10c-11 0-22 5-29 13l-21 24c-8 9-20 14-32 14H31c-8 0-15-7-15-15z"/>

                                                        <!-- Kepala -->
                                                        <ellipse cx="206" cy="174" rx="30" ry="22"/>

                                                        <!-- Tangan -->
                                                        <path d="M36 172c9-10 22-14 38-11l26 6c7 2 12 8 12 15 0 9-8 16-17 15l-58-5c-8-1-14-7-14-15 0-2 1-4 1-5z"/>

                                                        <!-- Detail leher -->
                                                        <path d="M164 156c10 4 20 2 28-6 5-5 13-5 18 0s5 13 0 18c-15 16-36 20-56 12-7-3-10-11-7-17 3-7 11-10 17-7z"/>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700 truncate">Jadwal Shalat</div>
                                                        <div class="text-[10px] text-gray-500 truncate">Waktu shalat</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="block px-2 py-1.5 rounded-lg opacity-50 cursor-not-allowed">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-400 truncate">Pengingat Harian</div>
                                                        <div class="text-[10px] text-gray-400 truncate">Segera Hadir</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block px-2 py-1.5 rounded-lg opacity-50 cursor-not-allowed">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-400 truncate">Penanda</div>
                                                        <div class="text-[10px] text-gray-400 truncate">Segera Hadir</div>
                                                    </div>
                                                </div>
                                            </div>
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
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" viewBox="0 0 256 256" fill="currentColor" aria-hidden="true">
                        <!-- Badan + kaki (siluet utama) -->
                        <path d="M16 182c0-8 7-15 15-15h72c10 0 19-5 25-13l16-22c15-20 38-32 63-32h4c21 0 41 9 55 25l18 20c6 7 15 11 24 11h12c8 0 15 7 15 15s-7 15-15 15h-44c-13 0-26-6-34-17l-11-15c-7-10-19-16-31-16h-10c-11 0-22 5-29 13l-21 24c-8 9-20 14-32 14H31c-8 0-15-7-15-15z"/>

                        <!-- Kepala -->
                        <ellipse cx="206" cy="174" rx="30" ry="22"/>

                        <!-- Tangan / lengan depan -->
                        <path d="M36 172c9-10 22-14 38-11l26 6c7 2 12 8 12 15 0 9-8 16-17 15l-58-5c-8-1-14-7-14-15 0-2 1-4 1-5z"/>

                        <!-- Leher/ruang kosong kecil antara badan & kepala (biar lebih mirip siluet) -->
                        <path d="M164 156c10 4 20 2 28-6 5-5 13-5 18 0s5 13 0 18c-15 16-36 20-56 12-7-3-10-11-7-17 3-7 11-10 17-7z"/>
                        </svg>
                    Tracking Shalat
                </a>
            </div>

            <!-- Right Side: User -->
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
                            <span class="hidden lg:block font-medium text-sm">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': userOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- User Dropdown Menu -->
                        <div x-show="userOpen" 
                             @click.away="userOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-lg shadow-xl bg-white overflow-hidden z-50 border border-gray-100"
                             style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-teal-50 transition-colors">
                                <svg class="w-5 h-5 inline-block mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <button @click="userOpen = false; showLogoutModal = true" 
                                    class="w-full text-left px-4 py-3 text-gray-700 hover:bg-teal-50 transition-colors border-t border-gray-100">
                                <svg class="w-5 h-5 inline-block mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
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
                    <div class="hidden md:flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold hover:from-teal-600 hover:to-emerald-600 transition-all duration-200 shadow-md">
                            Register
                        </a>
                    </div>
                @endauth

                <!-- Mobile Burger Menu -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-teal-50 transition-all duration-200">
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
             class="md:hidden py-3 space-y-1 border-t border-gray-100">
            
            <a href="{{ route('home') }}" 
               class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Beranda
            </a>

            <!-- Al-Quran Mobile -->
            <a href="{{ route('quran.index') }}" 
            class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1"
                    viewBox="0 0 256 256"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">

                <path fill-rule="evenodd" d="
                    /* =======================
                    BUKU (SILUET)
                    ======================= */
                    M26 58
                    C26 44 40 34 60 34
                    C86 34 108 42 128 56
                    C148 42 170 34 196 34
                    C216 34 230 44 230 58
                    L230 150
                    C230 162 220 170 206 170
                    C182 170 158 176 140 186
                    C136 188 132 186 132 182
                    L132 64
                    C132 62 131 60 128 58
                    C125 60 124 62 124 64
                    L124 182
                    C124 186 120 188 116 186
                    C98 176 74 170 50 170
                    C36 170 26 162 26 150
                    Z

                    /* bibir bawah kiri */
                    M44 156
                    C68 146 96 146 116 156
                    C120 158 120 164 116 166
                    C96 158 68 158 44 168
                    C40 170 38 160 44 156
                    Z

                    /* bibir bawah kanan */
                    M212 156
                    C188 146 160 146 140 156
                    C136 158 136 164 140 166
                    C160 158 188 158 212 168
                    C216 170 218 160 212 156
                    Z

                    /* =======================
                    REHAL
                    ======================= */
                    M32 150 L124 196 L116 212 L24 166 Z
                    M224 150 L132 196 L140 212 L232 166 Z

                    M54 228 L122 186 L134 198 L82 244 L62 244 Z
                    M202 228 L134 186 L122 198 L174 244 L194 244 Z

                    /* =======================
                    CUT-OUT (GARIS/LIPATAN)
                    ======================= */

                    /* lipatan tengah */
                    M127 60 L129 60 L129 186 L127 186 Z

                    /* lengkung kiri */
                    M56 90
                    C80 84 100 88 114 98
                    L110 106
                    C96 96 78 94 60 98
                    Z

                    /* lengkung kanan */
                    M200 90
                    C176 84 156 88 142 98
                    L146 106
                    C160 96 178 94 196 98
                    Z
                "/>
                </svg>

                Al-Quran
            </a>

            <a href="{{ route('asmaul-husna.index') }}" 
               class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('asmaul-husna.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <text x="2" y="18" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="currentColor">99</text>
                </svg>
                Asmaul Husna
            </a>

            <a href="{{ route('doa-pendek.index') }}" 
               class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('doa-pendek.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                    <defs>
                        <mask id="crescent-mask-mobile">
                            <rect width="24" height="24" fill="white"/>
                            <circle cx="14.5" cy="9.5" r="6.8" fill="black"/>
                        </mask>
                    </defs>
                    <circle cx="10" cy="13.5" r="7.5" mask="url(#crescent-mask-mobile)"/>
                    <polygon points="19,1.5 20.4,5.7 24.8,5.7 21.3,8.3 22.7,12.5 19,9.8 15.3,12.5 16.7,8.3 13.2,5.7 17.6,5.7"/>
                </svg>
                Doa Pendek
            </a>

            <a href="{{ route('tasbih.index') }}" 
               class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('tasbih.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                    <circle cx="3" cy="12" r="2"/><circle cx="12" cy="3" r="2"/><circle cx="21" cy="12" r="2"/><circle cx="12" cy="21" r="2"/>
                </svg>
                Tasbih Digital
            </a>

            <a href="{{ route('qibla.index') }}" 
               class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('qibla.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9.5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M12 4 L12.8 11.2 L12 12 L11.2 11.2 Z" fill="currentColor"/>
                    <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
                </svg>
                Arah Kiblat
            </a>

            <!-- Tracking Shalat Mobile -->
            <a href="{{ route('prayer-tracking.index') }}" 
            class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('prayer-tracking.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" 
                    viewBox="0 0 64 64" 
                    fill="currentColor" 
                    aria-hidden="true">
                    <!-- Kepala -->
                    <circle cx="10" cy="22" r="7"/>
                    <!-- Tubuh membungkuk / posisi sujud -->
                    <path d="M16 26 C22 22 38 18 52 17 L54 24 C40 26 24 30 20 34 Z"/>
                    <!-- Tangan menjulur ke depan -->
                    <path d="M52 17 C57 16 62 17 63 21 L60 25 C58 22 54 22 51 24 Z"/>
                    <!-- Pinggul dan kaki terlipat -->
                    <path d="M20 34 C18 40 16 48 14 52 L6 50 C9 46 12 38 14 32 Z"/>
                    <!-- Telapak kaki -->
                    <path d="M14 52 C18 56 28 56 32 52 L30 46 C27 49 18 49 16 46 Z"/>
                </svg>
                Tracking Shalat
            </a>

            @auth
                <div class="border-t border-gray-100 pt-3 mt-3" x-data="{ showLogoutModalMobile: false }">
                    <div class="flex items-center gap-3 px-3 py-2 mb-2">
                        <div class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-teal-100 flex-shrink-0">
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
                        <div class="text-gray-700 text-sm font-medium">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile
                    </a>
                    <button @click="showLogoutModalMobile = true" 
                            class="w-full text-left px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
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