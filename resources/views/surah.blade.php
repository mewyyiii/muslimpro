@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif;
    }
    .verse-item.playing {
        background-color: var(--primary-accent-light, #ecfdf5); /* Light teal */
        border-left-color: var(--primary-accent, #14b8a6);
        border-left-width: 4px;
    }
    .dark .verse-item.playing {
        background-color: #0d2d29;
    }

    /* Header divider biar rapi/profesional */
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
            <span class="hidden sm:inline ml-2 text-sm font-semibold">
                Kembali
            </span>
        </a>

        <!-- Center Title -->
        <h1 class="absolute left-1/2 transform -translate-x-1/2 text-2xl sm:text-3xl font-bold"
            style="color: var(--text-primary);">
            Al-Quran
        </h1>

        <!-- Spacer -->
        <div class="w-10 sm:w-20"></div>

    </div>


    {{-- Surah Header --}}
    <div class="text-center mb-8">
        <h2 class="text-5xl font-arabic" style="color: var(--text-primary);">{{ $surah->arabic_name }}</h2>
        <p class="text-3xl font-bold text-gray-800 dark:text-gray-200 mt-2">{{ $surah->name }}</p>
        <p class="text-lg text-gray-600 dark:text-gray-400 mt-1">"{{ $surah->translation }}" - {{ $surah->total_verses }} Ayat</p>
    </div>

    {{-- Main Audio Player --}}
    <div id="main-player-container" class="sticky top-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm p-4 rounded-xl shadow-lg mb-8 z-10 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between mb-2">
            <p id="player-verse-info" class="text-sm font-semibold text-gray-700 dark:text-gray-300">Pilih ayat untuk memulai</p>
            <button id="play-all-btn" class="px-3 py-1 text-sm text-white rounded-full transition"
                style="background-color: var(--primary-accent);">
                Putar Semua
            </button>
        </div>
        <audio id="main-player" controls class="w-full"></audio>
    </div>

    {{-- Verses List --}}
    <div class="space-y-4">
        @foreach($surah->verses as $verse)
            <div id="verse-{{ $verse->number }}" class="verse-item rounded-lg shadow-sm transition-all duration-300 border border-gray-200 dark:border-gray-700" style="background-color: var(--surface);" data-verse-number="{{ $verse->number }}">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-gray-400 dark:text-gray-500">{{ $verse->number }}</span>
                            <button class="play-verse-btn" data-verse-number="{{ $verse->number }}">
                                <svg class="h-8 w-8 transition-colors" style="color: var(--primary-accent);" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-3xl font-arabic text-right leading-loose" style="color: var(--text-primary);">{{ $verse->arabic }}</p>
                    </div>
                    <p class="text-lg mt-4 text-left" style="color: var(--text-primary-muted); font-style: italic;">{{ $verse->transliteration }}</p>
                    <p class="text-md italic text-left" style="color: var(--text-primary-muted);">"{{ $verse->translation }}"</p>
                </div>
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
        let currentPlayingVerseNumber = null;

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
            currentPlayingVerseNumber = verseNumber;
        }

        document.querySelectorAll('.play-verse-btn').forEach(button => {
            button.addEventListener('click', function() {
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
            currentPlayingVerseNumber = null;
        });
    });
</script>
@endpush
