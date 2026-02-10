<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Al-Huda Islamic App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0d9488 0%, #14b8a6 50%, #5eead4 100%);
            overflow: hidden;
            position: relative;
        }

        /* Animated background pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 50%);
            animation: moveBackground 20s ease-in-out infinite;
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
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-container {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .tasbih-icon {
            width: 50px;
            height: 50px;
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
            margin: 20px 0;
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
            background: white;
            color: #0d9488;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .register-link {
            margin-top: 25px;
            font-size: 14px;
            color: #4a5568;
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
            margin-top: 20px;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Mobile responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 40px 30px;
            }

            .icon-container {
                width: 80px;
                height: 80px;
            }

            .tasbih-icon {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <!-- Tasbih Icon -->
            <div class="icon-container">
                <svg class="tasbih-icon" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Tasbih design -->
                    <circle cx="32" cy="12" r="4" fill="#14b8a6"/>
                    <circle cx="26" cy="18" r="3.5" fill="#14b8a6"/>
                    <circle cx="38" cy="18" r="3.5" fill="#14b8a6"/>
                    <circle cx="22" cy="24" r="3.5" fill="#14b8a6"/>
                    <circle cx="42" cy="24" r="3.5" fill="#14b8a6"/>
                    <circle cx="20" cy="30" r="3.5" fill="#14b8a6"/>
                    <circle cx="44" cy="30" r="3.5" fill="#14b8a6"/>
                    <circle cx="20" cy="36" r="3.5" fill="#14b8a6"/>
                    <circle cx="44" cy="36" r="3.5" fill="#14b8a6"/>
                    <circle cx="22" cy="42" r="3.5" fill="#14b8a6"/>
                    <circle cx="42" cy="42" r="3.5" fill="#14b8a6"/>
                    <circle cx="26" cy="48" r="3.5" fill="#14b8a6"/>
                    <circle cx="38" cy="48" r="3.5" fill="#14b8a6"/>
                    <circle cx="32" cy="54" r="4" fill="#14b8a6"/>
                    <!-- String -->
                    <path d="M32 8 Q28 10 26 18 Q24 22 22 24 Q20 26 20 30 L20 36 Q20 38 22 42 Q24 46 26 48 Q28 52 32 54" 
                          stroke="#0d9488" stroke-width="2" fill="none"/>
                    <path d="M32 8 Q36 10 38 18 Q40 22 42 24 Q44 26 44 30 L44 36 Q44 38 42 42 Q40 46 38 48 Q36 52 32 54" 
                          stroke="#0d9488" stroke-width="2" fill="none"/>
                    <!-- Tassel -->
                    <line x1="28" y1="56" x2="26" y2="62" stroke="#14b8a6" stroke-width="1.5"/>
                    <line x1="32" y1="58" x2="32" y2="64" stroke="#14b8a6" stroke-width="1.5"/>
                    <line x1="36" y1="56" x2="38" y2="62" stroke="#14b8a6" stroke-width="1.5"/>
                </svg>
            </div>

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

                <!-- Username/Email -->
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
                            placeholder="Username" 
                            value="{{ old('email') }}"
                            required 
                            autofocus
                            onfocus="document.getElementById('username-wrapper').classList.add('focused')"
                            onblur="document.getElementById('username-wrapper').classList.remove('focused')"
                        >
                    </div>
                </div>

                <!-- Password -->
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
                            placeholder="Password" 
                            required
                            onfocus="document.getElementById('password-wrapper').classList.add('focused')"
                            onblur="document.getElementById('password-wrapper').classList.remove('focused')"
                        >
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="checkbox-group">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember_me">
                        <span>Remember Me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" class="login-button">
                    Login
                </button>

                <!-- Register Link -->
                @if (Route::has('register'))
                    <div class="register-link">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                    </div>
                @endif
            </form>
        </div>

        <p class="footer-text" style="text-align: center;">
            designed by Al-Huda Team
        </p>
    </div>
</body>
</html>