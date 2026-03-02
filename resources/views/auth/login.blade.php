<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Login - NurSteps</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body { height: 100%; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0d9488 0%, #14b8a6 50%, #5eead4 100%);
            background-attachment: fixed;
            overflow-y: auto;
            overflow-x: hidden;
            position: relative;
            padding: 20px 0;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(255,255,255,0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255,255,255,0.15) 0%, transparent 50%);
            animation: moveBackground 20s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes moveBackground {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, 20px); }
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 460px;
            padding: 20px;
            z-index: 1;
            margin: auto;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 50px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .icon-container {
            width: 100px; height: 100px;
            background: white;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-10px); }
        }

        .tasbih-icon { width: 50px; height: 50px; }

        .app-name {
            font-size: 22px;
            font-weight: 800;
            color: #0d9488;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }

        .app-tagline {
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 28px;
        }

        .form-group { margin-bottom: 16px; position: relative; }

        .input-wrapper {
            position: relative;
            background: rgba(13, 148, 136, 0.08);
            border-radius: 25px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .input-wrapper:hover  { background: rgba(13, 148, 136, 0.13); }
        .input-wrapper:focus-within {
            background: rgba(13, 148, 136, 0.15);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
        }

        .form-input {
            width: 100%;
            padding: 15px 20px 15px 52px;
            border: none;
            background: transparent;
            font-size: 15px;
            color: #2d3748;
            outline: none;
        }

        .form-input::placeholder { color: rgba(45, 55, 72, 0.45); }

        .input-icon {
            position: absolute;
            left: 18px; top: 50%;
            transform: translateY(-50%);
            width: 20px; height: 20px;
            color: #14b8a6;
        }

        .checkbox-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 18px 0;
            font-size: 13px;
        }

        .remember-me {
            display: flex; align-items: center; gap: 8px;
            color: #4a5568; cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 17px; height: 17px;
            accent-color: #14b8a6;
        }

        .forgot-password {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-password:hover { color: #0d9488; }

        .login-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            background: linear-gradient(135deg, #0d9488, #14b8a6);
            color: white;
            box-shadow: 0 8px 20px rgba(13, 148, 136, 0.4);
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            margin-top: 6px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(13, 148, 136, 0.5);
        }

        .login-button:active { transform: translateY(0); }

        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 20px 0;
            color: #cbd5e1;
            font-size: 12px;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .register-link {
            margin-top: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .register-link a {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover { text-decoration: underline; }

        .footer-text {
            margin-top: 20px;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.75);
            text-align: center;
        }

        @media (max-width: 480px) {
            body { align-items: flex-start; padding: 24px 0 32px; }
            .container { padding: 16px; }
            .login-card { padding: 36px 24px; }
            .icon-container { width: 80px; height: 80px; }
            .tasbih-icon { width: 40px; height: 40px; }
            .app-name { font-size: 18px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card">

            <!-- Icon -->
            <div class="icon-container">
                <svg viewBox="0 0 100 120" class="tasbih-icon" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="11" r="6" fill="#14b8a6"/>
                    <circle cx="68" cy="16" r="5.5" fill="#14b8a6"/>
                    <circle cx="80" cy="29" r="5.5" fill="#14b8a6"/>
                    <circle cx="84" cy="46" r="5.5" fill="#14b8a6"/>
                    <circle cx="78" cy="62" r="5.5" fill="#14b8a6"/>
                    <circle cx="64" cy="73" r="5.5" fill="#14b8a6"/>
                    <circle cx="50" cy="77" r="6" fill="#14b8a6"/>
                    <circle cx="36" cy="73" r="5.5" fill="#14b8a6"/>
                    <circle cx="22" cy="62" r="5.5" fill="#14b8a6"/>
                    <circle cx="16" cy="46" r="5.5" fill="#14b8a6"/>
                    <circle cx="20" cy="29" r="5.5" fill="#14b8a6"/>
                    <circle cx="32" cy="16" r="5.5" fill="#14b8a6"/>
                    <circle cx="50" cy="85" r="5" fill="#14b8a6"/>
                    <line x1="44" y1="90" x2="41" y2="108" stroke="#14b8a6" stroke-width="3" stroke-linecap="round"/>
                    <line x1="50" y1="90" x2="50" y2="110" stroke="#14b8a6" stroke-width="3" stroke-linecap="round"/>
                    <line x1="56" y1="90" x2="59" y2="108" stroke="#14b8a6" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>

            <p class="app-name">NurSteps</p>
            <p class="app-tagline">Pendamping Ibadah Anda</p>

            <form onsubmit="return false;">

                <!-- Email -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input type="email" class="form-input" placeholder="Email">
                    </div>
                </div>

                <!-- Kata Sandi -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input type="password" class="form-input" placeholder="Kata Sandi">
                    </div>
                </div>

                <!-- Ingat Saya & Lupa Kata Sandi -->
                <div class="checkbox-group">
                    <label class="remember-me">
                        <input type="checkbox">
                        <span>Ingat Saya</span>
                    </label>
                    <a href="#" class="forgot-password">Lupa Kata Sandi?</a>
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" class="login-button">Masuk</button>

                <div class="divider">atau</div>

                <!-- Link Daftar -->
                <div class="register-link">
                    Belum punya akun? <a href="#">Daftar sekarang</a>
                </div>

            </form>
        </div>

        <p class="footer-text">dibuat oleh Tim Al-Huda</p>
    </div>
</body>
</html>