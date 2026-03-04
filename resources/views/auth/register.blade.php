<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Akun - NurSteps</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --teal-deep: #0d9488;
            --teal-mid:  #14b8a6;
            --teal-light:#5eead4;
            --teal-pale: #ccfbf1;
            --text-dark: #1e293b;
            --text-mid:  #475569;
            --text-soft: #94a3b8;
        }

        html, body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f0fdfa;
        }

        /* ===================== COVER PANEL ===================== */
        .cover-panel {
            flex: 1 1 50%;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 48px 40px;
            overflow: hidden;
            background: linear-gradient(145deg, #0a7a71 0%, #0d9488 35%, #14b8a6 70%, #2dd4bf 100%);
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.25;
            animation: drift 8s ease-in-out infinite;
        }
        .blob-1 { width: 420px; height: 420px; background: #5eead4; top: -120px; left: -100px; animation-delay: 0s; }
        .blob-2 { width: 300px; height: 300px; background: #0f766e; bottom: -80px; right: -80px; animation-delay: -3s; }
        .blob-3 { width: 200px; height: 200px; background: #a7f3d0; top: 50%; left: 60%; animation-delay: -5s; }

        @keyframes drift {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(20px, -30px) scale(1.05); }
            66%       { transform: translate(-15px, 20px) scale(0.95); }
        }

        .pattern-overlay {
            position: absolute;
            inset: 0;
            opacity: 0.06;
            background-image:
                repeating-linear-gradient(60deg, white 0px, white 1px, transparent 1px, transparent 30px),
                repeating-linear-gradient(-60deg, white 0px, white 1px, transparent 1px, transparent 30px),
                repeating-linear-gradient(0deg, white 0px, white 1px, transparent 1px, transparent 30px);
            background-size: 35px 60px;
        }

        .cover-content {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
            max-width: 480px;
            animation: fadeSlideIn 0.9s ease-out both;
        }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .cover-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 32px;
        }

        .nur-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            animation: float 4s ease-in-out infinite;
        }

        .nur-icon { width: 64px; height: 64px; display: block; border-radius: 50%; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-8px); }
        }

        .cover-brand-name {
            font-size: 32px;
            font-weight: 800;
            color: white;
            letter-spacing: -0.5px;
        }

        .cover-headline {
            font-size: clamp(22px, 2.8vw, 38px);
            font-weight: 800;
            color: white;
            line-height: 1.2;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .cover-headline span {
            display: block;
            color: var(--teal-pale);
            font-style: italic;
        }

        .cover-sub {
            font-size: clamp(13px, 1.2vw, 15px);
            color: rgba(255,255,255,0.8);
            line-height: 1.7;
            margin-bottom: 28px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 28px;
        }

        .pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 100px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            color: white;
            backdrop-filter: blur(4px);
            transition: background 0.2s;
        }

        .pill:hover { background: rgba(255,255,255,0.2); }

        .pill-icon {
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .arabic-quote {
            font-family: 'Amiri', serif;
            font-size: 20px;
            color: rgba(255,255,255,0.6);
            border-top: 1px solid rgba(255,255,255,0.2);
            padding-top: 20px;
            direction: rtl;
            letter-spacing: 1px;
        }

        .arabic-quote-trans {
            font-size: 12px;
            color: rgba(255,255,255,0.5);
            margin-top: 6px;
            direction: ltr;
            font-style: italic;
        }

        .deco-top {
            position: absolute;
            top: 32px;
            right: 32px;
            opacity: 0.3;
        }

        .deco-circles {
            position: absolute;
            bottom: 40px;
            left: 40px;
            display: flex;
            gap: 10px;
            opacity: 0.3;
        }

        .deco-circle {
            border-radius: 50%;
            border: 2px solid white;
        }

        /* ===================== FORM PANEL ===================== */
        .form-panel {
            flex: 0 0 430px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 36px;
            background: white;
            overflow-y: auto;
            min-height: 100vh;
        }

        .form-inner {
            width: 100%;
            max-width: 360px;
            margin: auto;
            animation: fadeSlideIn 0.7s 0.2s ease-out both;
        }

        .form-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }

        .form-subtitle {
            font-size: 14px;
            color: var(--text-soft);
            margin-bottom: 28px;
        }

        /* Form groups */
        .form-group { margin-bottom: 15px; position: relative; }

        .input-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            position: relative;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            background: #f8fafc;
            transition: border-color 0.25s, box-shadow 0.25s, background 0.25s, opacity 0.3s;
        }

        .input-wrapper:hover   { border-color: var(--teal-mid); }
        .input-wrapper.focused { border-color: var(--teal-deep); box-shadow: 0 0 0 3px rgba(13,148,136,0.12); background: white; }
        .input-wrapper.error   { border-color: #ef4444; box-shadow: 0 0 0 3px rgba(239,68,68,0.1); background: #fff8f8; }
        .input-wrapper.valid   { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,0.1); background: #f0fdf4; }
        .input-wrapper.locked  { opacity: 0.45; pointer-events: none; background: #f1f5f9; }

        .input-icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            width: 17px; height: 17px; color: var(--teal-mid); pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 13px 14px 13px 44px;
            border: none; background: transparent;
            font-size: 14px; color: var(--text-dark);
            font-family: inherit; outline: none;
        }

        .form-input.has-eye { padding-right: 44px; }
        .form-input::placeholder { color: var(--text-soft); }
        .form-input:disabled { cursor: not-allowed; }

        .status-icon {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            width: 15px; height: 15px; display: none; pointer-events: none;
        }
        .input-wrapper.valid .status-icon.ok  { display: block; color: #10b981; }
        .input-wrapper.error .status-icon.err { display: block; color: #ef4444; }

        .eye-toggle {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            display: flex; align-items: center; color: var(--text-soft);
            transition: color 0.2s; padding: 4px;
        }
        .eye-toggle:hover { color: var(--teal-deep); }
        .eye-toggle svg { width: 18px; height: 18px; }

        .field-error {
            display: none;
            font-size: 11.5px; color: #ef4444;
            margin-top: 5px; margin-left: 4px;
            animation: fadeIn 0.2s ease;
        }
        .field-error.show { display: block; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-3px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Password strength */
        .password-strength { display: none; margin-top: 8px; }
        .password-strength.show { display: block; }
        .strength-bars { display: flex; gap: 4px; margin-bottom: 4px; }
        .strength-bar { height: 4px; flex: 1; border-radius: 2px; background: #e2e8f0; transition: background 0.3s; }
        .strength-label { font-size: 11px; color: #718096; }

        /* Register button */
        .register-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            background: linear-gradient(135deg, #0d9488, #14b8a6);
            color: white;
            box-shadow: 0 6px 20px rgba(13,148,136,0.35);
            transition: all 0.25s;
            letter-spacing: 0.5px;
            margin-top: 18px;
        }
        .register-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(13,148,136,0.45); }
        .register-btn:active { transform: translateY(0); }

        .terms {
            font-size: 11px;
            color: var(--text-soft);
            margin-top: 14px;
            line-height: 1.6;
            text-align: center;
        }
        .terms a { color: var(--teal-deep); text-decoration: none; font-weight: 600; }
        .terms a:hover { text-decoration: underline; }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 18px 0 0;
        }
        .divider-line { flex: 1; height: 1px; background: #e2e8f0; }
        .divider-text { font-size: 12px; color: var(--text-soft); font-weight: 500; }

        .login-line {
            margin-top: 16px;
            font-size: 14px;
            color: var(--text-mid);
            text-align: center;
        }
        .login-line a {
            color: var(--teal-deep);
            font-weight: 700;
            text-decoration: none;
        }
        .login-line a:hover { text-decoration: underline; }

        .error-box {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .form-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 11px;
            color: var(--text-soft);
        }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 900px) {
            body { flex-direction: column; }

            .cover-panel {
                position: relative;
                height: auto;
                min-height: auto;
                padding: 36px 24px 32px;
            }

            .cover-content { max-width: 100%; }
            .cover-headline { font-size: clamp(20px, 5vw, 28px); }
            .cover-sub { font-size: 14px; margin-bottom: 20px; }
            .cover-logo { margin-bottom: 20px; }
            .steps-list { display: none; }
            .feature-pills { margin-bottom: 20px; }
            .arabic-quote { display: none; }
            .deco-circles { display: none; }
            .deco-top { display: none; }

            .form-panel {
                flex: 1;
                min-height: auto;
                padding: 32px 24px 40px;
            }

            .form-inner { margin: 0 auto; }
        }

        @media (max-width: 480px) {
            .cover-panel { padding: 28px 16px 24px; }
            .cover-headline { font-size: clamp(18px, 6vw, 24px); }
            .cover-sub { font-size: 13px; }
            .nur-circle { width: 48px; height: 48px; }
            .nur-icon { width: 48px; height: 48px; }
            .cover-brand-name { font-size: 24px; }
            .form-panel { padding: 28px 16px 36px; }
        }
    </style>
</head>
<body>

    <!-- =========== LEFT: COVER PANEL =========== -->
    <div class="cover-panel">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
        <div class="pattern-overlay"></div>

        <svg class="deco-top" width="80" height="80" viewBox="0 0 80 80" fill="none">
            <path d="M55 40c0 13.255-10.745 24-24 24-3.5 0-6.82-.75-9.82-2.09C26.5 64.6 32 66 38 66c14.912 0 27-12.088 27-27 0-6-.2-11.5-2.09-16.18C64.25 25.82 65 29.14 65 32.64 65 36.73 60 40 55 40z" fill="white" opacity="0.5"/>
            <circle cx="62" cy="18" r="3" fill="white" opacity="0.6"/>
            <circle cx="70" cy="28" r="2" fill="white" opacity="0.4"/>
            <circle cx="55" cy="10" r="1.5" fill="white" opacity="0.5"/>
        </svg>

        <div class="cover-content">
            <!-- Logo -->
            <div class="cover-logo">
                <div class="nur-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" class="nur-icon">
                        <defs>
                            <clipPath id="circleClip"><circle cx="512" cy="512" r="512"/></clipPath>
                            <radialGradient id="bgGrad" cx="50%" cy="45%" r="65%">
                                <stop offset="0%" stop-color="#2ecf8e"/>
                                <stop offset="100%" stop-color="#1aaa72"/>
                            </radialGradient>
                            <filter id="glow" x="-40%" y="-40%" width="180%" height="180%">
                                <feGaussianBlur in="SourceGraphic" stdDeviation="28" result="blur1"/>
                                <feGaussianBlur in="SourceGraphic" stdDeviation="12" result="blur2"/>
                                <feColorMatrix in="blur1" type="matrix" values="0 0 0 0 0.5 0 0 0 0 1 0 0 0 0 0.7 0 0 0 0.6 0" result="colorBlur"/>
                                <feMerge><feMergeNode in="colorBlur"/><feMergeNode in="blur2"/><feMergeNode in="SourceGraphic"/></feMerge>
                            </filter>
                            <radialGradient id="centerGlow" cx="52%" cy="48%" r="35%">
                                <stop offset="0%" stop-color="white" stop-opacity="0.08"/>
                                <stop offset="100%" stop-color="transparent" stop-opacity="0"/>
                            </radialGradient>
                        </defs>
                        <g clip-path="url(#circleClip)">
                            <rect width="1024" height="1024" fill="url(#bgGrad)"/>
                            <rect width="1024" height="1024" fill="url(#centerGlow)"/>
                            <text x="510" y="570" text-anchor="middle" dominant-baseline="middle"
                                font-family="'Noto Naskh Arabic','Arabic Typesetting','Traditional Arabic','Geeza Pro',serif"
                                font-size="430" font-weight="bold" fill="white" direction="rtl" filter="url(#glow)">نور</text>
                        </g>
                    </svg>
                </div>
                <div class="cover-brand-name">NurSteps</div>
            </div>

            <!-- Headline -->
            <h1 class="cover-headline">
                Perjalanan Ibadah
                <span>Dimulai dari Sini</span>
            </h1>

            <p class="cover-sub">
                NurSteps hadir sebagai pendamping setia ibadah harian Anda — mencatat, mengingatkan, dan memotivasi setiap langkah menuju kebaikan.
            </p>

            <!-- Feature pills -->
            <div class="feature-pills">
                <div class="pill">
                    <span class="pill-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="white" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </span>
                    Pelacak Ibadah
                </div>
                <div class="pill">
                    <span class="pill-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="white" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    Pengingat Shalat
                </div>
                <div class="pill">
                    <span class="pill-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="white" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </span>
                    Catatan Al-Qur'an
                </div>
                <div class="pill">
                    <span class="pill-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="white" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </span>
                    Statistik Amal
                </div>
            </div>

            <!-- Arabic quote -->
            <div class="arabic-quote">
                وَالَّذِينَ جَاهَدُوا فِينَا لَنَهْدِيَنَّهُمْ سُبُلَنَا
                <div class="arabic-quote-trans">"Dan orang-orang yang bersungguh-sungguh di jalan Kami, benar-benar akan Kami tunjukkan kepada mereka jalan-jalan Kami."<br>— QS. Al-Ankabut: 69</div>
            </div>
        </div>

        <div class="deco-circles">
            <div class="deco-circle" style="width:14px;height:14px;"></div>
            <div class="deco-circle" style="width:10px;height:10px;"></div>
            <div class="deco-circle" style="width:6px;height:6px;"></div>
        </div>
    </div>

    <!-- =========== RIGHT: FORM PANEL =========== -->
    <div class="form-panel">
        <div class="form-inner">

            <h2 class="form-title">Daftar Akun ✨</h2>
            <p class="form-subtitle">Isi data Anda untuk membuat akun baru</p>

            @if ($errors->any())
                <div class="error-box">
                    <ul style="list-style:none;padding:0;margin:0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="register-form" novalidate>
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label class="input-label">Nama Lengkap</label>
                    <div class="input-wrapper" id="name-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input type="text" id="input-name" name="name" class="form-input"
                            placeholder="Nama lengkap Anda" value="{{ old('name') }}" autofocus
                            onfocus="setFocus('name-wrapper')" onblur="validateName()">
                        <svg class="status-icon ok" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <svg class="status-icon err" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div class="field-error" id="name-error">Nama lengkap wajib diisi.</div>
                </div>

                <!-- Nama Pengguna -->
                <div class="form-group">
                    <label class="input-label">Nama Pengguna</label>
                    <div class="input-wrapper" id="username-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                        </svg>
                        <input type="text" id="input-username" name="username" class="form-input"
                            placeholder="Nama pengguna (opsional)" value="{{ old('username') }}"
                            onfocus="setFocus('username-wrapper')"
                            onblur="document.getElementById('username-wrapper').classList.remove('focused')">
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="input-label">Alamat Email</label>
                    <div class="input-wrapper" id="email-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input type="email" id="input-email" name="email" class="form-input"
                            placeholder="contoh@email.com" value="{{ old('email') }}"
                            onfocus="setFocus('email-wrapper')" onblur="validateEmail()">
                        <svg class="status-icon ok" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <svg class="status-icon err" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div class="field-error" id="email-error">Format email tidak valid. Contoh: nama@gmail.com</div>
                </div>

                <!-- Kata Sandi -->
                <div class="form-group">
                    <label class="input-label">Kata Sandi</label>
                    <div class="input-wrapper" id="password-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input type="password" id="input-password" name="password"
                            class="form-input has-eye" placeholder="Minimal 6 karakter"
                            onfocus="setFocus('password-wrapper')"
                            onblur="validatePassword()"
                            oninput="checkStrength()">
                        <button type="button" class="eye-toggle" onclick="toggleEye('input-password','eye-open-1','eye-closed-1')" tabindex="-1">
                            <svg id="eye-open-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-closed-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    <div class="password-strength" id="strength-wrap">
                        <div class="strength-bars">
                            <div class="strength-bar" id="bar1"></div>
                            <div class="strength-bar" id="bar2"></div>
                            <div class="strength-bar" id="bar3"></div>
                            <div class="strength-bar" id="bar4"></div>
                        </div>
                        <div class="strength-label" id="strength-label">Masukkan kata sandi</div>
                    </div>
                    <div class="field-error" id="password-error">Kata sandi minimal 6 karakter dan harus mengandung huruf serta angka.</div>
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="form-group">
                    <label class="input-label">Konfirmasi Kata Sandi</label>
                    <div class="input-wrapper" id="confirm-password-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <input type="password" id="input-confirm" name="password_confirmation"
                            class="form-input has-eye" placeholder="Ulangi kata sandi"
                            onfocus="setFocus('confirm-password-wrapper')"
                            onblur="validateConfirm()">
                        <button type="button" class="eye-toggle" onclick="toggleEye('input-confirm','eye-open-2','eye-closed-2')" tabindex="-1">
                            <svg id="eye-open-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-closed-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    <div class="field-error" id="confirm-error">Kata sandi tidak cocok.</div>
                </div>

                <!-- Terms -->
                <p class="terms">
                    Jangan khawatir, Anda dapat mengubah nama pengguna nanti.<br>
                    Dengan mendaftar, Anda menyetujui <a href="#">Ketentuan Layanan</a> &amp; <a href="#">Kebijakan Privasi</a>
                </p>

                <button type="submit" class="register-btn">Daftar Sekarang</button>

                <div class="divider">
                    <div class="divider-line"></div>
                    <span class="divider-text">atau</span>
                    <div class="divider-line"></div>
                </div>

                <div class="login-line">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </form>

            <div class="form-footer">dirancang oleh Tim NurSteps &nbsp;·&nbsp; v1.0</div>
        </div>
    </div>

<script>
    function setFocus(id) {
        document.getElementById(id).classList.add('focused');
    }

    function setWrapperState(id, state) {
        var w = document.getElementById(id);
        w.classList.remove('focused', 'error', 'valid');
        if (state) w.classList.add(state);
    }

    function showError(id, show) {
        var el = document.getElementById(id);
        show ? el.classList.add('show') : el.classList.remove('show');
    }

    function toggleEye(inputId, openId, closedId) {
        var inp = document.getElementById(inputId);
        var o   = document.getElementById(openId);
        var c   = document.getElementById(closedId);
        if (inp.type === 'password') {
            inp.type = 'text'; o.style.display = 'none'; c.style.display = 'block';
        } else {
            inp.type = 'password'; o.style.display = 'block'; c.style.display = 'none';
        }
    }

    function lockPasswordFields(lock) {
        var pairs = [
            { inp: 'input-password', wrap: 'password-wrapper',        ph: 'Minimal 6 karakter' },
            { inp: 'input-confirm',  wrap: 'confirm-password-wrapper', ph: 'Ulangi kata sandi' }
        ];
        pairs.forEach(function(p) {
            var inp = document.getElementById(p.inp);
            var w   = document.getElementById(p.wrap);
            if (lock) {
                inp.disabled = true;
                w.classList.remove('unlocked','valid','error','focused');
                w.classList.add('locked');
                inp.placeholder = 'Isi email yang valid dulu';
            } else {
                inp.disabled = false;
                w.classList.remove('locked','error','valid','focused');
                inp.placeholder = p.ph;
            }
        });
    }

    function validateName() {
        var val = document.getElementById('input-name').value.trim();
        var ok  = val.length > 0;
        setWrapperState('name-wrapper', ok ? 'valid' : 'error');
        showError('name-error', !ok);
        return ok;
    }

    function validateEmail() {
        var val = document.getElementById('input-email').value.trim();
        var ok  = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
        setWrapperState('email-wrapper', ok ? 'valid' : 'error');
        showError('email-error', !ok);
        lockPasswordFields(!ok);
        return ok;
    }

    function validatePassword() {
        var val = document.getElementById('input-password').value;
        var errEl = document.getElementById('password-error');
        var hasLetter  = /[a-zA-Z]/.test(val);
        var hasNumber  = /[0-9]/.test(val);
        var longEnough = val.length >= 6;
        var ok = longEnough && hasLetter && hasNumber;
        if (!longEnough)     errEl.textContent = 'Kata sandi minimal 6 karakter.';
        else if (!hasLetter) errEl.textContent = 'Kata sandi harus mengandung minimal satu huruf.';
        else if (!hasNumber) errEl.textContent = 'Kata sandi harus mengandung minimal satu angka.';
        setWrapperState('password-wrapper', ok ? 'valid' : 'error');
        showError('password-error', !ok);
        return ok;
    }

    function validateConfirm() {
        var p1 = document.getElementById('input-password').value;
        var p2 = document.getElementById('input-confirm').value;
        var ok = p1 === p2 && p2.length > 0;
        setWrapperState('confirm-password-wrapper', ok ? 'valid' : 'error');
        showError('confirm-error', !ok);
        return ok;
    }

    function checkStrength() {
        var val = document.getElementById('input-password').value;
        document.getElementById('strength-wrap').classList.toggle('show', val.length > 0);
        var score = 0;
        if (val.length >= 6)           score++;
        if (/[A-Z]/.test(val))         score++;
        if (/[0-9]/.test(val))         score++;
        if (/[^A-Za-z0-9]/.test(val))  score++;
        var colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
        var labels = ['Sangat lemah', 'Lemah', 'Cukup kuat', 'Kuat'];
        for (var i = 1; i <= 4; i++) {
            document.getElementById('bar' + i).style.background = i <= score ? colors[score - 1] : '#e2e8f0';
        }
        document.getElementById('strength-label').textContent = labels[score - 1] || 'Sangat lemah';
        document.getElementById('strength-label').style.color  = colors[score - 1] || '#ef4444';
    }

    document.getElementById('register-form').addEventListener('submit', function(e) {
        var ok = validateName() & validateEmail() & validatePassword() & validateConfirm();
        if (!ok) {
            e.preventDefault();
            var first = document.querySelector('.field-error.show');
            if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    lockPasswordFields(true);
</script>
</body>
</html>