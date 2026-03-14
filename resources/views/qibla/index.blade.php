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
                    <div class="state-icon-wrap"><svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
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
                    <div class="state-icon-wrap"><svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg></div>
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
                            <div class="qibla-marker-text">Ka'bah <svg width="14" height="13" viewBox="0 0 130 120" fill="none" style="display:inline-block;vertical-align:middle;"><polygon points="65,4 118,28 65,52 12,28" fill="currentColor"/><polygon points="12,28 12,82 65,106 65,52" fill="currentColor" opacity="0.85"/><polygon points="118,28 118,82 65,106 65,52" fill="currentColor" opacity="0.7"/><line x1="12" y1="50" x2="65" y2="70" stroke="rgba(0,0,0,0.3)" stroke-width="3"/><line x1="12" y1="58" x2="65" y2="76" stroke="rgba(0,0,0,0.3)" stroke-width="3"/><line x1="118" y1="50" x2="65" y2="70" stroke="rgba(0,0,0,0.3)" stroke-width="3"/><line x1="118" y1="58" x2="65" y2="76" stroke="rgba(0,0,0,0.3)" stroke-width="3"/></svg></div>
                            <div class="qibla-triangle"></div>
                            <div class="qibla-line"></div>
                        </div>

                        <!-- Rotating face -->
                        <div class="compass-face" :style="`transform: rotate(${-heading}deg)`">
                            <div class="cardinal N">N</div>
                            <div class="cardinal S">S</div>
                            <div class="cardinal E">E</div>
                            <div class="cardinal W">W</div>

                            <!-- Degree ticks (simple, clean) -->
                            <svg style="position:absolute;inset:0;width:100%;height:100%;overflow:visible;" viewBox="0 0 260 260">
                                <g transform="translate(130,130)">
                                    <template x-for="i in 36" :key="i">
                                        <line
                                            :x1="Math.sin((i-1)*10*Math.PI/180)*112"
                                            :y1="-Math.cos((i-1)*10*Math.PI/180)*112"
                                            :x2="Math.sin((i-1)*10*Math.PI/180)*((i-1)%9===0?100:105)"
                                            :y2="-Math.cos((i-1)*10*Math.PI/180)*((i-1)%9===0?100:105)"
                                            :stroke="(i-1)%9===0?'rgba(255,255,255,0.5)':'rgba(255,255,255,0.2)'"
                                            :stroke-width="(i-1)%9===0?'1.5':'1'"
                                        />
                                    </template>
                                </g>
                            </svg>
                        </div>

                        <!-- Qibla Needle -->
                        <div class="needle-wrap" :style="`transform: rotate(${getNeedleAngle()}deg)`">
                            <div class="needle">
                                <div class="needle-kaaba">
                                    <svg width="28" height="26" viewBox="0 0 130 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <polygon points="65,4 118,28 65,52 12,28" fill="white"/>
                                        <polygon points="12,28 12,82 65,106 65,52" fill="white" opacity="0.85"/>
                                        <polygon points="118,28 118,82 65,106 65,52" fill="white" opacity="0.7"/>
                                        <polygon points="12,28 12,82 65,106 118,82 118,28 65,52" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2"/>
                                        <line x1="12" y1="50" x2="65" y2="70" stroke="rgba(0,0,0,0.25)" stroke-width="2.5"/>
                                        <line x1="12" y1="58" x2="65" y2="76" stroke="rgba(0,0,0,0.25)" stroke-width="2.5"/>
                                        <line x1="118" y1="50" x2="65" y2="70" stroke="rgba(0,0,0,0.25)" stroke-width="2.5"/>
                                        <line x1="118" y1="58" x2="65" y2="76" stroke="rgba(0,0,0,0.25)" stroke-width="2.5"/>
                                        <path d="M12,68 Q20,74 28,68 Q36,74 44,68 Q52,74 60,68 Q62,70 65,72" fill="none" stroke="rgba(0,0,0,0.2)" stroke-width="1.5"/>
                                        <path d="M118,68 Q110,74 102,68 Q94,74 86,68 Q78,74 70,68 Q68,70 65,72" fill="none" stroke="rgba(0,0,0,0.2)" stroke-width="1.5"/>
                                    </svg>
                                </div>
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
                        <span class="notice-icon"><svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg></span>
                        <span><strong>Mode Desktop:</strong> Arah ditampilkan dari Utara. Gunakan smartphone untuk kompas digital.</span>
                    </div>
                    <div x-show="compassAvailable" class="notice teal">
                        <span class="notice-icon"><svg width="18" height="18" viewBox="0 0 80 130" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="2" width="72" height="126" rx="14" ry="14"/><rect x="10" y="18" width="60" height="82" rx="3" ry="3" fill="rgba(20,184,166,0.3)"/><rect x="26" y="8" width="20" height="4" rx="2" fill="rgba(255,255,255,0.5)"/><circle cx="20" cy="10" r="2.5" fill="rgba(255,255,255,0.5)"/><circle cx="40" cy="114" r="7" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2"/></svg></span>
                        <span><strong>Kompas Aktif!</strong> Putar device, panah hijau selalu menunjuk ke Ka'bah.</span>
                    </div>
                    <div x-show="needsCompassPermission" class="notice amber" style="flex-direction:column;gap:10px;">
                        <div style="display:flex;gap:8px;align-items:flex-start;">
                            <span class="notice-icon"><svg width="18" height="18" fill="currentColor" viewBox="0 0 338.605 338.605" xmlns="http://www.w3.org/2000/svg"><g><path d="M169.303,0.001C75.949,0.001,0,75.949,0,169.303s75.949,169.302,169.303,169.302s169.303-75.949,169.303-169.302S262.656,0.001,169.303,0.001z M169.303,320c-83.095,0-150.697-67.603-150.697-150.698S86.208,18.605,169.303,18.605S320,86.208,320,169.303S252.397,320,169.303,320z"/><path d="M169.303,27.22C90.958,27.22,27.22,90.958,27.22,169.303s63.738,142.083,142.083,142.083s142.083-63.738,142.083-142.083S247.647,27.22,169.303,27.22z M301.309,189.066l-9.702-1.71l-1.201,6.816l9.708,1.711c-1.095,5.393-2.516,10.668-4.24,15.805l-9.258-3.369l-2.367,6.504l9.255,3.369c-2.015,5.1-4.335,10.046-6.939,14.817l-8.509-4.912l-3.459,5.994l8.494,4.903c-2.863,4.657-6.005,9.124-9.399,13.382l-7.492-6.286l-4.449,5.302l7.486,6.282c-3.615,4.085-7.477,7.946-11.561,11.562l-6.286-7.488l-5.301,4.449l6.29,7.493c-4.258,3.396-8.726,6.538-13.384,9.401l-4.901-8.492l-5.994,3.46l4.909,8.506c-4.771,2.603-9.718,4.924-14.818,6.939l-3.369-9.254l-6.504,2.368l3.37,9.255c-5.138,1.725-10.412,3.146-15.805,4.24l-1.714-9.705l-6.816,1.203l1.713,9.698c-5.339,0.796-10.777,1.28-16.301,1.421v-26.382h-6.922v26.382c-5.523-0.141-10.964-0.625-16.303-1.421l1.714-9.697l-6.814-1.204l-1.716,9.705c-5.393-1.094-10.668-2.515-15.806-4.24l3.371-9.254l-6.502-2.369l-3.371,9.254c-5.101-2.015-10.046-4.336-14.818-6.939l4.91-8.506l-5.994-3.46l-4.901,8.492c-4.658-2.863-9.126-6.005-13.384-9.401l6.288-7.493l-5.301-4.449l-6.284,7.488c-4.085-3.616-7.946-7.477-11.562-11.562l7.486-6.282l-4.449-5.302l-7.492,6.286c-3.395-4.257-6.537-8.725-9.399-13.382l8.494-4.902l-3.459-5.994l-8.509,4.911c-2.604-4.771-4.925-9.717-6.939-14.817l9.254-3.368l-2.367-6.504l-9.256,3.369c-1.725-5.137-3.146-10.412-4.24-15.805l9.708-1.711l-1.201-6.816l-9.702,1.71c-0.797-5.339-1.28-10.779-1.422-16.303h26.381v-6.921H35.875c0.142-5.524,0.625-10.963,1.422-16.302l9.702,1.711l1.201-6.816l-9.708-1.711c1.095-5.393,2.516-10.668,4.24-15.806l9.256,3.369l2.367-6.504l-9.254-3.368c2.016-5.1,4.336-10.046,6.939-14.817l8.509,4.911l3.459-5.994l-8.494-4.903c2.862-4.657,6.005-9.125,9.399-13.382l7.492,6.286l4.449-5.302l-7.486-6.282c3.615-4.084,7.477-7.946,11.562-11.562l6.286,7.489l5.301-4.449l-6.29-7.494c4.258-3.396,8.726-6.538,13.384-9.401l4.901,8.492l5.994-3.46l-4.909-8.506c4.771-2.603,9.718-4.924,14.818-6.939l3.369,9.255l6.504-2.367l-3.37-9.258c5.137-1.725,10.412-3.146,15.805-4.24l1.714,9.708l6.816-1.203l-1.713-9.702c5.339-0.796,10.777-1.28,16.301-1.421v9.846h6.922v-9.846c5.523,0.141,10.962,0.625,16.301,1.421l-1.713,9.702l6.816,1.203l1.714-9.708c5.393,1.094,10.667,2.515,15.804,4.239l-3.369,9.258l6.504,2.367l3.368-9.256c5.101,2.015,10.048,4.336,14.819,6.939l-4.909,8.508l5.994,3.459l4.9-8.493c4.658,2.863,9.126,6.005,13.384,9.401l-6.289,7.495l5.301,4.449l6.285-7.49c4.085,3.617,7.946,7.479,11.563,11.563l-7.486,6.283l4.449,5.302l7.492-6.287c3.395,4.257,6.536,8.724,9.398,13.381l-8.494,4.905l3.461,5.993l8.508-4.913c2.603,4.772,4.924,9.718,6.939,14.818l-9.255,3.37l2.367,6.503l9.258-3.371c1.725,5.138,3.146,10.413,4.24,15.807l-9.708,1.711l1.201,6.816l9.702-1.711c0.797,5.339,1.28,10.778,1.422,16.302H276.35v6.921h26.381C302.589,178.287,302.105,183.727,301.309,189.066z"/><path d="M189.766,191.022c4.402-1.555,7.948-7.063,9.68-14.091l-21.099,7.1C181.032,189.691,185.278,192.607,189.766,191.022z"/><path d="M215.203,182.132c4.328-1.53,7.828-6.876,9.592-13.73l-20.868,7.022C206.612,180.9,210.797,183.691,215.203,182.132z"/><path d="M148.846,191.022c4.482,1.585,8.732-1.331,11.414-6.992l-21.1-7.1C140.893,183.958,144.441,189.468,148.846,191.022z"/><path d="M123.4,182.132c4.415,1.559,8.594-1.232,11.281-6.709l-20.868-7.022C115.573,175.255,119.073,180.602,123.4,182.132z"/><path d="M215.471,193.755c-6.798,2.403-13.084-5.339-14.318-17.397l-0.145,0.049c0.6,12.244-4.198,23.842-10.974,26.239c-6.861,2.424-13.194-5.477-14.35-17.718l-6.379,2.146l-6.377-2.146c-1.156,12.241-7.492,20.141-14.348,17.717c-6.785-2.397-11.584-13.997-10.981-26.241l-0.146-0.049c-1.234,12.06-7.52,19.802-14.319,17.399c-6.713-2.375-11.483-13.792-10.984-25.914l-1.959-0.659v44.239l59.115,19.897l59.115-19.897v-44.239l-1.959,0.659C226.96,179.962,222.189,191.379,215.471,193.755z"/><path d="M110.15,128.777l0.039,0.013v23.872l59.115,19.897l59.115-19.897v-23.873l0.035-0.012l-59.15-21.49L110.15,128.777z M169.305,142.929l-42.667-14.35l42.667-15.501l42.664,15.501L169.305,142.929z"/><polygon points="201.225,110.545 169.303,52.664 137.381,110.436 169.303,91.635"/></g></svg></span>
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
                <div class="kaaba-emoji">
                    <svg width="48" height="48" viewBox="0 0 130 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="65,4 118,28 65,52 12,28" fill="white"/>
                        <polygon points="65,4 118,28 65,52 12,28" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"/>
                        <polygon points="12,28 12,82 65,106 65,52" fill="white" opacity="0.85"/>
                        <polygon points="118,28 118,82 65,106 65,52" fill="white" opacity="0.7"/>
                        <polygon points="12,28 12,82 65,106 118,82 118,28 65,52" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.5"/>
                        <line x1="12" y1="48" x2="65" y2="68" stroke="rgba(0,0,0,0.2)" stroke-width="2"/>
                        <line x1="12" y1="56" x2="65" y2="74" stroke="rgba(0,0,0,0.2)" stroke-width="2"/>
                        <line x1="118" y1="48" x2="65" y2="68" stroke="rgba(0,0,0,0.2)" stroke-width="2"/>
                        <line x1="118" y1="56" x2="65" y2="74" stroke="rgba(0,0,0,0.2)" stroke-width="2"/>
                        <path d="M12,68 Q20,74 28,68 Q36,74 44,68 Q52,74 60,68 Q62,70 65,72" fill="none" stroke="rgba(0,0,0,0.2)" stroke-width="1.5"/>
                        <path d="M118,68 Q110,74 102,68 Q94,74 86,68 Q78,74 70,68 Q68,70 65,72" fill="none" stroke="rgba(0,0,0,0.2)" stroke-width="1.5"/>
                    </svg>
                </div>
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