@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif;
    }

    /* ===== Warna Card Surah (Samakan dengan Asmaul Husna) ===== */
    .surah-card {
        background: linear-gradient(90deg, #1FAF90, #10B981);
        color: white;
        border-radius: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .surah-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
    }

    /* Lingkaran Nomor */
    .surah-number {
        background-color: rgba(255,255,255,0.25);
    }

    /* Teks putih soft */
    .surah-muted {
        color: rgba(255,255,255,0.85);
    }

</style>
@endpush

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">
        
        <h1 class="text-3xl font-bold text-center mb-6 mt-4" style="color: var(--text-primary);">
            Al-Quran
        </h1>

        <div class="w-full max-w-md mx-auto mb-8">
        <div class="relative">
            <input type="text"
                id="surah-search-input"
                placeholder="Cari surah (e.g. Al-Fatihah, Pembukaan)"
                class="w-full pl-10 pr-4 py-3 rounded-xl border focus:outline-none focus:ring-2 transition-all"
                style="
                    background-color: var(--surface);
                    color: var(--text-primary);
                    border-color: var(--primary-accent);
                    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
                ">

            <!-- Icon Search -->
            <div class="absolute left-3 top-1/2 transform -translate-y-1/2"
                style="color: var(--primary-accent);">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    
    <div id="surah-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($surahs as $surah)
            <a href="{{ route('quran.show', ['number' => $surah->number]) }}" 
               class="surah-card block p-5 shadow-md" 
               
               data-name="{{ strtolower($surah->name . ' ' . $surah->translation) }}">
                
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full surah-number">
                        <span class="text-white font-bold text-sm">{{ $surah->number }}</span>
                    </div>
                    <div class="text-right">
                        <h3 class="text-2xl font-arabic font-bold text-white">{{ $surah->arabic_name }}</h3>
                    </div>
                </div>
                
                <div>
                    <h2 class="text-lg font-bold text-white">{{ $surah->name }}</h2>
                    <p class="text-sm surah-muted">{{ $surah->translation }}</p>
                    <p class="text-xs mt-2 surah-muted">{{ $surah->total_verses }} Ayat</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('surah-search-input');
        const surahGrid = document.getElementById('surah-grid');
        // Get cards from the grid context to ensure we don't select other potential cards on the page
        const surahCards = surahGrid.getElementsByClassName('surah-card');

        searchInput.addEventListener('keyup', function () {
            const searchTerm = searchInput.value.toLowerCase().trim();

            for (let i = 0; i < surahCards.length; i++) {
                const card = surahCards[i];
                // The name is stored in a data attribute for clean access
                const surahName = card.getAttribute('data-name');
                
                // Simple "includes" check provides a good-enough fuzzy search
                if (surahName.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    });
</script>
@endpush
