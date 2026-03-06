@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');

    .font-arabic {
        font-family: 'Amiri', serif;
    }

    /* ===== GRID: seimbang di semua ukuran layar ===== */
    #doa-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        align-items: start;
    }

    @media (max-width: 1024px) { #doa-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 700px)  { #doa-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 440px)  { #doa-grid { grid-template-columns: 1fr; } }

    /* ===== Card Default (Emerald) ===== */
    .doa-card {
        background: linear-gradient(135deg, #1FAF90, #10B981);
        color: white;
        border-radius: 14px;
        padding: 14px;
        cursor: pointer;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s cubic-bezier(0.4,0,0.2,1),
                    box-shadow 0.3s ease;
    }

    .doa-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 26px rgba(16, 185, 129, 0.28);
    }

    /* ===== Card Saat Aktif (terbuka) ===== */
    .doa-card.active {
        background: var(--surface, #ffffff);
        color: var(--text-primary, #1f2937);
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        transform: none;
    }

    .doa-card.active h2,
    .doa-card.active h3,
    .doa-card.active p {
        color: var(--text-primary, #1f2937) !important;
    }

    /* ===== Header: tinggi konsisten di semua card ===== */
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

    /* Lingkaran Nomor */
    .doa-number {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 50%;
        background: rgba(255,255,255,0.25);
        font-size: 0.78rem;
        font-weight: 700;
        color: white;
        transition: background 0.3s, color 0.3s;
    }

    /* Nomor berubah hijau solid saat card aktif */
    .doa-card.active .doa-number {
        background: #10B981;
        color: white;
    }

    /* Judul card */
    .doa-card h2 {
        font-size: 0.88rem;
        font-weight: 600;
        color: white;
        line-height: 1.4;
        transition: color 0.3s;
    }

    /* Teks putih soft */
    .doa-muted {
        color: rgba(255,255,255,0.85);
        transition: color 0.3s;
    }

    .doa-card.active .doa-muted {
        color: var(--text-primary-muted, #6b7280);
    }

    /* ===== Chevron (pengganti + / x) ===== */
    .doa-chevron {
        width: 26px;
        min-width: 26px;
        height: 26px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background 0.3s ease;
    }

    .doa-chevron svg {
        width: 13px;
        height: 13px;
        stroke: rgba(255,255,255,0.95);
        fill: none;
        display: block;
        transition: stroke 0.3s ease,
                    transform 0.35s cubic-bezier(0.4,0,0.2,1);
    }

    .doa-card.active .doa-chevron {
        background: rgba(16, 185, 129, 0.12);
    }

    .doa-card.active .doa-chevron svg {
        stroke: #10B981;
        transform: rotate(180deg);
    }

    /* ===== Konten Expand/Collapse ===== */
    .doa-content {
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1),
                    opacity 0.3s ease;
    }

    .doa-content.open {
        max-height: 500px;
        opacity: 1;
    }

    /* Garis pemisah */
    .doa-divider {
        height: 1px;
        background: rgba(255,255,255,0.22);
        margin: 12px 0;
        transition: background 0.3s;
    }

    .doa-card.active .doa-divider {
        background: #e5e7eb;
    }

    /* Teks Arab */
    .doa-arabic {
        font-family: 'Amiri', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: white;
        text-align: right;
        line-height: 1.75;
        margin-bottom: 8px;
        transition: color 0.3s;
    }

    .doa-card.active .doa-arabic {
        color: var(--text-primary, #1f2937);
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">

    <h1 class="text-3xl font-bold text-center mb-6 mt-4">
        Doa-doa Pendek
    </h1>

    <div class="w-full max-w-md mx-auto mb-8">
        <input type="text"
            id="doa-search-input"
            placeholder="Cari doa (Doa Sebelum Makan, Doa Masuk Rumah, dll.)"
            class="w-full p-3 rounded-lg shadow-sm border focus:outline-none focus:ring-2"
            style="border-color: #10B981;">
    </div>

    <div id="doa-grid">
        @foreach($doapendek as $doa)
            <div class="doa-card" data-search-terms="{{ strtolower($doa->title) }}">

                {{-- Header Card --}}
                <div class="doa-card-header">
                    <div class="doa-card-header-left">
                        <div class="doa-number">
                            <span>{{ $doa->id }}</span>
                        </div>
                        <h2>{{ $doa->title }}</h2>
                    </div>

                    {{-- Chevron: menghadap bawah saat tutup, atas saat buka --}}
                    <div class="doa-chevron">
                        <svg viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </div>
                </div>

                {{-- Konten (expand/collapse) --}}
                <div class="doa-content">
                    <div class="doa-divider"></div>
                    <div class="text-right mb-3">
                        <h3 class="doa-arabic">{{ $doa->arabic }}</h3>
                    </div>
                    <div>
                        <p class="text-xs doa-muted leading-relaxed">{{ $doa->transliteration }}</p>
                        <p class="text-xs mt-2 doa-muted leading-relaxed italic">"{{ $doa->translation }}"</p>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('doa-search-input');
        const cards = document.querySelectorAll('.doa-card');

        // ===== Search: filter card berdasarkan judul =====
        searchInput.addEventListener('keyup', function () {
            const term = this.value.toLowerCase().trim();
            cards.forEach(card => {
                card.style.display = card.dataset.searchTerms.includes(term) ? '' : 'none';
            });
        });

        // ===== Expand / Collapse dengan animasi chevron =====
        cards.forEach(card => {
            card.addEventListener('click', function () {
                const content = this.querySelector('.doa-content');
                const isOpen = content.classList.contains('open');

                // Toggle konten: open = expand, tutup = collapse
                content.classList.toggle('open', !isOpen);

                // Toggle class active pada card:
                // active = card putih + nomor hijau + chevron putar ke atas
                this.classList.toggle('active', !isOpen);
            });
        });
    });
</script>
@endpush