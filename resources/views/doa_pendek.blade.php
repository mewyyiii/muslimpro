@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif;
    }

    /* ===== Tampilan Awal Emerald (SAMA SEPERTI ASMAUL HUSNA) ===== */
    .doa-card {
        background: linear-gradient(90deg, #1FAF90, #10B981);
        color: white;
        border-radius: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .doa-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
    }

    /* ===== Saat Diklik (kembali ke warna lama) ===== */
    .doa-card.active {
        background: var(--surface);
        color: var(--text-primary);
    }

    .doa-card.active h2,
    .doa-card.active h3,
    .doa-card.active p {
        color: var(--text-primary) !important;
    }

    /* Lingkaran Nomor */
    .doa-number {
        background-color: rgba(255,255,255,0.25);
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

    /* Icon arrow */
    .doa-icon {
        color: rgba(255,255,255,0.9);
    }

    .doa-card.active .doa-icon {
        color: var(--text-primary-muted);
    }

    /* Content yang expand */
    .doa-content {
        transition: all 0.3s ease;
    }

    /* Icon rotation */
    .rotate-45 {
        transform: rotate(45deg);
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
            placeholder="Cari doa (e.g. Rabbana Atina)" 
            class="w-full p-3 rounded-lg shadow-sm border focus:outline-none focus:ring-2" 
            style="border-color: #10B981;">
    </div>

    <div id="doa-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($doapendek as $doa)
            <div class="doa-card block p-5 shadow-md" data-search-terms="{{ strtolower($doa->title) }}">
                
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full doa-number">
                            <span class="text-white font-bold text-sm">{{ $doa->id }}</span>
                        </div>
                        <h2 class="text-lg font-bold text-white">{{ $doa->title }}</h2>
                    </div>
                    <svg class="w-6 h-6 doa-icon transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>

                <div class="doa-content hidden">
                    <div class="text-right mb-3">
                        <h3 class="text-2xl font-arabic font-bold text-white">{{ $doa->arabic }}</h3>
                    </div>
                    <div>
                        <p class="text-sm doa-muted">{{ $doa->transliteration }}</p>
                        <p class="text-sm mt-2 doa-muted">"{{ $doa->translation }}"</p>
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
        const doaGrid = document.getElementById('doa-grid');
        const doaCards = doaGrid.getElementsByClassName('doa-card');

        // Search functionality
        searchInput.addEventListener('keyup', function () {
            const searchTerm = searchInput.value.toLowerCase().trim();

            for (let i = 0; i < doaCards.length; i++) {
                const card = doaCards[i];
                const searchTerms = card.getAttribute('data-search-terms');
                
                if (searchTerms.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });

        // Expand/Collapse functionality + Toggle Active Class
        for (let i = 0; i < doaCards.length; i++) {
            const card = doaCards[i];
            card.addEventListener('click', function() {
                const content = this.querySelector('.doa-content');
                const icon = this.querySelector('svg');

                // Toggle content visibility
                content.classList.toggle('hidden');
                
                // Rotate icon
                icon.classList.toggle('rotate-45');
                
                // Toggle active class (untuk ubah warna)
                this.classList.toggle('active');
            });
        }
    });
</script>
@endpush