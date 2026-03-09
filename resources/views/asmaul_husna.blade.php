@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');

    .font-arabic { font-family: 'Amiri', serif; }

    /* ── Card ── */
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
        box-shadow: 0 12px 20px rgba(0,0,0,0.2);
    }
    .asma-card.active {
        background: var(--surface, #ffffff);
        color: var(--text-primary, #1f2937);
        border: 2px solid #10B981;
    }
    .asma-card.active h2,
    .asma-card.active h3,
    .asma-card.active p { color: var(--text-primary, #1f2937) !important; }
    .asma-card.active .asma-muted { color: #6b7280 !important; }

    .asma-number {
        background-color: rgba(255,255,255,0.25);
        display: flex; align-items: center; justify-content: center;
        width: 2.5rem; height: 2.5rem;
        border-radius: 9999px;
        flex-shrink: 0;
    }
    .asma-card.active .asma-number { background-color: #10B981; }
    .asma-muted { color: rgba(255,255,255,0.85); }

    /* ── Tombol audio per card ── */
    .btn-audio-card {
        position: absolute;
        bottom: 10px; right: 10px;
        background: rgba(255,255,255,0.2);
        border: 1.5px solid rgba(255,255,255,0.5);
        border-radius: 50%;
        width: 36px; height: 36px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        z-index: 2;
    }
    .btn-audio-card:hover { background: rgba(255,255,255,0.35); transform: scale(1.1); }
    .asma-card.active .btn-audio-card { border-color: #10B981; background: rgba(16,185,129,0.1); }
    .asma-card.active .btn-audio-card svg { fill: #10B981; }
    .btn-audio-card svg { width: 16px; height: 16px; fill: white; pointer-events: none; }

    /* ── Playing state ── */
    .asma-card.playing {
        box-shadow: 0 0 0 3px #10B981, 0 8px 24px rgba(16,185,129,0.35);
    }
    .asma-card.playing .btn-audio-card {
        background: white !important;
        border-color: white !important;
        animation: pulse-btn 1s ease-in-out infinite;
    }
    .asma-card.playing .btn-audio-card svg { fill: #10B981 !important; }
    @keyframes pulse-btn {
        0%, 100% { transform: scale(1); }
        50%       { transform: scale(1.2); }
    }

    /* ── Tombol Play All ── */
    #btn-play-all {
        display: inline-flex; align-items: center; gap: 8px;
        background: #10B981; color: white;
        border: none; border-radius: 10px;
        padding: 10px 22px; font-size: 14px; font-weight: 600;
        cursor: pointer; transition: all 0.2s; margin-bottom: 24px;
    }
    #btn-play-all:hover { background: #0ea572; transform: translateY(-1px); }
    #btn-play-all svg { width: 18px; height: 18px; fill: white; }

    /* ── Sticky Player Bar ── */
    #player-bar {
        position: fixed; bottom: 0; left: 0; right: 0;
        background: #0f172a;
        border-top: 1px solid rgba(16,185,129,0.3);
        padding: 12px 20px;
        display: flex; align-items: center;
        justify-content: space-between; gap: 16px;
        z-index: 9999;
        transform: translateY(100%);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    #player-bar.visible { transform: translateY(0); }

    .player-info { display: flex; align-items: center; gap: 10px; flex: 1; min-width: 0; }
    .player-number {
        background: #10B981; color: white;
        border-radius: 8px; padding: 4px 10px;
        font-size: 12px; font-weight: 700; flex-shrink: 0;
    }
    .player-arabic { font-family: 'Amiri', serif; font-size: 22px; color: white; flex-shrink: 0; }
    .player-latin { font-size: 13px; color: #94a3b8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    .player-progress { flex: 2; display: flex; flex-direction: column; gap: 4px; max-width: 380px; }
    .progress-track { width: 100%; height: 4px; background: rgba(255,255,255,0.1); border-radius: 99px; overflow: hidden; }
    .progress-fill { height: 100%; background: linear-gradient(90deg, #10B981, #34d399); border-radius: 99px; transition: width 0.3s linear; width: 0%; }
    .progress-label { font-size: 11px; color: #64748b; text-align: center; }

    .player-controls { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
    .ctrl-btn {
        background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);
        border-radius: 50%; width: 40px; height: 40px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.2s; color: white;
    }
    .ctrl-btn:hover { background: rgba(16,185,129,0.2); border-color: #10B981; }
    .ctrl-btn.primary { background: #10B981; border-color: #10B981; width: 46px; height: 46px; }
    .ctrl-btn.primary:hover { background: #0ea572; }
    .ctrl-btn svg { width: 18px; height: 18px; fill: currentColor; }
    .ctrl-btn.primary svg { width: 20px; height: 20px; }

    #asmaul-husna-grid { padding-bottom: 0; }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">

    <h1 class="text-3xl font-bold text-center mb-4 mt-4">Asmaul Husna</h1>

    <div class="flex justify-center mb-6">
        <button id="btn-play-all" onclick="playAll()">
            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            Putar Semua (Playlist)
        </button>
    </div>

    <div id="asmaul-husna-grid"
         class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($asmaulHusna as $name)
        <div class="asmaul-husna-card asma-card block p-5 shadow-md"
             data-id="{{ $name->id }}"
             data-arabic="{{ $name->arabic }}"
             data-latin="{{ $name->transliteration }}"
             data-audio="{{ $name->audio_url }}"
             data-search-terms="{{ strtolower($name->transliteration . ' ' . $name->meaning_id) }}">

            <div class="flex justify-between items-center mb-3">
                <div class="asma-number">
                    <span class="font-bold text-sm text-white">{{ $name->id }}</span>
                </div>
                <div class="text-right">
                    <h3 class="text-2xl font-arabic font-bold text-white">{{ $name->arabic }}</h3>
                </div>
            </div>

            <div class="pb-6">
                <h2 class="text-lg font-bold text-white">{{ $name->transliteration }}</h2>
                <p class="text-sm asma-muted">{{ $name->meaning_id }}</p>
            </div>

            <button class="btn-audio-card" title="Putar audio"
                    onclick="event.stopPropagation(); playSingle(this.closest('.asma-card'))">
                <svg class="icon-speaker" viewBox="0 0 24 24">
                    <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                </svg>
                <svg class="icon-pause" viewBox="0 0 24 24" style="display:none">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                </svg>
            </button>

        </div>
        @endforeach

    </div>
</div>

{{-- Sticky Player Bar --}}
<div id="player-bar">
    <div class="player-info">
        <span class="player-number" id="pl-number">—</span>
        <span class="player-arabic" id="pl-arabic">—</span>
        <span class="player-latin"  id="pl-latin">—</span>
    </div>

    <div class="player-progress">
        <div class="progress-track">
            <div class="progress-fill" id="pl-progress"></div>
        </div>
        <div class="progress-label" id="pl-label">— / 99</div>
    </div>

    <div class="player-controls">
        <button class="ctrl-btn" onclick="playPrev()" title="Sebelumnya">
            <svg viewBox="0 0 24 24"><path d="M6 6h2v12H6zm3.5 6 8.5 6V6z"/></svg>
        </button>
        <button class="ctrl-btn primary" id="btn-playpause" onclick="togglePause()" title="Play/Pause">
            <svg id="icon-play"  viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            <svg id="icon-pause" viewBox="0 0 24 24" style="display:none"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
        </button>
        <button class="ctrl-btn" onclick="playNext()" title="Berikutnya">
            <svg viewBox="0 0 24 24"><path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/></svg>
        </button>
        <button class="ctrl-btn" onclick="stopAll()" title="Stop">
            <svg viewBox="0 0 24 24"><path d="M6 6h12v12H6z"/></svg>
        </button>
    </div>
</div>

{{-- Satu audio element tersembunyi, src diganti tiap nama --}}
<audio id="asma-audio" preload="none"></audio>

{{-- Kredit Audio --}}
<div class="text-center mt-4 mb-6">
    <p class="text-sm" style="color: rgba(107,114,128,0.6); letter-spacing: 0.03em;">
        Audio bersumber dari
        <a href="https://github.com/soachishti/Asma-ul-Husna" target="_blank"
           style="font-weight:600; color: rgba(107,114,128,0.8);">soachishti/Asma-ul-Husna</a>
        &amp; dihosting via
        <a href="https://www.jsdelivr.com" target="_blank"
           style="font-weight:600; color: rgba(107,114,128,0.8);">jsDelivr CDN</a>
    </p>
</div>

@endsection

@push('scripts')
<script>
const audio      = document.getElementById('asma-audio');
const cards      = Array.from(document.querySelectorAll('.asma-card'));
let currentIndex = -1;
let isPlaylist   = false;
let activeCard   = null;

// ── UI ──
function setPlaying(card) {
    if (activeCard && activeCard !== card) {
        activeCard.classList.remove('playing');
        setCardIcon(activeCard, false);
    }
    card.classList.add('playing');
    setCardIcon(card, true);
    activeCard = card;
}

function clearPlaying() {
    if (activeCard) {
        activeCard.classList.remove('playing');
        setCardIcon(activeCard, false);
        activeCard = null;
    }
}

function setCardIcon(card, isPlaying) {
    card.querySelector('.icon-speaker').style.display = isPlaying ? 'none' : '';
    card.querySelector('.icon-pause').style.display   = isPlaying ? ''     : 'none';
}

function setBarIcon(isPlaying) {
    document.getElementById('icon-play').style.display  = isPlaying ? 'none' : '';
    document.getElementById('icon-pause').style.display = isPlaying ? ''     : 'none';
}

function updateBar(card) {
    document.getElementById('player-bar').classList.add('visible');
    document.getElementById('pl-number').textContent = card.dataset.id;
    document.getElementById('pl-arabic').textContent  = card.dataset.arabic;
    document.getElementById('pl-latin').textContent   = card.dataset.latin;
    const idx = cards.indexOf(card) + 1;
    document.getElementById('pl-label').textContent    = `${idx} / ${cards.length}`;
    document.getElementById('pl-progress').style.width = `${(idx / cards.length) * 100}%`;
}

// ── CORE ──
function loadAndPlay(card) {
    const url = card.dataset.audio;
    if (!url) {
        if (isPlaylist) playAtIndex(currentIndex + 1);
        return;
    }
    audio.src = url;
    audio.load();
    audio.play().catch(() => {
        if (isPlaylist) playAtIndex(currentIndex + 1);
    });
}

// ── SINGLE ──
function playSingle(card) {
    isPlaylist = false;
    if (activeCard === card) {
        if (!audio.paused) { audio.pause(); setBarIcon(false); setCardIcon(card, false); }
        else               { audio.play();  setBarIcon(true);  setCardIcon(card, true);  }
        return;
    }
    currentIndex = cards.indexOf(card);
    setPlaying(card);
    updateBar(card);
    setBarIcon(true);
    loadAndPlay(card);
}

// ── PLAYLIST ──
function playAll() {
    isPlaylist = true;
    playAtIndex(0);
}

function playAtIndex(idx) {
    if (idx < 0 || idx >= cards.length) {
        clearPlaying(); setBarIcon(false); isPlaylist = false; return;
    }
    const card   = cards[idx];
    currentIndex = idx;
    setPlaying(card);
    updateBar(card);
    card.scrollIntoView({ behavior: 'smooth', block: 'center' });
    setBarIcon(true);
    loadAndPlay(card);
}

// ── KONTROL ──
function playNext() { isPlaylist = true; playAtIndex(currentIndex + 1); }
function playPrev() { isPlaylist = true; playAtIndex(currentIndex - 1); }

function togglePause() {
    if (!audio.paused)      { audio.pause(); setBarIcon(false); if (activeCard) setCardIcon(activeCard, false); }
    else if (audio.src)     { audio.play();  setBarIcon(true);  if (activeCard) setCardIcon(activeCard, true);  }
    else if (currentIndex >= 0) { playAtIndex(currentIndex); }
}

function stopAll() {
    isPlaylist = false;
    audio.pause(); audio.src = '';
    clearPlaying(); setBarIcon(false);
    document.getElementById('player-bar').classList.remove('visible');
}

// ── AUDIO EVENTS ──
audio.addEventListener('ended', () => {
    clearPlaying(); setBarIcon(false);
    if (isPlaylist) playAtIndex(currentIndex + 1);
});

audio.addEventListener('error', () => {
    clearPlaying();
    if (isPlaylist) playAtIndex(currentIndex + 1); // skip error, lanjut
});

// ── TOGGLE ACTIVE (behavior lama) ──
document.addEventListener('DOMContentLoaded', () => {
    cards.forEach(card => card.addEventListener('click', () => card.classList.toggle('active')));
});
</script>
@endpush