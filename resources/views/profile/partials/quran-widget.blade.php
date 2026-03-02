{{-- 
    ═══════════════════════════════════════════════════════════════════════
    QURAN JOURNEY WIDGET
    File: resources/views/profile/partials/quran-widget.blade.php
    Style: Matching dengan Prayer Journey Card
    ═══════════════════════════════════════════════════════════════════════
--}}

<div class="bg-white rounded-3xl p-6 shadow-2xl">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl flex items-center justify-center shadow-md">
                <span class="text-2xl">📖</span>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800">Progres Al-Qur’an</h3>
                <p class="text-xs text-gray-500">Pantau progres bacaanmu</p>
            </div>
        </div>
        @if($lastReadQuran)
            <a href="{{ route('quran-tracking.index') }}" 
               class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-xl transition-all shadow-md">
                Lihat Detail →
            </a>
        @else
            <span class="px-4 py-2 bg-gray-100 text-gray-400 text-sm font-semibold rounded-xl">
                Segera
            </span>
        @endif
    </div>

    @if($lastReadQuran)
        {{-- Stats Display Box --}}
        <div class="bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl p-6 text-white shadow-lg mb-4">
            <div class="grid grid-cols-2 gap-4 mb-3">
                {{-- Surah Completed --}}
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-2xl">✓</span>
                        <div>
                            <div class="text-sm opacity-90">Surah</div>
                            <div class="text-3xl font-bold">{{ $totalSurahCompleted }}</div>
                        </div>
                    </div>
                    <div class="text-xs opacity-90">Selesai</div>
                </div>

                {{-- Streak --}}
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-2xl">🔥</span>
                        <div>
                            <div class="text-sm opacity-90">Konsisten</div>
                            <div class="text-3xl font-bold">{{ $quranStreak }}</div>
                        </div>
                    </div>
                    <div class="text-xs opacity-90">Hari berturut-turut</div>
                </div>
            </div>

            {{-- Currently Reading Info --}}
            <div class="mt-4 pt-4 border-t border-white/20">
                <div class="text-xs opacity-90 mb-1">Sedang Dibaca</div>
                <div class="text-lg font-bold">{{ $lastReadQuran->surah->number }}. {{ $lastReadQuran->surah->name }}</div>
                <div class="text-sm opacity-90">Ayat {{ $lastReadQuran->last_verse }}/{{ $lastReadQuran->surah->total_verses }}</div>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div>
            <div class="flex items-center justify-between text-sm text-gray-700 mb-2">
                <span class="font-semibold">Progres Surah</span>
                <span class="text-lg font-bold text-emerald-600">{{ $lastReadQuran->progress_percent }}%</span>
            </div>
            <div class="h-3 bg-gray-100 rounded-full overflow-hidden shadow-inner">
                <div class="h-full bg-gradient-to-r from-emerald-400 via-teal-400 to-emerald-500 rounded-full transition-all duration-1000"
                     style="width: {{ $lastReadQuran->progress_percent }}%"></div>
            </div>
            <p class="text-xs text-gray-500 mt-2 text-center">
                {{ $lastReadQuran->last_verse }} / {{ $lastReadQuran->surah->total_verses }} ayat selesai
            </p>
        </div>

        {{-- Status Badge --}}
        <div class="mt-4 text-center">
            <span class="inline-flex items-center gap-1 px-4 py-2 rounded-full text-sm font-semibold
                         {{ $readQuranToday ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                @if($readQuranToday)
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Dibaca Hari Ini
                @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Hari ini belum membaca
                @endif
            </span>
        </div>

    @else
        {{-- Empty State - Coming Soon --}}
        <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl p-8 text-center">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                <span class="text-4xl">📖</span>
            </div>
            <h4 class="text-lg font-bold text-gray-700 mb-2">Start Your Quran Journey</h4>
            <p class="text-sm text-gray-500 mb-4">Begin tracking your reading progress</p>
            <span class="inline-block px-4 py-2 bg-gray-300 text-gray-500 text-sm font-semibold rounded-xl">
                Coming Soon
            </span>
        </div>
    @endif
</div>

@push('styles')
<style>
    /* Smooth animations for Quran widget */
    .transition-all {
        transition: all 0.5s ease;
    }
</style>
@endpush