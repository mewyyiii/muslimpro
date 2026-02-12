@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-400 via-teal-500 to-teal-600 py-8 md:py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ══════════════════════════════════════════════════════════════
             HEADER
        ══════════════════════════════════════════════════════════════ --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg mb-2">
                📖 Tracking Mengaji
            </h1>
            <p class="text-white/80 text-base md:text-lg">Pantau progres bacaan Al-Quran kamu</p>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             STATISTIK RINGKASAN
        ══════════════════════════════════════════════════════════════ --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-6">
            {{-- Surah selesai --}}
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-1">
                    {{ $totalSurahCompleted }}<span class="text-lg text-gray-400">/114</span>
                </div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">Surah Selesai</div>
                <div class="mt-2 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full transition-all duration-500"
                         style="width: {{ $percentCompleted }}%"></div>
                </div>
            </div>

            {{-- Streak --}}
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-amber-500 mb-1">
                    {{ $streak }}<span class="text-lg text-gray-400"> 🔥</span>
                </div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">Hari Berturut</div>
                <div class="mt-2 text-xs {{ $readToday ? 'text-emerald-400' : 'text-gray-400' }} font-medium">
                    {{ $readToday ? '✓ Sudah baca hari ini' : 'Belum baca hari ini' }}
                </div>
            </div>

            {{-- Total ayat --}}
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-teal-600 mb-1">
                    {{ number_format($totalVersesRead) }}
                </div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">Ayat Dibaca</div>
            </div>

            {{-- Durasi --}}
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-indigo-600 mb-1">
                    {{ $totalHours }}j
                </div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">
                    {{ $totalMinutes }} menit
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             DAFTAR TRACKING SURAH
        ══════════════════════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-8 mb-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">📚</span>
                    Surah yang Sedang/Sudah Dibaca
                </h2>
                <a href="{{ route('quran.index') }}"
                   class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 hover:underline transition-colors">
                    + Baca Surah Baru
                </a>
            </div>

            @if($trackings->isEmpty())
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700 mb-2">Belum Ada Progress</h3>
                    <p class="text-sm text-gray-500 mb-4">Mulai baca Al-Quran untuk melacak progressmu</p>
                    <a href="{{ route('quran.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-400 to-teal-500 text-white font-semibold rounded-xl shadow hover:shadow-md transition-all hover:-translate-y-0.5">
                        Mulai Sekarang
                    </a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($trackings as $track)
                    <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all duration-200
                                {{ $track->is_completed ? 'bg-emerald-50 border-emerald-200' : 'bg-white' }}">
                        <div class="flex items-center justify-between gap-4">
                            {{-- Info surah --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="font-bold text-gray-800 truncate">
                                        {{ $track->surah_number }}. {{ $track->surah->name }}
                                    </h3>
                                    @if($track->is_completed)
                                        <span class="px-2 py-0.5 bg-emerald-500 text-white text-xs font-semibold rounded-full">
                                            ✓ Selesai
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500">
                                    Ayat {{ $track->last_verse }} / {{ $track->surah->total_verses }}
                                    • {{ $track->progress_percent }}% selesai
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    Terakhir: {{ $track->last_read_date->locale('id')->isoFormat('D MMM YYYY') }}
                                    @if($track->duration_seconds > 0)
                                        • {{ $track->formatted_duration }}
                                    @endif
                                </p>
                            </div>

                            {{-- Progress ring --}}
                            <div class="flex-shrink-0">
                                <div class="relative w-16 h-16">
                                    <svg class="transform -rotate-90 w-16 h-16" viewBox="0 0 64 64">
                                        <circle cx="32" cy="32" r="28" stroke="#E5E7EB" stroke-width="6" fill="none"/>
                                        <circle cx="32" cy="32" r="28"
                                                stroke="{{ $track->is_completed ? '#10B981' : '#14B8A6' }}"
                                                stroke-width="6" fill="none" stroke-linecap="round"
                                                stroke-dasharray="{{ 2 * pi() * 28 }}"
                                                stroke-dashoffset="{{ 2 * pi() * 28 * (1 - $track->progress_percent / 100) }}"
                                                class="transition-all duration-500"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-sm font-bold {{ $track->is_completed ? 'text-emerald-600' : 'text-teal-600' }}">
                                            {{ $track->progress_percent }}%
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Action buttons --}}
                            <div class="flex flex-col gap-2">
                                <a href="{{ route('quran.show', $track->surah_number) }}"
                                   class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-lg transition-colors text-center">
                                    {{ $track->is_completed ? 'Baca Lagi' : 'Lanjutkan' }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             TIPS
        ══════════════════════════════════════════════════════════════ --}}
        <div class="bg-emerald-50 border-2 border-emerald-100 rounded-2xl p-5">
            <div class="flex items-start gap-3">
                <div class="text-2xl">💡</div>
                <div>
                    <h4 class="font-bold text-emerald-800 mb-1">Tips Tracking:</h4>
                    <ul class="text-sm text-emerald-700 space-y-1">
                        <li>• Progress otomatis tersimpan saat kamu membaca surah</li>
                        <li>• Durasi membaca dihitung otomatis dengan timer</li>
                        <li>• Baca setiap hari untuk menjaga streak!</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
    /* Animasi progress ring */
    circle {
        transition: stroke-dashoffset 0.5s ease;
    }
</style>
@endpush