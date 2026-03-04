<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - NurSteps</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --teal-deep: #0d9488;
            --teal-mid:  #14b8a6;
            --teal-light:#5eead4;
            --teal-pale: #ccfbf1;
            --white:     #ffffff;
            --text-dark: #1e293b;
            --text-mid:  #475569;
            --text-soft: #94a3b8;
        }

        html, body {
            height: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f0fdfa;
        }

        /* ===================== COVER PANEL ===================== */
        .cover-panel {
            flex: 1 1 55%;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 48px;
            overflow: hidden;
            background: linear-gradient(145deg, #0a7a71 0%, #0d9488 35%, #14b8a6 70%, #2dd4bf 100%);
            min-height: 100vh;
        }

        /* Animated blobs */
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

        /* Islamic geometric pattern overlay */
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
            max-width: 480px;
            animation: fadeSlideIn 0.9s ease-out both;
        }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Logo + Nur Arabic */
        .cover-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 48px;
        }

        .nur-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
            animation: float 4s ease-in-out infinite;
        }

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

        /* Decorative crescent + star */
        .deco-top {
            position: absolute;
            top: 32px;
            right: 32px;
            opacity: 0.3;
        }

        /* Main headline */
        .cover-headline {
            font-size: clamp(28px, 3.5vw, 42px);
            font-weight: 800;
            color: white;
            line-height: 1.2;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        .cover-headline span {
            display: block;
            color: var(--teal-pale);
            font-style: italic;
        }

        .cover-sub {
            font-size: 16px;
            color: rgba(255,255,255,0.8);
            line-height: 1.7;
            margin-bottom: 48px;
            max-width: 380px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Feature pills */
        .feature-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 48px;
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

        /* Arabic quote */
        .arabic-quote {
            font-family: 'Amiri', serif;
            font-size: 22px;
            color: rgba(255,255,255,0.6);
            border-top: 1px solid rgba(255,255,255,0.2);
            padding-top: 24px;
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

        /* Decorative circles bottom */
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
            flex: 0 0 420px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 48px 40px;
            background: white;
            position: relative;
            overflow-y: auto;
        }

        .form-inner {
            width: 100%;
            max-width: 360px;
            animation: fadeSlideIn 0.7s 0.2s ease-out both;
        }

        /* Mobile icon shown only on small screens */
        .mobile-icon-wrap {
            display: none;
            flex-direction: column;
            align-items: center;
            margin-bottom: 24px;
        }

        .form-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .form-subtitle {
            font-size: 14px;
            color: var(--text-soft);
            margin-bottom: 32px;
        }

        .form-group { margin-bottom: 18px; }

        .input-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            border: 1.5px solid #e2e8f0;
            transition: border-color 0.25s, box-shadow 0.25s;
            background: #f8fafc;
        }

        .input-wrapper:hover { border-color: var(--teal-mid); }
        .input-wrapper.focused {
            border-color: var(--teal-deep);
            box-shadow: 0 0 0 3px rgba(13,148,136,0.12);
            background: white;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: var(--teal-mid);
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: none;
            background: transparent;
            font-size: 14px;
            color: var(--text-dark);
            font-family: inherit;
            outline: none;
        }

        .form-input::placeholder { color: var(--text-soft); }

        .eye-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-soft);
            transition: color 0.2s;
            display: flex;
            align-items: center;
        }
        .eye-toggle:hover { color: var(--teal-deep); }
        .eye-toggle svg { width: 18px; height: 18px; }

        .row-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 14px 0 22px;
            font-size: 13px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-mid);
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--teal-deep);
        }

        .forgot-link {
            color: var(--teal-deep);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }
        .forgot-link:hover { color: var(--teal-mid); text-decoration: underline; }

        .login-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            background: linear-gradient(135deg, #0d9488, #14b8a6);
            color: white;
            box-shadow: 0 6px 20px rgba(13,148,136,0.35);
            transition: all 0.25s;
            letter-spacing: 0.5px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(13,148,136,0.45);
        }

        .login-btn:active { transform: translateY(0); }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 22px 0 0;
        }
        .divider-line { flex: 1; height: 1px; background: #e2e8f0; }
        .divider-text { font-size: 12px; color: var(--text-soft); font-weight: 500; }

        .register-line {
            margin-top: 18px;
            font-size: 14px;
            color: var(--text-mid);
            text-align: center;
        }
        .register-line a {
            color: var(--teal-deep);
            font-weight: 700;
            text-decoration: none;
        }
        .register-line a:hover { text-decoration: underline; }

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
            margin-top: 32px;
            text-align: center;
            font-size: 11px;
            color: var(--text-soft);
        }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 860px) {
            body { flex-direction: column; }

            .cover-panel {
                flex: 0 0 auto;
                min-height: 220px;
                padding: 32px 24px;
            }

            .cover-content { max-width: 100%; }
            .cover-headline { font-size: 22px; }
            .cover-sub { font-size: 14px; margin-bottom: 20px; }
            .cover-logo { margin-bottom: 20px; }
            .feature-pills { margin-bottom: 20px; }
            .arabic-quote { display: none; }
            .deco-circles { display: none; }

            .form-panel {
                flex: 1;
                padding: 32px 24px 40px;
            }
        }

        @media (max-width: 480px) {
            .cover-panel { min-height: 180px; padding: 24px 16px; }
            .cover-headline { font-size: 18px; }
            .cover-sub { display: none; }
            .pill { font-size: 12px; padding: 6px 12px; }
        }
    </style>

    <script>
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

        function focusWrapper(id) {
            document.getElementById(id).classList.add('focused');
        }
        function blurWrapper(id) {
            document.getElementById(id).classList.remove('focused');
        }
    </script>
