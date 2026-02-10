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
    <h1 class="text-3xl font-bold text-center mb-4" style="color: var(--text-primary);">Doa Doa Pendek</h1>
    
    <div class="w-full max-w-md mx-auto mb-8">
        <input type="text" id="doa-search-input" placeholder="Cari doa (e.g. Rabbana Atina)" class="w-full p-3 rounded-lg shadow-sm border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2" style="background-color: var(--surface); color: var(--text-primary); border-color: var(--primary-accent);">
    </div>

    <div id="doa-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($doapendek as $doa)
            <div class="doa-card block p-5 rounded-lg shadow-md transition-transform transform hover:-translate-y-1 hover:shadow-xl cursor-pointer" style="background-color: var(--surface);" data-search-terms="{{ strtolower($doa->title) }}">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full" style="background-color: var(--primary-accent);">
                            <span class="text-white font-bold text-sm">{{ $doa->id }}</span>
                        </div>
                        <h2 class="text-lg font-bold" style="color: var(--text-primary);">{{ $doa->title }}</h2>
                    </div>
                    <svg class="w-6 h-6 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <div class="doa-content hidden">
                    <div class="text-right mb-3">
                        <h3 class="text-2xl font-arabic font-bold" style="color: var(--text-primary);">{{ $doa->arabic }}</h3>
                    </div>
                    <div>
                        <p class="text-sm" style="color: var(--text-primary-muted);">{{ $doa->transliteration }}</p>
                        <p class="text-sm mt-2" style="color: var(--secondary-accent);">"{{ $doa->translation }}"</p>
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

        // Expand/Collapse functionality
        for (let i = 0; i < doaCards.length; i++) {
            const card = doaCards[i];
            card.addEventListener('click', function() {
                const content = this.querySelector('.doa-content');
                const icon = this.querySelector('svg');

                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-45');
            });
        }
    });
</script>
@endpush