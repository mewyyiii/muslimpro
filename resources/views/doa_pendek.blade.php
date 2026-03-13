@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');

    .font-arabic { font-family: 'Amiri', serif; }

    /* ===== GRID ===== */
    #doa-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        align-items: start;
    }
    @media (max-width: 1024px) { #doa-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 700px)  { #doa-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 440px)  { #doa-grid { grid-template-columns: 1fr; } }

    /* ===== Card ===== */
    .doa-card {
        background: linear-gradient(135deg, #1FAF90, #10B981);
        color: white;
        border-radius: 14px;
        padding: 14px;
        cursor: pointer;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), box-shadow 0.3s ease;
        position: relative;
    }
    .doa-card:hover { transform: translateY(-4px); box-shadow: 0 14px 26px rgba(16,185,129,0.28); }

    .doa-card.active {
        background: var(--surface, #ffffff);
        color: var(--text-primary, #1f2937);
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        transform: none;
    }
    .doa-card.active h2,
    .doa-card.active h3,
    .doa-card.active p { color: var(--text-primary, #1f2937) !important; }

    /* ===== Header ===== */
    .doa-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        min-height: 56px;
        gap: 8px;
    }
    .doa-card-header-left {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
        flex: 1;
    }

    .doa-number {
        display: flex; align-items: center; justify-content: center;
        width: 36px; height: 36px; min-width: 36px;
        border-radius: 50%;
        background: rgba(255,255,255,0.25);
        font-size: 0.78rem; font-weight: 700; color: white;
        transition: background 0.3s, color 0.3s;
    }
    .doa-card.active .doa-number { background: #10B981; color: white; }

    .doa-card h2 {
        font-size: 0.88rem; font-weight: 600; color: white;
        line-height: 1.4; transition: color 0.3s;
    }

    .doa-muted { color: rgba(255,255,255,0.85); transition: color 0.3s; }
    .doa-card.active .doa-muted { color: var(--text-primary-muted, #6b7280); }

    /* ===== Chevron ===== */
    .doa-chevron {
        width: 26px; min-width: 26px; height: 26px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        transition: background 0.3s ease;
    }
    .doa-chevron svg {
        width: 13px; height: 13px;
        stroke: rgba(255,255,255,0.95); fill: none; display: block;
        transition: stroke 0.3s ease, transform 0.35s cubic-bezier(0.4,0,0.2,1);
    }
    .doa-card.active .doa-chevron { background: rgba(16,185,129,0.12); }
    .doa-card.active .doa-chevron svg { stroke: #10B981; transform: rotate(180deg); }

    /* ===== Konten ===== */
    .doa-content {
        overflow: hidden;
        max-height: 0; opacity: 0;
        transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1), opacity 0.3s ease;
    }
    .doa-content.open { max-height: 380px; overflow-y: auto; opacity: 1; }
    .doa-content.open::-webkit-scrollbar { width: 4px; }
    .doa-content.open::-webkit-scrollbar-track { background: transparent; }
    .doa-content.open::-webkit-scrollbar-thumb { background: rgba(16,185,129,0.4); border-radius: 99px; }

    .doa-divider {
        height: 1px; background: rgba(255,255,255,0.22);
        margin: 12px 0; transition: background 0.3s;
    }
    .doa-card.active .doa-divider { background: #e5e7eb; }

    .doa-arabic {
        font-family: 'Amiri', serif;
        font-size: 1.4rem; font-weight: 700; color: white;
        text-align: right; line-height: 1.75; margin-bottom: 8px;
        transition: color 0.3s;
    }
    .doa-card.active .doa-arabic { color: var(--text-primary, #1f2937); }

    /* ===== Tombol Audio ===== */
    .btn-audio-doa {
        position: absolute;
        bottom: 10px; right: 10px;
        background: rgba(255,255,255,0.2);
        border: 1.5px solid rgba(255,255,255,0.5);
        border-radius: 50%;
        width: 34px; height: 34px;
        display: none;
        align-items: center; justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        z-index: 2;
    }
    .btn-audio-doa svg { width: 15px; height: 15px; fill: white; pointer-events: none; }

    .doa-card.active .btn-audio-doa {
        display: flex;
        border-color: #10B981;
        background: rgba(16,185,129,0.1);
    }
    .doa-card.active .btn-audio-doa svg { fill: #10B981; }
    .doa-card.active .btn-audio-doa:hover { background: rgba(16,185,129,0.2); transform: scale(1.1); }

    .doa-card.playing .btn-audio-doa {
        background: #10B981 !important;
        border-color: #10B981 !important;
        animation: pulse-doa 1s ease-in-out infinite;
    }
    .doa-card.playing .btn-audio-doa svg { fill: white !important; }
    @keyframes pulse-doa {
        0%, 100% { transform: scale(1); }
        50%       { transform: scale(1.15); }
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">

    <h1 class="text-3xl font-bold text-center mb-6 mt-4">Doa-doa Pendek</h1>

    <div class="w-full max-w-md mx-auto mb-8">
        <input type="text"
            id="doa-search-input"
            placeholder="Cari doa (Doa Sebelum Makan, Doa Masuk Rumah, dll.)"
            class="w-full p-3 rounded-lg shadow-sm border focus:outline-none focus:ring-2"
            style="border-color: #10B981;">
    </div>

    <div id="doa-grid">
        @foreach($doapendek as $doa)
        <div class="doa-card"
             data-audio="{{ $doa->audio_url ?? '' }}"
             data-search-terms="{{ strtolower($doa->title) }}">

            {{-- Header --}}
            <div class="doa-card-header">
                <div class="doa-card-header-left">
                    <div class="doa-number"><span>{{ $doa->id }}</span></div>
                    <h2>{{ $doa->title }}</h2>
                </div>
                <div class="doa-chevron">
                    <svg viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </div>
            </div>

            {{-- Konten --}}
            <div class="doa-content">
                <div class="doa-divider"></div>
                <div class="text-right mb-3">
                    <h3 class="doa-arabic">{{ $doa->arabic }}</h3>
                </div>
                <div class="pb-8"> {{-- padding bawah agar tidak tertutup tombol audio --}}
                    <p class="text-xs doa-muted leading-relaxed">{{ $doa->transliteration }}</p>
                    <p class="text-xs mt-2 doa-muted leading-relaxed italic">"{{ $doa->translation }}"</p>
                </div>
            </div>

            {{-- Tombol Audio (muncul saat card terbuka) --}}
            <button class="btn-audio-doa"
                    title="Putar audio"
                    onclick="event.stopPropagation(); playDoa(this.closest('.doa-card'))">
                {{-- Icon speaker --}}
                <svg class="icon-speaker" viewBox="0 0 24 24">
                    <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                </svg>
                {{-- Icon pause --}}
                <svg class="icon-pause" viewBox="0 0 24 24" style="display:none">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                </svg>
            </button>

        </div>
        @endforeach
    </div>

    {{-- Kredit --}}
    <div class="text-center mt-4 mb-6">
        <p class="text-sm" style="color: rgba(107,114,128,0.6); letter-spacing: 0.03em;">
            Audio dihosting via <span style="font-weight:600; color: rgba(107,114,128,0.8);">Cloudinary CDN</span>
            &mdash; tersedia untuk semua pengguna
        </p>
    </div>

    {{-- Hidden audio element --}}
    <audio id="doa-audio" preload="none"></audio>

</div>
@endsection

@push('scripts')
<script>
// ═══════════════════════════════
//  STATE & AUDIO
// ═══════════════════════════════
let activeCard = null;
const audio    = document.getElementById('doa-audio');

function playDoa(card) {
    const url     = card.dataset.audio;
    const btn     = card.querySelector('.btn-audio-doa');
    const speaker = btn.querySelector('.icon-speaker');
    const pause   = btn.querySelector('.icon-pause');

    // Tidak ada audio URL → skip
    if (!url) return;

    // Klik card yang sama → stop
    if (activeCard === card && !audio.paused) {
        audio.pause();
        audio.currentTime = 0;
        card.classList.remove('playing');
        speaker.style.display = '';
        pause.style.display   = 'none';
        activeCard = null;
        return;
    }

    // Stop card lain dulu
    if (activeCard && activeCard !== card) {
        audio.pause();
        audio.currentTime = 0;
        activeCard.classList.remove('playing');
        const prevBtn = activeCard.querySelector('.btn-audio-doa');
        if (prevBtn) {
            prevBtn.querySelector('.icon-speaker').style.display = '';
            prevBtn.querySelector('.icon-pause').style.display   = 'none';
        }
    }

    // Play
    audio.src = url;
    audio.play().then(() => {
        activeCard = card;
        card.classList.add('playing');
        speaker.style.display = 'none';
        pause.style.display   = '';
    }).catch(() => {});

    audio.onended = () => {
        card.classList.remove('playing');
        speaker.style.display = '';
        pause.style.display   = 'none';
        activeCard = null;
    };
}

// ═══════════════════════════════
//  SEARCH & EXPAND
// ═══════════════════════════════
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('doa-search-input');
    const cards       = document.querySelectorAll('.doa-card');

    // Search
    searchInput.addEventListener('keyup', function () {
        const term = this.value.toLowerCase().trim();
        cards.forEach(card => {
            card.style.display = card.dataset.searchTerms.includes(term) ? '' : 'none';
        });
    });

    // Expand / Collapse
    cards.forEach(card => {
        card.addEventListener('click', function () {
            const content = this.querySelector('.doa-content');
            const isOpen  = content.classList.contains('open');

            // Stop audio kalau card ditutup
            if (isOpen && !audio.paused && activeCard === card) {
                audio.pause();
                audio.currentTime = 0;
                card.classList.remove('playing');
            }

            content.classList.toggle('open', !isOpen);
            this.classList.toggle('active', !isOpen);
        });
    });
});
</script>
@endpush