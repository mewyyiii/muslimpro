@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap');

    .upgrade-page {
        font-family: 'DM Sans', sans-serif;
        min-height: 100vh;
        background: #f0faf6;
        position: relative;
        overflow: hidden;
    }

    .upgrade-page::before {
        content: '';
        position: fixed;
        top: -200px;
        right: -200px;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(20,184,166,0.12) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .upgrade-page::after {
        content: '';
        position: fixed;
        bottom: -150px;
        left: -150px;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(16,185,129,0.1) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .card-wrapper {
        position: relative;
        z-index: 1;
    }

    .pro-card {
        background: white;
        border-radius: 28px;
        overflow: hidden;
        box-shadow:
            0 4px 6px rgba(0,0,0,0.04),
            0 20px 60px rgba(20,184,166,0.12),
            0 1px 0 rgba(255,255,255,0.8) inset;
        border: 1px solid rgba(20,184,166,0.1);
        animation: cardIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        opacity: 0;
        transform: translateY(30px);
    }

    @keyframes cardIn {
        to { opacity: 1; transform: translateY(0); }
    }

    .hero-section {
        background: linear-gradient(135deg, #0d9488 0%, #059669 50%, #047857 100%);
        padding: 48px 40px 40px;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: 30%;
        width: 140px;
        height: 140px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .pro-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.25);
        backdrop-filter: blur(10px);
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 600;
        color: white;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.4rem;
        font-weight: 900;
        color: white;
        line-height: 1.15;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .hero-subtitle {
        color: rgba(255,255,255,0.75);
        font-size: 15px;
        font-weight: 400;
        position: relative;
        z-index: 1;
    }

    .price-section {
        padding: 36px 40px;
        border-bottom: 1px solid #f0fdf4;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .price-label {
        font-size: 13px;
        color: #9ca3af;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .price-amount {
        font-family: 'Playfair Display', serif;
        font-size: 2.6rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1;
    }

    .price-note {
        font-size: 12px;
        color: #10b981;
        font-weight: 600;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }



    .benefits-section {
        padding: 28px 40px;
    }

    .benefits-title {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #9ca3af;
        margin-bottom: 16px;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px solid #f9fafb;
        animation: fadeSlideIn 0.5s ease forwards;
        opacity: 0;
    }

    .benefit-item:last-child { border-bottom: none; }
    .benefit-item:nth-child(1) { animation-delay: 0.15s; }
    .benefit-item:nth-child(2) { animation-delay: 0.25s; }
    .benefit-item:nth-child(3) { animation-delay: 0.35s; }

    @keyframes fadeSlideIn {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .benefit-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }

    .benefit-text {
        font-size: 14px;
        color: #1f2937;
        font-weight: 600;
    }

    .benefit-desc {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 2px;
    }

    .action-section {
        padding: 4px 40px 36px;
    }

    #error-box {
        margin: 0 0 16px;
        padding: 12px 16px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 12px;
    }

    #error-box p { font-size: 13px; color: #dc2626; }

    .pay-btn {
        width: 100%;
        background: linear-gradient(135deg, #0d9488, #059669);
        color: white;
        font-family: 'DM Sans', sans-serif;
        font-size: 16px;
        font-weight: 600;
        padding: 18px 24px;
        border-radius: 16px;
        border: none;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 20px rgba(13,148,136,0.35), 0 1px 0 rgba(255,255,255,0.15) inset;
        position: relative;
        overflow: hidden;
    }

    .pay-btn::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
        transition: left 0.5s ease;
    }

    .pay-btn:hover::before { left: 100%; }
    .pay-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(13,148,136,0.4); }
    .pay-btn:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

    .secure-note {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 14px;
        font-size: 12px;
        color: #9ca3af;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 24px;
        font-size: 14px;
        color: #9ca3af;
        text-decoration: none;
        transition: color 0.2s;
    }

    .back-link:hover { color: #0d9488; }

    .shape {
        position: fixed;
        pointer-events: none;
        z-index: 0;
    }

    .shape-1 {
        top: 10%; left: 5%;
        width: 60px; height: 60px;
        border: 2px solid rgba(20,184,166,0.2);
        border-radius: 12px;
        transform: rotate(20deg);
        animation: float1 6s ease-in-out infinite;
    }

    .shape-2 {
        top: 60%; right: 8%;
        width: 40px; height: 40px;
        border: 2px solid rgba(16,185,129,0.2);
        border-radius: 50%;
        animation: float2 8s ease-in-out infinite;
    }

    .shape-3 {
        bottom: 15%; left: 10%;
        width: 24px; height: 24px;
        background: rgba(20,184,166,0.12);
        border-radius: 6px;
        transform: rotate(45deg);
        animation: float1 7s ease-in-out infinite reverse;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes float1 {
        0%, 100% { transform: rotate(20deg) translateY(0); }
        50% { transform: rotate(20deg) translateY(-12px); }
    }

    @keyframes float2 {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-16px); }
    }
</style>

<div class="upgrade-page flex items-center justify-center px-4 py-12">

    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <div class="card-wrapper w-full max-w-md">
        <div class="pro-card">

            {{-- Hero --}}
            <div class="hero-section">
                <div class="pro-badge">✦ NurSteps Pro</div>
                <h1 class="hero-title">Pengalaman<br>tanpa batas.</h1>
                <p class="hero-subtitle">Nikmati NurSteps bebas iklan, selamanya.</p>
            </div>

            {{-- Price --}}
            <div class="price-section">
                <div>
                    <div class="price-label">Investasi sekali</div>
                    <div class="price-amount">Rp {{ number_format($price, 0, ',', '.') }}</div>
                    <div class="price-note">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
                        Bayar sekali, nikmati selamanya
                    </div>
                </div>

            </div>

            {{-- Benefits --}}
            <div class="benefits-section">
                <div class="benefits-title">Yang kamu dapatkan</div>

                <div class="benefit-item">
                    <div class="benefit-icon" style="background:#ecfdf5;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                        </svg>
                    </div>
                    <div>
                        <div class="benefit-text">Bebas Iklan Sebulan</div>
                        <div class="benefit-desc">Tidak ada lagi banner yang mengganggu ibadahmu</div>
                    </div>
                </div>


            </div>

            {{-- Error --}}
            <div id="error-box" class="hidden" style="margin: 0 40px 16px;">
                <p id="error-message"></p>
            </div>

            {{-- Action --}}
            <div class="action-section">
                <button id="pay-button" onclick="handleCheckout()" class="pay-btn">
                    <span id="btn-text">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle;margin-right:6px"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                        Upgrade Sekarang
                    </span>
                    <span id="btn-loading" class="hidden" style="display:none;align-items:center;gap:8px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;">
                            <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                        </svg>
                        Memproses...
                    </span>
                </button>

                <div class="secure-note">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Pembayaran aman diproses oleh <strong style="color:#6b7280;margin-left:3px;">Midtrans</strong>
                </div>
            </div>

        </div>

        <a href="{{ route('home') }}" class="back-link">← Kembali ke beranda</a>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
function showError(message) {
    const box = document.getElementById('error-box');
    const msg = document.getElementById('error-message');
    box.classList.remove('hidden');
    msg.textContent = message;
}

function resetButton() {
    const btn     = document.getElementById('pay-button');
    const btnText = document.getElementById('btn-text');
    const btnLoad = document.getElementById('btn-loading');
    btn.disabled = false;
    btnText.classList.remove('hidden');
    btnText.style.display = 'inline-flex';
    btnLoad.classList.add('hidden');
    btnLoad.style.display = 'none';
}

async function handleCheckout() {
    const btn     = document.getElementById('pay-button');
    const btnText = document.getElementById('btn-text');
    const btnLoad = document.getElementById('btn-loading');

    document.getElementById('error-box').classList.add('hidden');

    btn.disabled = true;
    btnText.classList.add('hidden');
    btnText.style.display = 'none';
    btnLoad.classList.remove('hidden');
    btnLoad.style.display = 'inline-flex';

    try {
        const response = await fetch('{{ route('payment.checkout') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        });

        if (!response.ok) {
            const errorData = await response.json().catch(() => null);
            const message = errorData?.message || 'Server error ' + response.status + '. Cek konfigurasi Midtrans.';
            showError(message);
            resetButton();
            return;
        }

        const data = await response.json();

        if (!data.snap_token) {
            showError('Snap token tidak ditemukan. Cek konfigurasi Midtrans.');
            resetButton();
            return;
        }

        snap.pay(data.snap_token, {
            onSuccess: function(result) {
                window.location.href = '{{ route('home') }}?upgrade=success';
            },
            onPending: function(result) {
                window.location.href = '{{ route('home') }}?upgrade=pending';
            },
            onError: function(result) {
                showError('Pembayaran gagal, silakan coba lagi.');
                resetButton();
            },
            onClose: function() {
                resetButton();
            },
        });

    } catch (error) {
        showError('Koneksi gagal: ' + error.message);
        resetButton();
    }
}
</script>
@endpush