<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NurSteps') }} - Pendamping Ibadah Anda</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- ★ IKLAN IN-CONTENT — tampil di bawah header, sebelum konten utama --}}
            {{--
                'page' bisa diisi sesuai nama halaman masing-masing.
                Untuk global (semua halaman), biarkan tanpa parameter 'page'.
                Jika ingin per-halaman, set variable $adPage di tiap controller:
                    return view('quran.index', ['adPage' => 'quran', ...]);
            --}}
            @include('components.ad-banner', [
                'position' => 'in_content',
                'page'     => $adPage ?? 'all',
            ])

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        {{-- ★ IKLAN FOOTER STICKY — tampil di bawah layar --}}
        @include('components.ad-banner', [
            'position' => 'footer_sticky',
            'page'     => $adPage ?? 'all',
        ])

        @stack('scripts')

        {{-- ★ Azan Service Worker + Audio Player --}}
        @auth
        <script>
        // Register service worker azan
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/azan-sw.js', { scope: '/' })
                .then(() => console.log('[Azan SW] Registered'))
                .catch(err => console.warn('[Azan SW] Failed:', err));

            // Terima pesan PLAY_AZAN dari service worker
            navigator.serviceWorker.addEventListener('message', (event) => {
                if (event.data?.type === 'PLAY_AZAN') {
                    playAzan(event.data.audioUrl, event.data.label, event.data.emoji);
                }
            });
        }

        // Play audio azan di tab
        let _azanAudio = null;

        function playAzan(audioUrl, label, emoji) {
            if (_azanAudio) { _azanAudio.pause(); _azanAudio = null; }
            _azanAudio = new Audio(audioUrl);
            _azanAudio.play().catch(() => showAzanBanner(label, emoji, audioUrl));
            _azanAudio.onended = () => { _azanAudio = null; };
            showAzanBanner(label, emoji, null);
        }

        // Banner notifikasi azan di halaman
        function showAzanBanner(label, emoji, audioUrl) {
            const old = document.getElementById('azanBanner');
            if (old) old.remove();

            const banner = document.createElement('div');
            banner.id = 'azanBanner';
            banner.style.cssText = [
                'position:fixed', 'top:20px', 'left:50%', 'transform:translateX(-50%)',
                'z-index:9999', 'min-width:320px', 'max-width:90vw',
                'background:linear-gradient(135deg,#0d9488,#059669)',
                'color:white', 'border-radius:16px', 'padding:16px 20px',
                'box-shadow:0 20px 60px rgba(0,0,0,0.3)',
                'display:flex', 'align-items:center', 'gap:12px',
                'animation:azanSlide 0.4s cubic-bezier(0.34,1.56,0.64,1)',
                'font-family:inherit'
            ].join(';');

            banner.innerHTML = `
                <style>
                    @keyframes azanSlide {
                        from { transform:translateX(-50%) translateY(-100px); opacity:0; }
                        to   { transform:translateX(-50%) translateY(0); opacity:1; }
                    }
                </style>
                <span style="font-size:2rem">${emoji}</span>
                <div style="flex:1">
                    <div style="font-weight:700;font-size:1rem">Waktu ${label}</div>
                    <div style="font-size:0.75rem;opacity:0.85">Allahu Akbar...</div>
                </div>
                ${audioUrl ? `<button onclick="(new Audio('${audioUrl}')).play()" style="background:rgba(255,255,255,0.2);border:none;color:white;padding:8px 12px;border-radius:8px;cursor:pointer;font-size:0.8rem;font-weight:600">▶ Play</button>` : ''}
                <button onclick="document.getElementById('azanBanner').remove()" style="background:rgba(255,255,255,0.2);border:none;color:white;width:28px;height:28px;border-radius:50%;cursor:pointer;font-size:1rem">✕</button>
            `;

            document.body.appendChild(banner);
            setTimeout(() => { const b = document.getElementById('azanBanner'); if (b) b.remove(); }, 30000);
        }
        </script>
        @endauth
    </body>
</html>