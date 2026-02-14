<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Al-Huda - Preview</title>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Figtree', sans-serif; }

        @keyframes float {
            0%,100% { transform: translateY(0px); }
            50%      { transform: translateY(-18px); }
        }
        .float-animation { animation: float 6s ease-in-out infinite; }

        @keyframes fadeInUp {
            from { opacity:0; transform:translateY(24px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .fade-in    { animation: fadeInUp .7s ease-out 0s    both; }
        .fade-in-d1 { animation: fadeInUp .7s ease-out .15s  both; }
        .fade-in-d2 { animation: fadeInUp .7s ease-out .30s  both; }
        .fade-in-d3 { animation: fadeInUp .7s ease-out .45s  both; }
        .fade-in-d4 { animation: fadeInUp .7s ease-out .60s  both; }

        .gradient-text {
            background: linear-gradient(135deg,#14b8a6,#10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes badgePulse {
            0%,100% { box-shadow: 0 0 0 0 rgba(20,184,166,.4); }
            60%      { box-shadow: 0 0 0 7px rgba(20,184,166,0); }
        }
        .badge-pill {
            display:inline-flex; align-items:center; gap:8px;
            background:rgba(20,184,166,.10);
            border:1.5px solid rgba(20,184,166,.30);
            color:#0d9488; font-size:.78rem; font-weight:600;
            padding:5px 14px; border-radius:999px; letter-spacing:.03em;
            animation: badgePulse 2.8s ease-in-out infinite;
            margin-bottom:18px; width:fit-content;
        }
        .badge-dot {
            width:7px; height:7px; border-radius:50%;
            background:#14b8a6; flex-shrink:0;
        }

        .feature-card {
            transition: transform .32s cubic-bezier(.34,1.56,.64,1), box-shadow .32s ease;
            transform: scale(1);
        }
        .feature-card:hover {
            transform: scale(1.05) !important;
            box-shadow: 0 28px 50px rgba(20,184,166,.16), 0 8px 20px rgba(0,0,0,.07);
        }

        .reveal {
            opacity:0; transform:translateY(32px);
            transition: opacity .65s ease, transform .65s ease;
        }
        .reveal.visible { opacity:1; transform:translateY(0); }
        .reveal-d1{transition-delay:.05s} .reveal-d2{transition-delay:.15s}
        .reveal-d3{transition-delay:.25s} .reveal-d4{transition-delay:.35s}
        .reveal-d5{transition-delay:.45s} .reveal-d6{transition-delay:.55s}

        .btn-shine { position:relative; overflow:hidden; }
        .btn-shine::after {
            content:''; position:absolute;
            top:-50%; left:-75%; width:50%; height:200%;
            background:rgba(255,255,255,.22); transform:skewX(-20deg);
            transition:left .55s ease;
        }
        .btn-shine:hover::after { left:130%; }

        .heading-underline { position:relative; padding-bottom:12px; }
        .heading-underline::after {
            content:''; position:absolute; bottom:0; left:50%; transform:translateX(-50%);
            width:52px; height:3px;
            background:linear-gradient(90deg,#14b8a6,#10b981); border-radius:2px;
        }

        .nav-scrolled { box-shadow: 0 4px 24px rgba(0,0,0,.09) !important; }

        @keyframes blob {
            0%,100% { border-radius:60% 40% 30% 70%/60% 30% 70% 40%; }
            50%      { border-radius:30% 60% 70% 40%/50% 60% 30% 60%; }
        }
        .blob { animation: blob 9s ease-in-out infinite, float 11s ease-in-out infinite; }
        .blob-delay { animation-delay:-5s; }

        .stat-item { opacity:0; transform:translateY(12px); animation:fadeInUp .5s ease-out both; }
        .stat-item:nth-child(1){animation-delay:.6s}
        .stat-item:nth-child(2){animation-delay:.75s}
        .stat-item:nth-child(3){animation-delay:.9s}

        .footer-link { transition: color .2s, padding-left .2s; }
        .footer-link:hover { color:#2dd4bf; padding-left:5px; }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-teal-50 via-white to-emerald-50">

<!-- NAVBAR -->
<nav id="main-nav" class="fixed top-0 w-full bg-white/90 backdrop-blur-md z-50 border-b border-teal-100 transition-shadow duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-lg flex items-center justify-center shadow-md">
                    <svg viewBox="0 0 120 120" class="w-6 h-6" fill="none">
                        <path d="M60 8 Q65 12 60 16" stroke="white" stroke-width="3" fill="none"/>
                        <circle cx="48" cy="22" r="6" fill="white"/><circle cx="60" cy="20" r="6" fill="white"/>
                        <circle cx="72" cy="22" r="6" fill="white"/><circle cx="44" cy="34" r="6" fill="white"/>
                        <circle cx="76" cy="34" r="6" fill="white"/><circle cx="46" cy="48" r="6" fill="white"/>
                        <circle cx="74" cy="48" r="6" fill="white"/><circle cx="52" cy="62" r="6" fill="white"/>
                        <circle cx="68" cy="62" r="6" fill="white"/>
                        <path d="M56 72 L54 84 M60 72 L60 88 M64 72 L66 84" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-teal-700">Al-Huda</span>
            </div>
            <div class="flex items-center space-x-3">
                <a href="#" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-teal-700 transition-colors">Masuk</a>
                <a href="#" class="btn-shine px-6 py-2 bg-gradient-to-r from-teal-500 to-emerald-500 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-all duration-200">Daftar Gratis</a>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="blob absolute top-16 right-8 w-80 h-80 bg-teal-200 rounded-full mix-blend-multiply filter blur-2xl opacity-20 pointer-events-none"></div>
    <div class="blob blob-delay absolute bottom-16 left-8 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-2xl opacity-20 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="fade-in">
                    <span class="badge-pill">
                        <span class="badge-dot"></span>
                            Pendamping Ibadah Digital Terpercaya
                    </span>
                </div>
                <h1 class="fade-in-d1 text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    Lebih Dekat dengan<br>
                    <span class="gradient-text">Allah SWT</span>
                </h1>
                <p class="fade-in-d2 text-lg sm:text-xl text-gray-600 mb-8 leading-relaxed">
                    Al-Huda hadir sebagai pendamping ibadah harian Anda. Dari Al-Quran digital, jadwal shalat, hingga dzikir counter — semua dalam satu aplikasi.
                </p>
                <div class="fade-in-d3 flex flex-col sm:flex-row gap-4">
                    <a href="#" class="btn-shine inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        Mulai Sekarang
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-white text-teal-700 font-semibold rounded-xl border-2 border-teal-400 hover:border-teal-600 hover:bg-teal-50 transition-all duration-200">
                        Sudah Punya Akun?
                    </a>
                </div>
                <div class="fade-in-d4 grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-gray-200">
                    <div class="stat-item"><div class="text-3xl font-bold text-teal-600">114</div><div class="text-sm text-gray-500 mt-1">Surah Al-Quran</div></div>
                    <div class="stat-item"><div class="text-3xl font-bold text-teal-600">99</div><div class="text-sm text-gray-500 mt-1">Asmaul Husna</div></div>
                    <div class="stat-item"><div class="text-3xl font-bold text-teal-600">50+</div><div class="text-sm text-gray-500 mt-1">Doa Harian</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 reveal">
            <p class="text-xs font-bold text-teal-500 uppercase tracking-widest mb-3">Apa yang Kami Sediakan</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 heading-underline inline-block">Fitur Lengkap untuk Ibadah Anda</h2>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto mt-6">Semua yang Anda butuhkan untuk mendekatkan diri kepada Allah SWT dalam satu aplikasi</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            <div class="feature-card reveal reveal-d1 bg-gradient-to-br from-teal-50 to-white rounded-2xl p-8 border border-teal-100/50">
                <div class="feature-icon w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-5 shadow-md">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Al-Quran Digital</h3>
                <p class="text-gray-500 leading-relaxed">Baca Al-Quran dengan terjemahan Indonesia, audio murottal, dan tafsir lengkap</p>
            </div>

            <div class="feature-card reveal reveal-d2 bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-8 border border-emerald-100/50">
                <div class="feature-icon w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-5 shadow-md">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm4.2 14.2L11 13V7h1.5v5.2l4.5 2.7-.8 1.3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Jadwal Shalat</h3>
                <p class="text-gray-500 leading-relaxed">Waktu shalat akurat berdasarkan lokasi Anda dengan notifikasi adzan</p>
            </div>

            <div class="feature-card reveal reveal-d3 bg-gradient-to-br from-teal-50 to-white rounded-2xl p-8 border border-teal-100/50">
                <div class="feature-icon w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-5 shadow-md">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2.2"/><circle cx="12" cy="4.8" r="2.2"/><circle cx="12" cy="19.2" r="2.2"/><circle cx="4.8" cy="12" r="2.2"/><circle cx="19.2" cy="12" r="2.2"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Tasbih Digital</h3>
                <p class="text-gray-500 leading-relaxed">Hitung dzikir dengan mudah dan simpan progres harian Anda</p>
            </div>

            <div class="feature-card reveal reveal-d4 bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-8 border border-emerald-100/50">
                <div class="feature-icon w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-5 shadow-md">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Arah Kiblat</h3>
                <p class="text-gray-500 leading-relaxed">Temukan arah kiblat dengan kompas digital yang akurat</p>
            </div>

            <div class="feature-card reveal reveal-d5 bg-gradient-to-br from-teal-50 to-white rounded-2xl p-8 border border-teal-100/50">
                <div class="feature-icon w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-5 shadow-md">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <defs><mask id="cm"><rect width="24" height="24" fill="white"/><circle cx="14" cy="10" r="7" fill="black"/></mask></defs>
                        <circle cx="10" cy="14" r="8" mask="url(#cm)"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Doa Harian</h3>
                <p class="text-gray-500 leading-relaxed">Kumpulan doa-doa pilihan untuk berbagai keperluan sehari-hari</p>
            </div>

            <div class="feature-card reveal reveal-d6 bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-8 border border-emerald-100/50">
                <div class="feature-icon w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center mb-5 shadow-md">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M9 2v2H7v2h10V4h-2V2h2c1.1 0 2 .9 2 2v16c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h2zm3 10c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-6 6h12v-1.5c0-2-4-3-6-3s-6 1-6 3V18z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Tracking Shalat</h3>
                <p class="text-gray-500 leading-relaxed">Pantau dan catat pelaksanaan shalat lima waktu Anda setiap hari</p>
            </div>

        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-teal-500 to-emerald-500 relative overflow-hidden">
    <div class="absolute -top-20 -right-20 w-72 h-72 bg-white/10 rounded-full pointer-events-none"></div>
    <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-white/10 rounded-full pointer-events-none"></div>
    <div class="max-w-4xl mx-auto text-center relative z-10 reveal">
        <p class="text-teal-100 text-xs font-bold uppercase tracking-widest mb-4">Bergabung Sekarang</p>
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">Siap Memulai Perjalanan Spiritual Anda?</h2>
        <p class="text-lg text-teal-50 mb-10 max-w-2xl mx-auto">Bergabunglah dengan ribuan Muslim yang sudah menjadikan Al-Huda sebagai pendamping ibadah harian mereka</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="btn-shine inline-flex items-center justify-center px-8 py-4 bg-white text-teal-700 font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Daftar Gratis Sekarang
            </a>
            <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-teal-600/60 text-white font-semibold rounded-xl border-2 border-white/25 hover:bg-teal-700 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Masuk
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-gray-900 text-white py-14 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-3 gap-10 mb-10">
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-lg flex items-center justify-center">
                        <svg viewBox="0 0 120 120" class="w-6 h-6" fill="none">
                            <circle cx="48" cy="22" r="6" fill="white"/><circle cx="60" cy="20" r="6" fill="white"/>
                            <circle cx="72" cy="22" r="6" fill="white"/><circle cx="52" cy="62" r="6" fill="white"/>
                            <circle cx="68" cy="62" r="6" fill="white"/>
                            <path d="M56 72 L54 84 M60 72 L60 88 M64 72 L66 84" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold">Al-Huda</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">Pendamping ibadah digital untuk Muslim modern. Mendekatkan diri kepada Allah dengan teknologi.</p>
            </div>
            <div>
                <h3 class="font-semibold mb-5 text-gray-200">Fitur Utama</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="footer-link">Al-Quran Digital</a></li>
                    <li><a href="#" class="footer-link">Jadwal Shalat</a></li>
                    <li><a href="#" class="footer-link">Tasbih Digital</a></li>
                    <li><a href="#" class="footer-link">Arah Kiblat</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold mb-5 text-gray-200">Hubungi Kami</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>info@al-huda.app</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-500">
            <p>&copy; 2025 Al-Huda. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>

<script>
    const nav = document.getElementById('main-nav');
    window.addEventListener('scroll', () => nav.classList.toggle('nav-scrolled', window.scrollY > 24));
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); io.unobserve(e.target); }});
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>
</body>
</html>