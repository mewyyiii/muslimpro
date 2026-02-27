<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Al-Huda - Pendamping Ibadah Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { 
            font-family: 'Figtree', sans-serif;
            scroll-behavior: smooth;
        }

        /* ANIMATIONS */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }
        .float-animation { animation: float 8s ease-in-out infinite; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeInUp 0.8s ease-out 0s both; }
        .fade-in-d1 { animation: fadeInUp 0.8s ease-out 0.2s both; }
        .fade-in-d2 { animation: fadeInUp 0.8s ease-out 0.4s both; }
        .fade-in-d3 { animation: fadeInUp 0.8s ease-out 0.6s both; }
        .fade-in-d4 { animation: fadeInUp 0.8s ease-out 0.8s both; }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .scale-in { animation: scaleIn 0.5s ease-out; }

        /* GRADIENT TEXT */
        .gradient-text {
            background: linear-gradient(135deg, #06B6D4 0%, #14B8A6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* BADGE PILL */
        @keyframes badgePulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(6,182,212,0.4); }
            50% { box-shadow: 0 0 0 8px rgba(6,182,212,0); }
        }
        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #FFF7ED 0%, #FFEDD5 100%);
            border: 2px solid rgba(6,182,212,0.25);
            color: #0891B2;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 999px;
            letter-spacing: 0.03em;
            animation: badgePulse 3s ease-in-out infinite;
            margin-bottom: 16px;
            width: fit-content;
        }
        @media (min-width: 640px) {
            .badge-pill {
                font-size: 0.8rem;
                padding: 6px 16px;
                gap: 10px;
            }
        }
        .badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: linear-gradient(135deg, #06B6D4, #14B8A6);
            flex-shrink: 0;
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @media (min-width: 640px) {
            .badge-dot {
                width: 8px;
                height: 8px;
            }
        }

        /* FEATURE CARDS */
        .feature-card {
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            transform: scale(1);
        }
        .feature-card:hover {
            transform: scale(1.03) translateY(-4px);
            box-shadow: 0 20px 40px rgba(6,182,212,0.15), 0 8px 20px rgba(0,0,0,0.08);
        }
        @media (min-width: 768px) {
            .feature-card:hover {
                transform: scale(1.06) translateY(-8px);
                box-shadow: 0 30px 60px rgba(6,182,212,0.2), 0 10px 25px rgba(0,0,0,0.1);
            }
        }

        /* REVEAL ON SCROLL */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-d1 { transition-delay: 0.1s; }
        .reveal-d2 { transition-delay: 0.2s; }
        .reveal-d3 { transition-delay: 0.3s; }
        .reveal-d4 { transition-delay: 0.4s; }
        .reveal-d5 { transition-delay: 0.5s; }
        .reveal-d6 { transition-delay: 0.6s; }

        /* BUTTON SHINE */
        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -75%;
            width: 50%;
            height: 200%;
            background: rgba(255,255,255,0.3);
            transform: skewX(-20deg);
            transition: left 0.6s ease;
        }
        .btn-shine:hover::after {
            left: 130%;
        }

        /* HEADING UNDERLINE */
        .heading-underline {
            position: relative;
            padding-bottom: 12px;
        }
        @media (min-width: 768px) {
            .heading-underline {
                padding-bottom: 14px;
            }
        }
        .heading-underline::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #06B6D4, #14B8A6);
            border-radius: 2px;
        }
        @media (min-width: 768px) {
            .heading-underline::after {
                width: 60px;
                height: 4px;
            }
        }

        /* NAVBAR SCROLL */
        .nav-scrolled {
            box-shadow: 0 4px 30px rgba(0,0,0,0.1) !important;
            background: rgba(255,255,255,0.95) !important;
        }

        /* BLOB ANIMATIONS */
        @keyframes blob {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        }
        .blob {
            animation: blob 10s ease-in-out infinite;
        }
        .blob-delay {
            animation: blob 12s ease-in-out infinite;
            animation-delay: -6s;
        }

        /* STAT ITEMS */
        .stat-item {
            opacity: 0;
            transform: translateY(15px);
            animation: fadeInUp 0.6s ease-out both;
        }
        .stat-item:nth-child(1) { animation-delay: 0.7s; }
        .stat-item:nth-child(2) { animation-delay: 0.85s; }
        .stat-item:nth-child(3) { animation-delay: 1s; }

        /* FOOTER LINKS */
        .footer-link {
            transition: color 0.25s, padding-left 0.25s;
        }
        .footer-link:hover {
            color: #22D3EE;
            padding-left: 6px;
        }

        /* MOSQUE ILLUSTRATION */
        .mosque-illustration {
            filter: drop-shadow(0 15px 30px rgba(6,182,212,0.25));
        }
        @media (min-width: 768px) {
            .mosque-illustration {
                filter: drop-shadow(0 20px 40px rgba(6,182,212,0.3));
            }
        }

        /* MODAL */
        .modal-backdrop {
            backdrop-filter: blur(8px);
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .modal-content {
            animation: slideUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            max-height: 90vh;
            overflow-y: auto;
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* INPUT FOCUS */
        .input-field:focus {
            outline: none;
            border-color: #06B6D4;
            box-shadow: 0 0 0 3px rgba(6,182,212,0.1);
        }

        /* DECORATIVE SHAPES */
        .deco-circle {
            animation: float 8s ease-in-out infinite;
        }
        .deco-star {
            animation: twinkle 3s ease-in-out infinite;
        }
        @keyframes twinkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }

        /* RESPONSIVE ADJUSTMENTS */
        @media (max-width: 639px) {
            .blob {
                width: 200px !important;
                height: 200px !important;
            }
        }

        /* Smooth scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #06B6D4, #14B8A6);
            border-radius: 5px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #0891B2, #0D9488);
        }

        /* TYPING TEXT */
        .typing-text {
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            border-right: 2px solid #0891B2;
            width: 0;
            animation: typing 8s ease-in-out infinite, blink 0.8s infinite;
        }

        @keyframes typing {
            0%   { width: 0 }
            40%  { width: 6.5ch }
            60%  { width: 6.5ch }
            100% { width: 0 }
        }

        @keyframes blink {
            50% { border-color: transparent }
        }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-orange-50 via-amber-50 to-teal-50">

<!-- NAVBAR -->
<nav id="main-nav" class="fixed top-0 w-full bg-white/90 backdrop-blur-md z-50 border-b border-orange-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14 sm:h-16">
            <div class="flex items-center space-x-2 sm:space-x-3">
                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/30">
                    <!-- TASBIH ICON -->
                    <svg viewBox="0 0 100 120" class="w-5 h-5 sm:w-6 sm:h-6" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                <span class="typing-text text-lg sm:text-xl font-bold text-cyan-700">
                    Al-Huda
                </span>
            </div>
            <div class="flex items-center space-x-2 sm:space-x-3">
                {{-- ✅ Langsung ke halaman login Breeze --}}
                <a href="{{ route('login') }}" class="px-3 py-1.5 sm:px-5 sm:py-2 text-xs sm:text-sm font-semibold text-gray-700 hover:text-cyan-700 transition-colors duration-200 hover:scale-105 transform">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="btn-shine px-4 py-1.5 sm:px-6 sm:py-2.5 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-xs sm:text-sm font-bold rounded-lg sm:rounded-xl shadow-lg shadow-cyan-500/30 hover:shadow-xl hover:scale-105 transition-all duration-200">
                    Daftar Gratis
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="relative pt-20 sm:pt-28 lg:pt-32 pb-16 sm:pb-20 lg:pb-24 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <!-- Decorative Blobs -->
    <div class="blob absolute top-10 sm:top-20 right-5 sm:right-10 w-60 h-60 sm:w-80 sm:h-80 lg:w-96 lg:h-96 bg-gradient-to-br from-cyan-200 to-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 pointer-events-none"></div>
    <div class="blob blob-delay absolute bottom-10 sm:bottom-20 left-5 sm:left-10 w-48 h-48 sm:w-64 sm:h-64 lg:w-80 lg:h-80 bg-gradient-to-br from-orange-200 to-amber-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 lg:gap-16 items-center">
            <!-- LEFT: Content -->
            <div class="text-center lg:text-left">
                <div class="fade-in flex justify-center lg:justify-start">
                    <span class="badge-pill">
                        <span class="badge-dot"></span>
                        Pendamping Ibadah Digital Terpercaya
                    </span>
                </div>
                <h1 class="fade-in-d1 text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-gray-900 leading-tight mb-4 sm:mb-6">
                    Lebih Dekat dengan<br>
                    <span class="gradient-text">Allah SWT</span>
                </h1>
                <p class="fade-in-d2 text-base sm:text-lg lg:text-xl text-gray-600 mb-6 sm:mb-8 lg:mb-10 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Al-Huda hadir sebagai pendamping ibadah harian Anda. Dari Al-Quran digital, jadwal shalat, hingga dzikir counter — semua dalam satu aplikasi.
                </p>
                <div class="fade-in-d3 flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
                    {{-- ✅ Langsung redirect ke register Breeze --}}
                    <a href="{{ route('register') }}" class="btn-shine inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-4 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm sm:text-base font-bold rounded-xl shadow-xl shadow-cyan-500/30 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        Mulai Sekarang
                    </a>
                    {{-- ✅ Langsung redirect ke login Breeze --}}
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-4 bg-white text-cyan-700 text-sm sm:text-base font-bold rounded-xl border-2 border-cyan-400 hover:border-cyan-600 hover:bg-cyan-50 transition-all duration-300 shadow-lg">
                        Sudah Punya Akun?
                    </a>
                </div>
                <div class="fade-in-d4 grid grid-cols-3 gap-4 sm:gap-6 lg:gap-8 mt-8 sm:mt-12 lg:mt-14 pt-6 sm:pt-8 lg:pt-10 border-t border-orange-200">
                    <div class="stat-item">
                        <div class="text-2xl sm:text-3xl lg:text-4xl font-extrabold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent">114</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1 sm:mt-2 font-medium">Surah Al-Quran</div>
                    </div>
                    <div class="stat-item">
                        <div class="text-2xl sm:text-3xl lg:text-4xl font-extrabold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent">99</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1 sm:mt-2 font-medium">Asmaul Husna</div>
                    </div>
                    <div class="stat-item">
                        <div class="text-2xl sm:text-3xl lg:text-4xl font-extrabold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent">50+</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1 sm:mt-2 font-medium">Doa Harian</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Mosque Illustration -->
            <div class="relative w-full max-w-md sm:max-w-lg mx-auto lg:mx-0 fade-in-d2 mt-8 lg:mt-0">
                <!-- Decorative Circle Background -->
                <div class="absolute -top-6 sm:-top-10 -left-6 sm:-left-10 w-24 h-24 sm:w-32 sm:h-32 lg:w-40 lg:h-40 bg-gradient-to-br from-orange-200 to-amber-200 rounded-full deco-circle opacity-60"></div>
                <div class="absolute -bottom-4 sm:-bottom-8 -right-4 sm:-right-8 w-20 h-20 sm:w-28 sm:h-28 lg:w-32 lg:h-32 bg-gradient-to-br from-cyan-200 to-teal-200 rounded-full deco-circle opacity-60" style="animation-delay: -2s;"></div>
                
                <!-- Decorative Stars -->
                <div class="absolute top-8 sm:top-16 right-8 sm:right-16 text-orange-300/40 deco-star">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-8 lg:h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <div class="absolute bottom-16 sm:bottom-24 left-12 sm:left-20 text-cyan-300/40 deco-star" style="animation-delay: -1.5s;">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>

                <!-- Main Mosque Illustration Card -->
                <div class="relative bg-gradient-to-br from-cyan-400 via-cyan-500 to-teal-500 rounded-3xl sm:rounded-[2.5rem] p-8 sm:p-10 lg:p-12 shadow-2xl shadow-cyan-500/40 float-animation mosque-illustration">
                    <svg viewBox="0 0 400 400" class="w-full h-auto" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <mask id="crescent">
                                <circle cx="200" cy="40" r="18" fill="white"/>
                                <circle cx="210" cy="40" r="16" fill="black"/>
                            </mask>
                        </defs>
                        <circle cx="200" cy="40" r="18" fill="#FFF7ED" mask="url(#crescent)"/>
                        <circle cx="150" cy="35" r="3" fill="#FFF7ED" opacity="0.8"/>
                        <circle cx="250" cy="30" r="2.5" fill="#FFF7ED" opacity="0.7"/>
                        <circle cx="180" cy="50" r="2" fill="#FFF7ED" opacity="0.6"/>
                        <ellipse cx="200" cy="140" rx="90" ry="70" fill="#14B8A6"/>
                        <ellipse cx="200" cy="135" rx="85" ry="65" fill="#0D9488"/>
                        <path d="M 110 140 Q 200 160 290 140" stroke="#FFF7ED" stroke-width="2" fill="none" opacity="0.3"/>
                        <ellipse cx="100" cy="170" rx="45" ry="35" fill="#14B8A6"/>
                        <ellipse cx="100" cy="167" rx="42" ry="32" fill="#0D9488"/>
                        <ellipse cx="300" cy="170" rx="45" ry="35" fill="#14B8A6"/>
                        <ellipse cx="300" cy="167" rx="42" ry="32" fill="#0D9488"/>
                        <rect x="75" y="120" width="35" height="140" rx="3" fill="#FFF7ED"/>
                        <rect x="78" y="120" width="29" height="140" rx="2" fill="#FFEDD5"/>
                        <line x1="80" y1="150" x2="105" y2="150" stroke="#E0E0E0" stroke-width="1"/>
                        <line x1="80" y1="180" x2="105" y2="180" stroke="#E0E0E0" stroke-width="1"/>
                        <line x1="80" y1="210" x2="105" y2="210" stroke="#E0E0E0" stroke-width="1"/>
                        <rect x="70" y="110" width="45" height="15" rx="2" fill="#14B8A6"/>
                        <ellipse cx="92.5" cy="100" rx="20" ry="15" fill="#0D9488"/>
                        <circle cx="92.5" cy="85" r="4" fill="#FFF7ED"/>
                        <path d="M 92.5 85 L 92.5 75 M 88 78 L 92.5 75 L 97 78" stroke="#FFF7ED" stroke-width="2" fill="none"/>
                        <rect x="290" y="120" width="35" height="140" rx="3" fill="#FFF7ED"/>
                        <rect x="293" y="120" width="29" height="140" rx="2" fill="#FFEDD5"/>
                        <line x1="295" y1="150" x2="320" y2="150" stroke="#E0E0E0" stroke-width="1"/>
                        <line x1="295" y1="180" x2="320" y2="180" stroke="#E0E0E0" stroke-width="1"/>
                        <line x1="295" y1="210" x2="320" y2="210" stroke="#E0E0E0" stroke-width="1"/>
                        <rect x="285" y="110" width="45" height="15" rx="2" fill="#14B8A6"/>
                        <ellipse cx="307.5" cy="100" rx="20" ry="15" fill="#0D9488"/>
                        <circle cx="307.5" cy="85" r="4" fill="#FFF7ED"/>
                        <path d="M 307.5 85 L 307.5 75 M 303 78 L 307.5 75 L 312 78" stroke="#FFF7ED" stroke-width="2" fill="none"/>
                        <rect x="120" y="200" width="160" height="100" rx="5" fill="#FFF7ED"/>
                        <rect x="125" y="200" width="150" height="100" rx="4" fill="#FFEDD5"/>
                        <rect x="145" y="220" width="25" height="35" rx="12" fill="#14B8A6"/>
                        <rect x="185" y="220" width="25" height="35" rx="12" fill="#14B8A6"/>
                        <rect x="225" y="220" width="25" height="35" rx="12" fill="#14B8A6"/>
                        <path d="M 175 270 Q 175 260 185 260 L 215 260 Q 225 260 225 270 L 225 300 L 175 300 Z" fill="#0D9488"/>
                        <circle cx="218" cy="285" r="3" fill="#FFF7ED"/>
                        <path d="M 200 260 L 200 300" stroke="#FFF7ED" stroke-width="2"/>
                        <ellipse cx="120" cy="310" rx="80" ry="25" fill="#10B981" opacity="0.6"/>
                        <ellipse cx="280" cy="315" rx="70" ry="20" fill="#10B981" opacity="0.5"/>
                        <ellipse cx="200" cy="320" rx="100" ry="30" fill="#059669" opacity="0.4"/>
                    </svg>
                </div>

                <!-- Bottom decorative wave -->
                <div class="absolute -bottom-4 sm:-bottom-6 left-0 right-0 h-12 sm:h-16 lg:h-20 opacity-20">
                    <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-full">
                        <path d="M0,0 C150,80 350,80 600,40 C850,0 1050,0 1200,40 L1200,120 L0,120 Z" fill="#06B6D4"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES SECTION -->
<section class="py-16 sm:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-orange-50 to-amber-50 relative">
    <!-- Top Wave -->
    <div class="absolute top-0 left-0 right-0 h-12 sm:h-16 lg:h-20">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-full">
            <path d="M0,60 C300,100 900,100 1200,60 L1200,0 L0,0 Z" fill="white"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-12 sm:mb-16 lg:mb-20 reveal">
            <p class="text-xs font-bold text-cyan-600 uppercase tracking-widest mb-3 sm:mb-4">Apa yang Kami Sediakan</p>
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 sm:mb-6 heading-underline inline-block px-4">
                Fitur Lengkap untuk Ibadah Anda
            </h2>
            <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto mt-6 sm:mt-8 leading-relaxed px-4">
                Semua yang Anda butuhkan untuk mendekatkan diri kepada Allah SWT dalam satu aplikasi
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8">
            <!-- Feature 1: Al-Quran Digital -->
            <div class="feature-card reveal reveal-d1 bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 border-2 border-orange-100/50 shadow-lg hover:border-cyan-300">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-cyan-400 to-teal-500 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 shadow-lg shadow-cyan-500/30">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Al-Quran Digital</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed">Baca Al-Quran dengan terjemahan Indonesia, audio murottal, dan tafsir lengkap</p>
            </div>

            <!-- Feature 2: Jadwal Shalat -->
            <div class="feature-card reveal reveal-d2 bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 border-2 border-orange-100/50 shadow-lg hover:border-cyan-300">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-cyan-400 to-teal-500 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 shadow-lg shadow-cyan-500/30">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm4.2 14.2L11 13V7h1.5v5.2l4.5 2.7-.8 1.3z"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Jadwal Shalat</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed">Waktu shalat akurat berdasarkan lokasi Anda dengan notifikasi adzan</p>
            </div>

            <!-- Feature 3: Tasbih Digital -->
            <div class="feature-card reveal reveal-d3 bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 border-2 border-orange-100/50 shadow-lg hover:border-cyan-300">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-cyan-400 to-teal-500 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 shadow-lg shadow-cyan-500/30">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="2.5"/>
                        <circle cx="12" cy="4.5" r="2.5"/>
                        <circle cx="12" cy="19.5" r="2.5"/>
                        <circle cx="4.5" cy="12" r="2.5"/>
                        <circle cx="19.5" cy="12" r="2.5"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Tasbih Digital</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed">Hitung dzikir dengan mudah dan simpan progres harian Anda</p>
            </div>

            <!-- Feature 4: Arah Kiblat -->
            <div class="feature-card reveal reveal-d4 bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 border-2 border-orange-100/50 shadow-lg hover:border-cyan-300">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-cyan-400 to-teal-500 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 shadow-lg shadow-cyan-500/30">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        <path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Arah Kiblat</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed">Temukan arah kiblat dengan kompas digital yang akurat</p>
            </div>

            <!-- Feature 5: Doa Harian -->
            <div class="feature-card reveal reveal-d5 bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 border-2 border-orange-100/50 shadow-lg hover:border-cyan-300">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-cyan-400 to-teal-500 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 shadow-lg shadow-cyan-500/30">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <defs>
                            <mask id="cm">
                                <rect width="24" height="24" fill="white"/>
                                <circle cx="14" cy="10" r="7" fill="black"/>
                            </mask>
                        </defs>
                        <circle cx="10" cy="14" r="8" mask="url(#cm)"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Doa Harian</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed">Kumpulan doa-doa pilihan untuk berbagai keperluan sehari-hari</p>
            </div>

            <!-- Feature 6: Tracking Shalat -->
            <div class="feature-card reveal reveal-d6 bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 border-2 border-orange-100/50 shadow-lg hover:border-cyan-300">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-cyan-400 to-teal-500 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 shadow-lg shadow-cyan-500/30">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 2v2H7v2h10V4h-2V2h2c1.1 0 2 .9 2 2v16c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h2zm3 10c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-6 6h12v-1.5c0-2-4-3-6-3s-6 1-6 3V18z"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Tracking Shalat</h3>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed">Pantau dan catat pelaksanaan shalat lima waktu Anda setiap hari</p>
            </div>
        </div>
    </div>

    <!-- Bottom Wave -->
    <div class="absolute bottom-0 left-0 right-0 h-12 sm:h-16 lg:h-20">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-full">
            <path d="M0,60 C300,20 900,20 1200,60 L1200,120 L0,120 Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-16 sm:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-cyan-500 via-teal-500 to-emerald-500 relative overflow-hidden">
    <!-- Decorative Circles -->
    <div class="absolute -top-12 sm:-top-24 -right-12 sm:-right-24 w-48 h-48 sm:w-80 sm:h-80 lg:w-96 lg:h-96 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-12 sm:-bottom-24 -left-12 sm:-left-24 w-40 h-40 sm:w-64 sm:h-64 lg:w-80 lg:h-80 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    
    <div class="max-w-4xl mx-auto text-center relative z-10 reveal">
        <p class="text-cyan-100 text-xs font-bold uppercase tracking-widest mb-4 sm:mb-5">Bergabung Sekarang</p>
        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white mb-6 sm:mb-8 leading-tight px-4">
            Siap Memulai Perjalanan<br class="hidden sm:block">Spiritual Anda?
        </h2>
        <p class="text-base sm:text-lg lg:text-xl text-cyan-50 mb-8 sm:mb-10 lg:mb-12 max-w-2xl mx-auto leading-relaxed px-4">
            Bergabunglah dengan ribuan Muslim yang sudah menjadikan Al-Huda sebagai pendamping ibadah harian mereka
        </p>
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-5 justify-center px-4">
            {{-- ✅ Langsung ke register Breeze --}}
            <a href="{{ route('register') }}" class="btn-shine inline-flex items-center justify-center px-8 py-4 sm:px-10 sm:py-5 bg-white text-cyan-700 font-bold text-base sm:text-lg rounded-xl shadow-2xl hover:shadow-white/20 hover:scale-105 transition-all duration-300">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Daftar Gratis Sekarang
            </a>
            {{-- ✅ Langsung ke login Breeze --}}
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 sm:px-10 sm:py-5 bg-cyan-600/60 backdrop-blur-sm text-white font-bold text-base sm:text-lg rounded-xl border-2 border-white/30 hover:bg-cyan-700 hover:border-white/50 transition-all duration-300 shadow-lg">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-gray-900 text-white py-12 sm:py-14 lg:py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10 lg:gap-12 mb-8 sm:mb-10 lg:mb-12">
            <!-- Column 1: About -->
            <div>
                <div class="flex items-center space-x-3 mb-4 sm:mb-5">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg">
                        <!-- TASBIH ICON FOOTER -->
                        <svg viewBox="0 0 100 120" class="w-6 h-6 sm:w-7 sm:h-7" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <span class="text-xl sm:text-2xl font-bold">Al-Huda</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Pendamping ibadah digital untuk Muslim modern. Mendekatkan diri kepada Allah dengan teknologi.
                </p>
            </div>

            <!-- Column 2: Features -->
            <div>
                <h3 class="font-bold text-base sm:text-lg mb-4 sm:mb-6 text-gray-200">Fitur Utama</h3>
                <ul class="space-y-2 sm:space-y-3 text-sm text-gray-400">
                    <li><a href="{{ route('register') }}" class="footer-link hover:text-cyan-400">Al-Quran Digital</a></li>
                    <li><a href="{{ route('register') }}" class="footer-link hover:text-cyan-400">Jadwal Shalat</a></li>
                    <li><a href="{{ route('register') }}" class="footer-link hover:text-cyan-400">Tasbih Digital</a></li>
                    <li><a href="{{ route('register') }}" class="footer-link hover:text-cyan-400">Arah Kiblat</a></li>
                </ul>
            </div>

            <!-- Column 3: Contact -->
            <div>
                <h3 class="font-bold text-base sm:text-lg mb-4 sm:mb-6 text-gray-200">Hubungi Kami</h3>
                <ul class="space-y-3 sm:space-y-4 text-sm text-gray-400">
                    <li class="flex items-center space-x-2 sm:space-x-3">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>info@al-huda.app</span>
                    </li>
                    <li class="flex items-center space-x-2 sm:space-x-3">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800 pt-6 sm:pt-8 text-center text-xs sm:text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} Al-Huda. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>

<!-- JAVASCRIPT -->
<script>
    // Navbar scroll effect
    const nav = document.getElementById('main-nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            nav.classList.add('nav-scrolled');
        } else {
            nav.classList.remove('nav-scrolled');
        }
    });

    // Intersection Observer for reveal animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -30px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>