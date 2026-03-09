@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full">

        {{-- Card Upgrade --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-teal-600 to-emerald-500 px-8 py-10 text-center text-white">
                <div class="text-5xl mb-3">✨</div>
                <h1 class="text-2xl font-bold">Upgrade ke Pro</h1>
                <p class="text-teal-100 text-sm mt-2">Nikmati NurSteps tanpa gangguan iklan</p>
            </div>

            {{-- Price --}}
            <div class="text-center py-8 border-b border-gray-100">
                <p class="text-gray-400 text-sm">Hanya</p>
                <p class="text-4xl font-bold text-gray-800 mt-1">
                    Rp {{ number_format($price, 0, ',', '.') }}
                </p>
                <p class="text-gray-400 text-sm mt-1">pembayaran sekali seumur hidup</p>
            </div>

            {{-- Benefits --}}
            <div class="px-8 py-6 space-y-3">
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="text-teal-500 font-bold">✓</span> Bebas iklan banner selamanya
                </div>
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="text-teal-500 font-bold">✓</span> Mendukung pengembangan NurSteps
                </div>
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="text-teal-500 font-bold">✓</span> Akses fitur premium mendatang
                </div>
            </div>

            {{-- Error Message --}}
            <div id="error-box" class="hidden mx-8 mb-4 px-4 py-3 bg-red-50 border border-red-200 rounded-xl">
                <p class="text-sm text-red-600" id="error-message"></p>
            </div>

            {{-- Button --}}
            <div class="px-8 pb-8">
                <button
                    id="pay-button"
                    onclick="handleCheckout()"
                    class="w-full bg-gradient-to-r from-teal-600 to-emerald-500 hover:from-teal-700 hover:to-emerald-600
                           text-white font-semibold py-4 rounded-2xl transition duration-200 shadow-md
                           flex items-center justify-center gap-2"
                >
                    <span id="btn-text">💳 Bayar Sekarang</span>
                    <span id="btn-loading" class="hidden">⏳ Memproses...</span>
                </button>

                <p class="text-center text-xs text-gray-400 mt-4">
                    Pembayaran aman diproses oleh
                    <span class="font-semibold text-gray-500">Midtrans</span>
                </p>
            </div>

        </div>

        {{-- Back --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-teal-600 transition">
                ← Kembali ke beranda
            </a>
        </div>

    </div>
</div>
@endsection

@push('scripts')
{{-- Midtrans Snap JS --}}
<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
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
    btnLoad.classList.add('hidden');
}

async function handleCheckout() {
    const btn     = document.getElementById('pay-button');
    const btnText = document.getElementById('btn-text');
    const btnLoad = document.getElementById('btn-loading');

    // Reset error
    document.getElementById('error-box').classList.add('hidden');

    // Loading state
    btn.disabled = true;
    btnText.classList.add('hidden');
    btnLoad.classList.remove('hidden');

    try {
        const response = await fetch('{{ route('payment.checkout') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        });

        // ← Tangkap error 500 / non-200
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

        // Buka Midtrans Snap popup
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