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
                        <!-- TASBIH ICON -->
                        <svg viewBox="0 0 100 120" class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="11" r="6" fill="white"/>
                            <circle cx="68" cy="16" r="5.5" fill="white"/>
                            <circle cx="80" cy="29" r="5.5" fill="white"/>
                            <circle cx="84" cy="46" r="5.5" fill="white"/>
                            <circle cx="78" cy="62" r="5.5" fill="white"/>
                            <circle cx="64" cy="73" r="5.5" fill="white"/>
                            <circle cx="50" cy="77" r="6" fill="white"/>
                            <circle cx="36" cy="73" r="5.5" fill="white"/>
                            <circle cx="22" cy="62" r="5.5" fill="white"/>
                            <circle cx="16" cy="46" r="5.5" fill="white"/>
                            <circle cx="20" cy="29" r="5.5" fill="white"/>
                            <circle cx="32" cy="16" r="5.5" fill="white"/>
                            <circle cx="50" cy="85" r="5" fill="white"/>
                            <line x1="44" y1="90" x2="41" y2="108" stroke="white" stroke-width="3" stroke-linecap="round"/>
                            <line x1="50" y1="90" x2="50" y2="110" stroke="white" stroke-width="3" stroke-linecap="round"/>
                            <line x1="56" y1="90" x2="59" y2="108" stroke="white" stroke-width="3" stroke-linecap="round"/>
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

                <!-- Al-Quran (Desktop) -->
                <a href="{{ route('quran.index') }}" 
                class="nav-link px-4 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 hover:text-teal-700 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1"
                        viewBox="0 0 256 256"
                        fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path d="M26 58 C26 44 40 34 60 34 C86 34 108 42 128 56 C148 42 170 34 196 34 C216 34 230 44 230 58 L230 150 C230 162 220 170 206 170 C182 170 158 176 140 186 C136 188 132 186 132 182 L132 64 C132 62 131 60 128 58 C125 60 124 62 124 64 L124 182 C124 186 120 188 116 186 C98 176 74 170 50 170 C36 170 26 162 26 150 Z M44 156 C68 146 96 146 116 156 C120 158 120 164 116 166 C96 158 68 158 44 168 C40 170 38 160 44 156 Z M212 156 C188 146 160 146 140 156 C136 158 136 164 140 166 C160 158 188 158 212 168 C216 170 218 160 212 156 Z M32 150 L124 196 L116 212 L24 166 Z M224 150 L132 196 L140 212 L232 166 Z M54 228 L122 186 L134 198 L82 244 L62 244 Z M202 228 L134 186 L122 198 L174 244 L194 244 Z M127 60 L129 60 L129 186 L127 186 Z M56 90 C80 84 100 88 114 98 L110 106 C96 96 78 94 60 98 Z M200 90 C176 84 156 88 142 98 L146 106 C160 96 178 94 196 98 Z"/>
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
                                            <a href="{{ route('quran.index') }}" class="block px-2 py-1.5 rounded-lg hover:bg-teal-50 transition-colors group">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-teal-600 flex-shrink-0"
                                                        viewBox="0 0 256 256"
                                                        fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true">
                                                        <path d="M26 58 C26 44 40 34 60 34 C86 34 108 42 128 56 C148 42 170 34 196 34 C216 34 230 44 230 58 L230 150 C230 162 220 170 206 170 C182 170 158 176 140 186 C136 188 132 186 132 182 L132 64 C132 62 131 60 128 58 C125 60 124 62 124 64 L124 182 C124 186 120 188 116 186 C98 176 74 170 50 170 C36 170 26 162 26 150 Z M44 156 C68 146 96 146 116 156 C120 158 120 164 116 166 C96 158 68 158 44 168 C40 170 38 160 44 156 Z M212 156 C188 146 160 146 140 156 C136 158 136 164 140 166 C160 158 188 158 212 168 C216 170 218 160 212 156 Z M32 150 L124 196 L116 212 L24 166 Z M224 150 L132 196 L140 212 L232 166 Z M54 228 L122 186 L134 198 L82 244 L62 244 Z M202 228 L134 186 L122 198 L174 244 L194 244 Z M127 60 L129 60 L129 186 L127 186 Z M56 90 C80 84 100 88 114 98 L110 106 C96 96 78 94 60 98 Z M200 90 C176 84 156 88 142 98 L146 106 C160 96 178 94 196 98 Z"/>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700 truncate">Al-Quran</div>
                                                        <div class="text-[10px] text-gray-500 truncate">Baca Al-Quran</div>
                                                    </div>
                                                </div>
                                            </a>
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
                                                    <svg class="w-4 h-4 text-teal-600 flex-shrink-0" viewBox="0 0 463 463" fill="currentColor" aria-hidden="true">
                                                        <path d="M397.886,238.967c-1.202-2.712-3.89-4.46-6.856-4.46h-32.162c-3.413-9.876-12.071-31.572-28.48-53.45c-29.019-38.692-68.521-59.229-114.27-59.44c-6.534-1.114-56.24-8.741-81.407,12.237c-9.696,8.083-14.613,19.147-14.613,32.886c0,20.927,28.343,64.929,43.219,86.583H108.78c-2.546,0-7.078-2.654-11.076-4.997c-6.04-3.538-12.887-7.548-20.285-7.548c-18.66,0-19.558,25.105-20.04,38.594c-0.161,4.508-1.549,8.055-3.018,11.81c-1.602,4.096-3.259,8.331-3.259,13.547c0,5.921,3.306,11.342,9.07,14.873c5.603,3.432,13.516,5.172,23.519,5.172c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5c-1.374,0-2.627-0.047-3.813-0.118c3.929-7.999,9.833-13.734,12.735-16.243h12.241l2.743,24.689c0.422,3.798,3.633,6.672,7.454,6.672H221.68c5.604,0,10.723-2.208,14.804-6.385c6.74-6.899,9.872-18.609,11.318-28.744c17.999,21.989,30.988,32.73,31.86,33.441c1.349,1.1,3.025,1.688,4.739,1.688c0.43,0,0.862-0.037,1.292-0.112c2.145-0.375,4.02-1.663,5.139-3.529l0.003-0.005c3.584,2.37,7.781,3.646,12.176,3.646h94.291c3.353,0,6.298-2.225,7.214-5.45C404.979,317.696,415.638,279.012,397.886,238.967z"/>
                                                        <path d="M395.195,67.805C351.471,24.08,293.336,0,231.5,0S111.529,24.08,67.805,67.805S0,169.664,0,231.5s24.08,119.971,67.805,163.695S169.664,463,231.5,463s119.971-24.08,163.695-67.805S463,293.336,463,231.5S438.92,111.529,395.195,67.805z M384.589,384.589C343.697,425.48,289.329,448,231.5,448s-112.197-22.52-153.089-63.411C37.52,343.697,15,289.329,15,231.5S37.52,119.303,78.411,78.411C119.303,37.52,173.671,15,231.5,15s112.197,22.52,153.089,63.411C425.48,119.303,448,173.671,448,231.5S425.48,343.697,384.589,384.589z"/>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-700 group-hover:text-teal-700 truncate">Jadwal Shalat</div>
                                                        <div class="text-[10px] text-gray-500 truncate">Waktu shalat</div>
                                                    </div>
                                                </div>
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
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" viewBox="0 0 463 463" fill="currentColor" aria-hidden="true">
                        <path d="M397.886,238.967c-1.202-2.712-3.89-4.46-6.856-4.46h-32.162c-3.413-9.876-12.071-31.572-28.48-53.45c-29.019-38.692-68.521-59.229-114.27-59.44c-6.534-1.114-56.24-8.741-81.407,12.237c-9.696,8.083-14.613,19.147-14.613,32.886c0,20.927,28.343,64.929,43.219,86.583H108.78c-2.546,0-7.078-2.654-11.076-4.997c-6.04-3.538-12.887-7.548-20.285-7.548c-18.66,0-19.558,25.105-20.04,38.594c-0.161,4.508-1.549,8.055-3.018,11.81c-1.602,4.096-3.259,8.331-3.259,13.547c0,5.921,3.306,11.342,9.07,14.873c5.603,3.432,13.516,5.172,23.519,5.172c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5c-1.374,0-2.627-0.047-3.813-0.118c3.929-7.999,9.833-13.734,12.735-16.243h12.241l2.743,24.689c0.422,3.798,3.633,6.672,7.454,6.672H221.68c5.604,0,10.723-2.208,14.804-6.385c6.74-6.899,9.872-18.609,11.318-28.744c17.999,21.989,30.988,32.73,31.86,33.441c1.349,1.1,3.025,1.688,4.739,1.688c0.43,0,0.862-0.037,1.292-0.112c2.145-0.375,4.02-1.663,5.139-3.529l0.003-0.005c3.584,2.37,7.781,3.646,12.176,3.646h94.291c3.353,0,6.298-2.225,7.214-5.45C404.979,317.696,415.638,279.012,397.886,238.967z"/>
                        <path d="M395.195,67.805C351.471,24.08,293.336,0,231.5,0S111.529,24.08,67.805,67.805S0,169.664,0,231.5s24.08,119.971,67.805,163.695S169.664,463,231.5,463s119.971-24.08,163.695-67.805S463,293.336,463,231.5S438.92,111.529,395.195,67.805z M384.589,384.589C343.697,425.48,289.329,448,231.5,448s-112.197-22.52-153.089-63.411C37.52,343.697,15,289.329,15,231.5S37.52,119.303,78.411,78.411C119.303,37.52,173.671,15,231.5,15s112.197,22.52,153.089,63.411C425.48,119.303,448,173.671,448,231.5S425.48,343.697,384.589,384.589z"/>
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
                    <path d="M26 58 C26 44 40 34 60 34 C86 34 108 42 128 56 C148 42 170 34 196 34 C216 34 230 44 230 58 L230 150 C230 162 220 170 206 170 C182 170 158 176 140 186 C136 188 132 186 132 182 L132 64 C132 62 131 60 128 58 C125 60 124 62 124 64 L124 182 C124 186 120 188 116 186 C98 176 74 170 50 170 C36 170 26 162 26 150 Z M44 156 C68 146 96 146 116 156 C120 158 120 164 116 166 C96 158 68 158 44 168 C40 170 38 160 44 156 Z M212 156 C188 146 160 146 140 156 C136 158 136 164 140 166 C160 158 188 158 212 168 C216 170 218 160 212 156 Z M32 150 L124 196 L116 212 L24 166 Z M224 150 L132 196 L140 212 L232 166 Z M54 228 L122 186 L134 198 L82 244 L62 244 Z M202 228 L134 186 L122 198 L174 244 L194 244 Z M127 60 L129 60 L129 186 L127 186 Z M56 90 C80 84 100 88 114 98 L110 106 C96 96 78 94 60 98 Z M200 90 C176 84 156 88 142 98 L146 106 C160 96 178 94 196 98 Z"/>
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
                <svg class="w-5 h-5 inline-block mr-2 -mt-1 text-black" fill="currentColor" viewBox="0 0 24 24">
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
                        viewBox="0 0 463 463" 
                        fill="#000000" 
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M397.886,238.967c-1.202-2.712-3.89-4.46-6.856-4.46h-32.162c-3.413-9.876-12.071-31.572-28.48-53.45
                            c-29.019-38.692-68.521-59.229-114.27-59.44c-6.534-1.114-56.24-8.741-81.407,12.237c-9.696,8.083-14.613,19.147-14.613,32.886
                            c0,20.927,28.343,64.929,43.219,86.583H108.78c-2.546,0-7.078-2.654-11.076-4.997c-6.04-3.538-12.887-7.548-20.285-7.548
                            c-18.66,0-19.558,25.105-20.04,38.594c-0.161,4.508-1.549,8.055-3.018,11.81c-1.602,4.096-3.259,8.331-3.259,13.547
                            c0,5.921,3.306,11.342,9.07,14.873c5.603,3.432,13.516,5.172,23.519,5.172c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5
                            c-1.374,0-2.627-0.047-3.813-0.118c3.929-7.999,9.833-13.734,12.735-16.243h12.241l2.743,24.689
                            c0.422,3.798,3.633,6.672,7.454,6.672H221.68c5.604,0,10.723-2.208,14.804-6.385c6.74-6.899,9.872-18.609,11.318-28.744
                            c17.999,21.989,30.988,32.73,31.86,33.441c1.349,1.1,3.025,1.688,4.739,1.688c0.43,0,0.862-0.037,1.292-0.112
                            c2.145-0.375,4.02-1.663,5.139-3.529l0.003-0.005c3.584,2.37,7.781,3.646,12.176,3.646h94.291c3.353,0,6.298-2.225,7.214-5.45
                            C404.979,317.696,415.638,279.012,397.886,238.967z M89.963,278.412c-1.573,0-3.106,0.495-4.383,1.414
                            c-0.55,0.396-12.341,9.011-19.386,23.664c0.261-2.028,1.104-4.204,2.137-6.842c1.687-4.313,3.786-9.679,4.038-16.739
                            c0.839-23.452,4.621-24.129,5.05-24.129c3.329,0,8.31,2.917,12.704,5.491c3.826,2.241,7.739,4.526,11.813,5.866l1.253,11.276
                            H89.963z M225.748,307.911c-1.276,1.305-2.493,1.862-4.068,1.862h-99.915l-4.605-41.45h60.615c2.821,0,5.403-1.583,6.684-4.097
                            s1.041-5.533-0.618-7.814c-18.846-25.913-48.743-73.171-48.743-89.672c0-9.199,3.011-16.184,9.204-21.353
                            c15.769-13.163,49.099-11.799,65.282-9.604c4.089,15.278,3.347,31.245,1.607,43.328c-0.955-1.906-1.57-3.09-1.677-3.296
                            c-1.916-3.672-6.443-5.096-10.118-3.18c-3.672,1.916-5.096,6.445-3.181,10.118c0.114,0.219,10.706,20.611,17.003,38.75
                            c-1.605,1.307-2.58,2.165-2.798,2.359c-2.664,2.373-3.288,6.293-1.492,9.376c8.591,14.745,17.1,27.55,25.087,38.527
                            C234.142,282.665,232.06,301.46,225.748,307.911z M225.151,231.199c10.035-7.741,34.517-24.5,59.581-25.606
                            c4.138-0.183,7.345-3.685,7.162-7.823s-3.66-7.336-7.824-7.162c-22.815,1.007-44.397,12.455-58.242,21.65
                            c-1.315-3.528-2.728-7.052-4.156-10.444c2.322-7.818,9.653-36.164,3.61-64.85c37.192,2.635,68.383,20.324,92.816,52.708
                            c16.167,21.427,24.386,43.181,27.063,51.16c-8.988,10.495-37.414,13.952-56.278,11.821c-3.353-4.65-7.032-9.711-10.982-15.087
                            c-2.453-3.339-7.146-4.056-10.484-1.604c-3.338,2.452-4.057,7.146-1.604,10.484c13.479,18.347,23.812,33.046,28.483,39.756
                            l-11.621,19.368C271.88,295.179,249.006,270.857,225.151,231.199z M307.603,279.064c-1.586-2.285-4.18-6.002-7.593-10.831
                            c0.154,0,0.303,0.004,0.457,0.004c4.077,0,8.416-0.18,12.833-0.591c-0.487,1.101-1.098,2.123-1.802,3.299
                            C310.183,273.139,308.699,275.63,307.603,279.064z M303.011,309.773c-1.631,0-3.177-0.547-4.434-1.548l5.125-8.541h30.065
                            c1.992,1.085,5.938,4.989,10.358,10.089H303.011z M334.579,284.684h-12.981c0.591-2.392,1.577-4.043,2.765-6.026
                            c1.921-3.206,4.229-7.076,4.945-13.612c10.385-2.512,19.97-6.723,26.27-13.384c10.032,25.667,10.404,47.773,9.827,58.111h-1.961
                            C344.594,284.698,337.103,284.684,334.579,284.684z M391.251,309.773h-10.792c0.604-11.732-0.039-34.071-9.658-60.267h15.218
                            C395.734,274.75,393.136,299.207,391.251,309.773z"/>
                        <path d="M395.195,67.805C351.471,24.08,293.336,0,231.5,0S111.529,24.08,67.805,67.805S0,169.664,0,231.5
                            s24.08,119.971,67.805,163.695S169.664,463,231.5,463s119.971-24.08,163.695-67.805S463,293.336,463,231.5
                            S438.92,111.529,395.195,67.805z M384.589,384.589C343.697,425.48,289.329,448,231.5,448s-112.197-22.52-153.089-63.411
                            C37.52,343.697,15,289.329,15,231.5S37.52,119.303,78.411,78.411C119.303,37.52,173.671,15,231.5,15s112.197,22.52,153.089,63.411
                            C425.48,119.303,448,173.671,448,231.5S425.48,343.697,384.589,384.589z"/>
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
                        Profil
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