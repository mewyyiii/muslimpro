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
            --teal-deep:  #0d9488;
            --teal-mid:   #14b8a6;
            --teal-pale:  #ccfbf1;
            --text-dark:  #0f172a;
            --text-mid:   #475569;
            --text-soft:  #94a3b8;
            --border:     #e2e8f0;
            --bg:         #f1f5f9;
        }

        html, body { font-family: 'Plus Jakarta Sans', sans-serif; min-height: 100%; }

        body { display: flex; min-height: 100vh; background: #f0fdfa; }

        /* ===================== COVER PANEL ===================== */
        .cover-panel {
            flex: 1 1 55%; position: sticky; top: 0; height: 100vh;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            padding: 48px 40px; overflow: hidden;
            background: linear-gradient(145deg, #0a7a71 0%, #0d9488 35%, #14b8a6 70%, #2dd4bf 100%);
        }

        .blob { position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.25; animation: drift 8s ease-in-out infinite; }
        .blob-1 { width: 420px; height: 420px; background: #5eead4; top: -120px; left: -100px; }
        .blob-2 { width: 300px; height: 300px; background: #0f766e; bottom: -80px; right: -80px; animation-delay: -3s; }
        .blob-3 { width: 200px; height: 200px; background: #a7f3d0; top: 50%; left: 60%; animation-delay: -5s; }

        @keyframes drift { 0%,100% { transform: translate(0,0) scale(1); } 33% { transform: translate(20px,-30px) scale(1.05); } 66% { transform: translate(-15px,20px) scale(0.95); } }

        .pattern-overlay { position: absolute; inset: 0; opacity: 0.06; background-image: repeating-linear-gradient(60deg, white 0px, white 1px, transparent 1px, transparent 30px), repeating-linear-gradient(-60deg, white 0px, white 1px, transparent 1px, transparent 30px); background-size: 35px 60px; }

        .cover-content { position: relative; z-index: 2; text-align: center; width: 100%; max-width: 520px; animation: fadeUp 0.9s ease-out both; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }

        .cover-logo { display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 32px; }
        .nur-circle { width: 64px; height: 64px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; animation: float 4s ease-in-out infinite; }
        .nur-icon { width: 64px; height: 64px; display: block; border-radius: 50%; }

        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

        .cover-brand { font-size: 32px; font-weight: 800; color: white; letter-spacing: -0.5px; }
        .cover-headline { font-size: clamp(22px,2.8vw,38px); font-weight: 800; color: white; line-height: 1.2; margin-bottom: 16px; letter-spacing: -0.5px; }
        .cover-headline span { display: block; color: var(--teal-pale); font-style: italic; }
        .cover-sub { font-size: clamp(13px,1.2vw,15px); color: rgba(255,255,255,0.8); line-height: 1.7; margin-bottom: 28px; max-width: 400px; margin-left: auto; margin-right: auto; }

        .feature-pills { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin-bottom: 28px; }
        .pill { display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 100px; padding: 8px 16px; font-size: 13px; font-weight: 600; color: white; backdrop-filter: blur(4px); transition: background 0.2s; }
        .pill:hover { background: rgba(255,255,255,0.2); }
        .pill-icon { width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; }

        .arabic-quote { font-family: 'Amiri', serif; font-size: 22px; color: rgba(255,255,255,0.6); border-top: 1px solid rgba(255,255,255,0.2); padding-top: 24px; direction: rtl; letter-spacing: 1px; }
        .arabic-quote-trans { font-size: 12px; color: rgba(255,255,255,0.5); margin-top: 6px; direction: ltr; font-style: italic; }

        .deco-top { position: absolute; top: 32px; right: 32px; opacity: 0.3; }
        .deco-circles { position: absolute; bottom: 40px; left: 40px; display: flex; gap: 10px; opacity: 0.3; }
        .deco-circle { border-radius: 50%; border: 2px solid white; }

        /* ===================== FORM PANEL ===================== */
        .form-panel { flex: 0 0 420px; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 48px 40px; background: white; overflow-y: auto; }
        .form-inner { width: 100%; max-width: 360px; animation: fadeUp 0.7s 0.2s ease-out both; }

        .form-title { font-size: 26px; font-weight: 800; color: var(--text-dark); margin-bottom: 6px; letter-spacing: -0.5px; }
        .form-subtitle { font-size: 14px; color: var(--text-soft); margin-bottom: 32px; }
        .form-group { margin-bottom: 18px; }

        .input-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-mid); margin-bottom: 8px; letter-spacing: 0.3px; }

        .input-wrapper { position: relative; border-radius: 14px; border: 1.5px solid var(--border); background: #f8fafc; overflow: hidden; transition: border-color 0.25s, box-shadow 0.25s, background 0.25s, opacity 0.3s; }
        .input-wrapper:hover { border-color: var(--teal-mid); }
        .input-wrapper.focused { border-color: var(--teal-deep); box-shadow: 0 0 0 3px rgba(13,148,136,0.12); background: white; }
        .input-wrapper.error   { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.1); background: #fff5f5; }
        .input-wrapper.valid   { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,0.1); background: #f0fdf4; }
        .input-wrapper.locked  { opacity: 0.45; pointer-events: none; background: rgba(148,163,184,0.12); border-color: var(--border); box-shadow: none; }
        .input-wrapper.unlocked { background: #f8fafc; border-color: var(--teal-mid); box-shadow: none; opacity: 1; }

        .status-icon { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; display: none; pointer-events: none; }
        .input-wrapper.valid .status-icon.ok  { display: block; color: #10b981; }
        .input-wrapper.error .status-icon.err { display: block; color: #dc2626; }

        .field-error { display: none; font-size: 11.5px; color: #dc2626; margin-top: 6px; margin-left: 4px; }
        .field-error.show { display: block; animation: fadeIn 0.2s ease; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(-3px); } to { opacity:1; transform:translateY(0); } }

        .input-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: var(--teal-mid); pointer-events: none; }

        .form-input { width: 100%; padding: 14px 16px 14px 48px; border: none; background: transparent; font-size: 14px; color: var(--text-dark); font-family: inherit; outline: none; border-radius: inherit; }
        .form-input.has-eye { padding-right: 44px; }
        .form-input::placeholder { color: var(--text-soft); }

        .eye-toggle { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-soft); transition: color 0.2s; display: flex; align-items: center; }
        .eye-toggle:hover { color: var(--teal-deep); }
        .eye-toggle svg { width: 18px; height: 18px; }

        .remember-me { display: flex; align-items: center; gap: 8px; color: var(--text-mid); cursor: pointer; }
        .remember-me input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--teal-deep); }

        .forgot-link { color: var(--teal-deep); text-decoration: none; font-weight: 600; font-size: 12px; }
        .forgot-link:hover { text-decoration: underline; }

        .login-btn { width: 100%; padding: 15px; border: none; border-radius: 14px; font-size: 15px; font-weight: 700; font-family: inherit; cursor: not-allowed; background: linear-gradient(135deg, #ef4444, #f87171); color: white; box-shadow: 0 6px 20px rgba(239,68,68,0.3); transition: all 0.35s cubic-bezier(.4,0,.2,1); letter-spacing: 0.5px; opacity: 0.85; }
        .login-btn.ready { background: linear-gradient(135deg, #0d9488, #14b8a6); box-shadow: 0 6px 20px rgba(13,148,136,0.35); cursor: pointer; opacity: 1; }
        .login-btn.ready:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(13,148,136,0.45); }
        .login-btn:active { transform: translateY(0); }

        .divider { display: flex; align-items: center; gap: 12px; margin: 22px 0 0; }
        .divider-line { flex: 1; height: 1px; background: var(--border); }
        .divider-text { font-size: 12px; color: var(--text-soft); font-weight: 500; }

        .register-line { margin-top: 18px; font-size: 14px; color: var(--text-mid); text-align: center; }
        .register-line a { color: var(--teal-deep); font-weight: 700; text-decoration: none; }
        .register-line a:hover { text-decoration: underline; }

        .error-box { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; border-radius: 10px; padding: 12px 14px; font-size: 13px; margin-bottom: 18px; }

        .form-footer { margin-top: 14px; text-align: center; font-size: 11px; color: var(--text-soft); }

        /* ===== HADITH SECTION ===== */
        .hadith-section {
            margin-top: 24px;
            padding-top: 22px;
            border-top: 1px solid var(--border);
        }

        .hadith-card {
            background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 100%);
            border: 1px solid rgba(13,148,136,0.15);
            border-radius: 16px;
            padding: 18px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hadith-card::before {
            content: '\275D';
            position: absolute;
            top: 8px; left: 14px;
            font-size: 40px;
            color: rgba(13,148,136,0.08);
            font-family: Georgia, serif;
            line-height: 1;
        }

        .hadith-arabic {
            font-family: 'Amiri', serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--teal-deep);
            line-height: 1.9;
            margin-bottom: 10px;
            direction: rtl;
        }

        .hadith-ornament {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-bottom: 10px;
        }
        .ornament-line { width: 30px; height: 1px; background: rgba(13,148,136,0.25); }
        .ornament-diamond {
            width: 6px; height: 6px;
            background: var(--teal-mid);
            transform: rotate(45deg);
            opacity: 0.6;
        }

        .hadith-text {
            font-size: 12px;
            color: var(--text-mid);
            font-style: italic;
            line-height: 1.6;
            margin-bottom: 6px;
        }

        .hadith-source {
            font-size: 11px;
            color: var(--teal-deep);
            font-weight: 700;
            opacity: 0.7;
        }

        /* ===================== MOBILE ===================== */
        @media (max-width: 860px) {
            body { flex-direction: column; background: var(--bg); min-height: 100vh; }

            .cover-panel { position: relative; height: auto; min-height: auto; flex: none; padding: 28px 24px 24px; background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%); }

            .blob, .pattern-overlay, .deco-circles, .deco-top, .arabic-quote, .cover-sub, .feature-pills { display: none; }

            .cover-content { max-width: 100%; }
            .cover-logo { margin-bottom: 12px; gap: 12px; }
            .nur-circle { width: 44px; height: 44px; animation: none; }
            .nur-icon   { width: 44px; height: 44px; }
            .cover-brand { font-size: 22px; }
            .cover-headline { font-size: 20px; font-weight: 800; color: white; line-height: 1.3; margin-bottom: 0; text-align: center; }
            .cover-headline span { font-size: 17px; font-style: italic; color: #ccfbf1; }

            .form-panel { flex: 1; background: transparent; padding: 0 16px 40px; justify-content: flex-start; overflow-y: visible; align-items: stretch; }

            .form-inner { max-width: 100%; margin: 0; background: white; border-radius: 24px; box-shadow: 0 4px 24px rgba(15,23,42,0.08), 0 1px 4px rgba(15,23,42,0.04); padding: 28px 22px; margin-top: -20px; position: relative; z-index: 10; }

            .form-title { font-size: 20px; margin-bottom: 4px; }
            .form-subtitle { font-size: 13px; margin-bottom: 24px; }
            .input-label { font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 7px; }

            .input-wrapper { border-radius: 10px; border: 1.5px solid var(--border); background: white; overflow: hidden; }
            .input-wrapper:hover { border-color: #94a3b8; }
            .input-wrapper.focused { border-color: var(--teal-mid); box-shadow: 0 0 0 3px rgba(20,184,166,0.1); }

            .input-icon { display: none; }
            .form-input { padding: 13px 14px; font-size: 14px; border-radius: 10px; }
            .form-input.has-eye { padding-right: 44px; }

            .form-group { margin-bottom: 14px; }
            .login-btn { padding: 15px; border-radius: 10px; font-size: 15px; margin-top: 4px; box-shadow: 0 4px 16px rgba(13,148,136,0.3); }
            .divider { margin: 18px 0 0; }
            .register-line { margin-top: 14px; }

            .hadith-section { margin-top: 20px; padding-top: 18px; }
            .hadith-arabic { font-size: 16px; }
            .form-footer { margin-top: 14px; }
        }

        @media (max-width: 480px) {
            .cover-panel { padding: 24px 20px 22px; }
            .cover-headline { font-size: 18px; }
            .cover-headline span { font-size: 15px; }
            .form-panel { padding: 0 12px 36px; }
            .form-inner { padding: 24px 18px; border-radius: 20px; }
        }

        @media (max-width: 360px) {
            .form-inner { padding: 20px 14px; border-radius: 16px; }
            .form-title { font-size: 18px; }
        }
    </style>

    <script>
        /* ===== Helpers ===== */
        function setFocus(id) {
            var w = document.getElementById(id);
            if (!w.classList.contains('locked')) {
                w.classList.add('focused');
            }
        }
        function blurWrapper(id) {
            document.getElementById(id).classList.remove('focused');
        }
        function focusWrapper(id) { setFocus(id); }

        function setWrapperState(id, state) {
            var w = document.getElementById(id);
            w.classList.remove('focused', 'error', 'valid');
            if (state) w.classList.add(state);
        }

        function showError(id, show) {
            var el = document.getElementById(id);
            show ? el.classList.add('show') : el.classList.remove('show');
        }

        /* ===== Cek tombol siap / belum ===== */
        function checkLoginReady() {
            var emailOk = isValidEmail(document.getElementById('email-input').value.trim());
            var passOk  = document.getElementById('password-input').value.length > 0;
            var btn     = document.getElementById('login-btn');
            if (emailOk && passOk) {
                btn.classList.add('ready');
                btn.disabled = false;
            } else {
                btn.classList.remove('ready');
                btn.disabled = true;
            }
        }

        /* ===== Lock / Unlock password ===== */
        function lockPassword(lock) {
            var inp = document.getElementById('password-input');
            var w   = document.getElementById('password-wrapper');
            if (lock) {
                inp.disabled = true;
                inp.value = '';
                w.classList.remove('unlocked', 'valid', 'error', 'focused');
                w.classList.add('locked');
                inp.placeholder = 'Email harus valid untuk mengisi sandi';
            } else {
                inp.disabled = false;
                w.classList.remove('locked', 'error', 'valid', 'focused');
                w.classList.add('unlocked');
                inp.placeholder = 'Kata sandi Anda';
            }
            checkLoginReady();
        }

        /* ===== Email validation ===== */
        function isValidEmail(val) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
        }

        function validateEmail() {
            var val = document.getElementById('email-input').value.trim();
            var ok  = isValidEmail(val);
            setWrapperState('email-wrapper', ok ? 'valid' : (val.length > 0 ? 'error' : ''));
            showError('email-error', val.length > 0 && !ok);
            lockPassword(!ok);
            return ok;
        }

        /* Live check saat mengetik — unlock segera kalau sudah valid */
        function validateEmailLive() {
            var val = document.getElementById('email-input').value.trim();
            var ok  = isValidEmail(val);
            if (ok) {
                setWrapperState('email-wrapper', 'valid');
                showError('email-error', false);
                lockPassword(false);
            } else {
                lockPassword(true);
                /* Jangan tampilkan error saat masih mengetik */
                if (document.getElementById('email-wrapper').classList.contains('error')) {
                    showError('email-error', val.length > 0);
                }
            }
        }

        /* ===== Password toggle ===== */
        function togglePassword() {
            var input = document.getElementById('password-input');
            var eo = document.getElementById('eye-open');
            var ec = document.getElementById('eye-closed');
            if (input.type === 'password') {
                input.type = 'text';
                eo.style.display = 'none';
                ec.style.display = 'block';
            } else {
                input.type = 'password';
                eo.style.display = 'block';
                ec.style.display = 'none';
            }
        }

        /* ===== Submit guard ===== */
        document.addEventListener('DOMContentLoaded', function () {
            /* Jika old('email') sudah ada dan valid, langsung unlock */
            var emailVal = document.getElementById('email-input').value.trim();
            if (isValidEmail(emailVal)) {
                setWrapperState('email-wrapper', 'valid');
                lockPassword(false);
            }

            /* Live check password untuk tombol hijau */
            document.getElementById('password-input').addEventListener('input', checkLoginReady);

            /* Cek awal state tombol */
            checkLoginReady();

            document.querySelector('form').addEventListener('submit', function (e) {
                if (!validateEmail()) {
                    e.preventDefault();
                    document.getElementById('email-input').focus();
                }
            });
        });
    </script>
</head>
<body>

    <!-- ===== COVER PANEL ===== -->
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
            <div class="cover-logo">
                <div class="nur-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" class="nur-icon">
                        <defs>
                            <clipPath id="cc"><circle cx="512" cy="512" r="512"/></clipPath>
                            <radialGradient id="bg" cx="50%" cy="45%" r="65%">
                                <stop offset="0%" stop-color="#2ecf8e"/>
                                <stop offset="100%" stop-color="#1aaa72"/>
                            </radialGradient>
                            <filter id="gw" x="-40%" y="-40%" width="180%" height="180%">
                                <feGaussianBlur in="SourceGraphic" stdDeviation="28" result="b1"/>
                                <feGaussianBlur in="SourceGraphic" stdDeviation="12" result="b2"/>
                                <feColorMatrix in="b1" type="matrix" values="0 0 0 0 0.5 0 0 0 0 1 0 0 0 0 0.7 0 0 0 0.6 0" result="cb"/>
                                <feMerge><feMergeNode in="cb"/><feMergeNode in="b2"/><feMergeNode in="SourceGraphic"/></feMerge>
                            </filter>
                        </defs>
                        <g clip-path="url(#cc)">
                            <rect width="1024" height="1024" fill="url(#bg)"/>
                            <text x="510" y="570" text-anchor="middle" dominant-baseline="middle"
                                font-family="'Noto Naskh Arabic','Arabic Typesetting',serif"
                                font-size="430" font-weight="bold" fill="white" direction="rtl" filter="url(#gw)">نور</text>
                        </g>
                    </svg>
                </div>
                <div class="cover-brand">NurSteps</div>
            </div>

            <h1 class="cover-headline">
                Perjalanan Ibadah
                <span>Dimulai dari Sini</span>
            </h1>

            <p class="cover-sub">NurSteps hadir sebagai pendamping setia ibadah harian Anda — mencatat, mengingatkan, dan memotivasi setiap langkah menuju kebaikan.</p>

            <div class="feature-pills">
                <div class="pill"><span class="pill-icon"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="white" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></span>Pelacak Ibadah</div>
                <div class="pill"><span class="pill-icon"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="white" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>Pengingat Shalat</div>
                <div class="pill"><span class="pill-icon"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="white" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></span>Catatan Al-Qur'an</div>
                <div class="pill"><span class="pill-icon"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="white" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg></span>Statistik Amal</div>
            </div>

            <div class="arabic-quote">
                وَالَّذِينَ جَاهَدُوا فِينَا لَنَهْدِيَنَّهُمْ سُبُلَنَا
                <div class="arabic-quote-trans">"Dan orang-orang yang bersungguh-sungguh di jalan Kami, benar-benar akan Kami tunjukkan kepada mereka jalan-jalan Kami." — QS. Al-Ankabut: 69</div>
            </div>
        </div>

        <div class="deco-circles">
            <div class="deco-circle" style="width:14px;height:14px;"></div>
            <div class="deco-circle" style="width:10px;height:10px;"></div>
            <div class="deco-circle" style="width:6px;height:6px;"></div>
        </div>
    </div>

    <!-- ===== FORM PANEL ===== -->
    <div class="form-panel">
        <div class="form-inner">

            <h2 class="form-title">Selamat Datang 👋</h2>
            <p class="form-subtitle">Masuk ke akun NurSteps Anda</p>

            @if (session('status'))
                <div class="error-box">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="error-box">
                    <ul style="list-style:none;padding:0;margin:0;">
                        @foreach ($errors->all() as $error)
                            <li>
                                @php
                                    $terjemahan = [
                                        'These credentials do not match our records.'         => 'Akun dengan email atau kata sandi tersebut tidak ditemukan.',
                                        'The provided credentials are incorrect.'             => 'Email atau kata sandi yang Anda masukkan salah.',
                                        'The provided credentials do not match our records.'  => 'Akun dengan email atau kata sandi tersebut tidak ditemukan.',
                                        'Too many login attempts. Please try again in'        => 'Terlalu banyak percobaan login. Silakan coba lagi dalam',
                                        'seconds.'                                            => 'detik.',
                                        'The email field is required.'                        => 'Kolom email wajib diisi.',
                                        'The password field is required.'                     => 'Kolom kata sandi wajib diisi.',
                                        'The email must be a valid email address.'            => 'Format email tidak valid.',
                                    ];
                                    $pesan = $error;
                                    foreach ($terjemahan as $en => $id) {
                                        if (str_contains($pesan, $en)) {
                                            $pesan = str_replace($en, $id, $pesan);
                                        }
                                    }
                                @endphp
                                {{ $pesan }}
                            </li>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input type="email" id="email-input" name="email" class="form-input"
                            placeholder="contoh@gmail.com"
                            value="{{ old('email') }}"
                            required autofocus autocomplete="username"
                            onfocus="setFocus('email-wrapper')"
                            onblur="validateEmail()"
                            oninput="validateEmailLive()">
                        <svg class="status-icon ok" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <svg class="status-icon err" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div class="field-error" id="email-error">Format email tidak valid. Contoh: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="acc9d4cdc1dcc0c9eccbc1cdc5c082cfc3c1">[email&#160;protected]</a></div>
                </div>

                <!-- Kata Sandi -->
                <div class="form-group">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                        <label class="input-label" for="password-input" style="margin-bottom:0;">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Lupa Kata Sandi?</a>
                        @endif
                    </div>
                    <div class="input-wrapper locked" id="password-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input type="password" id="password-input" name="password"
                            class="form-input has-eye" placeholder="Email harus valid untuk mengisi sandi"
                            disabled autocomplete="current-password"
                            onfocus="setFocus('password-wrapper')"
                            onblur="blurWrapper('password-wrapper')">
                        <button type="button" class="eye-toggle" onclick="togglePassword()" tabindex="-1">
                            <svg id="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Ingat Saya -->
                <div style="margin: 12px 0 20px;">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember_me">
                        <span style="font-size:13px; color:#475569;">Ingat Saya</span>
                    </label>
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" id="login-btn" class="login-btn" disabled>Masuk</button>

                <div class="divider">
                    <div class="divider-line"></div>
                    <span class="divider-text">atau</span>
                    <div class="divider-line"></div>
                </div>

                @if (Route::has('register'))
                    <div class="register-line">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                    </div>
                @endif
            </form>

            <!-- ===== HADITH SECTION ===== -->
            <div class="hadith-section">
                <div class="hadith-card">
                    <p class="hadith-arabic">مَنْ سَلَكَ طَرِيقًا يَلْتَمِسُ فِيهِ عِلْمًا سَهَّلَ اللَّهُ لَهُ طَرِيقًا إِلَى الْجَنَّةِ</p>
                    <div class="hadith-ornament">
                        <div class="ornament-line"></div>
                        <div class="ornament-diamond"></div>
                        <div class="ornament-line"></div>
                    </div>
                    <p class="hadith-text">"Barangsiapa menempuh jalan untuk mencari ilmu, maka Allah akan mudahkan baginya jalan menuju surga." — HR. Muslim</p>
                </div>
            </div>

        </div><!-- /.form-inner -->
    </div><!-- /.form-panel -->

</body>
</html>