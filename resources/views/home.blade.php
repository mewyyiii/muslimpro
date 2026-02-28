@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-500 py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12 md:mb-16">
            <div class="inline-block mb-6">

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 text-white drop-shadow-lg">
                Assalamu'alaikum
            </h1>
            <p class="text-lg md:text-xl lg:text-2xl text-white/90 font-medium">
                Selamat datang di NurSteps - Pendamping Ibadah Anda
            </p>
        </div>

        <!-- Main Features Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-12">
            <!-- Al-Quran -->
            <a href="{{ route('quran.index') }}" 
               class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center mb-4 md:mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Al-Quran</h3>
                    <p class="text-sm md:text-base text-gray-600">Baca Al-Quran 30 Juz lengkap dengan terjemahan</p>
                </div>
            </a>

            <!-- Waktu Shalat -->
            <a href="{{ route('prayer-tracking.index') }}" 
            class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center mb-4 md:mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Waktu Shalat</h3>
                    <p class="text-sm md:text-base text-gray-600">
                        Jadwal shalat 5 waktu sesuai lokasi Anda
                    </p>
                </div>
            </a>

            <!-- Arah Kiblat -->
            <a href="{{ route('qibla.index') }}" 
               class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center mb-4 md:mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9.5" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M12 4 L12.8 11.2 L12 12 L11.2 11.2 Z" fill="currentColor"/>
                            <path d="M12 20 L11.2 12.8 L12 12 L12.8 12.8 Z" fill="currentColor" opacity="0.5"/>
                            <path d="M20 12 L12.8 11.2 L12 12 L12.8 12.8 Z" fill="currentColor" opacity="0.4"/>
                            <path d="M4 12 L11.2 12.8 L12 12 L11.2 11.2 Z" fill="currentColor" opacity="0.4"/>
                            <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
                            <text x="12" y="3.5" text-anchor="middle" font-size="2.2" font-weight="bold" fill="currentColor">N</text>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Arah Kiblat</h3>
                    <p class="text-sm md:text-base text-gray-600">Temukan arah kiblat dengan kompas digital</p>
                </div>
            </a>

            <!-- Asmaul Husna -->
            <a href="{{ route('asmaul-husna.index') }}" 
               class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center mb-4 md:mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10 md:w-12 md:h-12 text-white" viewBox="0 0 24 24">
                            <text x="3" y="17"
                                font-family="Arial, sans-serif"
                                font-size="14"
                                font-weight="bold"
                                fill="currentColor">
                                99
                            </text>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Asmaul Husna</h3>
                    <p class="text-sm md:text-base text-gray-600">99 Nama Allah yang Maha Agung</p>
                </div>
            </a>

            <!-- Doa-doa -->
            <a href="{{ route('doa-pendek.index') }}" 
               class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center mb-4 md:mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <defs>
                                <mask id="crescent-mask-card">
                                    <rect width="24" height="24" fill="white"/>
                                    <circle cx="14.5" cy="9.5" r="6.8" fill="black"/>
                                </mask>
                            </defs>

                            <!-- Bulan -->
                            <circle cx="10" cy="13.5" r="7.5" mask="url(#crescent-mask-card)"/>

                            <!-- Bintang -->
                            <polygon points="19,1.5 20.4,5.7 24.8,5.7 21.3,8.3 22.7,12.5 19,9.8 15.3,12.5 16.7,8.3 13.2,5.7 17.6,5.7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Doa-doa Pendek</h3>
                    <p class="text-sm md:text-base text-gray-600">Kumpulan doa harian dan pilihan</p>
                </div>
            </a>

            <!-- ★ Tasbih Digital -->
            <a href="{{ route('tasbih.index') }}" 
               class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center mb-4 md:mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="3" cy="12" r="2"/>
                            <circle cx="5.5" cy="8" r="2"/>
                            <circle cx="9" cy="5.5" r="2"/>
                            <circle cx="12" cy="3" r="2"/>
                            <circle cx="15" cy="5.5" r="2"/>
                            <circle cx="18.5" cy="8" r="2"/>
                            <circle cx="21" cy="12" r="2"/>
                            <circle cx="18.5" cy="16" r="2"/>
                            <circle cx="15" cy="18.5" r="2"/>
                            <circle cx="12" cy="21" r="2"/>
                            <circle cx="9" cy="18.5" r="2"/>
                            <circle cx="5.5" cy="16" r="2"/>
                            <rect x="11" y="21" width="2" height="3" rx="0.5"/>
                            <circle cx="12" cy="24.5" r="1"/>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Tasbih Digital</h3>
                    <p class="text-sm md:text-base text-gray-600">Hitung dzikir dengan mudah dan praktis</p>
                </div>
            </a>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             WIDGET TRACKING SHALAT
        ══════════════════════════════════════════════════════════════ --}}
        <div class="mb-8 md:mb-12"
             x-data="prayerWidget()"
             x-init="load()">

            <div class="bg-white rounded-2xl shadow-xl p-5 md:p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-teal-50 rounded-full -mr-20 -mt-20 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-emerald-50 rounded-full -ml-12 -mb-12 pointer-events-none"></div>

                <div class="relative z-10">
                    {{-- Header widget --}}
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base md:text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-teal-100 flex items-center justify-center text-sm">🕌</span>
                            Shalat Hari Ini
                        </h3>
                        <a href="{{ route('prayer-tracking.index') }}"
                           class="text-xs md:text-sm text-teal-600 hover:text-teal-700 font-medium hover:underline">
                            Lihat detail →
                        </a>
                    </div>

                    {{-- Loading state --}}
                    <template x-if="loading">
                        <div class="text-center py-8">
                            <div class="inline-block w-8 h-8 border-4 border-teal-200 border-t-teal-500 rounded-full animate-spin"></div>
                            <p class="text-sm text-gray-500 mt-2">Memuat data...</p>
                        </div>
                    </template>

                    {{-- Loaded state --}}
                    <template x-if="!loading">
                        <div>
                            {{-- Progress bar --}}
                            <div class="mb-4">
                                <div class="flex items-center justify-between text-xs md:text-sm mb-1.5">
                                    <span class="font-medium text-gray-700">Progress Hari Ini</span>
                                    <span class="font-bold text-teal-600">
                                        <span x-text="data.performed"></span>/<span x-text="data.total"></span>
                                    </span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-teal-400 to-emerald-500 rounded-full transition-all duration-500 ease-out"
                                         :style="`width: ${data.percent}%`"></div>
                                </div>
                            </div>

                            {{-- 5 shalat grid --}}
                            <div class="grid grid-cols-5 gap-2 md:gap-3 mb-4">
                                <template x-for="prayer in prayers" :key="prayer">
                                    <div class="flex flex-col items-center gap-1.5 p-2 md:p-2.5 rounded-xl smooth-transition"
                                         :class="getStatus(prayer) === 'performed' ? 'bg-teal-50' : 'bg-gray-50'">
                                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center text-sm md:text-base smooth-transition"
                                             :class="getPrayerDotClass(prayer)">
                                            <span x-text="prayerIcons[prayer]"></span>
                                        </div>
                                        <span class="text-xs font-medium text-center leading-tight"
                                              :class="getPrayerTextClass(prayer)"
                                              x-text="prayerNames[prayer]"></span>
                                        <span class="text-xs px-1.5 py-0.5 rounded-full font-semibold"
                                              :class="getStatusBadgeClass(prayer)"
                                              x-text="getStatusLabel(prayer)">
                                        </span>
                                    </div>
                                </template>
                            </div>

                            {{-- CTA belum mulai --}}
                            <template x-if="data.performed === 0">
                                <div class="mt-4 text-center">
                                    <a href="{{ route('prayer-tracking.index') }}"
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-teal-400 to-emerald-500 text-white text-sm font-semibold rounded-xl shadow hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
                                        Mulai catat shalat hari ini →
                                    </a>
                                </div>
                            </template>

                            {{-- Pesan motivasi sebagian --}}
                            <template x-if="data.performed > 0 && data.performed < 5">
                                <div class="mt-3 p-3 bg-amber-50 border border-amber-100 rounded-xl text-center">
                                    <p class="text-xs text-amber-700 font-medium"
                                       x-text="(5 - data.performed) + ' shalat lagi untuk hari yang sempurna! 💪'"></p>
                                </div>
                            </template>

                            {{-- Pesan lengkap --}}
                            <template x-if="data.performed === 5">
                                <div class="mt-3 p-3 bg-teal-50 border border-teal-100 rounded-xl text-center">
                                    <p class="text-xs text-teal-700 font-medium">✨ MasyaAllah! Shalat hari ini lengkap!</p>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             WIDGET TRACKING MENGAJI — ★ DIPINDAH KE SINI (SEBELUM QUOTE)
        ══════════════════════════════════════════════════════════════ --}}
        <div class="mb-8 md:mb-12"
             x-data="quranWidget()"
             x-init="load()">

            <div class="bg-white rounded-2xl shadow-xl p-5 md:p-6 relative overflow-hidden">

                {{-- Dekorasi background --}}
                <div class="absolute top-0 right-0 w-40 h-40 bg-emerald-50 rounded-full -mr-20 -mt-20 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-teal-50 rounded-full -ml-12 -mb-12 pointer-events-none"></div>

                <div class="relative z-10">
                    {{-- Header widget --}}
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base md:text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center text-sm">📖</span>
                            Membaca Al-Quran
                        </h3>
                        <a href="{{ route('quran-tracking.index') }}"
                           class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 hover:underline transition-colors flex items-center gap-1">
                            Lihat detail
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    {{-- Loading state --}}
                    <template x-if="loading">
                        <div class="flex items-center justify-center py-6">
                            <div class="w-6 h-6 border-2 border-emerald-400 border-t-transparent rounded-full animate-spin"></div>
                        </div>
                    </template>

                    {{-- Konten --}}
                    <template x-if="!loading">
                        <div>
                            {{-- Progress bar --}}
                            <div class="mb-4">
                                <div class="flex items-end justify-between mb-1.5">
                                    <span class="text-2xl font-bold text-emerald-600"
                                          x-text="data.total_completed + '/114'"></span>
                                    <span class="text-sm text-gray-500">
                                        <span class="font-semibold text-amber-500">🔥 <span x-text="data.streak"></span></span>
                                        hari berturut
                                    </span>
                                </div>
                                <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full transition-all duration-700 ease-out"
                                         :style="'width: ' + data.percent + '%'"></div>
                                </div>
                                <div class="mt-1 text-xs text-gray-400 text-right"
                                     x-text="data.percent + '% surah selesai'"></div>
                            </div>

                            {{-- Last read info --}}
                            <template x-if="data.last_read">
                                <div class="p-3 bg-emerald-50 border border-emerald-100 rounded-xl">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-xs text-emerald-600 font-semibold mb-0.5">Terakhir dibaca:</p>
                                            <p class="text-sm font-bold text-emerald-800"
                                               x-text="data.last_read.surah_number + '. ' + data.last_read.surah_name"></p>
                                            <p class="text-xs text-emerald-600 mt-0.5">
                                                Sampai ayat <span x-text="data.last_read.last_verse"></span>
                                                (<span x-text="data.last_read.progress"></span>%)
                                            </p>
                                        </div>
                                        <a :href="'/surah/' + data.last_read.surah_number"
                                           class="px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold rounded-lg transition-colors">
                                            Lanjut
                                        </a>
                                    </div>
                                </div>
                            </template>

                            {{-- Belum mulai --}}
                            <template x-if="!data.last_read">
                                <div class="text-center">
                                    <a href="{{ route('quran.index') }}"
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-emerald-400 to-teal-500 text-white text-sm font-semibold rounded-xl shadow hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
                                        Mulai membaca Al-Quran →
                                    </a>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Quote Section -->
        <div class="mt-8 md:mt-12 p-6 md:p-10 rounded-2xl text-center bg-white shadow-2xl">
            <p class="text-2xl md:text-3xl lg:text-4xl font-arabic font-bold mb-4 md:mb-6 text-teal-600">
                بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
            </p>
            <p class="text-base md:text-lg lg:text-xl text-gray-700 font-medium">
                "Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang"
            </p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    .font-arabic { font-family: 'Amiri', serif; }
    .feature-card { cursor: pointer; }
    @media (max-width: 640px) {
        .feature-card:not(.opacity-75):active { transform: translateY(-4px); }
    }
