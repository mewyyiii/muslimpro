@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif;
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center mb-4" style="color: var(--text-primary);">Al-Quran</h1>

    <div class="w-full max-w-md mx-auto mb-8">
        <input type="text" id="surah-search-input" placeholder="Cari surah (e.g. Al-Fatihah, Pembukaan)" class="w-full p-3 rounded-lg shadow-sm border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2" style="background-color: var(--surface); color: var(--text-primary); border-color: var(--primary-accent);">
    </div>
    
    <div id="surah-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($surahs as $surah)
            <a href="{{ url('/surah/' . $surah['number']) }}" class="surah-card block p-5 rounded-lg shadow-md transition-transform transform hover:-translate-y-1 hover:shadow-xl" style="background-color: var(--surface);" data-name="{{ strtolower($surah['name'] . ' ' . $surah['translation']) }}">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full" style="background-color: var(--primary-accent);">
                        <span class="text-white font-bold text-sm">{{ $surah['number'] }}</span>
                    </div>
                    <div class="text-right">
                        <h3 class="text-2xl font-arabic font-bold" style="color: var(--text-primary);">{{ $surah['arabic_name'] }}</h3>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-bold" style="color: var(--text-primary);">{{ $surah['name'] }}</h2>
                    <p class="text-sm" style="color: var(--text-primary-muted);">{{ $surah['translation'] }}</p>
                    <p class="text-xs mt-2" style="color: var(--secondary-accent);">{{ $surah['total_verses'] }} Ayat</p>
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
