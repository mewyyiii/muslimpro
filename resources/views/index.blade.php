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

    .surah-number {
        background-color: rgba(255,255,255,0.25);
    }

    .surah-muted {
        color: rgba(255,255,255,0.85);
    }

    /* Header Divider */
    .page-header {
        border-bottom: 1px solid rgba(0,0,0,0.06);
        padding-bottom: 12px;
        margin-bottom: 24px;
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">
    
    <!-- ===== HEADER (Back + Center Title) ===== -->
    <div class="relative flex items-center justify-between page-header">

        <!-- Back Button -->
        <a href="{{ url()->previous() }}" 
           class="flex items-center text-sm font-medium hover:opacity-80 transition"
           style="color: var(--primary-accent);">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="w-5 h-5 mr-1" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor">
                <path stroke-linecap="round" 
                      stroke-linejoin="round" 
                      stroke-width="2" 
                      d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        <!-- Center Title -->
        <h1 class="absolute left-1/2 transform -translate-x-1/2 text-3xl font-bold"
            style="color: var(--text-primary);">
            Al-Quran
        </h1>

        <!-- Spacer (balance layout) -->
        <div class="w-20"></div>

    </div>


    <!-- ===== SEARCH ===== -->
    <div class="w-full max-w-md mx-auto mb-8">
        <input type="text" 
            id="surah-search-input" 
            placeholder="Cari surah (e.g. Al-Fatihah, Pembukaan)" 
            class="w-full p-3 rounded-lg shadow-sm border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2" 
            style="background-color: var(--surface); color: var(--text-primary); border-color: var(--primary-accent);">
    </div>
    

    <!-- ===== GRID ===== -->
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
        const surahCards = surahGrid.getElementsByClassName('surah-card');

        searchInput.addEventListener('keyup', function () {
            const searchTerm = searchInput.value.toLowerCase().trim();

            for (let i = 0; i < surahCards.length; i++) {
                const card = surahCards[i];
                const surahName = card.getAttribute('data-name');
                
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
