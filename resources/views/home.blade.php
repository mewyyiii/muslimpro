@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-teal-700 via-teal-600 to-emerald-500">

    {{-- ═══════════════════════════════════════
         HEADER
    ═══════════════════════════════════════ --}}
    <div class="px-4 pt-10 pb-5 md:px-6">
        <div class="max-w-2xl mx-auto flex items-center justify-between">
            <div>
                <p class="text-teal-200 text-xs font-medium mb-0.5">Bismillah,</p>
                <h1 class="text-xl md:text-2xl font-bold text-white leading-tight">Assalamu'alaikum 👋</h1>
                <p class="text-teal-200 text-xs mt-0.5">NurSteps — Pendamping Ibadah Anda</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                <span class="text-xl">🕌</span>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         MAIN CONTENT
    ═══════════════════════════════════════ --}}
    <div class="px-4 md:px-6 pb-10">
        <div class="max-w-2xl mx-auto space-y-3">

            {{-- ─────────────────────────────────────
                 FITUR GRID — ala Muslim Pro
            ───────────────────────────────────── --}}
            <div class="bg-white rounded-2xl shadow-md p-4">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-3">Fitur</p>
                <div class="grid grid-cols-6 gap-1">

                    {{-- Al-Quran --}}
                    <a href="{{ route('quran.index') }}"
                       class="flex flex-col items-center gap-1.5 p-1.5 rounded-xl
                              hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-11 h-11 rounded-2xl shadow
                                    bg-gradient-to-br from-emerald-400 to-teal-600
                                    flex items-center justify-center">
                            <span class="text-xl">📖</span>
                        </div>
                        <span class="text-[9.5px] font-semibold text-gray-500 text-center leading-tight">Al-Quran</span>
                    </a>

                    {{-- Shalat --}}
                    <a href="{{ route('prayer-tracking.index') }}"
                       class="flex flex-col items-center gap-1.5 p-1.5 rounded-xl
                              hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-11 h-11 rounded-2xl shadow
                                    bg-gradient-to-br from-teal-400 to-cyan-600
                                    flex items-center justify-center">
                            <svg class="w-6 h-6" viewBox="60 120 360 220" xmlns="http://www.w3.org/2000/svg">
                                <path fill="white" d="M397.886,238.967c-1.202-2.712-3.89-4.46-6.856-4.46h-32.162c-3.413-9.876-12.071-31.572-28.48-53.45
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
                        </div>
                        <span class="text-[9.5px] font-semibold text-gray-500 text-center leading-tight">Shalat</span>
                    </a>

                    {{-- Kiblat --}}
                    <a href="{{ route('qibla.index') }}"
                       class="flex flex-col items-center gap-1.5 p-1.5 rounded-xl
                              hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-11 h-11 rounded-2xl shadow
                                    bg-gradient-to-br from-amber-400 to-orange-500
                                    flex items-center justify-center">
                            <span class="text-xl">🧭</span>
                        </div>
                        <span class="text-[9.5px] font-semibold text-gray-500 text-center leading-tight">Kiblat</span>
                    </a>

                    {{-- Asmaul Husna --}}
                    <a href="{{ route('asmaul-husna.index') }}"
                       class="flex flex-col items-center gap-1.5 p-1.5 rounded-xl
                              hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-11 h-11 rounded-2xl shadow
                                    bg-gradient-to-br from-violet-400 to-purple-600
                                    flex items-center justify-center">
                            <span class="text-white font-extrabold text-sm tracking-tighter">99</span>
                        </div>
                        <span class="text-[9.5px] font-semibold text-gray-500 text-center leading-tight">Asmaul</span>
                    </a>

                    {{-- Doa --}}
                    <a href="{{ route('doa-pendek.index') }}"
                       class="flex flex-col items-center gap-1.5 p-1.5 rounded-xl
                              hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-11 h-11 rounded-2xl shadow
                                    bg-gradient-to-br from-sky-400 to-blue-600
                                    flex items-center justify-center">
                            <span class="text-xl">🌙</span>
                        </div>
                        <span class="text-[9.5px] font-semibold text-gray-500 text-center leading-tight">Doa</span>
                    </a>

                    {{-- Tasbih --}}
                    <a href="{{ route('tasbih.index') }}"
                       class="flex flex-col items-center gap-1.5 p-1.5 rounded-xl
                              hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-11 h-11 rounded-2xl shadow
                                    bg-gradient-to-br from-rose-400 to-pink-600
                                    flex items-center justify-center">
                            <span class="text-xl">📿</span>
                        </div>
                        <span class="text-[9.5px] font-semibold text-gray-500 text-center leading-tight">Tasbih</span>
                    </a>

                </div>
            </div>

            {{-- ─────────────────────────────────────
                 WIDGET TRACKING SHALAT
            ───────────────────────────────────── --}}
            <div x-data="prayerWidget()" x-init="load()">
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                    {{-- Header --}}
                    <div class="bg-gradient-to-r from-teal-600 to-emerald-500 px-4 py-3
                                flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">🕌</span>
                            <span class="text-white font-bold text-sm">Shalat Hari Ini</span>
                        </div>
                        <a href="{{ route('prayer-tracking.index') }}"
                           class="flex items-center gap-1 text-white/75 hover:text-white text-xs font-semibold transition-colors">
                            Lihat semua
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="p-4">
                        {{-- Loading --}}
                        <template x-if="loading">
                            <div class="flex items-center justify-center py-8">
                                <div class="w-6 h-6 border-2 border-teal-400 border-t-transparent rounded-full animate-spin"></div>
                            </div>
                        </template>

                        <template x-if="!loading">
                            <div>
                                {{-- Stats mini --}}
                                <div class="grid grid-cols-3 gap-2 mb-3">
                                    <div class="bg-teal-50 rounded-xl px-2 py-2.5 text-center">
                                        <p class="text-base font-extrabold text-teal-600 leading-none">
                                            <span x-text="data.performed"></span><span class="text-xs font-semibold text-teal-400">/<span x-text="data.total"></span></span>
                                        </p>
                                        <p class="text-[9px] text-gray-400 font-semibold mt-1">Hari Ini</p>
                                    </div>
                                    <div class="bg-amber-50 rounded-xl px-2 py-2.5 text-center">
                                        <p class="text-base font-extrabold text-amber-500 leading-none">
                                            <span x-text="data.streak"></span> <span class="text-sm">🔥</span>
                                        </p>
                                        <p class="text-[9px] text-gray-400 font-semibold mt-1">Berturut</p>
                                    </div>
                                    <div class="bg-emerald-50 rounded-xl px-2 py-2.5 text-center">
                                        <p class="text-base font-extrabold text-emerald-600 leading-none" x-text="data.percent + '%'"></p>
                                        <p class="text-[9px] text-gray-400 font-semibold mt-1">Progress</p>
                                    </div>
                                </div>

                                {{-- Progress bar --}}
                                <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden mb-3">
                                    <div class="h-full bg-gradient-to-r from-teal-400 to-emerald-500 rounded-full transition-all duration-500"
                                         :style="`width: ${data.percent}%`"></div>
                                </div>

                                {{-- 5 waktu --}}
                                <div class="grid grid-cols-5 gap-1.5">
                                    <template x-for="prayer in prayers" :key="prayer">
                                        <div class="flex flex-col items-center gap-1 py-2 px-1 rounded-xl transition-colors"
                                             :class="getStatus(prayer) === 'performed' ? 'bg-teal-50' : 'bg-gray-50'">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm transition-all"
                                                 :class="getPrayerDotClass(prayer)">
                                                <span x-text="prayerIcons[prayer]"></span>
                                            </div>
                                            <span class="text-[8.5px] font-semibold text-center leading-tight"
                                                  :class="getPrayerTextClass(prayer)"
                                                  x-text="prayerNames[prayer]"></span>
                                            <span class="text-[8px] px-1 py-0.5 rounded-full font-bold"
                                                  :class="getStatusBadgeClass(prayer)"
                                                  x-text="getStatusLabel(prayer)"></span>
                                        </div>
                                    </template>
                                </div>

                                {{-- CTA / motivasi --}}
                                <template x-if="data.performed === 0">
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('prayer-tracking.index') }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2
                                                  bg-gradient-to-r from-teal-500 to-emerald-400
                                                  text-white text-xs font-bold rounded-xl shadow
                                                  hover:shadow-md transition-all hover:-translate-y-0.5">
                                            Mulai catat shalat hari ini →
                                        </a>
                                    </div>
                                </template>
                                <template x-if="data.performed > 0 && data.performed < 5">
                                    <div class="mt-3 p-2.5 bg-amber-50 border border-amber-100 rounded-xl text-center">
                                        <p class="text-[11px] text-amber-700 font-semibold"
                                           x-text="(5 - data.performed) + ' shalat lagi untuk hari yang sempurna! 💪'"></p>
                                    </div>
                                </template>
                                <template x-if="data.performed === 5">
                                    <div class="mt-3 p-2.5 bg-teal-50 border border-teal-100 rounded-xl text-center">
                                        <p class="text-[11px] text-teal-700 font-semibold">✨ MasyaAllah! Shalat hari ini lengkap!</p>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- ─────────────────────────────────────
                 WIDGET TRACKING MENGAJI
            ───────────────────────────────────── --}}
            <div x-data="quranWidget()" x-init="load()">
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                    {{-- Header --}}
                    <div class="bg-gradient-to-r from-emerald-600 to-teal-500 px-4 py-3
                                flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">📖</span>
                            <span class="text-white font-bold text-sm">Membaca Al-Quran</span>
                        </div>
                        <a href="{{ route('quran-tracking.index') }}"
                           class="flex items-center gap-1 text-white/75 hover:text-white text-xs font-semibold transition-colors">
                            Lihat semua
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="p-4">
                        {{-- Loading --}}
                        <template x-if="loading">
                            <div class="flex items-center justify-center py-8">
                                <div class="w-6 h-6 border-2 border-emerald-400 border-t-transparent rounded-full animate-spin"></div>
                            </div>
                        </template>

                        <template x-if="!loading">
                            <div>
                                {{-- Progress surah + streak --}}
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="text-xl font-extrabold text-emerald-600"
                                              x-text="data.total_completed + '/114'"></span>
                                        <span class="text-xs text-gray-400 ml-1">surah</span>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-amber-500">🔥 <span x-text="data.streak"></span> hari</p>
                                        <p class="text-[9px] text-gray-400">berturut-turut</p>
                                    </div>
                                </div>

                                <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden mb-1">
                                    <div class="h-full bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full transition-all duration-700"
                                         :style="'width: ' + data.percent + '%'"></div>
                                </div>
                                <p class="text-[9px] text-gray-400 text-right mb-3"
                                   x-text="data.percent + '% surah selesai'"></p>

                                {{-- Last read --}}
                                <template x-if="data.last_read">
                                    <div class="flex items-center justify-between p-3
                                                bg-emerald-50 border border-emerald-100 rounded-xl">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-[9px] text-emerald-600 font-bold uppercase tracking-wide">Terakhir dibaca</p>
                                            <p class="text-sm font-bold text-emerald-900 truncate mt-0.5"
                                               x-text="data.last_read.surah_number + '. ' + data.last_read.surah_name"></p>
                                            <p class="text-[10px] text-emerald-600 mt-0.5">
                                                Ayat <span x-text="data.last_read.last_verse"></span>
                                                · <span x-text="data.last_read.progress"></span>%
                                            </p>
                                        </div>
                                        <a :href="'/surah/' + data.last_read.surah_number"
                                           class="ml-3 px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600
                                                  text-white text-xs font-bold rounded-lg transition-colors whitespace-nowrap">
                                            Lanjut →
                                        </a>
                                    </div>
                                </template>

                                <template x-if="!data.last_read">
                                    <div class="text-center py-2">
                                        <a href="{{ route('quran.index') }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2
                                                  bg-gradient-to-r from-emerald-400 to-teal-500
                                                  text-white text-xs font-bold rounded-xl shadow
                                                  hover:shadow-md transition-all hover:-translate-y-0.5">
                                            Mulai membaca Al-Quran →
                                        </a>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- ─────────────────────────────────────
                 QUOTE BISMILLAH
            ───────────────────────────────────── --}}
            <div class="rounded-2xl p-5 text-center
                        bg-white/15 backdrop-blur-sm border border-white/25">
                <p class="font-arabic text-2xl font-bold text-white mb-2 leading-loose">
                    بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                </p>
                <p class="text-white/75 text-xs font-medium">
                    "Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang"
                </p>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    .font-arabic { font-family: 'Amiri', serif; }
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
            } catch (e) { console.error(e); }
            this.loading = false;
        }
    };
}
</script>
@endpush