</style>
@endpush

@push('scripts')
<script>
function prayerWidget() {
    return {
        loading: true,
        data: { performed: 0, total: 5, percent: 0, streak: 0, today_data: {} },
        prayers: ['fajr','dhuhr','asr','maghrib','isha'],
        prayerNames: { fajr:'Subuh', dhuhr:'Dzuhur', asr:'Ashar', maghrib:'Maghrib', isha:'Isya' },
        prayerIcons: { fajr:'🌅', dhuhr:'☀️', asr:'🌤️', maghrib:'🌇', isha:'🌙' },

        async load() {
            try {
                const res = await fetch('{{ route("prayer-tracking.summary") }}', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                this.data = await res.json();
            } catch (e) { console.error(e); }
            this.loading = false;
        },

        getStatus(prayer) {
            return this.data.today_data?.[prayer]?.status || null;
        },

        getPrayerDotClass(prayer) {
            const s = this.getStatus(prayer);
            if (s === 'performed') return 'bg-gradient-to-br from-teal-400 to-emerald-500 shadow-md';
            if (s === 'qada')      return 'bg-amber-100';
            if (s === 'missed')    return 'bg-red-100';
            return 'bg-gray-100';
        },

        getPrayerTextClass(prayer) {
            const s = this.getStatus(prayer);
            if (s === 'performed') return 'text-teal-700';
            if (s === 'qada')      return 'text-amber-600';
            if (s === 'missed')    return 'text-red-400';
            return 'text-gray-400';
        },

        getStatusBadgeClass(prayer) {
            const s = this.getStatus(prayer);
            if (s === 'performed') return 'bg-teal-100 text-teal-700';
            if (s === 'qada')      return 'bg-amber-100 text-amber-600';
            if (s === 'missed')    return 'bg-red-100 text-red-400';
            return 'bg-gray-100 text-gray-300';
        },

        getStatusLabel(prayer) {
            const s = this.getStatus(prayer);
            if (s === 'performed') return '✓';
            if (s === 'qada')      return 'Q';
            if (s === 'missed')    return '✗';
            return '–';
        },
    };
}

function quranWidget() {
    return {
        loading: true,
        data: { total_completed: 0, total_surah: 114, percent: 0, streak: 0, last_read: null },

        async load() {
            try {
                const res = await fetch('{{ route("quran-tracking.summary") }}', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                this.data = await res.json();
            } catch (e) {
                console.error(e);
            }
            this.loading = false;
        }
    };
}
</script>
@endpush