@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif;
    }

    /* ===== GRID: 4 kolom seimbang ===== */
    #doa-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        align-items: start;
    }

    @media (max-width: 1024px) { #doa-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 700px)  { #doa-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 440px)  { #doa-grid { grid-template-columns: 1fr; } }

    /* ===== Tampilan Awal Emerald ===== */
    .doa-card {
        background: linear-gradient(135deg, #1FAF90, #10B981);
        color: white;
        border-radius: 14px;
        transition: transform 0.3s cubic-bezier(0.4,0,0.2,1),
                    box-shadow 0.3s ease;
        cursor: pointer;
        overflow: hidden;
    }

    .doa-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 26px rgba(16, 185, 129, 0.28);
    }

    /* ===== Saat Diklik ===== */
    .doa-card.active {
        background: var(--surface);
        color: var(--text-primary);
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        transform: none;
    }

    .doa-card.active h2,
    .doa-card.active h3,
    .doa-card.active p {
        color: var(--text-primary) !important;
    }

    /* Lingkaran Nomor */
    .doa-number {
        background-color: rgba(255,255,255,0.25);
        flex-shrink: 0;
        min-width: 34px;
    }

    .doa-card.active .doa-number {
        background-color: var(--primary-accent);
    }

    /* Teks putih soft */
    .doa-muted {
        color: rgba(255,255,255,0.85);
    }

    .doa-card.active .doa-muted {
        color: var(--text-primary-muted);
    }

<<<<<<< HEAD
    Icon arrow
    .doa-icon {
        color: rgba(255,255,255,0.9);
=======
    /* ===== Chevron Indicator ===== */
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
>>>>>>> 17bf04fc2e0c20ee7ced2e237f4381416c73a33a
    }

    .doa-chevron svg {
        width: 13px;
        height: 13px;
        color: rgba(255,255,255,0.95);
        transition: transform 0.35s cubic-bezier(0.4,0,0.2,1), color 0.3s;
        display: block;
    }

    .doa-card.active .doa-chevron {
        background: rgba(16, 185, 129, 0.12);
    }

    .doa-card.active .doa-chevron svg {
        color: #10B981;
        transform: rotate(180deg);
    }

    /* ===== Content expand ===== */
    .doa-content {
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1),
                    opacity 0.3s ease;
    }

<<<<<<< HEAD
    Icon rotation
    .rotate-45 {
        transform: rotate(45deg);
=======
    .doa-content.open {
        max-height: 500px;
        opacity: 1;
    }

    .doa-divider {
        height: 1px;
        background: rgba(255,255,255,0.22);
        margin-bottom: 12px;
    }

    .doa-card.active .doa-divider {
        background: #e5e7eb;
>>>>>>> 17bf04fc2e0c20ee7ced2e237f4381416c73a33a
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
            placeholder="Cari doa (Rabbana Atina)"
            class="w-full p-3 rounded-lg shadow-sm border focus:outline-none focus:ring-2"
            style="border-color: #10B981;">
    </div>

    <div id="doa-grid">
        @foreach($doapendek as $doa)
            <div class="doa-card p-4 shadow-md" data-search-terms="{{ strtolower($doa->title) }}">

                {{-- Header --}}
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2 min-w-0 flex-1">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full doa-number">
                            <span class="text-white font-bold text-sm">{{ $doa->id }}</span>
                        </div>
                        <h2 class="text-sm font-semibold text-white leading-snug">{{ $doa->title }}</h2>
                    </div>
                    <div class="doa-chevron ml-2">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>

                {{-- Konten --}}
                <div class="doa-content">
                    <div class="pt-3">
                        <div class="doa-divider"></div>
                        <div class="text-right mb-3">
                            <h3 class="font-arabic text-2xl font-bold text-white">{{ $doa->arabic }}</h3>
                        </div>
                        <div>
                            <p class="text-xs doa-muted leading-relaxed">{{ $doa->transliteration }}</p>
                            <p class="text-xs mt-2 doa-muted leading-relaxed italic">"{{ $doa->translation }}"</p>
                        </div>
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
                const isOpen = content.classList.contains('open');
                content.classList.toggle('open', !isOpen);
                this.classList.toggle('active', !isOpen);
            });
        });
    });
</script>
@endpush