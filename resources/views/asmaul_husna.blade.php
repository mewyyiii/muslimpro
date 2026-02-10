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
    <h1 class="text-3xl font-bold text-center mb-4" style="color: var(--text-primary);">Asmaul & Husna</h1>
    
    <div class="w-full max-w-md mx-auto mb-8">
        <input type="text" id="asmaul-husna-search-input" placeholder="Cari nama atau arti (e.g. Ar-Rahman, Pengasih)" class="w-full p-3 rounded-lg shadow-sm border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2" style="background-color: var(--surface); color: var(--text-primary); border-color: var(--primary-accent);">
    </div>

    <div id="asmaul-husna-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($asmaulHusna as $name)
            <div class="asmaul-husna-card block p-5 rounded-lg shadow-md transition-transform transform hover:-translate-y-1 hover:shadow-xl" style="background-color: var(--surface);" data-search-terms="{{ strtolower($name->transliteration . ' ' . $name->meaning_id) }}">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full" style="background-color: var(--primary-accent);">
                        <span class="text-white font-bold text-sm">{{ $name->id }}</span>
                    </div>
                    <div class="text-right">
                        <h3 class="text-2xl font-arabic font-bold" style="color: var(--text-primary);">{{ $name->arabic }}</h3>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-bold" style="color: var(--text-primary);">{{ $name->transliteration }}</h2>
                    <p class="text-sm" style="color: var(--text-primary-muted);">{{ $name->meaning_id }}</p>
                    <p class="text-xs mt-2" style="color: var(--secondary-accent);">{{ $name->meaning_en }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('asmaul-husna-search-input');
        const asmaulHusnaGrid = document.getElementById('asmaul-husna-grid');
        const asmaulHusnaCards = asmaulHusnaGrid.getElementsByClassName('asmaul-husna-card');

        searchInput.addEventListener('keyup', function () {
            const searchTerm = searchInput.value.toLowerCase().trim();

            for (let i = 0; i < asmaulHusnaCards.length; i++) {
                const card = asmaulHusnaCards[i];
                const searchTerms = card.getAttribute('data-search-terms');
                
                if (searchTerms.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    });
</script>
@endpush
