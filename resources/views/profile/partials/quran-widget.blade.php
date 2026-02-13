{{-- 
    WIDGET BACA AL-QURAN
    File: resources/views/profile/partials/quran-widget.blade.php
--}}

<div class="bg-white rounded-2xl p-4 shadow-xl text-center relative overflow-hidden">
    
    @if($lastReadQuran)
        {{-- ADA DATA TRACKING --}}
        
        {{-- Header --}}
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-semibold text-gray-600 flex items-center gap-1.5">
                📖 Baca Al-Quran
            </span>
            <a href="{{ route('quran-tracking.index') }}"
               class="text-xs text-teal-600 hover:underline font-medium">Detail →</a>
        </div>

        {{-- Statistik Mini --}}
        <div class="grid grid-cols-2 gap-2 mb-3">
            {{-- Surah Selesai --}}
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-lg p-2 border border-emerald-100">
                <div class="text-lg font-bold text-emerald-600">
                    {{ $totalSurahCompleted }}<span class="text-xs text-gray-400">/114</span>
                </div>
                <div class="text-xs text-gray-600">Surah selesai</div>
            </div>

            {{-- Streak --}}
            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-lg p-2 border border-amber-100">
                <div class="text-lg font-bold text-amber-600">
                    {{ $quranStreak }} 🔥
                </div>
                <div class="text-xs text-gray-600">Hari berturut</div>
            </div>
        </div>

        {{-- Progress Terakhir --}}
        <div class="bg-gray-50 rounded-lg p-2.5 border border-gray-200 text-left">
            <div class="flex items-center justify-between gap-2">
                <div class="flex-1 min-w-0">
                    <div class="text-xs text-gray-500">Terakhir dibaca</div>
                    <h4 class="font-bold text-gray-800 text-sm truncate">
                        {{ $lastReadQuran->surah->number }}. {{ $lastReadQuran->surah->name }}
                    </h4>
                    <p class="text-xs text-gray-600">
                        Ayat {{ $lastReadQuran->last_verse }}/{{ $lastReadQuran->surah->total_verses }}
                        <span class="text-teal-600 font-semibold">• {{ $lastReadQuran->progress_percent }}%</span>
                    </p>
                </div>
                
                {{-- Progress Circle --}}
                <div class="flex-shrink-0">
                    <div class="relative w-10 h-10">
                        <svg class="transform -rotate-90 w-10 h-10" viewBox="0 0 40 40">
                            <circle cx="20" cy="20" r="16" stroke="#E5E7EB" stroke-width="3" fill="none"/>
                            <circle cx="20" cy="20" r="16"
                                    stroke="{{ $lastReadQuran->is_completed ? '#10B981' : '#14B8A6' }}"
                                    stroke-width="3" fill="none" stroke-linecap="round"
                                    stroke-dasharray="{{ 2 * pi() * 16 }}"
                                    stroke-dashoffset="{{ 2 * pi() * 16 * (1 - $lastReadQuran->progress_percent / 100) }}"
                                    class="transition-all duration-500"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xs font-bold {{ $lastReadQuran->is_completed ? 'text-emerald-600' : 'text-teal-600' }}">
                                {{ $lastReadQuran->progress_percent }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Baca Hari Ini --}}
        <div class="mt-2 text-xs {{ $readQuranToday ? 'text-emerald-500' : 'text-gray-400' }} font-medium">
            {{ $readQuranToday ? '✓ Sudah baca hari ini' : 'Belum baca hari ini' }}
        </div>

    @else
        {{-- BELUM ADA DATA (COMING SOON) --}}
        
        <span class="absolute top-2 right-2 px-2 py-0.5 bg-gray-200 text-gray-500 rounded-full text-xs font-semibold">
            Segera
        </span>
        
        <div class="py-4">
            <div class="text-3xl font-bold text-gray-300 mb-1">📖</div>
            <div class="text-xs text-gray-400 font-medium">Baca Al-Quran</div>
            <div class="text-xs text-gray-300 mt-1">Coming soon</div>
        </div>
        
    @endif
</div>

@push('styles')
<style>
    circle {
        transition: stroke-dashoffset 0.5s ease;
    }
</style>
@endpush