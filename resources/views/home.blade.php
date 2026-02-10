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
                Selamat datang di Al-Huda - Pendamping Ibadah Anda
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
            <div class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl relative overflow-hidden opacity-75 cursor-not-allowed">
                <span class="absolute top-3 right-3 px-3 py-1 bg-gray-400 text-white rounded-full text-xs font-semibold shadow-md z-20">Segera</span>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Waktu Shalat</h3>
                    <p class="text-sm md:text-base text-gray-600">Jadwal shalat 5 waktu sesuai lokasi Anda</p>
                </div>
            </div>

            <!-- Arah Kiblat -->
            <div class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl relative overflow-hidden opacity-75 cursor-not-allowed">
                <span class="absolute top-3 right-3 px-3 py-1 bg-gray-400 text-white rounded-full text-xs font-semibold shadow-md z-20">Segera</span>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Arah Kiblat</h3>
                    <p class="text-sm md:text-base text-gray-600">Temukan arah kiblat dengan kompas digital</p>
                </div>
            </div>

            <!-- Asmaul Husna -->
            <a href="{{ route('asmaul-husna.index') }}" 
               class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center mb-4 md:mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
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
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Doa-doa Pendek</h3>
                    <p class="text-sm md:text-base text-gray-600">Kumpulan doa harian dan pilihan</p>
                </div>
            </a>

            <!-- Jadwal Puasa -->
            <div class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl relative overflow-hidden opacity-75 cursor-not-allowed">
                <span class="absolute top-3 right-3 px-3 py-1 bg-gray-400 text-white rounded-full text-xs font-semibold shadow-md z-20">Segera</span>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Jadwal Puasa</h3>
                    <p class="text-sm md:text-base text-gray-600">Waktu imsak, sahur, dan berbuka puasa</p>
                </div>
            </div>
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
                           class="text-xs font-semibold text-teal-600 hover:text-teal-700 hover:underline transition-colors flex items-center gap-1">
                            Lihat semua
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    {{-- Loading state --}}
                    <template x-if="loading">
                        <div class="flex items-center justify-center py-6">
                            <div class="w-6 h-6 border-2 border-teal-400 border-t-transparent rounded-full animate-spin"></div>
                        </div>
                    </template>

                    {{-- Konten --}}
                    <template x-if="!loading">
                        <div>
                            {{-- Progress bar --}}
                            <div class="mb-4">
                                <div class="flex items-end justify-between mb-1.5">
                                    <span class="text-2xl font-bold text-teal-600"
                                          x-text="data.performed + '/5'"></span>
                                    <span class="text-sm text-gray-500">
                                        <span class="font-semibold text-amber-500">🔥 <span x-text="data.streak"></span></span>
                                        hari berturut
                                    </span>
                                </div>
                                <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-teal-400 to-emerald-500 rounded-full transition-all duration-700 ease-out"
                                         :style="'width: ' + data.percent + '%'"></div>
                                </div>
                                <div class="mt-1 text-xs text-gray-400 text-right"
                                     x-text="data.percent + '% selesai'"></div>
                            </div>

                            {{-- Dots 5 waktu --}}
                            <div class="grid grid-cols-5 gap-2">
                                <template x-for="prayer in prayers" :key="prayer">
                                    <div class="flex flex-col items-center gap-1">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg transition-all duration-300"
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
</script>
@endpush