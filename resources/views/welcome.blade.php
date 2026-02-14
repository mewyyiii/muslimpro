<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Al-Huda - Islamic App</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #14b8a6 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-teal-50 via-white to-emerald-50">
    
    <!-- Navbar -->
    <nav class="fixed top-0 w-full bg-white/90 backdrop-blur-md shadow-sm z-50 border-b border-teal-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-lg flex items-center justify-center shadow-md">
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
                    <span class="text-xl font-bold text-teal-700">Al-Huda</span>
                </div>
                
                <!-- Auth Buttons -->
                @if (Route::has('login'))
                    <div class="flex items-center space-x-3">
                        @auth
                            <a href="{{ url('/home') }}" class="px-4 py-2 text-sm font-medium text-teal-700 hover:text-teal-800 transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-teal-700 transition-colors">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-teal-500 to-emerald-500 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-all duration-200">
                                    Daftar Gratis
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute top-20 right-10 w-72 h-72 bg-teal-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
        <div class="absolute bottom-20 left-10 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
        
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="fade-in">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Lebih Dekat dengan
                        <span class="gradient-text">Allah SWT</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-600 mb-8 leading-relaxed">
                        Al-Huda hadir sebagai pendamping ibadah harian Anda. Dari Al-Quran digital, jadwal shalat, hingga dzikir counter - semua dalam satu aplikasi.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        @auth
                            <a href="{{ url('/home') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                Ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                Mulai Sekarang
                            </a>
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-teal-700 font-semibold rounded-xl border-2 border-teal-200 hover:border-teal-300 hover:bg-teal-50 transition-all duration-200">
                                Sudah Punya Akun?
                            </a>
                        @endauth
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-gray-200">
                        <div>
                            <div class="text-3xl font-bold text-teal-600">114</div>
                            <div class="text-sm text-gray-600 mt-1">Surah Al-Quran</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-teal-600">99</div>
                            <div class="text-sm text-gray-600 mt-1">Asmaul Husna</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-teal-600">50+</div>
                            <div class="text-sm text-gray-600 mt-1">Doa Harian</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Illustration -->
                <div class="relative hidden lg:block float-animation">
                    <div class="relative w-full h-[500px]">
                        <!-- Islamic Pattern Background -->
                        <div class="absolute inset-0 bg-gradient-to-br from-teal-100 to-emerald-100 rounded-3xl opacity-50"></div>
                        
                        <!-- Mock App Screenshot -->
                        <div class="absolute inset-6 bg-white rounded-2xl shadow-2xl p-8 overflow-hidden">
                            <!-- App Header -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-lg"></div>
                                    <div class="text-lg font-bold text-gray-800">Al-Huda</div>
                                </div>
                                <div class="w-8 h-8 bg-teal-100 rounded-full"></div>
                            </div>
                            
                            <!-- Prayer Times -->
                            <div class="bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl p-6 text-white mb-4">
                                <div class="text-sm opacity-90 mb-2">Waktu Shalat Berikutnya</div>
                                <div class="text-3xl font-bold mb-1">Dzuhur</div>
                                <div class="text-xl">12:15 WIB</div>
                            </div>
                            
                            <!-- Feature Cards -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-teal-50 rounded-lg p-4">
                                    <div class="w-10 h-10 bg-teal-100 rounded-lg mb-2"></div>
                                    <div class="text-sm font-semibold text-gray-800">Al-Quran</div>
                                </div>
                                <div class="bg-emerald-50 rounded-lg p-4">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-lg mb-2"></div>
                                    <div class="text-sm font-semibold text-gray-800">Tasbih</div>
                                </div>
                                <div class="bg-teal-50 rounded-lg p-4">
                                    <div class="w-10 h-10 bg-teal-100 rounded-lg mb-2"></div>
                                    <div class="text-sm font-semibold text-gray-800">Kiblat</div>
                                </div>
                                <div class="bg-emerald-50 rounded-lg p-4">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-lg mb-2"></div>
                                    <div class="text-sm font-semibold text-gray-800">Doa</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Fitur Lengkap untuk Ibadah Anda
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Semua yang Anda butuhkan untuk mendekatkan diri kepada Allah SWT dalam satu aplikasi
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gradient-to-br from-teal-50 to-white rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Al-Quran Digital</h3>
                    <p class="text-gray-600">Baca Al-Quran dengan terjemahan Indonesia, audio murottal, dan tafsir lengkap</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm4.2 14.2L11 13V7h1.5v5.2l4.5 2.7-.8 1.3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Jadwal Shalat</h3>
                    <p class="text-gray-600">Waktu shalat akurat berdasarkan lokasi Anda dengan notifikasi adzan</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gradient-to-br from-teal-50 to-white rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="2"/>
                            <circle cx="12" cy="5" r="2"/>
                            <circle cx="12" cy="19" r="2"/>
                            <circle cx="5" cy="12" r="2"/>
                            <circle cx="19" cy="12" r="2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tasbih Digital</h3>
                    <p class="text-gray-600">Hitung dzikir dengan mudah dan simpan progres harian Anda</p>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                            <path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Arah Kiblat</h3>
                    <p class="text-gray-600">Temukan arah kiblat dengan kompas digital yang akurat</p>
                </div>
                
                <!-- Feature 5 -->
                <div class="bg-gradient-to-br from-teal-50 to-white rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <defs>
                                <mask id="crescent">
                                    <rect width="24" height="24" fill="white"/>
                                    <circle cx="14" cy="10" r="7" fill="black"/>
                                </mask>
                            </defs>
                            <circle cx="10" cy="14" r="8" mask="url(#crescent)"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Doa Harian</h3>
                    <p class="text-gray-600">Kumpulan doa-doa pilihan untuk berbagai keperluan sehari-hari</p>
                </div>
                
                <!-- Feature 6 -->
                <div class="bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 2v2H7v2h10V4h-2V2h2c1.1 0 2 .9 2 2v16c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h2zm3 10c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-6 6h12v-1.5c0-2-4-3-6-3s-6 1-6 3V18z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tracking Shalat</h3>
                    <p class="text-gray-600">Pantau dan catat pelaksanaan shalat lima waktu Anda setiap hari</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-teal-500 to-emerald-500">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                Siap Memulai Perjalanan Spiritual Anda?
            </h2>
            <p class="text-lg text-teal-50 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan Muslim yang sudah menjadikan Al-Huda sebagai pendamping ibadah harian mereka
            </p>
            
            @guest
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-teal-700 font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Daftar Gratis Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-teal-600 text-white font-semibold rounded-xl border-2 border-white/20 hover:bg-teal-700 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Masuk
                    </a>
                </div>
            @else
                <a href="{{ url('/home') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-teal-700 font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    Ke Dashboard
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <!-- About -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-lg flex items-center justify-center">
                            <svg viewBox="0 0 120 120" class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M60 8 Q65 12 60 16" stroke="white" stroke-width="3" fill="none"/>
                                <circle cx="48" cy="22" r="6" fill="white"/>
                                <circle cx="60" cy="20" r="6" fill="white"/>
                                <circle cx="72" cy="22" r="6" fill="white"/>
                                <circle cx="44" cy="34" r="6" fill="white"/>
                                <circle cx="76" cy="34" r="6" fill="white"/>
                                <circle cx="46" cy="48" r="6" fill="white"/>
                                <circle cx="74" cy="48" r="6" fill="white"/>
                                <circle cx="52" cy="62" r="6" fill="white"/>
                                <circle cx="68" cy="62" r="6" fill="white"/>
                                <path d="M56 72 L54 84 M60 72 L60 88 M64 72 L66 84" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">Al-Huda</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Pendamping ibadah digital untuk Muslim modern. Mendekatkan diri kepada Allah dengan teknologi.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold mb-4">Fitur Utama</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('login') }}" class="hover:text-teal-400 transition-colors">Al-Quran Digital</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-teal-400 transition-colors">Jadwal Shalat</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-teal-400 transition-colors">Tasbih Digital</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-teal-400 transition-colors">Arah Kiblat</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="font-semibold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>info@alhuda.app</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Al-Huda. Semua hak dilindungi. Dibuat dengan ❤️ untuk umat Muslim.</p>
                <p class="mt-2 text-xs">Laravel v{{ Illuminate\Foundation\Application::VERSION }} • PHP v{{ PHP_VERSION }}</p>
            </div>
        </div>
    </footer>

</body>
</html>