</head>
<body>

    <!-- =========== LEFT: COVER PANEL =========== -->
    <div class="cover-panel">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
        <div class="pattern-overlay"></div>

        <!-- Crescent deco top-right -->
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
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="44" height="44">
                        <text x="50" y="68" text-anchor="middle"
                            font-family="'Amiri','Traditional Arabic',serif"
                            font-size="60" font-weight="bold" fill="white" direction="rtl">نور</text>
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

        <!-- Deco circles bottom-left -->
        <div class="deco-circles">
            <div class="deco-circle" style="width:14px;height:14px;"></div>
            <div class="deco-circle" style="width:10px;height:10px;"></div>
            <div class="deco-circle" style="width:6px;height:6px;"></div>
        </div>
    </div>

    <!-- =========== RIGHT: FORM PANEL =========== -->
    <div class="form-panel">
        <div class="form-inner">

            <h2 class="form-title">Selamat Datang 👋</h2>
            <p class="form-subtitle">Masuk ke akun NurSteps Anda</p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="error-box">{{ session('status') }}</div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="error-box">
                    <ul style="list-style:none;padding:0;margin:0;">
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
                    <label class="input-label" for="email-input">Alamat Email</label>
                    <div class="input-wrapper" id="email-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input
                            type="email"
                            id="email-input"
                            name="email"
                            class="form-input"
                            placeholder="contoh@email.com"
                            value="{{ old('email') }}"
                            required autofocus
                            onfocus="focusWrapper('email-wrapper')"
                            onblur="blurWrapper('email-wrapper')"
                        >
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="input-label" for="password-input">Kata Sandi</label>
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
                            placeholder="Kata sandi Anda"
                            required
                            onfocus="focusWrapper('password-wrapper')"
                            onblur="blurWrapper('password-wrapper')"
                        >
                        <button type="button" class="eye-toggle" onclick="togglePassword()" tabindex="-1">
                            <svg id="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember + Forgot -->
                <div class="row-between">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember_me">
                        <span>Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa Kata Sandi?</a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="login-btn">Masuk</button>

                <!-- Divider -->
                <div class="divider">
                    <div class="divider-line"></div>
                    <span class="divider-text">atau</span>
                    <div class="divider-line"></div>
                </div>

                <!-- Register link -->
                @if (Route::has('register'))
                    <div class="register-line">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                    </div>
                @endif
            </form>

            <div class="form-footer">dirancang oleh Tim NurSteps &nbsp;·&nbsp; v1.0</div>
        </div>
    </div>

</body>
</html>