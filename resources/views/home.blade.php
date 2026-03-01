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

        <!-- Feature Dock -->
        <div class="flex justify-center px-4 mb-8 pt-5">
            <div class="inline-flex items-center gap-1 bg-white
                    rounded-2xl px-5 pt-5 pb-3.5
                    shadow-xl overflow-visible">

                <!-- Al-Quran -->
                <a href="{{ route('quran.index') }}"
                    data-tooltip="Al-Quran"
                    class="group relative flex flex-col items-center gap-1.5
                            px-4 py-2.5 rounded-[22px] hover:bg-teal-50
                            transition-all duration-200
                            hover:-translate-y-[7px] hover:scale-[1.06]">
                    <span class="text-[28px] leading-none
                                group-hover:scale-110 transition-transform">📖</span>
                    <span class="text-[10px] font-bold text-gray-500 group-hover:text-teal-600">Al-Quran</span>
                </a>

                <!-- Shalat (SVG sujud) -->
                <a href="{{ route('prayer-tracking.index') }}"
                    data-tooltip="Tracking Shalat"
                    class="group relative flex flex-col items-center gap-1.5
                            px-4 py-2.5 rounded-[22px] hover:bg-teal-50
                            transition-all duration-200
                            hover:-translate-y-[7px] hover:scale-[1.06]">
                    <svg class="w-8 h-8 group-hover:scale-110 transition-transform"
                        viewBox="60 120 360 220" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#0d9488"
                            d="M397.886,238.967c-1.202-2.712-3.89-4.46-6.856-4.46h-32.162c-3.413-9.876-12.071-31.572-28.48-53.45
                            c-29.019-38.692-68.521-59.229-114.27-59.44c-6.534-1.114-56.24-8.741-81.407,12.237c-9.696,8.083-14.613,19.147-14.613,32.886
                            c0,20.927,28.343,64.929,43.219,86.583H108.78c-2.546,0-7.078-2.654-11.076-4.997c-6.04-3.538-12.887-7.548-20.285-7.548
                            c-18.66,0-19.558,25.105-20.04,38.594c-0.161,4.508-1.549,8.055-3.018,11.81c-1.602,4.096-3.259,8.331-3.259,13.547
                            c0,5.921,3.306,11.342,9.07,14.873c5.603,3.432,13.516,5.172,23.519,5.172c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5
                            c-1.374,0-2.627-0.047-3.813-0.118c3.929-7.999,9.833-13.734,12.735-16.243h12.241l2.743,24.689
                            c0.422,3.798,3.633,6.672,7.454,6.672H221.68c5.604,0,10.723-2.208,14.804-6.385c6.74-6.899,9.872-18.609,11.318-28.744
                            c17.999,21.989,30.988,32.73,31.86,33.441c1.349,1.1,3.025,1.688,4.739,1.688c0.43,0,0.862-0.037,1.292-0.112
                            c2.145-0.375,4.02-1.663,5.139-3.529l0.003-0.005c3.584,2.37,7.781,3.646,12.176,3.646h94.291c3.353,0,6.298-2.225,7.214-5.45
                            C404.979,317.696,415.638,279.012,397.886,238.967z M89.963,278.412c-1.573,0-3.106,0.495-4.383,1.414
                            c-0.55,0.396-12.341,9.011-19.386,23.664c0.261-2.028,1.104-4.204,2.137-6.842c1.687-4.313,3.786-9.679,4.038-16.739
                            c0.839-23.452,4.621-24.129,5.05-24.129c3.329,0,8.31,2.917,12.704,5.491c3.826,2.241,7.739,4.526,11.813,5.866l1.253,11.276
                            H89.963z M225.748,307.911c-1.276,1.305-2.493,1.862-4.068,1.862h-99.915l-4.605-41.45h60.615c2.821,0,5.403-1.583,6.684-4.097
                            s1.041-5.533-0.618-7.814c-18.846-25.913-48.743-73.171-48.743-89.672c0-9.199,3.011-16.184,9.204-21.353
                            c15.769-13.163,49.099-11.799,65.282-9.604c4.089,15.278,3.347,31.245,1.607,43.328c-0.955-1.906-1.57-3.09-1.677-3.296
                            c-1.916-3.672-6.443-5.096-10.118-3.18c-3.672,1.916-5.096,6.445-3.181,10.118c0.114,0.219,10.706,20.611,17.003,38.75
                            c-1.605,1.307-2.58,2.165-2.798,2.359c-2.664,2.373-3.288,6.293-1.492,9.376c8.591,14.745,17.1,27.55,25.087,38.527
                            C234.142,282.665,232.06,301.46,225.748,307.911z M225.151,231.199c10.035-7.741,34.517-24.5,59.581-25.606
                            c4.138-0.183,7.345-3.685,7.162-7.823s-3.66-7.336-7.824-7.162c-22.815,1.007-44.397,12.455-58.242,21.65
                            c-1.315-3.528-2.728-7.052-4.156-10.444c2.322-7.818,9.653-36.164,3.61-64.85c37.192,2.635,68.383,20.324,92.816,52.708
                            c16.167,21.427,24.386,43.181,27.063,51.16c-8.988,10.495-37.414,13.952-56.278,11.821c-3.353-4.65-7.032-9.711-10.982-15.087
                            c-2.453-3.339-7.146-4.056-10.484-1.604c-3.338,2.452-4.057,7.146-1.604,10.484c13.479,18.347,23.812,33.046,28.483,39.756
                            l-11.621,19.368C271.88,295.179,249.006,270.857,225.151,231.199z M307.603,279.064c-1.586-2.285-4.18-6.002-7.593-10.831
                            c0.154,0,0.303,0.004,0.457,0.004c4.077,0,8.416-0.18,12.833-0.591c-0.487,1.101-1.098,2.123-1.802,3.299
                            C310.183,273.139,308.699,275.63,307.603,279.064z M303.011,309.773c-1.631,0-3.177-0.547-4.434-1.548l5.125-8.541h30.065
                            c1.992,1.085,5.938,4.989,10.358,10.089H303.011z M334.579,284.684h-12.981c0.591-2.392,1.577-4.043,2.765-6.026
                            c1.921-3.206,4.229-7.076,4.945-13.612c10.385-2.512,19.97-6.723,26.27-13.384c10.032,25.667,10.404,47.773,9.827,58.111h-1.961
                            C344.594,284.698,337.103,284.684,334.579,284.684z M391.251,309.773h-10.792c0.604-11.732-0.039-34.071-9.658-60.267h15.218
                            C395.734,274.75,393.136,299.207,391.251,309.773z"/>
                    </svg>
                    <span class="text-[10px] font-bold text-gray-500 group-hover:text-teal-600">Shalat</span>
                </a>

                <!-- Kiblat -->
                <a href="{{ route('qibla.index') }}"
                    data-tooltip="Arah Kiblat"
                    class="group relative flex flex-col items-center gap-1.5
                            px-4 py-2.5 rounded-[22px] hover:bg-teal-50
                            transition-all duration-200
                            hover:-translate-y-[7px] hover:scale-[1.06]">
                    <span class="text-[28px] leading-none
                                group-hover:scale-110 transition-transform">🧭</span>
                    <span class="text-[10px] font-bold text-gray-500 group-hover:text-teal-600">Kiblat</span>
                </a>

                <!-- Asmaul Husna -->
                <a href="{{ route('asmaul-husna.index') }}"
                    data-tooltip="Asmaul Husna"
                    class="group relative flex flex-col items-center gap-1.5
                            px-4 py-2.5 rounded-[22px] hover:bg-teal-50
                            transition-all duration-200
                            hover:-translate-y-[7px] hover:scale-[1.06]">
                    <span class="w-8 h-8 flex items-center justify-center
                                text-[20px] font-extrabold text-teal-600
                                tracking-tighter leading-none
                                group-hover:scale-110 transition-transform
                                drop-shadow-md">99</span>
                    <span class="text-[10px] font-bold text-gray-500 group-hover:text-teal-600">Asmaul</span>
                </a>

                <!-- Doa -->
                <a href="{{ route('doa-pendek.index') }}"
                    data-tooltip="Doa-doa Pendek"
                    class="group relative flex flex-col items-center gap-1.5
                            px-4 py-2.5 rounded-[22px] hover:bg-teal-50
                            transition-all duration-200
                            hover:-translate-y-[7px] hover:scale-[1.06]">
                    <span class="text-[28px] leading-none
                                group-hover:scale-110 transition-transform">🌙</span>
                    <span class="text-[10px] font-bold text-gray-500 group-hover:text-teal-600">Doa</span>
                </a>

                <!-- Tasbih -->
                <a href="{{ route('tasbih.index') }}"
                    data-tooltip="Tasbih Digital"
                    class="group relative flex flex-col items-center gap-1.5
                            px-4 py-2.5 rounded-[22px] hover:bg-teal-50
                            transition-all duration-200
                            hover:-translate-y-[7px] hover:scale-[1.06]">
                    <span class="text-[28px] leading-none
                                group-hover:scale-110 transition-transform">📿</span>
                    <span class="text-[10px] font-bold text-gray-500 group-hover:text-teal-600">Tasbih</span>
                </a>

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

    [data-tooltip]::before {
        content: attr(data-tooltip);
        position: absolute; bottom: calc(100% + 10px);
        left: 50%; transform: translateX(-50%) scale(0.85);
        background: rgba(0,0,0,0.65); color: white;
        font-size: 11px; font-weight: 600;
        padding: 5px 10px; border-radius: 8px;
        white-space: nowrap; opacity: 0;
        pointer-events: none; transition: all 0.18s ease;
        backdrop-filter: blur(6px); z-index: 10;
    }
    [data-tooltip]:hover::before {
        opacity: 1; transform: translateX(-50%) scale(1);
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