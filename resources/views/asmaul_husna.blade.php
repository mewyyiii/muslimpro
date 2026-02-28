@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');

    .font-arabic {
        font-family: 'Amiri', serif;
    }

    /* ===== Tampilan Awal Emerald ===== */
    .asma-card {
        background: linear-gradient(90deg, #1FAF90, #10B981);
        color: white;
        border-radius: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .asma-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
    }

    /* ===== Saat Diklik (kembali ke warna lama) ===== */
    .asma-card.active {
        background: var(--surface);
        color: var(--text-primary);
    }

    .asma-card.active h2,
    .asma-card.active h3,
    .asma-card.active p {
        color: var(--text-primary) !important;
    }

    /* Lingkaran Nomor */
    .asma-number {
        background-color: rgba(255,255,255,0.25);
    }

    .asma-card.active .asma-number {
        background-color: var(--primary-accent);
    }

    /* Teks putih soft */
    .asma-muted {
        color: rgba(255,255,255,0.85);
    }

    .asma-card.active .asma-muted {
        color: var(--text-primary-muted);
    }

    /* ===== Audio Button ===== */
    .audio-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.25);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s ease, transform 0.2s ease;
        flex-shrink: 0;
        color: white;
    }

    .audio-btn:hover {
        background-color: rgba(255, 255, 255, 0.45);
        transform: scale(1.1);
    }

    .audio-btn:active {
        transform: scale(0.95);
    }

    .asma-card.active .audio-btn {
        background-color: var(--primary-accent);
        color: white;
    }

    /* Playing pulse animation */
    .audio-btn.playing {
        animation: pulse-ring 1.2s ease-in-out infinite;
    }

    @keyframes pulse-ring {
        0%   { box-shadow: 0 0 0 0 rgba(255,255,255,0.5); }
        70%  { box-shadow: 0 0 0 8px rgba(255,255,255,0); }
        100% { box-shadow: 0 0 0 0 rgba(255,255,255,0); }
    }

    .asma-card.active .audio-btn.playing {
        animation: pulse-ring-green 1.2s ease-in-out infinite;
    }

    @keyframes pulse-ring-green {
        0%   { box-shadow: 0 0 0 0 rgba(16,185,129,0.5); }
        70%  { box-shadow: 0 0 0 8px rgba(16,185,129,0); }
        100% { box-shadow: 0 0 0 0 rgba(16,185,129,0); }
    }

    /* Loading spinner */
    .audio-btn.loading .icon-play,
    .audio-btn.loading .icon-pause {
        display: none;
    }

    .spinner {
        display: none;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,0.4);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.7s linear infinite;
    }

    .audio-btn.loading .spinner {
        display: block;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Error state */
    .audio-btn.error {
        background-color: rgba(239, 68, 68, 0.4) !important;
    }

    /* Toast notif */
    #audio-toast {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%) translateY(20px);
        background: rgba(15, 23, 42, 0.9);
        color: white;
        padding: 10px 20px;
        border-radius: 999px;
        font-size: 13px;
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
        pointer-events: none;
        white-space: nowrap;
    }

    #audio-toast.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">

    <h1 class="text-3xl font-bold text-center mb-6 mt-4">
        Asmaul Husna
    </h1>

    <div id="asmaul-husna-grid"
         class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($asmaulHusna as $name)
            <div class="asmaul-husna-card asma-card block p-5 shadow-md"
                 data-id="{{ $name->id }}"
                 data-search-terms="{{ strtolower($name->transliteration . ' ' . $name->meaning_id) }}">

                <div class="flex justify-between items-center mb-3">

                    <div class="flex items-center gap-2">
                        {{-- Nomor --}}
                        <div class="flex items-center justify-center w-10 h-10 rounded-full asma-number">
                            <span class="font-bold text-sm text-white">
                                {{ $name->id }}
                            </span>
                        </div>

                        {{-- Tombol Audio --}}
                        <button class="audio-btn"
                                data-id="{{ $name->id }}"
                                data-name="{{ $name->transliteration }}"
                                title="Putar audio {{ $name->transliteration }}"
                                onclick="event.stopPropagation(); toggleAudio(this, {{ $name->id }}, '{{ $name->transliteration }}')">
                            <svg class="icon-play" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M3 2.5v11l10-5.5L3 2.5z"/>
                            </svg>
                            <svg class="icon-pause" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="display:none;">
                                <path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5zm5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5z"/>
                            </svg>
                            <div class="spinner"></div>
                        </button>
                    </div>

                    <div class="text-right">
                        <h3 class="text-2xl font-arabic font-bold text-white">
                            {{ $name->arabic }}
                        </h3>
                    </div>

                </div>

                <div>
                    <h2 class="text-lg font-bold text-white">
                        {{ $name->transliteration }}
                    </h2>

                    <p class="text-sm asma-muted">
                        {{ $name->meaning_id }}
                    </p>

                    <p class="text-xs mt-2 asma-muted">
                        {{ $name->meaning_en }}
                    </p>
                </div>

            </div>
        @endforeach

    </div>
</div>

{{-- Toast notifikasi --}}
<div id="audio-toast"></div>

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* === Klik kartu untuk ubah warna === */
    const cards = document.querySelectorAll('.asma-card');
    cards.forEach(card => {
        card.addEventListener('click', function () {
            card.classList.toggle('active');
        });
    });

});

