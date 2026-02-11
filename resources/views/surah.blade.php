@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700&display=swap');

    .font-arabic {
        font-family: 'Amiri', serif;
    }

    /* ===== Emerald Card Ayat ===== */
    .verse-item {
        background: linear-gradient(90deg, #1FAF90, #10B981);
        color: white;
        border-radius: 14px;
        transition: all 0.3s ease;
        border: none;
    }

    .verse-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 20px rgba(0,0,0,0.15);
    }

    /* ===== Playing Highlight ===== */
    .verse-item.playing {
        background: linear-gradient(90deg, #0F9F7F, #059669);
        box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
    }

    /* Teks di dalam card */
    .verse-item p,
    .verse-item span {
        color: rgba(255,255,255,0.95);
    }

    /* ===== Nama Surah & Makna Abu Tua ===== */
    .surah-dark-gray {
        color: #374151; /* gray-700 */
    }

    .dark .surah-dark-gray {
        color: #D1D5DB; /* gray-300 */
    }

    /* Header divider */
    .page-header {
        border-bottom: 1px solid rgba(0,0,0,0.06);
        padding-bottom: 12px;
        margin-bottom: 24px;
    }

    .dark .page-header {
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

<<<<<<< HEAD
        <!-- ===== HEADER (Responsive Back + Center Title) ===== -->
    <div class="relative flex items-center justify-between page-header">

        <!-- Back Button -->
        <a href="{{ route('quran.index') }}"
        class="inline-flex items-center justify-center sm:justify-start px-3 py-2 rounded-lg transition hover:opacity-90"
        style="color: var(--primary-accent); background-color: rgba(20, 184, 166, 0.08);">

            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>

            <!-- Text (Desktop Only) -->
=======
    <!-- ===== HEADER ===== -->
    <div class="relative flex items-center justify-between page-header">

        <a href="{{ route('quran.index') }}"
           class="inline-flex items-center justify-center px-3 py-2 rounded-lg transition hover:opacity-90"
           style="color: var(--primary-accent); background-color: rgba(20, 184, 166, 0.08);">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>

>>>>>>> 0d3f53612881d45c057f7ede13a39f61f3fcb747
            <span class="hidden sm:inline ml-2 text-sm font-semibold">
                Kembali
            </span>
        </a>

<<<<<<< HEAD
        <!-- Center Title -->
=======
>>>>>>> 0d3f53612881d45c057f7ede13a39f61f3fcb747
        <h1 class="absolute left-1/2 transform -translate-x-1/2 text-2xl sm:text-3xl font-bold"
            style="color: var(--text-primary);">
            Al-Quran
        </h1>
<<<<<<< HEAD

        <!-- Spacer -->
        <div class="w-10 sm:w-20"></div>

    </div>
=======
>>>>>>> 0d3f53612881d45c057f7ede13a39f61f3fcb747

        <div class="w-10 sm:w-20"></div>
    </div>

    {{-- Surah Header --}}
    <div class="text-center mb-8">
        <h2 class="text-5xl font-arabic" style="color: var(--text-primary);">
            {{ $surah->arabic_name }}
        </h2>

        {{-- Nama Surah Abu Tua --}}
        <p class="text-3xl font-bold surah-dark-gray mt-2">
            {{ $surah->name }}
        </p>

        {{-- Makna Surah Abu Tua --}}
        <p class="text-lg surah-dark-gray mt-1">
            "{{ $surah->translation }}" - {{ $surah->total_verses }} Ayat
        </p>
    </div>

    {{-- Main Audio Player --}}
    <div id="main-player-container"
         class="sticky top-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm p-4 rounded-xl shadow-lg mb-8 z-10 border border-gray-200 dark:border-gray-700">

        <div class="flex items-center justify-between mb-2">
            <p id="player-verse-info" class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                Pilih ayat untuk memulai
            </p>

            <button id="play-all-btn"
                    class="px-3 py-1 text-sm text-white rounded-full transition"
                    style="background-color: var(--primary-accent);">
                Putar Semua
            </button>
        </div>

        <audio id="main-player" controls class="w-full"></audio>
    </div>

    {{-- Verses List --}}
    <div class="space-y-4">
        @foreach($surah->verses as $verse)
            <div id="verse-{{ $verse->number }}"
                 class="verse-item p-6 shadow-md"
                 data-verse-number="{{ $verse->number }}">

                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-4">
                        <span class="font-bold opacity-80">
                            {{ $verse->number }}
                        </span>

                        <button class="play-verse-btn" data-verse-number="{{ $verse->number }}">
                            <svg class="h-8 w-8"
                                 fill="currentColor"
                                 viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                      clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <p class="text-3xl font-arabic text-right leading-loose text-white">
                        {{ $verse->arabic }}
                    </p>
                </div>

                <p class="text-lg mt-4 italic text-white">
                    {{ $verse->transliteration }}
                </p>

                <p class="text-md italic text-white">
                    "{{ $verse->translation }}"
                </p>
            </div>
        @endforeach
    </div>

</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const mainPlayer = document.getElementById('main-player');
    const playerInfo = document.getElementById('player-verse-info');
    const playAllBtn = document.getElementById('play-all-btn');
    const surahAudioUrl = "{{ $surah->audio_url }}";
    const surahName = "{{ $surah->name }}";

    function playFullSurahAudio(verseNumber = 1) {
        mainPlayer.src = surahAudioUrl;
        mainPlayer.play();
        playerInfo.textContent = `Memutar: Surah ${surahName}`;
        updatePlayingIndicator(verseNumber);
    }

    function removePlayingIndicator() {
        document.querySelectorAll('.verse-item').forEach(v => v.classList.remove('playing'));
    }

    function updatePlayingIndicator(verseNumber) {
        removePlayingIndicator();
        const verseElement = document.getElementById(`verse-${verseNumber}`);
        if (verseElement) {
            verseElement.classList.add('playing');
            verseElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    document.querySelectorAll('.play-verse-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const verseNumber = parseInt(this.dataset.verseNumber, 10);
            playFullSurahAudio(verseNumber);
        });
    });

    playAllBtn.addEventListener('click', function() {
        playFullSurahAudio();
    });

    mainPlayer.addEventListener('ended', function() {
        removePlayingIndicator();
        playerInfo.textContent = "Pilih ayat untuk memulai";
    });

});
</script>
@endpush
