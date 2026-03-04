@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap');

    @keyframes countPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    .count-pulse { animation: countPulse 0.3s ease-in-out; }
    .smooth-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

    .ripple { position: relative; overflow: hidden; }
    .ripple::after {
        content: '';
        position: absolute; top: 50%; left: 50%;
        width: 0; height: 0; border-radius: 50%;
        background: rgba(255,255,255,0.45);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    .ripple:active::after { width: 300px; height: 300px; }

    body { font-family: 'DM Sans', sans-serif; }

    .tasbih-page {
        min-height: 100vh;
        background: linear-gradient(160deg, #2dd4bf 0%, #14b8a6 40%, #0d9488 100%);
        display: flex;
        flex-direction: column;
    }

    /* ── Top bar ── */
    .top-bar {
        display: flex; align-items: center; justify-content: space-between;
        padding: 14px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    .top-bar-title { font-size: 17px; font-weight: 600; color: white; letter-spacing: 0.02em; }
    .top-bar-sub { font-size: 11px; color: rgba(255,255,255,0.7); text-align: center; }
    .icon-btn {
        background: none; border: none;
        color: rgba(255,255,255,0.75); cursor: pointer;
        padding: 7px; border-radius: 10px;
        display: flex; align-items: center;
        transition: color 0.2s, background 0.2s;
    }
    .icon-btn:hover { color: white; background: rgba(255,255,255,0.1); }
    .icon-btn.sound-on { color: white; }

    /* ── Dzikir active bar ── */
    .dzikir-active-bar {
        display: flex; align-items: center; justify-content: center;
        gap: 10px; padding: 8px 20px 0;
    }
    .dzikir-active-name {
        font-family: 'Amiri', serif;
        font-size: 18px; color: white; direction: rtl; line-height: 1;
    }
    .dzikir-active-name.latin {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px; font-style: italic; direction: ltr;
    }
    .btn-ganti {
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.35);
        border-radius: 20px; padding: 4px 12px;
        font-size: 11px; font-weight: 600; color: white;
        cursor: pointer; font-family: 'DM Sans', sans-serif;
        transition: background 0.2s; white-space: nowrap;
    }
    .btn-ganti:hover { background: rgba(255,255,255,0.3); }

    /* ── Session label ── */
    .session-label {
        text-align: center; padding: 6px 20px 0;
        font-size: 11px; font-weight: 600;
        color: rgba(255,255,255,0.8);
        letter-spacing: 0.1em; text-transform: uppercase;
    }

    /* ── Counter area ── */
    .counter-area {
        flex: 1; display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        padding: 12px 20px 8px;
        cursor: pointer; user-select: none;
        -webkit-tap-highlight-color: transparent;
        min-height: 160px; gap: 4px;
    }
    .count-number {
        font-size: 92px; font-weight: 300; color: white;
        line-height: 1; letter-spacing: -5px;
        font-variant-numeric: tabular-nums;
        text-shadow: 0 4px 20px rgba(0,0,0,0.12);
    }
    .count-of { font-size: 15px; color: rgba(255,255,255,0.7); font-weight: 400; }

    /* ── Bead track ── */
    .bead-section {
        padding: 8px 20px 10px; position: relative;
        height: 76px; display: flex; align-items: center;
    }
    .bead-line {
        position: absolute; left: 10px; right: 10px;
        top: 50%; transform: translateY(-50%); height: 2px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.35) 15%, rgba(255,255,255,0.35) 85%, transparent);
    }
    .bead-row {
        display: flex; align-items: center; justify-content: center;
        gap: 7px; width: 100%; position: relative; z-index: 1;
    }
    .bead {
        width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .bead.filled {
        background: radial-gradient(circle at 35% 32%, #e8b84b, #c8962a 55%, #7a5a10);
        box-shadow: 0 4px 10px rgba(0,0,0,0.3), inset 0 1px 2px rgba(255,255,255,0.25);
    }
    .bead.empty {
        background: radial-gradient(circle at 35% 32%, rgba(255,255,255,0.28), rgba(255,255,255,0.08));
        box-shadow: 0 2px 4px rgba(0,0,0,0.1); opacity: 0.55;
    }
    @keyframes beadPop {
        0%   { transform: scale(1); }
        50%  { transform: scale(1.35); box-shadow: 0 0 18px rgba(232,184,75,0.7); }
        100% { transform: scale(1); }
    }
    .bead-pop { animation: beadPop 0.35s cubic-bezier(0.34,1.56,0.64,1); }

    /* ── Tap hint ── */
    .tap-hint {
        text-align: center; color: rgba(255,255,255,0.7);
        font-size: 12px; padding: 0 20px 8px; line-height: 1.5;
    }

    /* ── Session dots ── */
    .session-dots {
        display: flex; align-items: center; justify-content: center;
        gap: 8px; padding: 4px 20px 12px; flex-wrap: wrap;
    }
    .s-dot {
        width: 28px; height: 28px; border-radius: 50%;
        border: 1.5px solid rgba(255,255,255,0.35);
        background: rgba(255,255,255,0.12);
        display: flex; align-items: center; justify-content: center;
        font-size: 10px; font-weight: 600; color: rgba(255,255,255,0.7);
        transition: all 0.3s;
    }
    .s-dot.done { background: white; border-color: white; color: #0d9488; }
    .s-dot.current {
        background: transparent; border-color: white; color: white;
        box-shadow: 0 0 0 3px rgba(255,255,255,0.25);
    }

    /* ── Bottom sheet ── */
    .bottom-sheet {
        background: white; border-radius: 24px 24px 0 0;
        padding: 12px 20px 28px;
        box-shadow: 0 -8px 32px rgba(0,0,0,0.1);
    }
    .sheet-handle {
        width: 36px; height: 3px; background: #e2e8f0;
        border-radius: 2px; margin: 0 auto 16px;
    }

    /* ── Stats ── */
    .stats-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 10px; margin-bottom: 16px;
    }
    .stat-card {
        background: #f0fdf9; border: 1px solid #ccfbf1;
        border-radius: 14px; padding: 11px 8px; text-align: center;
    }
    .stat-value {
        font-size: 20px; font-weight: 700; color: #0d9488;
        font-variant-numeric: tabular-nums; line-height: 1;
    }
    .stat-label {
        font-size: 10px; color: #94a3b8; margin-top: 4px;
        text-transform: uppercase; letter-spacing: 0.06em;
    }

    /* ── Completion banner ── */
    .completion-banner {
        background: linear-gradient(135deg, rgba(13,148,136,0.08), rgba(20,184,166,0.04));
        border: 1px solid rgba(13,148,136,0.2);
        border-radius: 14px; padding: 12px 16px;
        text-align: center; margin-bottom: 16px;
    }
    .completion-banner p { font-size: 14px; color: #0d9488; font-weight: 600; }
    .completion-banner span { font-size: 12px; color: #94a3b8; margin-top: 2px; display: block; }

    /* ── Action buttons ── */
    .action-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .btn-reset {
        padding: 13px; background: transparent;
        border: 1px solid #e2e8f0; border-radius: 14px;
        color: #64748b; font-family: 'DM Sans', sans-serif;
        font-size: 14px; font-weight: 500; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 7px;
        transition: all 0.2s;
    }
    .btn-reset:hover { border-color: #94a3b8; color: #334155; background: #f8fafc; }
    .btn-count {
        padding: 13px; background: linear-gradient(135deg, #14b8a6, #0d9488);
        border: none; border-radius: 14px; color: white;
        font-family: 'DM Sans', sans-serif;
        font-size: 15px; font-weight: 700; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 7px;
        box-shadow: 0 4px 14px rgba(13,148,136,0.35); transition: all 0.2s;
    }
    .btn-count:hover { box-shadow: 0 6px 18px rgba(13,148,136,0.45); transform: translateY(-1px); }
    .btn-count:active { transform: translateY(0); }
    .btn-count:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

    /* ── Ripple overlay ── */
    .ripple-overlay { position: fixed; inset: 0; pointer-events: none; z-index: 5; }
    .ripple-circle {
        position: absolute; border-radius: 50%;
        background: rgba(255,255,255,0.22);
        transform: translate(-50%, -50%) scale(0);
        animation: rippleSpread 0.55s ease-out forwards; pointer-events: none;
    }
    @keyframes rippleSpread { to { transform: translate(-50%, -50%) scale(7); opacity: 0; } }

    /* ── Modal Dzikir Custom ── */
    .modal-dzikir-inner {
        background: white; border-radius: 24px 24px 0 0;
        padding: 20px 20px 32px;
        width: 100%; max-width: 480px;
        max-height: 88vh; overflow-y: auto;
    }
    @media (min-width: 640px) {
        .modal-dzikir-inner { border-radius: 24px; }
    }
    .modal-title {
        font-size: 16px; font-weight: 700; color: #134e4a;
        margin-bottom: 16px; text-align: center;
    }
    .form-group { margin-bottom: 12px; }
    .form-label {
        display: block; font-size: 11px; font-weight: 600;
        color: #64748b; text-transform: uppercase;
        letter-spacing: 0.08em; margin-bottom: 5px;
    }
    .form-input {
        width: 100%; padding: 11px 14px;
        border: 1.5px solid #e2e8f0; border-radius: 12px;
        font-family: 'DM Sans', sans-serif; font-size: 14px;
        color: #1e293b; outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    .form-input:focus { border-color: #14b8a6; box-shadow: 0 0 0 3px rgba(20,184,166,0.12); }
    .form-input.arabic-input {
        font-family: 'Amiri', serif;
        font-size: 20px; direction: rtl; text-align: right;
    }
    .input-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .preset-list { display: flex; flex-direction: column; gap: 7px; margin-bottom: 14px; }
    .preset-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 9px 14px; border: 1.5px solid #e2e8f0;
        border-radius: 12px; cursor: pointer; transition: all 0.2s;
    }
    .preset-item:hover { border-color: #14b8a6; background: #f0fdf9; }
    .preset-item.selected { border-color: #14b8a6; background: #f0fdf9; }
    .preset-name { font-size: 13px; font-weight: 500; color: #334155; }
    .preset-arabic { font-family: 'Amiri', serif; font-size: 17px; color: #0d9488; }
    .preset-meta { font-size: 11px; color: #94a3b8; margin-top: 1px; }
    .divider {
        display: flex; align-items: center; gap: 10px;
        margin: 12px 0; color: #94a3b8; font-size: 12px;
    }
    .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }
    .modal-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 14px; }
    .btn-modal-cancel {
        padding: 12px; background: #f1f5f9; border: none;
        border-radius: 12px; color: #64748b;
        font-family: 'DM Sans', sans-serif; font-size: 14px;
        cursor: pointer; transition: background 0.2s;
    }
    .btn-modal-cancel:hover { background: #e2e8f0; }
    .btn-modal-save {
        padding: 12px; background: linear-gradient(135deg, #14b8a6, #0d9488);
        border: none; border-radius: 12px; color: white;
        font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
        cursor: pointer; box-shadow: 0 4px 12px rgba(13,148,136,0.3);
        transition: all 0.2s;
    }
    .btn-modal-save:hover { box-shadow: 0 6px 16px rgba(13,148,136,0.4); }
</style>
@endpush

@section('content')
<div class="tasbih-page" x-data="tasbihCounter()" x-init="init()">

    {{-- ═══════════════════════════════════════
         MODAL KONFIRMASI RESET
    ═══════════════════════════════════════ --}}
    <div x-show="showResetModal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
         @click.self="showResetModal = false">
        <div x-show="showResetModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-2xl shadow-2xl p-6 w-[90vw] md:w-[360px] text-center">
            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
            <h4 class="text-lg font-bold text-gray-800 mb-2">Reset Counter?</h4>
            <p class="text-sm text-gray-500 mb-6">Semua hitungan dan sesi akan direset ke awal. Yakin ingin melanjutkan?</p>
            <div class="flex gap-3">
                <button @click="showResetModal = false"
                        class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors text-sm">
                    Batal
                </button>
                <button @click="confirmReset()"
                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-teal-400 to-emerald-500 text-white font-semibold rounded-xl shadow hover:shadow-md transition-all text-sm">
                    Ya, Reset
                </button>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         MODAL SESI SELESAI
    ═══════════════════════════════════════ --}}
    <div x-show="showSessionModal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
         @click.self="showSessionModal = false">
        <div x-show="showSessionModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-2xl shadow-2xl p-6 w-[90vw] md:w-[380px] text-center">

            <template x-if="completedSession < dzikir.sesi">
                <div>
                    <div class="text-4xl mb-3">✨</div>
                    <h4 class="text-xl font-bold text-gray-800 mb-1">
                        Sesi <span x-text="completedSession"></span> Selesai!
                    </h4>
                    <p class="text-sm text-gray-500 mb-2">
                        <span x-text="completedSession * dzikir.target"></span> dari
                        <span x-text="dzikir.sesi * dzikir.target"></span> dzikir selesai
                    </p>
                    <p class="text-sm text-teal-600 font-medium mb-6">
                        Lanjutkan sesi <span x-text="completedSession + 1"></span> dari <span x-text="dzikir.sesi"></span>
                    </p>
                    <button @click="showSessionModal = false"
                            class="w-full px-4 py-3 bg-gradient-to-r from-teal-400 to-emerald-500 text-white font-semibold rounded-xl shadow hover:shadow-md transition-all">
                        Lanjutkan →
                    </button>
                </div>
            </template>

            <template x-if="completedSession >= dzikir.sesi">
                <div>
                    <div class="text-4xl mb-3">🎉</div>
                    <h4 class="text-xl font-bold text-gray-800 mb-1">Alhamdulillah!</h4>
                    <p class="text-sm text-gray-500 mb-2">
                        <span x-text="dzikir.sesi * dzikir.target"></span> dzikir telah selesai
                    </p>
                    <p class="text-sm text-teal-600 font-medium mb-6">Semua <span x-text="dzikir.sesi"></span> sesi tuntas!</p>
                    <button @click="showSessionModal = false"
                            class="w-full px-4 py-3 bg-gradient-to-r from-teal-400 to-emerald-500 text-white font-semibold rounded-xl shadow hover:shadow-md transition-all">
                        Tutup
                    </button>
                </div>
            </template>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         MODAL DZIKIR CUSTOM
    ═══════════════════════════════════════ --}}
    <div x-show="showDzikirModal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-end sm:items-center justify-center bg-black/50"
         @click.self="showDzikirModal = false">
        <div x-show="showDzikirModal"
             x-transition:enter="transition ease-out duration-250"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-end="opacity-0 translate-y-8"
             class="modal-dzikir-inner">

            <div class="modal-title">Pilih / Buat Dzikir</div>

            {{-- Preset list --}}
            <div class="preset-list">
                <template x-for="(p, idx) in presets" :key="idx">
                    <div class="preset-item"
                         :class="{ selected: draft.nama === p.nama }"
                         @click="selectPreset(p)">
                        <div>
                            <div class="preset-name" x-text="p.nama"></div>
                            <div class="preset-meta" x-text="p.target + '× per sesi · ' + p.sesi + ' sesi'"></div>
                        </div>
                        <div class="preset-arabic" x-text="p.arab"></div>
                    </div>
                </template>
            </div>

            <div class="divider">atau buat sendiri</div>

            <div class="form-group">
                <label class="form-label">Nama Dzikir</label>
                <input class="form-input" type="text" x-model="draft.nama" placeholder="cth: Subhanallah">
            </div>
            <div class="form-group">
                <label class="form-label">Teks Arab (opsional)</label>
                <input class="form-input arabic-input" type="text" x-model="draft.arab" placeholder="سُبْحَانَ اللَّهِ">
            </div>
            <div class="input-row">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Target per Sesi</label>
                    <input class="form-input" type="number" min="1" max="999" x-model.number="draft.target" placeholder="33">
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Jumlah Sesi</label>
                    <input class="form-input" type="number" min="1" max="99" x-model.number="draft.sesi" placeholder="3">
                </div>
            </div>

            <div class="modal-actions">
                <button class="btn-modal-cancel" @click="showDzikirModal = false">Batal</button>
                <button class="btn-modal-save" @click="saveDzikir()">Simpan & Mulai</button>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         TOP BAR
    ═══════════════════════════════════════ --}}
    <div class="top-bar">
        <a href="{{ url()->previous() }}" class="icon-btn">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
        </a>
        <div class="text-center">
            <div class="top-bar-title">Tasbih Digital</div>
            <div class="top-bar-sub">Hitung dzikir Anda dengan mudah</div>
        </div>
        <div class="flex gap-1">
            <button class="icon-btn" @click="reset()" title="Reset">
                <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </button>
            <button class="icon-btn" :class="soundEnabled ? 'sound-on' : ''" @click="toggleSound()" title="Suara">
                <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" x-show="soundEnabled">
                    <path d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                </svg>
                <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" x-show="!soundEnabled">
                    <path d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                    <path d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         DZIKIR AKTIF BAR
    ═══════════════════════════════════════ --}}
    <div class="dzikir-active-bar">
        <span class="dzikir-active-name" :class="{ latin: !dzikir.arab }"
              x-text="dzikir.arab || dzikir.nama"></span>
        <button class="btn-ganti" @click="openDzikirModal()">Ganti ✎</button>
    </div>

    {{-- ═══════════════════════════════════════
         SESSION LABEL
    ═══════════════════════════════════════ --}}
    <div class="session-label">
        Sesi <span x-text="currentSession"></span> dari <span x-text="dzikir.sesi"></span>
        &nbsp;·&nbsp;
        <span x-text="sessionCount"></span>/<span x-text="dzikir.target"></span>
    </div>

    {{-- ═══════════════════════════════════════
         COUNTER (tap area)
    ═══════════════════════════════════════ --}}
    <div class="counter-area" @click="increment(); spawnRipple($event)">
        <div class="count-number"
             x-text="String(sessionCount).padStart(2,'0')"
             :class="{ 'count-pulse': counting }">
        </div>
        <div class="count-of">
            / <span x-text="dzikir.target"></span>
            &nbsp;·&nbsp; Total <span x-text="count"></span>/<span x-text="dzikir.sesi * dzikir.target"></span>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         BEAD VISUAL
    ═══════════════════════════════════════ --}}
    <div class="bead-section">
        <div class="bead-line"></div>
        <div class="bead-row" id="beadRow">
            <template x-for="i in 11" :key="i">
                <div class="bead"
                     :id="'bead-' + i"
                     :class="i <= Math.round((sessionCount / dzikir.target) * 11) ? 'filled' : 'empty'">
                </div>
            </template>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         TAP HINT
    ═══════════════════════════════════════ --}}
    <div class="tap-hint" x-show="count < dzikir.sesi * dzikir.target">
        Tap di mana saja untuk mulai
        <br><span style="font-size:11px;opacity:0.7">Tekan Space dari keyboard</span>
    </div>

    {{-- ═══════════════════════════════════════
         SESSION DOTS
    ═══════════════════════════════════════ --}}
    <div class="session-dots">
        <template x-for="s in dzikir.sesi" :key="s">
            <div class="s-dot"
                 :class="{
                     'done':    s < currentSession || (s === currentSession && count >= dzikir.sesi * dzikir.target),
                     'current': s === currentSession && count < dzikir.sesi * dzikir.target
                 }">
                <template x-if="s < currentSession || (s === currentSession && count >= dzikir.sesi * dzikir.target)">
                    <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path d="M5 13l4 4L19 7"/>
                    </svg>
                </template>
                <template x-if="!(s < currentSession || (s === currentSession && count >= dzikir.sesi * dzikir.target))">
                    <span x-text="s"></span>
                </template>
            </div>
        </template>
    </div>

    {{-- ripple overlay --}}
    <div class="ripple-overlay" id="rippleOverlay"></div>

    {{-- ═══════════════════════════════════════
         BOTTOM SHEET
    ═══════════════════════════════════════ --}}
    <div class="bottom-sheet">
        <div class="sheet-handle"></div>

        {{-- Completion banner --}}
        <div class="completion-banner"
             x-show="count >= dzikir.sesi * dzikir.target"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <p>🎉 Alhamdulillah!</p>
            <span><span x-text="dzikir.sesi * dzikir.target"></span> dzikir telah selesai. Semua sesi tuntas.</span>
        </div>

        {{-- Stats --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value" x-text="totalToday"></div>
                <div class="stat-label">Total Dzikir</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" x-text="(currentSession - 1) + (count >= dzikir.sesi * dzikir.target ? 1 : 0)"></div>
                <div class="stat-label">Sesi Selesai</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" x-text="count + '/' + (dzikir.sesi * dzikir.target)"></div>
                <div class="stat-label">Progress</div>
            </div>
        </div>

        {{-- Action buttons --}}
        <div class="action-row">
            <button class="btn-reset" @click="reset()">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Reset
            </button>
            <button class="btn-count ripple"
                    @click="increment(); spawnRipple($event)"
                    :disabled="count >= dzikir.sesi * dzikir.target">
                +1 &nbsp;Hitung
            </button>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function tasbihCounter() {
    return {
        // ── State counter ──
        count: 0,
        currentSession: 1,
        completedSession: 0,
        soundEnabled: true,
        counting: false,
        totalToday: 0,
        circumference: 2 * Math.PI * 85,
        showResetModal: false,
        showSessionModal: false,

        // ── State dzikir custom ──
        showDzikirModal: false,
        dzikir: { nama: 'Subhanallah', arab: 'سُبْحَانَ اللَّهِ', target: 33, sesi: 3 },
        draft:  { nama: '', arab: '', target: 33, sesi: 3 },

        presets: [
            { nama: 'Subhanallah',   arab: 'سُبْحَانَ اللَّهِ',        target: 33,  sesi: 3 },
            { nama: 'Alhamdulillah', arab: 'الْحَمْدُ لِلَّهِ',        target: 33,  sesi: 3 },
            { nama: 'Allahu Akbar',  arab: 'اللَّهُ أَكْبَرُ',          target: 33,  sesi: 3 },
            { nama: 'Istighfar',     arab: 'أَسْتَغْفِرُ اللَّهَ',      target: 100, sesi: 1 },
            { nama: 'Shalawat',      arab: 'صَلَّى اللَّهُ عَلَيْهِ',   target: 100, sesi: 1 },
            { nama: 'Tahlil',        arab: 'لَا إِلَهَ إِلَّا اللَّهُ', target: 100, sesi: 1 },
        ],

        // ── Computed ──
        get sessionCount() {
            return this.count - ((this.currentSession - 1) * this.dzikir.target);
        },
        get progressOffset() {
            const progress = this.sessionCount / this.dzikir.target;
            return this.circumference - (progress * this.circumference);
        },
        get totalTarget() {
            return this.dzikir.sesi * this.dzikir.target;
        },

        // ── Init ──
        init() {
            const saved = localStorage.getItem('tasbih_today');
            if (saved) {
                const data = JSON.parse(saved);
                if (data.date === new Date().toDateString()) this.totalToday = data.total || 0;
            }
            const savedDzikir = localStorage.getItem('tasbih_dzikir');
            if (savedDzikir) this.dzikir = JSON.parse(savedDzikir);

            document.addEventListener('keydown', (e) => {
                if (e.code === 'Space' && !this.showDzikirModal && this.count < this.totalTarget) {
                    e.preventDefault();
                    this.increment();
                }
            });
        },

        // ── Increment ──
        increment() {
            if (this.count >= this.totalTarget) return;

            this.count++;
            this.totalToday++;
            this.counting = true;

            if (this.soundEnabled) this.playSound();
            if (navigator.vibrate) navigator.vibrate(50);

            // Flash bead yang baru terisi
            const filledIdx = Math.round((this.sessionCount / this.dzikir.target) * 11);
            const bead = document.getElementById('bead-' + filledIdx);
            if (bead) {
                bead.classList.add('bead-pop');
                setTimeout(() => bead.classList.remove('bead-pop'), 400);
            }

            // Cek sesi selesai
            if (this.count % this.dzikir.target === 0) {
                this.completedSession = this.currentSession;
                if (this.currentSession < this.dzikir.sesi) this.currentSession++;
                this.celebrate();
                this.showSessionModal = true;
            }

            this.saveToday();
            setTimeout(() => { this.counting = false; }, 300);
        },

        // ── Reset ──
        reset() { this.showResetModal = true; },
        confirmReset() {
            this.count = 0;
            this.currentSession = 1;
            this.completedSession = 0;
            this.showResetModal = false;
        },

        toggleSound() { this.soundEnabled = !this.soundEnabled; },

        // ── Dzikir custom ──
        openDzikirModal() {
            this.draft = { ...this.dzikir };
            this.showDzikirModal = true;
        },
        selectPreset(p) {
            this.draft = { ...p };
        },
        saveDzikir() {
            if (!this.draft.nama || !this.draft.target || !this.draft.sesi) return;
            this.dzikir = { ...this.draft };
            localStorage.setItem('tasbih_dzikir', JSON.stringify(this.dzikir));
            this.count = 0;
            this.currentSession = 1;
            this.completedSession = 0;
            this.showDzikirModal = false;
        },

        // ── Ripple ──
        spawnRipple(event) {
            const overlay = document.getElementById('rippleOverlay');
            const r = document.createElement('div');
            r.className = 'ripple-circle';
            r.style.width  = '80px';
            r.style.height = '80px';
            r.style.left = (event.clientX ?? window.innerWidth  / 2) + 'px';
            r.style.top  = (event.clientY ?? window.innerHeight / 2) + 'px';
            overlay.appendChild(r);
            setTimeout(() => r.remove(), 600);
        },

        // ── Sound ──
        playSound() {
            try {
                const ctx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.connect(gain); gain.connect(ctx.destination);
                osc.frequency.value = 800; osc.type = 'sine';
                gain.gain.setValueAtTime(0.3, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.1);
                osc.start(ctx.currentTime); osc.stop(ctx.currentTime + 0.1);
            } catch (e) {}
        },
        celebrate() {
            if (navigator.vibrate) navigator.vibrate([100, 50, 100, 50, 200]);
            if (this.soundEnabled) {
                setTimeout(() => {
                    try {
                        const ctx = new (window.AudioContext || window.webkitAudioContext)();
                        [800, 1000, 1200].forEach((freq, i) => {
                            setTimeout(() => {
                                const osc = ctx.createOscillator();
                                const gain = ctx.createGain();
                                osc.connect(gain); gain.connect(ctx.destination);
                                osc.frequency.value = freq; osc.type = 'sine';
                                gain.gain.setValueAtTime(0.2, ctx.currentTime);
                                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.3);
                                osc.start(ctx.currentTime); osc.stop(ctx.currentTime + 0.3);
                            }, i * 100);
                        });
                    } catch (e) {}
                }, 100);
            }
        },
        saveToday() {
            localStorage.setItem('tasbih_today', JSON.stringify({
                date: new Date().toDateString(),
                total: this.totalToday,
            }));
        }
    };
}
</script>
@endpush