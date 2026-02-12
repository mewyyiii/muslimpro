@extends('layouts.app')

@push('styles')
<style>
    /* Divider header biar clean */
    .page-header {
        border-bottom: 1px solid rgba(0,0,0,0.06);
        padding-bottom: 12px;
        margin-bottom: 24px;
    }

    .dark .page-header {
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    /* Card Surah */
    .surah-card {
        background-color: var(--surface);
        border-radius: 14px;
        transition: all 0.25s ease;
        border: 1px solid rgba(0,0,0,0.06);
    }

    .surah-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 20px rgba(0,0,0,0.08);
    }

    .dark .surah-card {
        border: 1px solid rgba(255,255,255,0.08);
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-12">

    <!-- ===== HEADER ===== -->
    <div class="text-center page-header">
        <h1 class="text-3xl font-bold" style="color: var(--text-primary);">
            Al-Quran
        </h1>
    </div>

    <!-- ===== SEARCH (Disamakan dengan doa_pendek) ===== -->
    <div class="w-full max-w-md mx-auto mb-8">
        <input type="text"
            id="surah-search-input"
            placeholder="Cari surah (e.g. Al-Fatihah, Pembukaan)"
            class="w-full p-3 rounded-lg shadow-sm border focus:outline-none focus:ring-2"
            style="border-color: #10B981;">
    </div>

    <!-- ===== GRID SURAH ===== -->
    <div id="surah-grid"
         class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($surahs as $surah)
            <a href="{{ route('quran.show', $surah->number) }}"
               class="surah-card block p-5 shadow-sm"
               data-surah-name="{{ strtolower($surah->name . ' ' . $surah->translation) }}">

                <div class="flex justify-between items-center mb-3">
                    <span class="font-bold text-gray-400">
                        {{ $surah->number }}
                    </span>

                    <h2 class="text-2xl font-arabic"
                        style="color: var(--text-primary);">
                        {{ $surah->arabic_name }}
                    </h2>
                </div>

                <div>
                    <h3 class="text-lg font-bold"
                        style="color: var(--text-primary);">
                        {{ $surah->name }}
                    </h3>

                    <p class="text-sm"
                       style="color: var(--text-primary-muted);">
                        "{{ $surah->translation }}"
                    </p>

                    <p class="text-xs mt-2 text-gray-500">
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
    const surahCards = surahGrid.getElementsByClassName('surah-card');

    searchInput.addEventListener('keyup', function () {
        const searchTerm = searchInput.value.toLowerCase().trim();

        for (let i = 0; i < surahCards.length; i++) {
            const card = surahCards[i];
            const surahName = card.getAttribute('data-surah-name');

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
