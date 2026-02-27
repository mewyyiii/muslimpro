<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register Account - Al-Huda Islamic App</title>
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
            background: linear-gradient(135deg, #14b8a6 0%, #5eead4 50%, #fde68a 100%);
            overflow: hidden;
            position: relative;
            padding: 20px 0;
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

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 40px 35px;
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
            width: 90px;
            height: 90px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .tasbih-icon {
            width: 45px;
            height: 45px;
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
        }

        /* Mobile responsive */
        @media (max-width: 480px) {
            .register-card {
                padding: 35px 28px;
            }

            .icon-container {
                width: 75px;
                height: 75px;
            }

            .tasbih-icon {
                width: 38px;
                height: 38px;
            }

            .title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-card">
            <!-- Tasbih Icon -->
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

            <h2 class="title">Register Account</h2>

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

                <!-- Name -->
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
                            placeholder="Your Name" 
                            value="{{ old('name') }}"
                            required 
                            autofocus
                            onfocus="document.getElementById('name-wrapper').classList.add('focused')"
                            onblur="document.getElementById('name-wrapper').classList.remove('focused')"
                        >
                    </div>
                </div>

                <!-- Username (optional, if you want it) -->
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
                            placeholder="Username" 
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
                            placeholder="Your Email" 
                            value="{{ old('email') }}"
                            required
                            onfocus="document.getElementById('email-wrapper').classList.add('focused')"
                            onblur="document.getElementById('email-wrapper').classList.remove('focused')"
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

                <!-- Confirm Password -->
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
                            placeholder="Confirm Password" 
                            required
                            onfocus="document.getElementById('confirm-password-wrapper').classList.add('focused')"
                            onblur="document.getElementById('confirm-password-wrapper').classList.remove('focused')"
                        >
                    </div>
                </div>

                <!-- Terms -->
                <p class="terms">
                    Don't worry, you can change your username later.<br>
                    Login to <a href="#">Terms of Service</a> & <a href="#">Privacy Policy</a>
                </p>

                <!-- Register Button -->
                <button type="submit" class="register-button">
                    Register
                </button>

                <!-- Login Link -->
                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                </div>
            </form>
        </div>

        <p class="footer-text" style="text-align: center;">
            designed by Al-Huda Team
        </p>
    </div>
</body>
</html>