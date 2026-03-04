<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Akun - Aplikasi NurSteps</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            /* Hapus scrollbar default yang bikin garis di kanan/bawah */
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE/Edge */
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none; /* Chrome/Safari */
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #14b8a6 0%, #5eead4 50%, #fde68a 100%);
            background-attachment: fixed;
            overflow: hidden auto;
            position: relative;
            padding: 30px 20px;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 50%);
            animation: moveBackground 20s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes moveBackground {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, 20px); }
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 520px;
            padding: 20px;
            z-index: 1;
            margin: auto;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 40px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .icon-container {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            animation: float 3s ease-in-out infinite;
            background: transparent;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-10px); }
        }

        .nur-icon {
            width: 110px;
            height: 110px;
            display: block;
            border-radius: 50%;
        }

        .title {
            font-size: 22px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 16px;
            position: relative;
        }

        .input-wrapper {
            position: relative;
            background: rgba(245, 245, 245, 0.8);
            border-radius: 25px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .input-wrapper:hover {
            background: rgba(240, 240, 240, 0.9);
        }

        .input-wrapper.focused {
            background: rgba(235, 235, 235, 0.95);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }

        .form-input {
            width: 100%;
            padding: 14px 20px 14px 50px;
            border: none;
            background: transparent;
            font-size: 14px;
            color: #2d3748;
            outline: none;
        }

        .form-input::placeholder {
            color: rgba(45, 55, 72, 0.5);
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #14b8a6;
        }

        .register-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(13, 148, 136, 0.3);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 15px;
        }

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(13, 148, 136, 0.4);
        }

        .register-button:active {
            transform: translateY(0);
        }

        .terms {
            font-size: 11px;
            color: #718096;
            margin-top: 15px;
            line-height: 1.5;
        }

        .terms a {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .login-link {
            margin-top: 20px;
            font-size: 14px;
            color: #4a5568;
        }

        .login-link a {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-size: 13px;
            text-align: left;
        }

        .footer-text {
            margin-top: 15px;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
            text-align: center;
        }

        /* ── Responsif Mobile ── */
        @media (max-width: 480px) {
            body {
                align-items: flex-start;
                padding: 20px 16px;
            }

            .container {
                max-width: 100%;
                padding: 0;
            }

            .register-card {
                padding: 32px 24px;
                border-radius: 24px;
            }

            .icon-container {
                width: 90px;
                height: 90px;
            }

            .nur-icon {
                width: 90px;
                height: 90px;
            }

            .title {
                font-size: 20px;
                margin-bottom: 20px;
            }

            .form-input {
                font-size: 16px; /* Mencegah zoom otomatis di iOS */
                padding: 13px 18px 13px 46px;
            }

            .register-button {
                padding: 14px;
                font-size: 14px;
            }
        }

        /* ── Tablet ── */
        @media (min-width: 481px) and (max-width: 768px) {
            .container {
                max-width: 480px;
            }

            .register-card {
                padding: 38px 36px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-card">

            <!-- Icon Nur -->
            <div class="icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" class="nur-icon">
                    <defs>
                        <clipPath id="circleClip">
                            <circle cx="512" cy="512" r="512"/>
                        </clipPath>
                        <radialGradient id="bgGrad" cx="50%" cy="45%" r="65%">
                            <stop offset="0%" stop-color="#2ecf8e"/>
                            <stop offset="100%" stop-color="#1aaa72"/>
                        </radialGradient>
                        <filter id="glow" x="-40%" y="-40%" width="180%" height="180%">
                            <feGaussianBlur in="SourceGraphic" stdDeviation="28" result="blur1"/>
                            <feGaussianBlur in="SourceGraphic" stdDeviation="12" result="blur2"/>
                            <feColorMatrix in="blur1" type="matrix"
                                values="0 0 0 0 0.5 0 0 0 0 1 0 0 0 0 0.7 0 0 0 0.6 0" result="colorBlur"/>
                            <feMerge>
                                <feMergeNode in="colorBlur"/>
                                <feMergeNode in="blur2"/>
                                <feMergeNode in="SourceGraphic"/>
                            </feMerge>
                        </filter>
                        <radialGradient id="centerGlow" cx="52%" cy="48%" r="35%">
                            <stop offset="0%" stop-color="white" stop-opacity="0.08"/>
                            <stop offset="100%" stop-color="transparent" stop-opacity="0"/>
                        </radialGradient>
                    </defs>
                    <g clip-path="url(#circleClip)">
                        <rect width="1024" height="1024" fill="url(#bgGrad)"/>
                        <rect width="1024" height="1024" fill="url(#centerGlow)"/>
                        <text x="510" y="570"
                            text-anchor="middle"
                            dominant-baseline="middle"
                            font-family="'Noto Naskh Arabic','Arabic Typesetting','Traditional Arabic','Geeza Pro',serif"
                            font-size="430"
                            font-weight="bold"
                            fill="white"
                            direction="rtl"
                            filter="url(#glow)">نور</text>
                    </g>
                </svg>
            </div>

            <h2 class="title">Daftar Akun</h2>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="error-message">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-group">
                    <div class="input-wrapper" id="name-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-input" 
                            placeholder="Nama Lengkap" 
                            value="{{ old('name') }}"
                            required 
                            autofocus
                            onfocus="document.getElementById('name-wrapper').classList.add('focused')"
                            onblur="document.getElementById('name-wrapper').classList.remove('focused')"
                        >
                    </div>
                </div>

                <!-- Username -->
                <div class="form-group">
                    <div class="input-wrapper" id="username-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                        </svg>
                        <input 
                            type="text" 
                            name="username" 
                            class="form-input" 
                            placeholder="Nama Pengguna" 
                            value="{{ old('username') }}"
                            onfocus="document.getElementById('username-wrapper').classList.add('focused')"
                            onblur="document.getElementById('username-wrapper').classList.remove('focused')"
                        >
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <div class="input-wrapper" id="email-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-input" 
                            placeholder="Email Anda" 
                            value="{{ old('email') }}"
                            required
                            onfocus="document.getElementById('email-wrapper').classList.add('focused')"
                            onblur="document.getElementById('email-wrapper').classList.remove('focused')"
                        >
                    </div>
                </div>

                <!-- Kata Sandi -->
                <div class="form-group">
                    <div class="input-wrapper" id="password-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-input" 
                            placeholder="Kata Sandi" 
                            required
                            onfocus="document.getElementById('password-wrapper').classList.add('focused')"
                            onblur="document.getElementById('password-wrapper').classList.remove('focused')"
                        >
                    </div>
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="form-group">
                    <div class="input-wrapper" id="confirm-password-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            class="form-input" 
                            placeholder="Konfirmasi Kata Sandi" 
                            required
                            onfocus="document.getElementById('confirm-password-wrapper').classList.add('focused')"
                            onblur="document.getElementById('confirm-password-wrapper').classList.remove('focused')"
                        >
                    </div>
                </div>

                <!-- Terms -->
                <p class="terms">
                    Jangan khawatir, Anda dapat mengubah nama pengguna Anda nanti.<br>
                    Silahkan lihat <a href="#">Ketentuan Layanan</a> & <a href="#">Kebijakan Privasi</a>
                </p>

                <!-- Tombol Daftar -->
                <button type="submit" class="register-button">
                    Daftar
                </button>

                <!-- Link Masuk -->
                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </form>
        </div>

        <p class="footer-text">
            dirancang oleh Tim NurSteps
        </p>
    </div>
</body>
</html><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Akun - Aplikasi NurSteps</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            height: 100%;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        html::-webkit-scrollbar, body::-webkit-scrollbar { display: none; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(160deg, #0d9488 0%, #14b8a6 50%, #5eead4 100%);
            background-attachment: fixed;
            overflow: hidden auto;
            padding: 30px 20px;
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 520px;
            padding: 20px;
            z-index: 1;
            margin: auto;
        }

        .register-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 40px 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            text-align: center;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .icon-container {
            width: 110px; height: 110px;
            border-radius: 50%; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 25px;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%,100% { transform: translateY(0); }
            50%      { transform: translateY(-10px); }
        }
        .nur-icon { width: 110px; height: 110px; display: block; border-radius: 50%; }

        .title { font-size: 22px; font-weight: 600; color: #2d3748; margin-bottom: 25px; }

        /* ── Form Groups ── */
        .form-group { margin-bottom: 16px; position: relative; }

        .input-wrapper {
            position: relative;
            background: rgba(13,148,136,0.08);
            border-radius: 25px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .input-wrapper:hover  { background: rgba(13,148,136,0.13); }
        .input-wrapper.focused { background: rgba(13,148,136,0.18); box-shadow: 0 0 0 3px rgba(13,148,136,0.1); }
        .input-wrapper.error  { background: rgba(220,38,38,0.07);  box-shadow: 0 0 0 2px rgba(220,38,38,0.3); }
        .input-wrapper.valid  { background: rgba(16,185,129,0.08);  box-shadow: 0 0 0 2px rgba(16,185,129,0.3); }
        .input-wrapper.locked { opacity: 0.5; pointer-events: none; }

        .form-input {
            width: 100%;
            padding: 14px 20px 14px 50px;
            border: none; background: transparent;
            font-size: 14px; color: #2d3748; outline: none;
        }
        .form-input.has-eye { padding-right: 48px; }
        .form-input::placeholder { color: rgba(45,55,72,0.5); }
        .form-input:disabled { cursor: not-allowed; }

        .input-icon {
            position: absolute; left: 18px; top: 50%; transform: translateY(-50%);
            width: 18px; height: 18px; color: #14b8a6; pointer-events: none;
        }

        /* status tick / cross */
        .status-icon {
            position: absolute; right: 16px; top: 50%; transform: translateY(-50%);
            width: 16px; height: 16px; display: none; pointer-events: none;
        }
        .input-wrapper.valid .status-icon.ok  { display: block; color: #10b981; }
        .input-wrapper.error .status-icon.err { display: block; color: #dc2626; }

        /* eye button */
        .eye-toggle {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: #94a3b8; transition: color 0.2s; padding: 4px;
        }
        .eye-toggle:hover { color: #14b8a6; }
        .eye-toggle svg { width: 19px; height: 19px; }

        /* inline error text */
        .field-error {
            display: none;
            font-size: 11.5px; color: #dc2626;
            margin-top: 6px; margin-left: 16px;
            text-align: left;
            animation: fadeIn 0.2s ease;
        }
        .field-error.show { display: block; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(-4px); } to { opacity:1; transform:translateY(0); } }

        /* password strength */
        .password-strength { display: none; margin-top: 8px; margin-left: 4px; }
        .password-strength.show { display: block; }
        .strength-bars { display: flex; gap: 4px; margin-bottom: 4px; }
        .strength-bar  { height: 4px; flex: 1; border-radius: 2px; background: #e2e8f0; transition: background 0.3s; }
        .strength-label { font-size: 11px; color: #718096; text-align: left; }

        /* ── Buttons ── */
        .register-button {
            width: 100%; padding: 15px;
            border: none; border-radius: 25px;
            font-size: 15px; font-weight: 600; cursor: pointer;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(13,148,136,0.3);
            transition: all 0.3s ease;
            text-transform: uppercase; letter-spacing: 1px;
            margin-top: 15px;
        }
        .register-button:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(13,148,136,0.4); }
        .register-button:active { transform: translateY(0); }

        .terms { font-size: 11px; color: #718096; margin-top: 15px; line-height: 1.5; }
        .terms a { color: #14b8a6; text-decoration: none; font-weight: 600; }
        .terms a:hover { text-decoration: underline; }

        .login-link { margin-top: 20px; font-size: 14px; color: #4a5568; }
        .login-link a { color: #14b8a6; text-decoration: none; font-weight: 600; }
        .login-link a:hover { text-decoration: underline; }

        .error-message {
            background: #fee; color: #c33; padding: 10px;
            border-radius: 12px; margin-bottom: 15px; font-size: 13px; text-align: left;
        }

        .footer-text { margin-top: 15px; font-size: 11px; color: rgba(255,255,255,0.8); text-align: center; }

        /* ── Responsive ── */
        @media (max-width: 480px) {
            body { align-items: flex-start; padding: 20px 16px; }
            .container { max-width: 100%; padding: 0; }
            .register-card { padding: 32px 24px; border-radius: 24px; }
            .icon-container, .nur-icon { width: 90px; height: 90px; }
            .title { font-size: 20px; margin-bottom: 20px; }
            .form-input { font-size: 16px; padding: 13px 18px 13px 46px; }
            .form-input.has-eye { padding-right: 46px; }
            .register-button { padding: 14px; font-size: 14px; }
        }
        @media (min-width: 481px) and (max-width: 768px) {
            .container { max-width: 480px; }
            .register-card { padding: 38px 36px; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="register-card">

        <!-- Icon Nur -->
        <div class="icon-container">
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

        <h2 class="title">Daftar Akun</h2>

        
            <div class="error-message">
                <ul style="list-style:none;padding:0;margin:0;">
                    <li></li>
                </ul>
            </div>
        

        <form method="POST" action="#" id="register-form" novalidate>
            

            <!-- Nama Lengkap -->
            <div class="form-group">
                <div class="input-wrapper" id="name-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <input type="text" id="input-name" name="name" class="form-input"
                        placeholder="Nama Lengkap"  required autofocus
                        onfocus="setFocus('name-wrapper')" onblur="validateName()">
                    <svg class="status-icon ok" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <svg class="status-icon err" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <div class="field-error" id="name-error">Nama lengkap wajib diisi (minimal 2 karakter).</div>
            </div>

            <!-- Username -->
            <div class="form-group">
                <div class="input-wrapper" id="username-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                    </svg>
                    <input type="text" id="input-username" name="username" class="form-input"
                        placeholder="Nama Pengguna" 
                        onfocus="setFocus('username-wrapper')" onblur="validateUsername()">
                    <svg class="status-icon ok" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <svg class="status-icon err" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <div class="field-error" id="username-error">Nama pengguna hanya boleh huruf, angka, dan garis bawah (_).</div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <div class="input-wrapper" id="email-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input type="email" id="input-email" name="email" class="form-input"
                        placeholder="Email Anda"  required
                        onfocus="setFocus('email-wrapper')" onblur="validateEmail()">
                    <svg class="status-icon ok" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <svg class="status-icon err" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <div class="field-error" id="email-error">Format email tidak valid. Contoh: nama@email.com</div>
            </div>

            <!-- Kata Sandi -->
            <div class="form-group">
                <div class="input-wrapper" id="password-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input type="password" id="input-password" name="password"
                        class="form-input has-eye" placeholder="Kata Sandi" required
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
                <div class="field-error" id="password-error">Kata sandi minimal 8 karakter.</div>
            </div>

            <!-- Konfirmasi Kata Sandi -->
            <div class="form-group">
                <div class="input-wrapper" id="confirm-password-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <input type="password" id="input-confirm" name="password_confirmation"
                        class="form-input has-eye" placeholder="Konfirmasi Kata Sandi" required
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
                Jangan khawatir, Anda dapat mengubah nama pengguna Anda nanti.<br>
                Silahkan lihat <a href="#">Ketentuan Layanan</a> &amp; <a href="#">Kebijakan Privasi</a>
            </p>

            <button type="submit" class="register-button">Daftar</button>

            <div class="login-link">
                Sudah punya akun? <a href="#">Masuk di sini</a>
            </div>
        </form>
    </div>

    <p class="footer-text">dirancang oleh Tim NurSteps</p>
</div>

<script>
    /* ── Helpers ── */
    function setFocus(id) { document.getElementById(id).classList.add('focused'); }

    function setWrapperState(id, state) {
        var w = document.getElementById(id);
        w.classList.remove('focused','error','valid');
        if (state) w.classList.add(state);
    }

    function showError(id, show) {
        var el = document.getElementById(id);
        show ? el.classList.add('show') : el.classList.remove('show');
    }

    /* ── Toggle Mata ── */
    function toggleEye(inputId, openId, closedId) {
        var inp = document.getElementById(inputId);
        var o   = document.getElementById(openId);
        var c   = document.getElementById(closedId);
        if (inp.type === 'password') {
            inp.type = 'text';
            o.style.display = 'none';
            c.style.display = 'block';
        } else {
            inp.type = 'password';
            o.style.display = 'block';
            c.style.display = 'none';
        }
    }

    /* ── Kunci / buka kolom password ── */
    function lockPasswordFields(lock) {
        ['input-password','input-confirm'].forEach(function(id, i) {
            var inp = document.getElementById(id);
            var w   = document.getElementById(i === 0 ? 'password-wrapper' : 'confirm-password-wrapper');
            if (lock) {
                inp.disabled = true;
                w.classList.add('locked');
                inp.placeholder = 'Isi email yang valid dulu';
            } else {
                inp.disabled = false;
                w.classList.remove('locked');
                inp.placeholder = i === 0 ? 'Kata Sandi' : 'Konfirmasi Kata Sandi';
            }
        });
    }

    /* ── Validasi Nama ── */
    function validateName() {
        var val = document.getElementById('input-name').value.trim();
        var ok  = val.length >= 2;
        setWrapperState('name-wrapper', ok ? 'valid' : 'error');
        showError('name-error', !ok);
        return ok;
    }

    /* ── Validasi Username (opsional) ── */
    function validateUsername() {
        var val = document.getElementById('input-username').value.trim();
        if (val === '') { setWrapperState('username-wrapper',''); showError('username-error',false); return true; }
        var ok = /^[a-zA-Z0-9_]+$/.test(val);
        setWrapperState('username-wrapper', ok ? 'valid' : 'error');
        showError('username-error', !ok);
        return ok;
    }

    /* ── Validasi Email → kunci/buka password ── */
    function validateEmail() {
        var val = document.getElementById('input-email').value.trim();
        var ok  = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
        setWrapperState('email-wrapper', ok ? 'valid' : 'error');
        showError('email-error', !ok);
        lockPasswordFields(!ok);
        return ok;
    }

    /* ── Validasi Password ── */
    function validatePassword() {
        var val = document.getElementById('input-password').value;
        var ok  = val.length >= 8;
        setWrapperState('password-wrapper', ok ? 'valid' : 'error');
        showError('password-error', !ok);
        return ok;
    }

    /* ── Validasi Konfirmasi ── */
    function validateConfirm() {
        var p1 = document.getElementById('input-password').value;
        var p2 = document.getElementById('input-confirm').value;
        var ok = p1 === p2 && p2.length > 0;
        setWrapperState('confirm-password-wrapper', ok ? 'valid' : 'error');
        showError('confirm-error', !ok);
        return ok;
    }

    /* ── Kekuatan Password ── */
    function checkStrength() {
        var val = document.getElementById('input-password').value;
        document.getElementById('strength-wrap').classList.toggle('show', val.length > 0);
        var score = 0;
        if (val.length >= 8)          score++;
        if (/[A-Z]/.test(val))        score++;
        if (/[0-9]/.test(val))        score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;
        var colors = ['#ef4444','#f97316','#eab308','#22c55e'];
        var labels = ['Sangat lemah','Lemah','Cukup kuat','Kuat'];
        for (var i = 1; i <= 4; i++) {
            document.getElementById('bar'+i).style.background = i <= score ? colors[score-1] : '#e2e8f0';
        }
        document.getElementById('strength-label').textContent = labels[score-1] || 'Sangat lemah';
        document.getElementById('strength-label').style.color  = colors[score-1] || '#ef4444';
    }

    /* ── Submit guard ── */
    document.getElementById('register-form').addEventListener('submit', function(e) {
        var ok = validateName() & validateEmail() & validateUsername() & validatePassword() & validateConfirm();
        if (!ok) {
            e.preventDefault();
            var first = document.querySelector('.field-error.show');
            if (first) first.scrollIntoView({ behavior:'smooth', block:'center' });
        }
    });

    /* Kunci password saat halaman pertama muat */
    lockPasswordFields(true);
</script>
</body>
</html>