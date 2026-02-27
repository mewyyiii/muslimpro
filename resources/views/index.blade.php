@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');

    .font-arabic {
        font-family: 'Amiri', serif;
    }

    /* ===== Card Emerald ===== */
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

    /* Lingkaran nomor */
    .surah-number {
        background-color: rgba(255,255,255,0.25);
    }

    /* teks putih soft */
    .surah-muted {
        color: rgba(255,255,255,0.85);
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">

    <h1 class="text-3xl font-bold text-center mb-6 mt-4">
        Al-Quran
    </h1>

    {{-- SEARCH TANPA ICON --}}
    <div class="w-full max-w-md mx-auto mb-8">
        <input type="text"
            id="surah-search-input"
            placeholder="Cari surah (Al-Fatihah, Pembukaan)"
            class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:ring-2 transition-all"
            style="
                background-color: var(--surface);
                color: var(--text-primary);
                border-color: #10B981;
            ">
    </div>

    {{-- GRID SURAH --}}
    <div id="surah-grid"
         class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($surahs as $surah)
            <a href="{{ route('quran.show', $surah->number) }}"
               class="surah-card block p-5 shadow-md surah-card-item"
               data-surah-terms="{{ strtolower($surah->name . ' ' . $surah->translation . ' ' . $surah->arabic_name) }}">

                <div class="flex justify-between items-center mb-3">

                    <div class="flex items-center justify-center w-10 h-10 rounded-full surah-number">
                        <span class="font-bold text-sm text-white">
                            {{ $surah->number }}
                        </span>
                    </div>

                    <div class="text-right">
                        <h2 class="text-2xl font-arabic font-bold text-white">
                            {{ $surah->arabic_name }}
                        </h2>
                    </div>

                </div>

                <div>
                    <h3 class="text-lg font-bold text-white">
                        {{ $surah->name }}
                    </h3>

                    <p class="text-sm surah-muted">
                        "{{ $surah->translation }}"
                    </p>

                    <p class="text-xs mt-2 surah-muted">
                        {{ $surah->total_verses }} Ayat
                    </p>
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
    const surahCards = surahGrid.getElementsByClassName('surah-card-item');

    searchInput.addEventListener('keyup', function () {
        const searchTerm = searchInput.value.toLowerCase().trim();

        for (let i = 0; i < surahCards.length; i++) {
            const card = surahCards[i];
            const terms = card.getAttribute('data-surah-terms') || '';

            if (terms.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        }
    });

});
</script>
@endpush
