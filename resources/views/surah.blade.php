@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700&display=swap');

    :root {
        --emerald-500: #10b981;
        --emerald-600: #059669;
        --emerald-700: #047857;
        --emerald-50:  rgba(16,185,129,0.06);
        --emerald-border: rgba(16,185,129,0.2);
        --radius-card: 16px;
        --radius-btn:  12px;
        --radius-pill: 99px;
        --shadow-card: 0 2px 12px rgba(0,0,0,0.08);
        --shadow-float: 0 8px 32px rgba(0,0,0,0.12);
    }

    .font-arabic { font-family: 'Amiri', serif; }
    .surah-dark-gray { color: #374151; }
    .dark .surah-dark-gray { color: #d1d5db; }

    .page-header {
        border-bottom: 1px solid rgba(0,0,0,0.06);
        padding-bottom: 14px;
        margin-bottom: 28px;
    }
    .dark .page-header { border-bottom-color: rgba(255,255,255,0.08); }

    .surah-meta-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--emerald-50);
        border: 1px solid var(--emerald-border);
        color: var(--emerald-600);
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: var(--radius-pill);
        margin-top: 10px;
    }

    .btn-play-all {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 24px;
        background: linear-gradient(135deg, #1faf90, var(--emerald-500));
        color: white;
        font-weight: 700;
        font-size: 0.9rem;
        border: none;
        border-radius: var(--radius-pill);
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(16,185,129,0.35);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        margin-top: 16px;
    }
    .btn-play-all:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(16,185,129,0.4); }
    .btn-play-all:active { transform: translateY(0); }

    /* ─── Sticky Audio Player ─────────────────────────────────── */
    #main-player-container {
        position: sticky;
        top: 68px;
        z-index: 40;
        background: rgba(255,255,255,0.82);
        backdrop-filter: blur(20px) saturate(1.5);
        -webkit-backdrop-filter: blur(20px) saturate(1.5);
        border-radius: var(--radius-card);
        padding: 14px 18px 12px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-float), 0 0 0 1px rgba(16,185,129,0.12);
        border: 1px solid rgba(16,185,129,0.14);
    }
    .dark #main-player-container {
        background: rgba(15,23,42,0.82);
        border-color: rgba(52,211,153,0.12);
    }

    .player-info-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }
    #player-verse-info {
        flex: 1;
        font-size: 0.78rem;
        font-weight: 600;
        color: #065f46;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        letter-spacing: 0.01em;
    }
    .dark #player-verse-info { color: #6ee7b7; }
    .player-music-icon { color: #10b981; flex-shrink: 0; }

    .mode-badge {
        font-size: 0.65rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: var(--radius-pill);
        background: rgba(16,185,129,0.1);
        color: var(--emerald-600);
        border: 1px solid rgba(16,185,129,0.22);
        white-space: nowrap;
        letter-spacing: 0.04em;
    }

    .progress-track {
        position: relative;
        height: 5px;
        background: rgba(16,185,129,0.13);
        border-radius: var(--radius-pill);
        cursor: pointer;
        margin: 6px 0 3px;
    }
    .dark .progress-track { background: rgba(255,255,255,0.08); }
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--emerald-500), var(--emerald-600));
        border-radius: var(--radius-pill);
        pointer-events: none;
        transition: width 0.1s linear;
    }
    .progress-thumb {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 13px; height: 13px;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 0 0 2px var(--emerald-500), 0 1px 4px rgba(0,0,0,0.15);
        pointer-events: none;
        transition: left 0.1s linear;
    }
    .time-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.66rem;
        color: #9ca3af;
        margin-top: 2px;
        margin-bottom: 8px;
    }

    .player-controls { display: flex; align-items: center; gap: 8px; }
    .ctrl-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 5px;
        border-radius: 8px;
        transition: color 0.15s, background 0.15s;
        flex-shrink: 0;
    }
    .ctrl-btn:hover { color: var(--emerald-600); background: var(--emerald-50); }
    .ctrl-btn.active { color: var(--emerald-500); }
    .dark .ctrl-btn { color: #64748b; }
    .dark .ctrl-btn:hover { color: #6ee7b7; background: rgba(110,231,183,0.08); }
    .dark .ctrl-btn.active { color: #34d399; }

    #play-pause-ctrl {
        width: 38px; height: 38px;
        background: linear-gradient(135deg, #1faf90, var(--emerald-600));
        color: #fff;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(16,185,129,0.35);
        transition: transform 0.15s, box-shadow 0.15s;
        padding: 0;
    }
    #play-pause-ctrl:hover {
        background: linear-gradient(135deg, #1faf90, var(--emerald-600));
        color: #fff;
        transform: scale(1.08);
        box-shadow: 0 6px 18px rgba(16,185,129,0.45);
    }

    #volume-slider {
        -webkit-appearance: none;
        width: 64px; height: 3px;
        background: rgba(16,185,129,0.18);
        border-radius: var(--radius-pill);
        outline: none;
        cursor: pointer;
    }
    .dark #volume-slider { background: rgba(255,255,255,0.1); }
    #volume-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 11px; height: 11px;
        background: var(--emerald-500);
        border-radius: 50%;
        cursor: pointer;
    }

    /* ─── Bookmark Banner ─────────────────────────────────────── */
    #bookmark-banner {
        display: none;
        align-items: center;
        gap: 10px;
        background: rgba(16,185,129,0.07);
        border: 1px solid rgba(16,185,129,0.2);
        border-radius: var(--radius-card);
        padding: 12px 14px;
        margin-bottom: 20px;
    }
    .dark #bookmark-banner { background: rgba(16,185,129,0.08); border-color: rgba(52,211,153,0.18); }
    .bookmark-icon-wrap {
        width: 34px; height: 34px;
        background: rgba(16,185,129,0.12);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        color: var(--emerald-600);
    }
    .dark .bookmark-icon-wrap { color: #34d399; background: rgba(52,211,153,0.12); }
    .bookmark-banner-text { flex: 1; min-width: 0; }
    .bookmark-banner-text p { margin: 0; }
    .bookmark-banner-text .title { font-size: 0.82rem; font-weight: 700; color: #065f46; }
    .dark .bookmark-banner-text .title { color: #6ee7b7; }
    .bookmark-banner-text .sub { font-size: 0.72rem; color: #6b7280; margin-top: 1px; }
    .btn-bookmark-goto {
        font-size: 0.75rem; font-weight: 700;
        padding: 6px 12px; border-radius: 8px;
        border: 1px solid rgba(16,185,129,0.25);
        background: rgba(16,185,129,0.1);
        color: var(--emerald-600); cursor: pointer;
        white-space: nowrap; transition: background 0.15s; flex-shrink: 0;
    }
    .btn-bookmark-goto:hover { background: rgba(16,185,129,0.18); }
    .dark .btn-bookmark-goto { color: #34d399; }

    /* ─── Verse Cards ─────────────────────────────────────────── */
    .verse-item {
        background: linear-gradient(135deg, #1faf90, var(--emerald-500));
        border-radius: var(--radius-card);
        padding: 20px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        box-shadow: var(--shadow-card);
    }
    .verse-item::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 60%);
        pointer-events: none; border-radius: inherit;
    }
    .verse-item:hover { transform: translateY(-3px); box-shadow: var(--shadow-float); }

    .verse-item.playing {
        background: linear-gradient(135deg, var(--emerald-600), var(--emerald-700));
        box-shadow: 0 0 0 3px rgba(52,211,153,0.5), 0 12px 32px rgba(5,150,105,0.3);
        transform: translateY(-2px) scale(1.005);
    }
    .verse-item.playing .transliteration-text { color: rgba(167,243,208,0.95) !important; }

    .arabic-word { display: inline; transition: color 0.18s, text-shadow 0.18s; }
    .arabic-word.highlighted {
        color: #fde68a !important;
        text-shadow: 0 0 14px rgba(253,224,71,0.65);
    }

    .verse-number-badge {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px;
        background: rgba(255,255,255,0.18);
        border-radius: 8px;
        font-size: 0.78rem; font-weight: 700;
        color: rgba(255,255,255,0.9); flex-shrink: 0;
    }

    .play-verse-btn {
        display: flex; align-items: center; justify-content: center;
        width: 36px; height: 36px;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.25);
        border-radius: 50%;
        color: rgba(255,255,255,0.9);
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
        flex-shrink: 0;
    }
    .play-verse-btn:hover { background: rgba(255,255,255,0.28); transform: scale(1.1); color: #fff; }

    .arabic-text {
        font-family: 'Amiri', serif;
        font-size: clamp(1.1rem, 2.8vw, 1.5rem);
        line-height: 2; color: #fff;
        direction: rtl; text-align: right;
    }
    .transliteration-text {
        font-size: 0.9rem; font-style: italic;
        color: rgba(255,255,255,0.88);
        margin-top: 10px; line-height: 1.6;
    }
    .translation-text {
        font-size: 0.85rem;
        color: rgba(255,255,255,0.8);
        margin-top: 4px; line-height: 1.6;
    }

    .verse-divider {
        height: 1px;
        background: rgba(255,255,255,0.12);
        margin: 12px 0;
    }

    /* ─── Bookmark btn: icon only, bawah card ─────────────────── */
    .verse-bottom-row {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-top: 10px;
        padding-top: 8px;
        border-top: 1px solid rgba(255,255,255,0.08);
    }

    /* Wrapper untuk tooltip */
    .verse-bookmark-wrap {
        position: relative;
        display: inline-flex;
    }

    .verse-bookmark-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px; height: 28px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 8px;
        color: rgba(255,255,255,0.35);
        cursor: pointer;
        flex-shrink: 0;
        transition: background 0.2s, color 0.2s, border-color 0.2s, transform 0.15s;
    }
    .verse-bookmark-btn:hover {
        background: rgba(255,255,255,0.22);
        color: rgba(255,255,255,0.85);
        border-color: rgba(255,255,255,0.35);
        transform: scale(1.1);
    }
    .verse-bookmark-btn.bookmarked {
        background: rgba(253,224,71,0.2);
        border-color: rgba(253,224,71,0.5);
        color: #fde047;
    }
    .verse-bookmark-btn.bookmarked:hover {
        background: rgba(253,224,71,0.3);
        color: #fef08a;
        border-color: rgba(253,224,71,0.65);
    }

    /* ── Tooltip bubble ── */
    .bm-tooltip {
        position: absolute;
        bottom: calc(100% + 8px);
        right: 0;
        white-space: nowrap;
        background: #1e293b;
        color: #fff;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 8px;
        pointer-events: none;
        opacity: 0;
        transform: translateY(4px) scale(0.95);
        transition: opacity 0.18s ease, transform 0.18s ease;
        box-shadow: 0 4px 14px rgba(0,0,0,0.25);
        letter-spacing: 0.02em;
        z-index: 10;
    }
    /* Ekor tooltip */
    .bm-tooltip::after {
        content: '';
        position: absolute;
        top: 100%; right: 8px;
        border: 5px solid transparent;
        border-top-color: #1e293b;
    }
    /* Bookmarked state: tooltip kuning */
    .verse-bookmark-btn.bookmarked ~ .bm-tooltip {
        background: #78350f;
        color: #fef9c3;
    }
    .verse-bookmark-btn.bookmarked ~ .bm-tooltip::after {
        border-top-color: #78350f;
    }
    /* Tampil saat hover wrapper */
    .verse-bookmark-wrap:hover .bm-tooltip {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* ─── MODAL ──────────────────────────────────────────────── */
    #verse-modal-overlay {
        display: none;
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        z-index: 70;
        align-items: flex-end;
        justify-content: center;
        padding: 0 12px 20px;
    }
    #verse-modal-overlay.open { display: flex; }

    #verse-modal {
        width: 100%; max-width: 520px;
        background: #fff;
        border-radius: 24px; overflow: hidden;
        box-shadow: 0 -4px 60px rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.04);
        animation: modalSlideUp 0.28s cubic-bezier(0.34,1.1,0.64,1);
    }
    .dark #verse-modal { background: #1e293b; box-shadow: 0 -4px 60px rgba(0,0,0,0.5); }
    @keyframes modalSlideUp {
        from { transform: translateY(50px); opacity: 0; }
        to   { transform: translateY(0);    opacity: 1; }
    }

    .modal-handle {
        width: 36px; height: 4px;
        background: rgba(0,0,0,0.1);
        border-radius: 99px;
        margin: 10px auto 0;
    }
    .dark .modal-handle { background: rgba(255,255,255,0.12); }

    .modal-header { padding: 16px 20px 14px; border-bottom: 1px solid rgba(0,0,0,0.06); }
    .dark .modal-header { border-bottom-color: rgba(255,255,255,0.06); }
    .modal-ayat-label { display: flex; align-items: center; gap: 8px; }
    .modal-number-badge {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 28px; height: 28px; padding: 0 8px;
        background: linear-gradient(135deg, #1faf90, var(--emerald-500));
        color: white; font-size: 0.75rem; font-weight: 700; border-radius: 8px;
    }
    .modal-surah-name { font-size: 0.8rem; font-weight: 600; color: #374151; }
    .dark .modal-surah-name { color: #94a3b8; }
    .modal-close-btn {
        margin-left: auto;
        width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(0,0,0,0.05); border: none; border-radius: 8px;
        color: #6b7280; cursor: pointer;
        transition: background 0.15s, color 0.15s; flex-shrink: 0;
    }
    .modal-close-btn:hover { background: rgba(0,0,0,0.1); color: #374151; }
    .dark .modal-close-btn { background: rgba(255,255,255,0.06); color: #64748b; }
    .dark .modal-close-btn:hover { background: rgba(255,255,255,0.1); color: #e2e8f0; }

    .modal-body { padding: 16px 20px; }
    .modal-arabic {
        font-family: 'Amiri', serif;
        font-size: 1.3rem;
        direction: rtl; text-align: right;
        color: #065f46; line-height: 2;
        padding: 12px 14px;
        background: rgba(16,185,129,0.05);
        border-radius: 12px;
        border: 1px solid rgba(16,185,129,0.1);
        margin-bottom: 10px;
        max-height: 160px; overflow-y: auto;
        scroll-behavior: smooth;
    }
    .modal-arabic::-webkit-scrollbar { width: 4px; }
    .modal-arabic::-webkit-scrollbar-track { background: transparent; }
    .modal-arabic::-webkit-scrollbar-thumb { background: rgba(16,185,129,0.3); border-radius: 99px; }
    .dark .modal-arabic { color: #6ee7b7; background: rgba(16,185,129,0.07); border-color: rgba(52,211,153,0.12); }

    .modal-translation {
        font-size: 0.82rem; color: #6b7280;
        font-style: italic; line-height: 1.6;
        padding: 0 2px; margin-bottom: 16px;
    }
    .dark .modal-translation { color: #94a3b8; }

    .modal-actions { display: flex; flex-direction: column; gap: 8px; }
    .modal-btn {
        width: 100%; padding: 13px 16px;
        border-radius: var(--radius-btn); border: none;
        font-weight: 700; font-size: 0.88rem; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        transition: transform 0.15s, box-shadow 0.15s, background 0.15s;
    }
    .modal-btn:active { transform: scale(0.98); }
    .modal-btn-primary {
        background: linear-gradient(135deg, #1faf90, var(--emerald-500));
        color: white; box-shadow: 0 4px 16px rgba(16,185,129,0.3);
    }
    .modal-btn-primary:hover { box-shadow: 0 6px 22px rgba(16,185,129,0.4); transform: translateY(-1px); }
    .modal-btn-secondary {
        background: var(--emerald-50); color: var(--emerald-600);
        border: 1px solid var(--emerald-border);
    }
    .dark .modal-btn-secondary { background: rgba(16,185,129,0.08); color: #34d399; border-color: rgba(52,211,153,0.18); }
    .modal-btn-secondary:hover { background: rgba(16,185,129,0.1); }
    .modal-btn-ghost {
        background: rgba(107,114,128,0.06); color: #9ca3af;
        border: 1px solid rgba(107,114,128,0.1);
    }
    .dark .modal-btn-ghost { background: rgba(255,255,255,0.04); color: #64748b; border-color: rgba(255,255,255,0.06); }
    .modal-btn-ghost:hover { background: rgba(107,114,128,0.1); color: #6b7280; }

    @media (max-width: 480px) {
        #main-player-container { border-radius: 12px; padding: 12px 14px 10px; }
        .verse-item { padding: 16px; border-radius: 12px; }
        #volume-slider { width: 48px; }
        .modal-arabic { font-size: 1.3rem; }
    }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6">

    {{-- ── Page Header ── --}}
    <div class="relative flex items-center justify-between page-header">
        <a href="{{ route('quran.index') }}"
           class="inline-flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition hover:opacity-80"
           style="color: var(--primary-accent, #10b981); background: rgba(16,185,129,0.07); border: 1px solid rgba(16,185,129,0.15)">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="hidden sm:inline">Kembali</span>
        </a>
        <h1 class="absolute left-1/2 -translate-x-1/2 text-xl sm:text-2xl font-bold" style="color:var(--text-primary);">Al-Quran</h1>
        <div class="w-16"></div>
    </div>

    {{-- ── Surah Header ── --}}
    <div class="text-center mb-8">
        <h2 class="font-arabic leading-normal" style="font-size: clamp(2.5rem,8vw,3.5rem); color:var(--text-primary);">
            {{ $surah->arabic_name }}
        </h2>
        <p class="text-2xl sm:text-3xl font-bold surah-dark-gray mt-1">{{ $surah->name }}</p>
        <div class="flex items-center justify-center gap-2 flex-wrap mt-3">
            <span class="surah-meta-pill">
                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                "{{ $surah->translation }}"
            </span>
            <span class="surah-meta-pill">
                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg>
                {{ $surah->total_verses }} Ayat
            </span>
        </div>
        <button id="play-all-btn" class="btn-play-all">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
            </svg>
            Putar Semua Ayat
        </button>
    </div>

    {{-- ── Sticky Audio Player ── --}}
    <div id="main-player-container">
        <div class="player-info-row">
            <svg class="h-4 w-4 player-music-icon" fill="currentColor" viewBox="0 0 20 20">
                <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
            </svg>
            <p id="player-verse-info">Pilih ayat untuk diputar</p>
            <span id="player-mode-badge" class="mode-badge hidden">Auto-Play</span>
        </div>

        <audio id="main-player" class="hidden"></audio>

        <div class="progress-track" id="progress-bar">
            <div class="progress-fill" id="progress-fill" style="width:0%"></div>
            <div class="progress-thumb" id="progress-thumb" style="left:0%"></div>
        </div>
        <div class="time-row">
            <span id="time-current">0:00</span>
            <span id="time-duration">0:00</span>
        </div>

        <div class="player-controls">
            <button class="ctrl-btn" id="prev-btn" title="Ayat sebelumnya">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.445 14.832A1 1 0 0010 14v-2.798l5.445 3.63A1 1 0 0017 14V6a1 1 0 00-1.555-.832L10 8.798V6a1 1 0 00-1.555-.832l-6 4a1 1 0 000 1.664l6 4z"/>
                </svg>
            </button>
            <button class="ctrl-btn" id="play-pause-ctrl" title="Play / Pause">
                <svg class="icon-play h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                </svg>
                <svg class="icon-pause h-5 w-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </button>
            <button class="ctrl-btn" id="next-btn" title="Ayat berikutnya">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4.555 5.168A1 1 0 003 6v8a1 1 0 001.555.832L10 11.202V14a1 1 0 001.555.832l6-4a1 1 0 000-1.664l-6-4A1 1 0 0010 6v2.798L4.555 5.168z"/>
                </svg>
            </button>
            <div class="flex items-center gap-2 ml-2">
                <svg class="h-4 w-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" style="color:#d1d5db">
                    <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd"/>
                </svg>
                <input type="range" id="volume-slider" min="0" max="1" step="0.05" value="1">
            </div>
            <button class="ctrl-btn ml-auto" id="repeat-btn" title="Ulangi ayat ini">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ── Bookmark Banner ── --}}
    <div id="bookmark-banner">
        <div class="bookmark-icon-wrap">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
            </svg>
        </div>
        <div class="bookmark-banner-text">
            <p class="title">Lanjut dari <span id="bookmark-verse-text">Ayat 1</span></p>
            <p class="sub">Kamu terakhir baca di sini</p>
        </div>
        <button id="bookmark-goto-btn" class="btn-bookmark-goto">Lanjut →</button>
        <button id="bookmark-dismiss" class="ctrl-btn">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- ── Verses List ── --}}
    <div class="space-y-3" id="verses-container">
        @foreach($surah->verses as $verse)
        <div id="verse-{{ $verse->number }}"
             class="verse-item"
             data-verse-number="{{ $verse->number }}"
             data-arabic="{{ $verse->arabic }}"
             data-translation="{{ $verse->translation }}"
             data-audio-url="https://everyayah.com/data/Alafasy_128kbps/{{ str_pad($surah->number, 3, '0', STR_PAD_LEFT) }}{{ str_pad($verse->number, 3, '0', STR_PAD_LEFT) }}.mp3">

            {{-- Top row: number + play btn + arabic (NO bookmark here) --}}
            <div class="flex items-start justify-between gap-3 mb-2">
                <div class="flex items-center gap-2 flex-shrink-0 mt-1">
                    <div class="verse-number-badge">{{ $verse->number }}</div>
                    <button class="play-verse-btn" data-verse-number="{{ $verse->number }}" onclick="event.stopPropagation()">
                        <svg class="icon-play h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                        </svg>
                        <svg class="icon-pause h-4 w-4 hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                <p class="arabic-text flex-1">
                    @foreach(explode(' ', $verse->arabic) as $word)
                        <span class="arabic-word">{{ $word }}</span>{{ !$loop->last ? ' ' : '' }}
                    @endforeach
                </p>
            </div>

            <div class="verse-divider"></div>

            <p class="transliteration-text">{{ $verse->transliteration }}</p>
            <p class="translation-text">"{{ $verse->translation }}"</p>

            {{-- Bottom row: bookmark icon + tooltip --}}
            <div class="verse-bottom-row">
                <div class="verse-bookmark-wrap">
                    <button class="verse-bookmark-btn"
                            data-verse-number="{{ $verse->number }}"
                            onclick="event.stopPropagation(); handleBookmarkBtnClick({{ $verse->number }})"
                            title="">
                        <svg style="width:12px;height:12px" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                        </svg>
                    </button>
                    <span class="bm-tooltip" data-verse-number="{{ $verse->number }}">Tandai terakhir dibaca</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ── Credit ── --}}
    <div class="text-center mt-10 mb-4">
        <p class="text-xs" style="color: rgba(107,114,128,0.6); letter-spacing: 0.03em;">
            Data ayat & terjemahan bersumber dari
            <span style="font-weight:600; color: rgba(107,114,128,0.8);">Kementerian Agama RI</span>
            &amp;
            <span style="font-weight:600; color: rgba(107,114,128,0.8);">Nahdlatul Ulama</span>
        </p>
    </div>
</div>

{{-- ── Scroll to Top FAB ── --}}
<button id="scroll-top-btn"
        title="Kembali ke atas"
        style="display:none;position:fixed;bottom:24px;right:20px;z-index:50;width:40px;height:40px;background:rgba(255,255,255,0.85);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1px solid rgba(16,185,129,0.25);border-radius:50%;box-shadow:0 4px 16px rgba(0,0,0,0.12);color:#059669;cursor:pointer;align-items:center;justify-content:center;transition:opacity 0.2s,transform 0.2s;">
    <svg style="width:18px;height:18px" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
    </svg>
</button>

{{-- ── Verse Modal ── --}}
<div id="verse-modal-overlay">
    <div id="verse-modal">
        <div class="modal-handle"></div>
        <div class="modal-header">
            <div class="modal-ayat-label">
                <span class="modal-number-badge" id="modal-verse-num">1</span>
                <span class="modal-surah-name">{{ $surah->name }}</span>
                <button class="modal-close-btn" id="modal-close">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="modal-body">
            <p id="modal-arabic" class="modal-arabic"></p>
            <p id="modal-translation" class="modal-translation"></p>
            <div class="modal-actions">
                <button id="modal-btn-bookmark" class="modal-btn modal-btn-primary">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                    </svg>
                    Tandai Terakhir Dibaca
                </button>
                <button id="modal-btn-play" class="modal-btn modal-btn-secondary">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                    </svg>
                    Putar Ayat Ini
                </button>
                <button id="modal-btn-cancel" class="modal-btn modal-btn-ghost">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const mainPlayer      = document.getElementById('main-player');
    const playerInfo      = document.getElementById('player-verse-info');
    const playAllBtn      = document.getElementById('play-all-btn');
    const playPauseCtrl   = document.getElementById('play-pause-ctrl');
    const prevBtn         = document.getElementById('prev-btn');
    const nextBtn         = document.getElementById('next-btn');
    const repeatBtn       = document.getElementById('repeat-btn');
    const progressBar     = document.getElementById('progress-bar');
    const progressFill    = document.getElementById('progress-fill');
    const progressThumb   = document.getElementById('progress-thumb');
    const timeCurrent     = document.getElementById('time-current');
    const timeDuration    = document.getElementById('time-duration');
    const volumeSlider    = document.getElementById('volume-slider');
    const modeBadge       = document.getElementById('player-mode-badge');
    const bookmarkBanner  = document.getElementById('bookmark-banner');
    const bookmarkText    = document.getElementById('bookmark-verse-text');
    const bookmarkGoto    = document.getElementById('bookmark-goto-btn');
    const bookmarkDismiss = document.getElementById('bookmark-dismiss');
    const modalOverlay    = document.getElementById('verse-modal-overlay');
    const modalVerseNum   = document.getElementById('modal-verse-num');
    const modalArabic     = document.getElementById('modal-arabic');
    const modalTranslation= document.getElementById('modal-translation');
    const modalBtnBookmark= document.getElementById('modal-btn-bookmark');
    const modalBtnPlay    = document.getElementById('modal-btn-play');
    const modalBtnCancel  = document.getElementById('modal-btn-cancel');
    const modalClose      = document.getElementById('modal-close');

    const surahName   = @json($surah->name);
    const surahNumber = {{ $surah->number }};
    const totalVerses = {{ $surah->total_verses }};

    let currentVerse     = 0;
    let isAutoPlay       = false;
    let isRepeat         = false;
    let isDragging       = false;
    let karaokeInterval  = null;
    let readingStartTime = Date.now();
    let trackingInterval = null;
    let modalTargetVerse = null;
    let completionShown  = false;

    const dwellTimers  = {};
    const readByScroll = new Set();
    const verseItems   = Array.from(document.querySelectorAll('.verse-item'));

    // ── Bookmark ──────────────────────────────────────────────────
    const bookmarkKey = `quran_bookmark_${surahNumber}`;
    let savedVerse = parseInt(localStorage.getItem(bookmarkKey) || '0');

    function updateBookmark(num) {
        const cur = parseInt(localStorage.getItem(bookmarkKey) || '0');
        if (num > cur) applyBookmark(num);
    }
    function applyBookmark(num) {
        savedVerse = num;
        localStorage.setItem(bookmarkKey, num);
        bookmarkText.textContent = `Ayat ${num}`;
        bookmarkBanner.style.display = 'flex';
        refreshBookmarkBtn(num);
    }

    if (savedVerse > 1) {
        bookmarkText.textContent = `Ayat ${savedVerse}`;
        bookmarkBanner.style.display = 'flex';
    }
    bookmarkGoto.addEventListener('click', () => { scrollToVerse(savedVerse); bookmarkBanner.style.display = 'none'; });
    bookmarkDismiss.addEventListener('click', () => { bookmarkBanner.style.display = 'none'; });

    // Refresh bookmark highlight on bottom-row btn (icon only, no text)
    function refreshBookmarkBtn(num) {
        document.querySelectorAll('.verse-bookmark-btn').forEach(btn => {
            btn.classList.remove('bookmarked');
        });
        document.querySelectorAll('.bm-tooltip').forEach(tip => {
            tip.textContent = 'Tandai terakhir dibaca';
        });
        if (!num) return;
        const btn = document.querySelector(`.verse-bookmark-btn[data-verse-number="${num}"]`);
        const tip = document.querySelector(`.bm-tooltip[data-verse-number="${num}"]`);
        if (btn) btn.classList.add('bookmarked');
        if (tip) tip.textContent = '✓ Terakhir Dibaca';
    }

    // Global handler — called from inline onclick on each card's bottom btn
    window.handleBookmarkBtnClick = function(num) {
        applyBookmark(num);
        saveProgress(num);
        toast(`🔖 Ayat ${num} ditandai sebagai terakhir dibaca`);
    };
    refreshBookmarkBtn(savedVerse);

    // ── Helpers ───────────────────────────────────────────────────
    const fmt = s => isNaN(s) ? '0:00' : `${Math.floor(s/60)}:${Math.floor(s%60).toString().padStart(2,'0')}`;
    const scrollToVerse = num => document.getElementById(`verse-${num}`)?.scrollIntoView({ behavior: 'smooth', block: 'center' });
    const getEl  = num => document.getElementById(`verse-${num}`);
    const getUrl = num => getEl(num)?.dataset.audioUrl;

    // ── Player UI ─────────────────────────────────────────────────
    function setPlaying(playing) {
        playPauseCtrl.querySelector('.icon-play').classList.toggle('hidden', playing);
        playPauseCtrl.querySelector('.icon-pause').classList.toggle('hidden', !playing);
    }
    function resetVerseButtons() {
        document.querySelectorAll('.play-verse-btn').forEach(b => {
            b.querySelector('.icon-play').classList.remove('hidden');
            b.querySelector('.icon-pause').classList.add('hidden');
        });
    }
    function setVersePause(num) {
        const b = getEl(num)?.querySelector('.play-verse-btn');
        if (!b) return;
        b.querySelector('.icon-play').classList.add('hidden');
        b.querySelector('.icon-pause').classList.remove('hidden');
    }
    function clearPlaying() { verseItems.forEach(v => v.classList.remove('playing')); }
    function setActiveVerse(num) {
        clearPlaying();
        getEl(num)?.classList.add('playing');
        scrollToVerse(num);
        currentVerse = num;
        updateBookmark(num);
    }

    // ── Karaoke ───────────────────────────────────────────────────
    function clearKaraoke() {
        clearInterval(karaokeInterval);
        document.querySelectorAll('.arabic-word.highlighted').forEach(w => w.classList.remove('highlighted'));
    }
    function startKaraoke(num) {
        clearKaraoke();
        const words = Array.from(getEl(num)?.querySelectorAll('.arabic-word') || []);
        if (!words.length) return;
        karaokeInterval = setInterval(() => {
            words.forEach(w => w.classList.remove('highlighted'));
            if (!mainPlayer.paused && mainPlayer.duration) {
                const t = Math.max(0, mainPlayer.currentTime - 0.35);
                words[Math.min(Math.floor(t / mainPlayer.duration * words.length), words.length-1)].classList.add('highlighted');
            }
        }, 150);
    }

    // ── Load & Play ───────────────────────────────────────────────
    function play(num) {
        const url = getUrl(num); if (!url) return;
        resetVerseButtons();
        mainPlayer.src = url; mainPlayer.load();
        mainPlayer.play().catch(() => {});
        setPlaying(true); setActiveVerse(num); setVersePause(num);
        playerInfo.textContent = `Ayat ${num} · ${surahName}`;
        startKaraoke(num);
    }

    // ── Controls ──────────────────────────────────────────────────
    playPauseCtrl.addEventListener('click', () => {
        if (!mainPlayer.src || mainPlayer.src === location.href) { play(savedVerse || 1); return; }
        if (mainPlayer.paused) { mainPlayer.play(); setPlaying(true); if (currentVerse) startKaraoke(currentVerse); }
        else { mainPlayer.pause(); setPlaying(false); clearKaraoke(); }
    });
    prevBtn.addEventListener('click',   () => { if (currentVerse > 1) play(currentVerse - 1); });
    nextBtn.addEventListener('click',   () => { if (currentVerse < totalVerses) play(currentVerse + 1); });
    repeatBtn.addEventListener('click', () => { isRepeat = !isRepeat; repeatBtn.classList.toggle('active', isRepeat); });
    playAllBtn.addEventListener('click', () => { isAutoPlay = true; modeBadge.classList.remove('hidden'); play(1); });

    mainPlayer.addEventListener('ended', () => {
        clearKaraoke();
        if (isRepeat && currentVerse) { play(currentVerse); return; }
        const done = currentVerse >= totalVerses;
        if (isAutoPlay && !done) {
            setTimeout(() => play(currentVerse + 1), 600);
        } else {
            if (done) { showCompletion('muratal'); saveProgress(totalVerses); }
            isAutoPlay = false; modeBadge.classList.add('hidden');
            clearPlaying(); resetVerseButtons(); setPlaying(false);
            playerInfo.textContent = done ? `✨ Surah ${surahName} selesai` : 'Pilih ayat untuk diputar';
        }
        if (!done) saveProgress(currentVerse);
    });

    document.querySelectorAll('.play-verse-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            const num = parseInt(this.dataset.verseNumber);
            isAutoPlay = false; modeBadge.classList.add('hidden');
            if (currentVerse === num && !mainPlayer.paused) {
                mainPlayer.pause(); setPlaying(false); clearKaraoke();
                resetVerseButtons(); clearPlaying();
                playerInfo.textContent = `Dijeda · Ayat ${num}`; return;
            }
            play(num);
        });
    });

    // ── Progress bar ──────────────────────────────────────────────
    mainPlayer.addEventListener('timeupdate', () => {
        if (isDragging || !mainPlayer.duration) return;
        const p = mainPlayer.currentTime / mainPlayer.duration * 100;
        progressFill.style.width = p + '%'; progressThumb.style.left = p + '%';
        timeCurrent.textContent  = fmt(mainPlayer.currentTime);
        timeDuration.textContent = fmt(mainPlayer.duration);
    });
    mainPlayer.addEventListener('loadedmetadata', () => { timeDuration.textContent = fmt(mainPlayer.duration); });

    function seek(e) {
        const r = progressBar.getBoundingClientRect();
        const p = Math.max(0, Math.min(1, (e.clientX - r.left) / r.width));
        mainPlayer.currentTime = p * mainPlayer.duration;
        progressFill.style.width = p*100+'%'; progressThumb.style.left = p*100+'%';
    }
    progressBar.addEventListener('mousedown', e => { isDragging = true; seek(e); });
    document.addEventListener('mousemove',    e => { if (isDragging) seek(e); });
    document.addEventListener('mouseup',      () => { isDragging = false; });
    progressBar.addEventListener('touchstart', e => { isDragging = true; seek(e.touches[0]); }, { passive: true });
    document.addEventListener('touchmove',    e => { if (isDragging) seek(e.touches[0]); }, { passive: true });
    document.addEventListener('touchend',     () => { isDragging = false; });
    volumeSlider.addEventListener('input', () => { mainPlayer.volume = volumeSlider.value; });

    // ── Modal ─────────────────────────────────────────────────────
    verseItems.forEach(item => {
        item.addEventListener('click', function () {
            const num = parseInt(this.dataset.verseNumber);
            modalTargetVerse = num;
            modalVerseNum.textContent    = num;
            modalArabic.textContent      = this.dataset.arabic || '';
            modalTranslation.textContent = '"' + (this.dataset.translation || '') + '"';
            modalOverlay.classList.add('open');
        });
    });

    modalBtnBookmark.addEventListener('click', () => {
        if (!modalTargetVerse) return;
        applyBookmark(modalTargetVerse);
        saveProgress(modalTargetVerse);
        closeModal();
        toast(`🔖 Ayat ${modalTargetVerse} ditandai sebagai terakhir dibaca`);
    });
    modalBtnPlay.addEventListener('click', () => {
        const v = modalTargetVerse; closeModal();
        isAutoPlay = false; if (v) play(v);
    });
    [modalBtnCancel, modalClose].forEach(b => b.addEventListener('click', closeModal));
    modalOverlay.addEventListener('click', e => { if (e.target === modalOverlay) closeModal(); });
    function closeModal() { modalOverlay.classList.remove('open'); modalTargetVerse = null; }

    // ── Scroll read tracking ──────────────────────────────────────
    const scrollObs = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            const num = parseInt(entry.target.dataset.verseNumber);
            if (entry.isIntersecting) {
                if (!dwellTimers[num] && !readByScroll.has(num)) {
                    dwellTimers[num] = setTimeout(() => {
                        readByScroll.add(num);
                        updateBookmark(num);
                        if (num >= totalVerses) { showCompletion('scroll'); saveProgress(totalVerses); }
                        else saveProgress(num);
                        delete dwellTimers[num];
                    }, 3000);
                }
            } else {
                if (dwellTimers[num]) { clearTimeout(dwellTimers[num]); delete dwellTimers[num]; }
            }
        });
    }, { threshold: 0.75 });
    verseItems.forEach(i => scrollObs.observe(i));

    // ── Save progress ─────────────────────────────────────────────
    function saveProgress(verseNum) {
        const dur = Math.floor((Date.now() - readingStartTime) / 1000);
        readingStartTime = Date.now();
        const v = verseNum || currentVerse; if (!v) return;
        fetch('{{ route("quran-tracking.update") }}', {
            method: 'POST',
            headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json' },
            body: JSON.stringify({ surah_number: surahNumber, last_verse: v, duration_seconds: dur }),
        }).then(r => r.json()).then(d => { if (d.is_completed && !completionShown) showCompletion('muratal'); })
          .catch(e => console.error(e));
    }

    trackingInterval = setInterval(() => { if (currentVerse) saveProgress(currentVerse); }, 30000);
    window.addEventListener('beforeunload', () => { if (currentVerse) saveProgress(currentVerse); clearInterval(trackingInterval); });
    document.addEventListener('visibilitychange', () => { if (document.hidden && currentVerse) saveProgress(currentVerse); else readingStartTime = Date.now(); });

    // ── Notifications ─────────────────────────────────────────────
    function showCompletion(mode) {
        if (completionShown) return; completionShown = true;
        const label = mode === 'scroll' ? 'membaca' : 'mendengarkan';
        const n = document.createElement('div');
        n.style.cssText = 'position:fixed;bottom:24px;right:16px;z-index:99;background:linear-gradient(135deg,#059669,#0d9488);color:#fff;padding:14px 18px;border-radius:16px;box-shadow:0 8px 32px rgba(5,150,105,0.4);display:flex;align-items:flex-start;gap:10px;max-width:260px;animation:slideInRight .3s ease';
        n.innerHTML = `<span style="font-size:1.4rem;line-height:1.2">✨</span><div><p style="font-weight:700;font-size:.9rem;margin:0 0 2px">MasyaAllah!</p><p style="font-size:.75rem;opacity:.9;margin:0;line-height:1.5">Kamu sudah ${label} Surah ${surahName} sampai selesai!</p></div>`;
        document.body.appendChild(n);
        setTimeout(() => { n.style.transition='opacity .4s'; n.style.opacity='0'; setTimeout(()=>n.remove(),400); }, 5000);
    }

    function toast(msg) {
        // Remove existing toast if any
        document.querySelectorAll('.bm-toast').forEach(t => t.remove());
        const t = document.createElement('div');
        t.className = 'bm-toast';
        t.style.cssText = 'position:fixed;bottom:24px;left:50%;transform:translateX(-50%);background:#1e293b;color:#fff;padding:10px 18px;border-radius:99px;font-size:.78rem;font-weight:600;z-index:99;box-shadow:0 4px 16px rgba(0,0,0,.25);white-space:nowrap;animation:fadeInUp .2s ease;display:flex;align-items:center;gap:6px;';
        t.textContent = msg;
        document.body.appendChild(t);
        setTimeout(() => { t.style.transition='opacity .3s'; t.style.opacity='0'; setTimeout(()=>t.remove(),300); }, 2500);
    }

    const s = document.createElement('style');
    s.textContent = '@keyframes slideInRight{from{transform:translateX(60px);opacity:0}to{transform:translateX(0);opacity:1}}@keyframes fadeInUp{from{transform:translateX(-50%) translateY(10px);opacity:0}to{transform:translateX(-50%) translateY(0);opacity:1}}';
    document.head.appendChild(s);

    if (savedVerse > 1) setTimeout(() => scrollToVerse(savedVerse), 800);

    // ── Scroll to top FAB ─────────────────────────────────────────
    const scrollTopBtn = document.getElementById('scroll-top-btn');
    window.addEventListener('scroll', () => {
        scrollTopBtn.style.display = window.scrollY > 400 ? 'flex' : 'none';
    }, { passive: true });
    scrollTopBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
});
</script>
@endpush