<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Islamic App</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
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
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: moveBackground 20s ease-in-out infinite;
        }

        @keyframes moveBackground {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, 20px); }
        }

        /* Decorative mosque silhouette */
        .mosque-decoration {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0.1;
            width: 100%;
            max-width: 600px;
            pointer-events: none;
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 420px;
            padding: 20px;
            z-index: 1;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 50px 35px;
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

        .tasbih-container {
            margin-bottom: 30px;
            animation: swingTasbih 3s ease-in-out infinite;
            transform-origin: top center;
        }

        @keyframes swingTasbih {
            0%, 100% { transform: rotate(-5deg); }
            50% { transform: rotate(5deg); }
        }

        .tasbih {
            width: 120px;
            height: auto;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.2));
        }

        .app-name {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .app-tagline {
            font-size: 14px;
            color: #718096;
            margin-bottom: 35px;
        }

        .welcome-text {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 14px;
            color: #718096;
            margin-bottom: 30px;
        }

        .login-button {
            width: 100%;
            padding: 16px;
            margin-bottom: 15px;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .login-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .login-button:active {
            transform: scale(0.98);
        }

        .btn-email {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-email:hover {
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
            transform: translateY(-2px);
        }

        .btn-google {
            background: white;
            color: #2d3748;
            border: 2px solid #e2e8f0;
        }

        .btn-google:hover {
            border-color: #cbd5e0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .btn-facebook {
            background: #1877f2;
            color: white;
            box-shadow: 0 10px 25px rgba(24, 119, 242, 0.3);
        }

        .btn-facebook:hover {
            background: #166fe5;
            box-shadow: 0 15px 35px rgba(24, 119, 242, 0.4);
            transform: translateY(-2px);
        }

        .icon {
            width: 24px;
            height: 24px;
            position: relative;
            z-index: 1;
        }

        .button-text {
            position: relative;
            z-index: 1;
        }

        .terms {
            font-size: 12px;
            color: #a0aec0;
            margin-top: 25px;
            line-height: 1.6;
        }

        .terms a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #a0aec0;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #e2e8f0, transparent);
        }

        .divider span {
            padding: 0 15px;
        }

        /* Floating particles */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 15s infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .particle:nth-child(1) {
            left: 10%;
            width: 10px;
            height: 10px;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            left: 30%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            left: 50%;
            width: 8px;
            height: 8px;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            left: 70%;
            width: 12px;
            height: 12px;
            animation-delay: 6s;
        }

        .particle:nth-child(5) {
            left: 90%;
            width: 10px;
            height: 10px;
            animation-delay: 8s;
        }

        /* Mobile responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 40px 25px;
            }

            .app-name {
                font-size: 24px;
            }

            .welcome-text {
                font-size: 18px;
            }

            .login-button {
                padding: 14px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating particles -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <!-- Mosque decoration -->
    <svg class="mosque-decoration" viewBox="0 0 800 400" fill="white">
        <path d="M400 50 L420 100 L440 100 L440 200 L360 200 L360 100 L380 100 Z"/>
        <circle cx="400" cy="30" r="20"/>
        <path d="M200 150 L250 120 L250 250 L150 250 L150 120 Z"/>
        <path d="M600 150 L550 120 L550 250 L650 250 L650 120 Z"/>
        <ellipse cx="200" cy="120" rx="30" ry="40"/>
        <ellipse cx="600" cy="120" rx="30" ry="40"/>
        <rect x="100" y="250" width="600" height="100" rx="10"/>
        <path d="M150 280 Q200 250 250 280"/>
        <path d="M300 280 Q350 250 400 280"/>
        <path d="M450 280 Q500 250 550 280"/>
        <path d="M600 280 Q625 250 650 280"/>
    </svg>

    <div class="container">
        <div class="login-card">
            <!-- Tasbih animation -->
            <div class="tasbih-container">
                <svg class="tasbih" viewBox="0 0 120 180" fill="none">
                    <!-- String -->
                    <path d="M60 10 Q65 15 60 20" stroke="#48bb78" stroke-width="3" fill="none"/>
                    
                    <!-- Beads -->
                    <circle cx="50" cy="25" r="8" fill="#48bb78"/>
                    <circle cx="70" cy="25" r="8" fill="#48bb78"/>
                    <circle cx="45" cy="40" r="8" fill="#48bb78"/>
                    <circle cx="75" cy="40" r="8" fill="#48bb78"/>
                    <circle cx="42" cy="55" r="8" fill="#48bb78"/>
                    <circle cx="78" cy="55" r="8" fill="#48bb78"/>
                    <circle cx="40" cy="70" r="8" fill="#48bb78"/>
                    <circle cx="80" cy="70" r="8" fill="#48bb78"/>
                    <circle cx="40" cy="85" r="8" fill="#48bb78"/>
                    <circle cx="80" cy="85" r="8" fill="#48bb78"/>
                    <circle cx="42" cy="100" r="8" fill="#48bb78"/>
                    <circle cx="78" cy="100" r="8" fill="#48bb78"/>
                    <circle cx="45" cy="115" r="8" fill="#48bb78"/>
                    <circle cx="75" cy="115" r="8" fill="#48bb78"/>
                    <circle cx="50" cy="130" r="8" fill="#48bb78"/>
                    <circle cx="70" cy="130" r="8" fill="#48bb78"/>
                    <circle cx="55" cy="145" r="8" fill="#48bb78"/>
                    <circle cx="65" cy="145" r="8" fill="#48bb78"/>
                    
                    <!-- Tassel -->
                    <path d="M52 155 L48 175 M60 155 L60 180 M68 155 L72 175" stroke="#48bb78" stroke-width="2"/>
                </svg>
            </div>

            <h1 class="app-name">Islamic Life</h1>
            <p class="app-tagline">Your Daily Spiritual Companion</p>

            <h2 class="welcome-text">Selamat Datang</h2>
            <p class="subtitle">Buat akun untuk menyimpan progres Anda</p>

            <button class="login-button btn-email" onclick="loginWithEmail()">
                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                </svg>
                <span class="button-text">Lanjutkan dengan Email</span>
            </button>

            <div class="divider">
                <span>atau</span>
            </div>

            <button class="login-button btn-google" onclick="loginWithGoogle()">
                <svg class="icon" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                <span class="button-text">Lanjutkan dengan Google</span>
            </button>

            <button class="login-button btn-facebook" onclick="loginWithFacebook()">
                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                <span class="button-text">Lanjutkan dengan Facebook</span>
            </button>

            <p class="terms">
                Dengan menggunakan aplikasi ini, Anda menyetujui <a href="#" onclick="showTerms()">Syarat & Ketentuan</a> kami
            </p>
        </div>
    </div>

    <script>
        function loginWithEmail() {
            alert('Login dengan Email - Akan diarahkan ke halaman pendaftaran email');
            // Implement email login logic here
            // window.location.href = '/register-email';
        }

        function loginWithGoogle() {
            alert('Login dengan Google - Integrasi Google OAuth akan dijalankan');
            // Implement Google OAuth here
            // Example: firebase.auth().signInWithPopup(googleProvider)
        }

        function loginWithFacebook() {
            alert('Login dengan Facebook - Integrasi Facebook Login akan dijalankan');
            // Implement Facebook Login here
            // Example: firebase.auth().signInWithPopup(facebookProvider)
        }

        function showTerms() {
            alert('Menampilkan Syarat & Ketentuan');
            // Navigate to terms page
        }

        // Add smooth entrance animation
        window.addEventListener('load', function() {
            document.querySelector('.login-card').style.animation = 'slideUp 0.6s ease-out';
        });
    </script>
</body>
</html>