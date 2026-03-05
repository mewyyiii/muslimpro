@extends('layouts.app')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Naskh+Arabic:wght@700&display=swap" rel="stylesheet">
<style>
    :root {
        --teal-deep:   #0d9488;
        --teal-mid:    #14b8a6;
        --teal-light:  #5eead4;
        --emerald:     #10b981;
        --gold:        #f59e0b;
        --dark:        #0f172a;
        --card-bg:     rgba(255,255,255,0.06);
        --card-border: rgba(255,255,255,0.12);
    }

    .qibla-page * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
    .font-arabic  { font-family: 'Noto Naskh Arabic', serif; }

    /* ── Page Shell ── */
    .qibla-page {
        min-height: 100vh;
        background: linear-gradient(160deg, #0d4f47 0%, #0d9488 45%, #0f766e 100%);
        padding: 0 0 32px;
        position: relative;
        overflow-x: hidden;
    }

    /* subtle geometric bg pattern */
    .qibla-page::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image:
            radial-gradient(circle at 80% 10%, rgba(94,234,212,0.15) 0%, transparent 40%),
            radial-gradient(circle at 10% 90%, rgba(16,185,129,0.12) 0%, transparent 40%);
        pointer-events: none;
        z-index: 0;
    }

    .qibla-wrap {
        position: relative;
        z-index: 1;
        max-width: 480px;
        margin: 0 auto;
        padding: 0 16px;
    }

    /* ── Hero Header ── */
    .qibla-hero {
        text-align: center;
        padding: 28px 0 20px;
    }
    .qibla-hero h1 {
        font-size: 28px;
        font-weight: 800;
        color: #fff;
        letter-spacing: -0.5px;
        margin-bottom: 4px;
    }
    .qibla-hero p {
        font-size: 13px;
        color: rgba(255,255,255,0.65);
        font-weight: 500;
    }

    /* ── Glass Card ── */
    .glass-card {
        background: rgba(255,255,255,0.10);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(255,255,255,0.16);
        border-radius: 24px;
        padding: 20px;
        margin-bottom: 12px;
    }

    /* ── State: Need Permission ── */
    .state-permission {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        padding: 10px 0;
    }
    .state-icon-wrap {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        border: 2px solid rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        animation: float-icon 3s ease-in-out infinite;
    }
    @keyframes float-icon {
        0%,100% { transform: translateY(0); }
        50%      { transform: translateY(-8px); }
    }
    .state-title {
        font-size: 17px;
        font-weight: 700;
        color: #fff;
        text-align: center;
    }
    .state-sub {
        font-size: 13px;
        color: rgba(255,255,255,0.6);
        text-align: center;
        line-height: 1.5;
        max-width: 260px;
    }

    /* ── Buttons ── */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 28px;
        background: linear-gradient(135deg, #10b981, #14b8a6);
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        box-shadow: 0 8px 24px rgba(16,185,129,0.4);
        transition: all 0.25s ease;
        letter-spacing: 0.3px;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(16,185,129,0.5);
    }
    .btn-primary:active { transform: translateY(0); }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 22px;
        background: rgba(255,255,255,0.12);
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .btn-secondary:hover { background: rgba(255,255,255,0.2); }

    /* ── Loading ── */
    .state-loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
    }
    .spinner {
        width: 44px; height: 44px;
        border: 3px solid rgba(255,255,255,0.2);
        border-top-color: #5eead4;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* ── Compass ── */
    .compass-section { display: flex; flex-direction: column; gap: 16px; }

    /* Location pill */
    .loc-pill {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 50px;
        padding: 8px 16px;
        width: fit-content;
        margin: 0 auto;
    }
    .loc-pill span { font-size: 12px; color: rgba(255,255,255,0.8); font-weight: 500; }
    .loc-dot { width: 8px; height: 8px; border-radius: 50%; background: #5eead4; box-shadow: 0 0 6px #5eead4; }

    /* Compass container */
    .compass-wrap {
        position: relative;
        width: 260px;
        height: 260px;
        margin: 0 auto;
    }

    .compass-outer-ring {
        position: absolute; inset: 0;
        border-radius: 50%;
        border: 2px solid rgba(255,255,255,0.15);
    }

    /* Qibla fixed marker - static, does NOT rotate */
    .qibla-marker-wrap {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        pointer-events: none;
        z-index: 20;
    }
    /* The triangle pointer at top of compass, rotated to qibla direction */
    .qibla-triangle {
        position: absolute;
        top: -18px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-bottom: 16px solid #f59e0b;
        filter: drop-shadow(0 0 6px rgba(245,158,11,0.9));
    }
    .qibla-marker-text {
        position: absolute;
        top: -36px;
        left: 50%;
        transform: translateX(-50%);
        color: #fbbf24;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 0.5px;
        white-space: nowrap;
        text-shadow: 0 0 8px rgba(245,158,11,0.9);
    }
    /* Dashed line from edge toward center for qibla direction reference */
    .qibla-line {
        position: absolute;
        top: 0;
        left: 50%;
        width: 2px;
        height: 32px;
        background: linear-gradient(to bottom, #f59e0b, rgba(245,158,11,0.1));
        transform: translateX(-50%);
        border-radius: 1px;
    }

    .compass-face {
        position: absolute;
        inset: 10px;
        border-radius: 50%;
        background: radial-gradient(circle at 40% 35%, rgba(255,255,255,0.08) 0%, rgba(0,0,0,0.25) 100%);
        border: 1px solid rgba(255,255,255,0.1);
        transition: transform 0.4s cubic-bezier(0.4,0,0.2,1);
    }

    /* Cardinal labels */
    .cardinal {
        position: absolute;
        font-size: 13px;
        font-weight: 800;
        line-height: 1;
    }
    .cardinal.N { top: 10px; left: 50%; transform: translateX(-50%); color: #f87171; }
    .cardinal.S { bottom: 10px; left: 50%; transform: translateX(-50%); color: rgba(255,255,255,0.5); }
    .cardinal.E { right: 10px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.5); }
    .cardinal.W { left: 10px;  top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.5); }

    /* Degree ticks */
    .tick-ring {
        position: absolute;
        inset: 6px;
        border-radius: 50%;
    }

    /* Needle */
    .needle-wrap {
        position: absolute; inset: 0;
        display: flex; align-items: center; justify-content: center;
        transition: transform 0.5s cubic-bezier(0.4,0,0.2,1);
    }
    .needle {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        transform: translateY(-30px);
    }
    .needle-kaaba { font-size: 22px; margin-bottom: 2px; filter: drop-shadow(0 2px 6px rgba(0,0,0,0.4)); }
    .needle-head {
        width: 0; height: 0;
        border-left: 9px solid transparent;
        border-right: 9px solid transparent;
        border-bottom: 16px solid #10b981;
        filter: drop-shadow(0 0 8px rgba(16,185,129,0.7));
    }
    .needle-body {
        width: 6px;
        height: 80px;
        background: linear-gradient(to bottom, #10b981, #059669);
        border-radius: 0 0 4px 4px;
        box-shadow: 0 0 12px rgba(16,185,129,0.5);
    }

    /* Center dot */
    .compass-center {
        position: absolute; inset: 0;
        display: flex; align-items: center; justify-content: center;
        pointer-events: none;
    }
    .center-dot {
        width: 12px; height: 12px;
        border-radius: 50%;
        background: linear-gradient(135deg, #5eead4, #10b981);
        box-shadow: 0 0 12px rgba(94,234,212,0.8);
        z-index: 10;
    }

    /* ── Stats Row ── */
    .stats-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }
    .stat-card {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 16px;
        padding: 14px 12px;
        text-align: center;
    }
    .stat-label { font-size: 11px; color: rgba(255,255,255,0.5); font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 4px; }
    .stat-value { font-size: 26px; font-weight: 800; color: #5eead4; line-height: 1; }
    .stat-unit  { font-size: 11px; color: rgba(255,255,255,0.5); margin-top: 3px; }

    /* ── Notice Banners ── */
    .notice {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 14px;
        border-radius: 14px;
        font-size: 12.5px;
        font-weight: 500;
        line-height: 1.4;
    }
    .notice.amber {
        background: rgba(245,158,11,0.12);
        border: 1px solid rgba(245,158,11,0.25);
        color: #fde68a;
    }
    .notice.teal {
        background: rgba(20,184,166,0.12);
        border: 1px solid rgba(20,184,166,0.25);
        color: #99f6e4;
    }
    .notice-icon { font-size: 16px; flex-shrink: 0; margin-top: 1px; }

    /* ── Manual Input ── */
    .manual-card .card-title {
        font-size: 14px;
        font-weight: 700;
        color: rgba(255,255,255,0.9);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .input-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px; }
    .input-group label { display: block; font-size: 11px; font-weight: 600; color: rgba(255,255,255,0.5); letter-spacing: 0.4px; margin-bottom: 6px; text-transform: uppercase; }
    .input-group input {
        width: 100%;
        padding: 11px 14px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.14);
        border-radius: 12px;
        color: #fff;
        font-size: 13px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        outline: none;
        transition: border-color 0.2s, background 0.2s;
    }
    .input-group input::placeholder { color: rgba(255,255,255,0.3); }
    .input-group input:focus {
        border-color: rgba(94,234,212,0.5);
        background: rgba(255,255,255,0.12);
    }
    .btn-calc {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #0d9488, #10b981);
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.25s;
        letter-spacing: 0.3px;
    }
    .btn-calc:hover { opacity: 0.9; transform: translateY(-1px); }

    /* ── Kaabah Info Card ── */
    .kaaba-card {
        display: flex;
        align-items: center;
        gap: 16px;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 20px;
        padding: 16px 18px;
        margin-bottom: 12px;
    }
    .kaaba-emoji { font-size: 40px; flex-shrink: 0; }
    .kaaba-text {}
    .kaaba-arabic { font-family: 'Noto Naskh Arabic', serif; font-size: 18px; color: #fff; line-height: 1.3; }
    .kaaba-name { font-size: 12px; color: rgba(255,255,255,0.55); margin-top: 2px; }
    .kaaba-coords { font-size: 11px; color: rgba(255,255,255,0.4); margin-top: 4px; font-weight: 500; }

    /* ── Error ── */
    .state-error { display: flex; flex-direction: column; align-items: center; gap: 12px; padding: 8px 0; }
    .error-msg { font-size: 13px; color: #fca5a5; text-align: center; line-height: 1.5; max-width: 280px; }
    .error-hint { font-size: 12px; color: rgba(255,255,255,0.4); text-align: center; }
</style>
@endpush

@section('content')
<div class="qibla-page">
    <div class="qibla-wrap">

        <!-- Hero -->
        <div class="qibla-hero">
            <h1>Arah Kiblat</h1>
            <p>Temukan arah Ka'bah dari lokasi Anda</p>
        </div>

        <div x-data="qiblaFinder()" x-init="init()">

            <!-- ── Main Card ── -->
            <div class="glass-card">

                <!-- LOADING -->
                <div x-show="status === 'loading'" class="state-loading">
                    <div class="spinner"></div>
                    <p style="color:rgba(255,255,255,0.7);font-size:13px;font-weight:600;">Mendapatkan lokasi Anda…</p>
                </div>

                <!-- NEED PERMISSION -->
                <div x-show="status === 'need-permission'" class="state-permission">
                    <div class="state-icon-wrap">📍</div>
                    <div>
                        <p class="state-title">Izinkan Akses Lokasi</p>
                        <p class="state-sub">Untuk menghitung arah kiblat yang akurat dari posisi Anda saat ini</p>
                    </div>
                    <button @click="requestLocation()" class="btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Aktifkan Lokasi
                    </button>
                </div>

                <!-- ERROR -->
                <div x-show="status === 'error'" class="state-error">
                    <div class="state-icon-wrap">⚠️</div>
                    <p class="error-msg" x-text="errorMessage"></p>
                    <p class="error-hint">Coba aktifkan GPS atau gunakan input manual di bawah</p>
                    <button @click="requestLocation()" class="btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Coba Lagi
                    </button>
                </div>

                <!-- SUCCESS -->
                <div x-show="status === 'success'" class="compass-section">

                    <!-- Location pill -->
                    <div class="loc-pill">
                        <div class="loc-dot"></div>
                        <span>
                            <span x-text="userLocation.lat?.toFixed(4)"></span>°,
                            <span x-text="userLocation.lng?.toFixed(4)"></span>°
                        </span>
                    </div>

                    <!-- Compass -->
                    <div class="compass-wrap">
                        <div class="compass-outer-ring"></div>

                        <!-- Qibla Fixed Marker (rotates to qibla direction, then stays fixed relative to world) -->
                        <div class="qibla-marker-wrap" :style="`transform: rotate(${qiblaAngle - heading}deg)`">
                            <div class="qibla-marker-text">Ka'bah 🕋</div>
                            <div class="qibla-triangle"></div>
                            <div class="qibla-line"></div>
                        </div>

                        <!-- Rotating face -->
                        <div class="compass-face" :style="`transform: rotate(${-heading}deg)`">
                            <div class="cardinal N">N</div>
                            <div class="cardinal S">S</div>
                            <div class="cardinal E">E</div>
                            <div class="cardinal W">W</div>

                            <!-- 36 tick marks -->
                            <template x-for="i in 36" :key="i">
                                <div style="position:absolute;top:50%;left:50%;width:1.5px;transform-origin:0 0;"
                                     :style="`height:${i%9===0?'14px':'8px'};background:rgba(255,255,255,${i%9===0?'0.5':'0.2'});transform:rotate(${i*10}deg) translate(-50%, -${118}px)`">
                                </div>
                            </template>
                        </div>

                        <!-- Qibla Needle -->
                        <div class="needle-wrap" :style="`transform: rotate(${getNeedleAngle()}deg)`">
                            <div class="needle">
                                <div class="needle-kaaba">🕋</div>
                                <div class="needle-head"></div>
                                <div class="needle-body"></div>
                            </div>
                        </div>

                        <!-- Center dot -->
                        <div class="compass-center">
                            <div class="center-dot"></div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="stats-row">
                        <div class="stat-card">
                            <div class="stat-label">Arah Kiblat</div>
                            <div class="stat-value"><span x-text="Math.round(qiblaAngle)"></span>°</div>
                            <div class="stat-unit" x-text="getCardinalDirection(qiblaAngle)"></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Jarak Ka'bah</div>
                            <div class="stat-value" style="font-size:20px;" x-text="distanceToKaaba"></div>
                            <div class="stat-unit">kilometer</div>
                        </div>
                    </div>

                    <!-- Notices -->
                    <div x-show="!compassAvailable && !needsCompassPermission" class="notice amber">
                        <span class="notice-icon">💡</span>
                        <span><strong>Mode Desktop:</strong> Arah ditampilkan dari Utara. Gunakan smartphone untuk kompas digital.</span>
                    </div>
                    <div x-show="compassAvailable" class="notice teal">
                        <span class="notice-icon">📱</span>
                        <span><strong>Kompas Aktif!</strong> Putar device, panah hijau selalu menunjuk ke Ka'bah.</span>
                    </div>
                    <div x-show="needsCompassPermission" class="notice amber" style="flex-direction:column;gap:10px;">
                        <div style="display:flex;gap:8px;align-items:flex-start;">
                            <span class="notice-icon">🧭</span>
                            <span><strong>Izin Kompas Dibutuhkan</strong><br>Tekan tombol untuk mengaktifkan kompas.</span>
                        </div>
                        <button @click="requestCompassPermission()" class="btn-secondary" style="align-self:flex-start;">
                            Aktifkan Kompas
                        </button>
                    </div>

                </div>
            </div>

            <!-- ── Manual Input ── -->
            <div x-show="status === 'success' || status === 'error'" class="glass-card manual-card">
                <div class="card-title">
                    <svg width="16" height="16" fill="none" stroke="rgba(255,255,255,0.6)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    Input Lokasi Manual
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label>Latitude</label>
                        <input type="number" x-model="manualLat" step="0.0001" placeholder="-7.7956">
                    </div>
                    <div class="input-group">
                        <label>Longitude</label>
                        <input type="number" x-model="manualLng" step="0.0001" placeholder="110.3695">
                    </div>
                </div>
                <button @click="setManualLocation()" class="btn-calc">Hitung Arah Kiblat</button>
            </div>

            <!-- ── Ka'bah Info ── -->
            <div class="kaaba-card">
                <div class="kaaba-emoji">🕋</div>
                <div class="kaaba-text">
                    <div class="kaaba-arabic">الْكَعْبَة الْمُشَرَّفَة</div>
                    <div class="kaaba-name">Ka'bah Al-Musharrafah</div>
                    <div class="kaaba-coords">Masjidil Haram, Makkah · 21.4225°N, 39.8262°E</div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function qiblaFinder() {
    return {
        status: 'need-permission',
        errorMessage: '',
        userLocation: { lat: null, lng: null },
        manualLat: null,
        manualLng: null,
        qiblaAngle: 0,
        distanceToKaaba: 0,
        heading: 0,
        compassAvailable: false,
        needsCompassPermission: false,
        kaabaLat: 21.4225,
        kaabaLng: 39.8262,

        init() {
            if (!navigator.geolocation) {
                this.status = 'error';
                this.errorMessage = 'Browser Anda tidak mendukung Geolocation';
            }
            if (window.DeviceOrientationEvent) this.setupCompass();
        },

        requestLocation() {
            this.status = 'loading';
            this.errorMessage = '';
            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    this.userLocation.lat = pos.coords.latitude;
                    this.userLocation.lng = pos.coords.longitude;
                    this.calculateQibla();
                    this.status = 'success';
                },
                (err) => {
                    this.status = 'error';
                    const msgs = {
                        [err.PERMISSION_DENIED]:    'Akses lokasi ditolak. Izinkan di pengaturan browser.',
                        [err.POSITION_UNAVAILABLE]: 'Informasi lokasi tidak tersedia. Pastikan GPS aktif.',
                        [err.TIMEOUT]:              'Request lokasi timeout. Coba lagi.',
                    };
                    this.errorMessage = msgs[err.code] || 'Error mendapatkan lokasi. Coba lagi.';
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        },

        setManualLocation() {
            if (this.manualLat && this.manualLng) {
                this.userLocation.lat = parseFloat(this.manualLat);
                this.userLocation.lng = parseFloat(this.manualLng);
                this.calculateQibla();
                this.status = 'success';
            } else {
                alert('Masukkan latitude dan longitude yang valid');
            }
        },

        calculateQibla() {
            const lat1 = this.toRadians(this.userLocation.lat);
            const lng1 = this.toRadians(this.userLocation.lng);
            const lat2 = this.toRadians(this.kaabaLat);
            const lng2 = this.toRadians(this.kaabaLng);
            const dLng = lng2 - lng1;
            const y = Math.sin(dLng);
            const x = Math.cos(lat1) * Math.tan(lat2) - Math.sin(lat1) * Math.cos(dLng);
            this.qiblaAngle = (this.toDegrees(Math.atan2(y, x)) + 360) % 360;
            this.calculateDistance();
        },

        calculateDistance() {
            const R = 6371;
            const lat1 = this.toRadians(this.userLocation.lat);
            const lat2 = this.toRadians(this.kaabaLat);
            const dLat = this.toRadians(this.kaabaLat - this.userLocation.lat);
            const dLng = this.toRadians(this.kaabaLng - this.userLocation.lng);
            const a = Math.sin(dLat/2)**2 + Math.cos(lat1)*Math.cos(lat2)*Math.sin(dLng/2)**2;
            this.distanceToKaaba = Math.round(6371 * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a))).toLocaleString();
        },

        setupCompass() {
            if (typeof DeviceOrientationEvent !== 'undefined' && typeof DeviceOrientationEvent.requestPermission === 'function') {
                this.needsCompassPermission = true; return;
            }
            this.startCompassListener();
        },

        async requestCompassPermission() {
            try {
                const res = await DeviceOrientationEvent.requestPermission();
                if (res === 'granted') { this.needsCompassPermission = false; this.startCompassListener(); }
                else { this.compassAvailable = false; }
            } catch(e) { this.compassAvailable = false; }
        },

        startCompassListener() {
            const handler = (e) => {
                let h = e.webkitCompassHeading != null ? e.webkitCompassHeading : (e.alpha != null ? 360 - e.alpha : null);
                if (h == null) return;
                const sa = (screen.orientation?.angle ?? window.orientation ?? 0);
                this.heading = (h + sa + 360) % 360;
                this.compassAvailable = true;
            };
            window.addEventListener('deviceorientationabsolute', handler, true);
            window.addEventListener('deviceorientation', handler, true);
        },

        getNeedleAngle() { return (this.qiblaAngle - this.heading + 360) % 360; },

        getCardinalDirection(a) {
            return ['Utara','Timur Laut','Timur','Tenggara','Selatan','Barat Daya','Barat','Barat Laut'][Math.round(a/45)%8];
        },

        toRadians(d) { return d * Math.PI / 180; },
        toDegrees(r) { return r * 180 / Math.PI; }
    };
}
</script>
@endpush