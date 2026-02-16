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
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 600 390" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="58.7,0.0 58.7,3.1 55.4,6.1 55.4,9.2 52.2,12.3 52.2,15.4 48.9,18.4 48.9,21.5 45.7,24.6 45.7,27.6 45.7,30.7 42.4,33.8 42.4,36.9 39.1,39.9 39.1,43.0 35.9,46.1 35.9,49.1 32.6,52.2 32.6,55.3 29.3,58.3 29.3,61.4 26.1,64.5 26.1,67.6 22.8,70.6 22.8,73.7 19.6,76.8 19.6,79.8 16.3,82.9 16.3,86.0 13.0,89.1 16.3,92.1 19.6,95.2 22.8,98.3 26.1,98.3 29.3,101.3 32.6,104.4 35.9,104.4 39.1,107.5 42.4,107.5 45.7,110.6 48.9,113.6 52.2,113.6 55.4,116.7 58.7,116.7 62.0,119.8 65.2,122.8 68.5,122.8 71.7,125.9 75.0,129.0 78.3,129.0 81.5,132.0 84.8,132.0 88.0,135.1 91.3,138.2 94.6,138.2 97.8,141.3 101.1,141.3 104.3,144.3 107.6,147.4 110.9,147.4 114.1,150.5 117.4,150.5 120.7,153.5 123.9,156.6 127.2,156.6 130.4,159.7 133.7,159.7 137.0,162.8 140.2,165.8 143.5,165.8 146.7,168.9 150.0,168.9 153.3,172.0 156.5,175.0 159.8,175.0 163.0,178.1 166.3,178.1 169.6,181.2 172.8,184.3 176.1,184.3 179.3,187.3 182.6,187.3 185.9,190.4 189.1,193.5 192.4,193.5 195.7,196.5 198.9,199.6 202.2,199.6 205.4,202.7 208.7,202.7 212.0,205.7 215.2,208.8 218.5,208.8 221.7,211.9 225.0,211.9 228.3,215.0 231.5,218.0 234.8,218.0 238.0,221.1 241.3,221.1 244.6,224.2 247.8,227.2 251.1,227.2 254.3,230.3 257.6,230.3 260.9,233.4 264.1,236.5 267.4,236.5 270.7,239.5 273.9,239.5 277.2,242.6 280.4,245.7 283.7,245.7 287.0,248.7 290.2,251.8 293.5,251.8 293.5,254.9 293.5,258.0 293.5,261.0 293.5,264.1 293.5,267.2 290.2,267.2 287.0,264.1 283.7,261.0 280.4,261.0 277.2,258.0 273.9,258.0 270.7,254.9 267.4,251.8 264.1,251.8 260.9,248.7 257.6,245.7 254.3,245.7 251.1,242.6 247.8,242.6 244.6,239.5 241.3,236.5 238.0,236.5 234.8,233.4 231.5,230.3 228.3,230.3 225.0,227.2 221.7,227.2 218.5,224.2 215.2,221.1 212.0,221.1 208.7,218.0 205.4,218.0 202.2,215.0 198.9,211.9 195.7,211.9 192.4,208.8 189.1,205.7 185.9,205.7 182.6,202.7 179.3,202.7 176.1,199.6 172.8,196.5 169.6,196.5 166.3,193.5 163.0,190.4 159.8,190.4 156.5,187.3 153.3,187.3 150.0,184.3 146.7,181.2 143.5,181.2 140.2,178.1 137.0,175.0 133.7,175.0 130.4,172.0 127.2,172.0 123.9,168.9 120.7,165.8 117.4,165.8 114.1,162.8 110.9,159.7 107.6,159.7 104.3,156.6 101.1,156.6 97.8,153.5 94.6,150.5 91.3,150.5 88.0,147.4 84.8,147.4 81.5,144.3 78.3,141.3 75.0,141.3 71.7,138.2 68.5,135.1 65.2,135.1 62.0,132.0 58.7,132.0 55.4,129.0 52.2,125.9 48.9,125.9 45.7,122.8 42.4,119.8 39.1,119.8 35.9,116.7 32.6,116.7 29.3,113.6 26.1,110.6 22.8,110.6 19.6,107.5 16.3,104.4 13.0,104.4 9.8,101.3 6.5,101.3 3.3,98.3 0.0,95.2 0.0,92.1 3.3,89.1 3.3,86.0 6.5,82.9 6.5,79.8 9.8,76.8 9.8,73.7 13.0,70.6 13.0,67.6 16.3,64.5 16.3,61.4 19.6,58.3 19.6,55.3 22.8,52.2 22.8,49.1 26.1,46.1 26.1,43.0 29.3,39.9 29.3,36.9 32.6,33.8 32.6,30.7 35.9,27.6 35.9,24.6 39.1,21.5 39.1,18.4 42.4,15.4 42.4,12.3 45.7,9.2 48.9,6.1 52.2,3.1 55.4,3.1"/>
                        <polygon points="538.0,0.0 541.3,3.1 544.6,3.1 547.8,6.1 551.1,9.2 554.3,12.3 554.3,15.4 557.6,18.4 557.6,21.5 560.9,24.6 560.9,27.6 564.1,30.7 564.1,33.8 567.4,36.9 567.4,39.9 570.7,43.0 570.7,46.1 573.9,49.1 573.9,52.2 577.2,55.3 577.2,58.3 580.4,61.4 580.4,64.5 583.7,67.6 583.7,70.6 587.0,73.7 587.0,76.8 590.2,79.8 590.2,82.9 593.5,86.0 593.5,89.1 596.7,92.1 596.7,95.2 593.5,98.3 590.2,101.3 587.0,101.3 583.7,104.4 580.4,107.5 577.2,107.5 573.9,110.6 570.7,110.6 567.4,113.6 564.1,116.7 560.9,116.7 557.6,119.8 554.3,122.8 551.1,122.8 547.8,125.9 544.6,125.9 541.3,129.0 538.0,132.0 534.8,132.0 531.5,135.1 528.3,135.1 525.0,138.2 521.7,141.3 518.5,141.3 515.2,144.3 512.0,147.4 508.7,147.4 505.4,150.5 502.2,150.5 498.9,153.5 495.7,156.6 492.4,156.6 489.1,159.7 485.9,162.8 482.6,162.8 479.3,165.8 476.1,165.8 472.8,168.9 469.6,172.0 466.3,172.0 463.0,175.0 459.8,178.1 456.5,178.1 453.3,181.2 450.0,181.2 446.7,184.3 443.5,187.3 440.2,187.3 437.0,190.4 433.7,193.5 430.4,193.5 427.2,196.5 423.9,196.5 420.7,199.6 417.4,202.7 414.1,202.7 410.9,205.7 407.6,205.7 404.3,208.8 401.1,211.9 397.8,211.9 394.6,215.0 391.3,218.0 388.0,218.0 384.8,221.1 381.5,221.1 378.3,224.2 375.0,227.2 371.7,227.2 368.5,230.3 365.2,233.4 362.0,233.4 358.7,236.5 355.4,236.5 352.2,239.5 348.9,242.6 345.7,242.6 342.4,245.7 339.1,245.7 335.9,248.7 332.6,251.8 329.3,251.8 326.1,254.9 322.8,258.0 319.6,258.0 316.3,261.0 313.0,264.1 309.8,264.1 306.5,267.2 306.5,264.1 306.5,261.0 303.3,258.0 303.3,254.9 303.3,251.8 306.5,251.8 309.8,248.7 313.0,245.7 316.3,245.7 319.6,242.6 322.8,242.6 326.1,239.5 329.3,236.5 332.6,236.5 335.9,233.4 339.1,230.3 342.4,230.3 345.7,227.2 348.9,227.2 352.2,224.2 355.4,221.1 358.7,221.1 362.0,218.0 365.2,218.0 368.5,215.0 371.7,211.9 375.0,211.9 378.3,208.8 381.5,208.8 384.8,205.7 388.0,202.7 391.3,202.7 394.6,199.6 397.8,199.6 401.1,196.5 404.3,193.5 407.6,193.5 410.9,190.4 414.1,190.4 417.4,187.3 420.7,184.3 423.9,184.3 427.2,181.2 430.4,178.1 433.7,178.1 437.0,175.0 440.2,175.0 443.5,172.0 446.7,172.0 450.0,168.9 453.3,165.8 456.5,165.8 459.8,162.8 463.0,159.7 466.3,159.7 469.6,156.6 472.8,156.6 476.1,153.5 479.3,150.5 482.6,150.5 485.9,147.4 489.1,147.4 492.4,144.3 495.7,141.3 498.9,141.3 502.2,138.2 505.4,138.2 508.7,135.1 512.0,132.0 515.2,132.0 518.5,129.0 521.7,129.0 525.0,125.9 528.3,122.8 531.5,122.8 534.8,119.8 538.0,119.8 541.3,116.7 544.6,113.6 547.8,113.6 551.1,110.6 554.3,107.5 557.6,107.5 560.9,104.4 564.1,104.4 567.4,101.3 570.7,98.3 573.9,98.3 577.2,95.2 580.4,95.2 583.7,92.1 583.7,89.1 580.4,86.0 580.4,82.9 577.2,79.8 577.2,76.8 573.9,73.7 573.9,70.6 570.7,67.6 570.7,64.5 567.4,61.4 567.4,58.3 564.1,55.3 564.1,52.2 560.9,49.1 560.9,46.1 560.9,43.0 557.6,39.9 557.6,36.9 554.3,33.8 554.3,30.7 551.1,27.6 551.1,24.6 547.8,21.5 547.8,18.4 544.6,15.4 544.6,12.3 541.3,9.2 541.3,6.1 538.0,3.1"/>
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
                                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-xs font-medium text-gray-400 truncate">Tafsir</div>
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
                                                    <svg class="w-4 h-4 text-teal-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
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
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 700 382">
                        <polygon points="284,0 286,0 288,0 290,0 292,0 294,0 296,0 298,0 300,0 302,0 304,0 306,0 308,2 310,2 312,2 314,2 316,2 318,2 320,2 322,2 324,2 326,2 328,2 330,2 332,2 334,2 336,2 338,2 340,2 342,2 344,4 346,4 348,4 350,4 352,4 354,4 356,4 358,6 360,6 362,6 364,6 366,6 368,8 370,8 372,8 374,8 376,8 378,10 380,10 382,10 384,12 386,12 388,12 390,14 392,14"/>
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

            <a href="{{ route('quran.index') }}" 
               class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 600 390">
                    <polygon points="58.7,0.0 58.7,3.1 55.4,6.1 55.4,9.2 52.2,12.3 52.2,15.4 48.9,18.4 48.9,21.5 45.7,24.6 45.7,27.6 45.7,30.7 42.4,33.8 42.4,36.9 39.1,39.9 39.1,43.0 35.9,46.1 35.9,49.1 32.6,52.2"/>
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

            <a href="{{ route('prayer-tracking.index') }}" 
               class="block px-3 py-2 rounded-lg text-gray-700 font-medium hover:bg-teal-50 transition-all duration-200 {{ request()->routeIs('prayer-tracking.*') ? 'bg-teal-50 text-teal-700' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 700 382">
                    <polygon points="284,0 286,0 288,0 290,0 292,0"/>
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