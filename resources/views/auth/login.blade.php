<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - NurSteps</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(160deg, #0d9488 0%, #14b8a6 50%, #5eead4 100%);
            padding: 20px;
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 460px;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-card {
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 40px 40px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
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
            margin: 0 auto 16px;
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

        .app-name {
            font-size: 22px;
            font-weight: 800;
            color: #0d9488;
            text-align: center;
            margin-bottom: 4px;
            letter-spacing: -0.3px;
        }

        .app-tagline {
            font-size: 13px;
            color: #94a3b8;
            text-align: center;
            margin-bottom: 28px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-wrapper {
            position: relative;
            background: rgba(13, 148, 136, 0.1);
            border-radius: 25px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .input-wrapper:hover {
            background: rgba(13, 148, 136, 0.15);
        }

        .input-wrapper.focused {
            background: rgba(13, 148, 136, 0.2);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }

        .form-input {
            width: 100%;
            padding: 16px 20px 16px 55px;
            border: none;
            background: transparent;
            font-size: 15px;
            color: #2d3748;
            outline: none;
        }

        .form-input::placeholder {
            color: rgba(45, 55, 72, 0.5);
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #14b8a6;
        }

        .checkbox-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 16px 0;
            font-size: 13px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #4a5568;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #14b8a6;
        }

        .forgot-password {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #0d9488;
        }

        .login-button {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            background: linear-gradient(135deg, #0d9488, #14b8a6);
            color: white;
            box-shadow: 0 8px 20px rgba(13, 148, 136, 0.4);
            transition: all 0.3s ease;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(13, 148, 136, 0.5);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .register-link {
            margin-top: 20px;
            font-size: 14px;
            color: #4a5568;
            text-align: center;
        }

        .register-link a {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: left;
        }

        .footer-text {
            margin-top: 16px;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
            text-align: center;
        }

        .eye-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            transition: color 0.2s ease;
        }
        .eye-toggle:hover { color: #14b8a6; }
        .eye-toggle svg { width: 20px; height: 20px; }

        @media (max-width: 480px) {
            body { padding: 12px; }
            .login-card { padding: 30px 24px 32px; border-radius: 24px; }
            .icon-container { width: 80px; height: 80px; margin: 0 auto 12px; }
            .nur-icon { width: 80px; height: 80px; }
            .app-name { font-size: 20px; }
            .app-tagline { font-size: 12px; margin-bottom: 20px; }
            .form-group { margin-bottom: 14px; }
            .form-input { padding: 13px 16px 13px 46px; font-size: 14px; }
            .input-icon { width: 17px; height: 17px; left: 16px; }
            .checkbox-group { margin: 12px 0; font-size: 12px; }
            .remember-me input[type="checkbox"] { width: 15px; height: 15px; }
            .login-button { padding: 14px; font-size: 15px; margin-top: 8px; }
            .register-link { margin-top: 14px; font-size: 13px; }
            .footer-text { margin-top: 12px; }
        }
    </style>
    <script>
        function scaleCard() {
            var container = document.querySelector('.container');
            if (!container) return;
            container.style.transform = '';
            container.style.transformOrigin = '';

            var viewH = window.innerHeight;
            var viewW = window.innerWidth;
            var cardH = container.offsetHeight;
            var cardW = container.offsetWidth;

            var scaleH = (viewH - 40) / cardH;
            var scaleW = (viewW - 40) / cardW;
            var scale = Math.min(scaleH, scaleW, 1);

            if (scale < 1) {
                container.style.transform = 'scale(' + scale + ')';
                container.style.transformOrigin = 'center center';
            }
        }
        window.addEventListener('load', scaleCard);
        window.addEventListener('resize', scaleCard);

        function togglePassword() {
            var input = document.getElementById('password-input');
            var eyeOpen = document.getElementById('eye-open');
            var eyeClosed = document.getElementById('eye-closed');
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                input.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="login-card">

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

            <!-- Nama App -->
            <h1 class="app-name">NurSteps</h1>
            <p class="app-tagline">Pendamping Ibadah Anda</p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="error-message">
                    {{ session('status') }}
                </div>
            @endif

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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <div class="input-wrapper" id="username-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input
                            type="email"
                            name="email"
                            class="form-input"
                            placeholder="Email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            onfocus="document.getElementById('username-wrapper').classList.add('focused')"
                            onblur="document.getElementById('username-wrapper').classList.remove('focused')"
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
                            id="password-input"
                            name="password"
                            class="form-input"
                            placeholder="Kata Sandi"
                            required
                            onfocus="document.getElementById('password-wrapper').classList.add('focused')"
                            onblur="document.getElementById('password-wrapper').classList.remove('focused')"
                        >
                        <button type="button" class="eye-toggle" id="eye-toggle" onclick="togglePassword()" tabindex="-1">
                            <!-- Eye Open -->
                            <svg id="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <!-- Eye Closed -->
                            <svg id="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Ingat Saya & Lupa Kata Sandi -->
                <div class="checkbox-group">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember_me">
                        <span>Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            Lupa Kata Sandi?
                        </a>
                    @endif
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" class="login-button">
                    Masuk
                </button>

                <!-- Divider -->
                <div style="display:flex; align-items:center; gap:12px; margin: 20px 0 0;">
                    <div style="flex:1; height:1px; background:#e2e8f0;"></div>
                    <span style="font-size:12px; color:#94a3b8; font-weight:500;">atau</span>
                    <div style="flex:1; height:1px; background:#e2e8f0;"></div>
                </div>

                <!-- Link Daftar -->
                @if (Route::has('register'))
                    <div class="register-link">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                    </div>
                @endif
            </form>
        </div>

        <p class="footer-text">
            dirancang oleh Tim NurSteps
        </p>
    </div>
</body>
</html>