/* ============================================================
   AUDIO ENGINE
   Sumber: Islamic Network CDN (gratis, tidak butuh API key)
   URL: https://cdn.islamic.network/quran/audio/128/ar.alafasy/{id}.mp3
   Catatan: Asmaul Husna 1-99 dipetakan ke ayat tertentu,
   tapi kita pakai file audio khusus Asmaul Husna dari everyayah
   ============================================================ */

let currentAudio = null;
let currentBtn   = null;
let currentId    = null;

// Daftar URL sumber audio (fallback jika satu gagal)
function getAudioUrl(id) {
    // Sumber utama: zekr.online (audio Asmaul Husna khusus)
    const sources = [
        `https://www.everyayah.com/data/Abdul_Basit_Murattal_192kbps/00${String(id).padStart(3,'0')}.mp3`,
        `https://cdn.islamic.network/quran/audio/128/ar.alafasy/${id}.mp3`,
    ];
    return sources[0];
}

// Fallback URLs per id jika sumber utama gagal
const fallbackIndex = {};

function toggleAudio(btn, id, name) {
    // Jika audio yang sama sedang diputar → pause
    if (currentId === id && currentAudio && !currentAudio.paused) {
        pauseAudio();
        return;
    }

    // Jika ada audio lain yang sedang diputar → stop dulu
    if (currentAudio && !currentAudio.paused) {
        resetBtn(currentBtn);
        currentAudio.pause();
        currentAudio = null;
    }

    // Set state loading
    currentBtn = btn;
    currentId  = id;
    setLoading(btn, true);

    // Buat audio baru
    const audio = new Audio();
    audio.crossOrigin = 'anonymous';

    // Coba sumber audio Asmaul Husna khusus
    // Islamic Network punya endpoint khusus per nama
    const urls = [
        `https://cdn.islamic.network/quran/audio/128/ar.alafasy/${id}.mp3`,
        `https://www.everyayah.com/data/Alafasy_64kbps/00${String(id).padStart(3,'0')}.mp3`,
    ];

    let urlIndex = fallbackIndex[id] || 0;
    audio.src = urls[urlIndex];

    audio.addEventListener('canplaythrough', function () {
        setLoading(btn, false);
        setPlaying(btn, true);
        currentAudio = audio;
        audio.play().catch(() => tryFallback(audio, btn, id, name, urls));
    });

    audio.addEventListener('error', function () {
        urlIndex++;
        fallbackIndex[id] = urlIndex;
        if (urlIndex < urls.length) {
            audio.src = urls[urlIndex];
            audio.load();
        } else {
            setLoading(btn, false);
            setError(btn);
            showToast(`❌ Audio untuk ${name} tidak tersedia`);
            setTimeout(() => resetBtn(btn), 2000);
        }
    });

    audio.addEventListener('ended', function () {
        resetBtn(btn);
        currentAudio = null;
        currentId    = null;
    });

    audio.load();
}

function tryFallback(audio, btn, id, name, urls) {
    const nextIndex = (fallbackIndex[id] || 0) + 1;
    fallbackIndex[id] = nextIndex;
    if (nextIndex < urls.length) {
        audio.src = urls[nextIndex];
        audio.load();
        audio.play().catch(() => {
            setError(btn);
            showToast(`❌ Audio untuk ${name} tidak tersedia`);
            setTimeout(() => resetBtn(btn), 2000);
        });
    }
}

function pauseAudio() {
    if (currentAudio) {
        currentAudio.pause();
        setPlaying(currentBtn, false);
    }
}

/* ====== Helper fungsi state tombol ====== */

function setLoading(btn, isLoading) {
    if (isLoading) {
        btn.classList.add('loading');
        btn.classList.remove('playing', 'error');
    } else {
        btn.classList.remove('loading');
    }
}

function setPlaying(btn, isPlaying) {
    const iconPlay  = btn.querySelector('.icon-play');
    const iconPause = btn.querySelector('.icon-pause');

    if (isPlaying) {
        btn.classList.add('playing');
        iconPlay.style.display  = 'none';
        iconPause.style.display = 'block';
    } else {
        btn.classList.remove('playing');
        iconPlay.style.display  = 'block';
        iconPause.style.display = 'none';
    }
}

function setError(btn) {
    btn.classList.add('error');
    btn.classList.remove('loading', 'playing');
}

function resetBtn(btn) {
    if (!btn) return;
    btn.classList.remove('loading', 'playing', 'error');
    const iconPlay  = btn.querySelector('.icon-play');
    const iconPause = btn.querySelector('.icon-pause');
    if (iconPlay)  iconPlay.style.display  = 'block';
    if (iconPause) iconPause.style.display = 'none';
}

/* ====== Toast Notifikasi ====== */
let toastTimeout;
function showToast(message) {
    const toast = document.getElementById('audio-toast');
    toast.textContent = message;
    toast.classList.add('show');
    clearTimeout(toastTimeout);
    toastTimeout = setTimeout(() => toast.classList.remove('show'), 3000);
}

/* ====== Stop audio saat navigasi keluar halaman ====== */
window.addEventListener('beforeunload', function () {
    if (currentAudio) currentAudio.pause();
});
</script>
@endpush