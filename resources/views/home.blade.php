@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(175deg, #115e59 0%, #0d9488 45%, #10b981 100%);">

    {{-- HEADER --}}
    <div class="px-4 pt-10 pb-5 md:px-8 lg:px-12">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <div>
                <p class="text-xs font-medium mb-0.5" style="color:#99f6e4">Bismillah,</p>
                <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-white leading-tight">Assalamu'alaikum 👋</h1>
                <p class="text-xs mt-0.5" style="color:#99f6e4">NurSteps — Pendamping Ibadah Anda</p>
            </div>
            <div class="w-10 h-10 rounded-full flex items-center justify-center text-xl flex-shrink-0"
                 style="background:rgba(255,255,255,0.18);border:1.5px solid rgba(255,255,255,0.3)">🕌</div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="px-4 md:px-8 lg:px-12 pb-10">
        <div class="max-w-6xl mx-auto">

            {{-- LAYOUT: 1 kolom mobile, 2 kolom desktop --}}
            <div class="flex flex-col lg:flex-row gap-4 items-start">

                {{-- ═══ KOLOM KIRI ═══ --}}
                <div class="w-full lg:w-72 xl:w-80 flex-shrink-0 flex flex-col gap-4">

                    {{-- FITUR GRID --}}
                    <div class="bg-white rounded-2xl shadow-md p-4">
                        <p class="text-xs font-bold uppercase tracking-wide mb-3" style="color:#94a3b8">Fitur</p>
                        <div class="grid grid-cols-6 lg:grid-cols-3 gap-2">

                            <a href="{{ route('quran.index') }}" class="flex flex-col items-center gap-1.5 p-2 rounded-xl transition-all duration-150 active:scale-95 no-underline fitur-item">
                                <div class="w-11 h-11 rounded-2xl flex items-center justify-center text-xl" style="background:linear-gradient(135deg,#34d399,#0d9488);box-shadow:0 2px 8px rgba(0,0,0,0.18)">📖</div>
                                <span class="text-center leading-tight font-semibold" style="font-size:9.5px;color:#64748b">Al-Quran</span>
                            </a>

                            <a href="{{ route('prayer-tracking.index') }}" class="flex flex-col items-center gap-1.5 p-2 rounded-xl transition-all duration-150 active:scale-95 no-underline fitur-item">
                                <div class="w-11 h-11 rounded-2xl flex items-center justify-center" style="background:linear-gradient(135deg,#2dd4bf,#0891b2);box-shadow:0 2px 8px rgba(0,0,0,0.18)">
                                    <svg width="24" height="24" viewBox="60 120 360 220" xmlns="http://www.w3.org/2000/svg"><path fill="white" d="M397.886,238.967c-1.202-2.712-3.89-4.46-6.856-4.46h-32.162c-3.413-9.876-12.071-31.572-28.48-53.45c-29.019-38.692-68.521-59.229-114.27-59.44c-6.534-1.114-56.24-8.741-81.407,12.237c-9.696,8.083-14.613,19.147-14.613,32.886c0,20.927,28.343,64.929,43.219,86.583H108.78c-2.546,0-7.078-2.654-11.076-4.997c-6.04-3.538-12.887-7.548-20.285-7.548c-18.66,0-19.558,25.105-20.04,38.594c-0.161,4.508-1.549,8.055-3.018,11.81c-1.602,4.096-3.259,8.331-3.259,13.547c0,5.921,3.306,11.342,9.07,14.873c5.603,3.432,13.516,5.172,23.519,5.172c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5c-1.374,0-2.627-0.047-3.813-0.118c3.929-7.999,9.833-13.734,12.735-16.243h12.241l2.743,24.689c0.422,3.798,3.633,6.672,7.454,6.672H221.68c5.604,0,10.723-2.208,14.804-6.385c6.74-6.899,9.872-18.609,11.318-28.744c17.999,21.989,30.988,32.73,31.86,33.441c1.349,1.1,3.025,1.688,4.739,1.688c0.43,0,0.862-0.037,1.292-0.112c2.145-0.375,4.02-1.663,5.139-3.529l0.003-0.005c3.584,2.37,7.781,3.646,12.176,3.646h94.291c3.353,0,6.298-2.225,7.214-5.45C404.979,317.696,415.638,279.012,397.886,238.967z M89.963,278.412c-1.573,0-3.106,0.495-4.383,1.414c-0.55,0.396-12.341,9.011-19.386,23.664c0.261-2.028,1.104-4.204,2.137-6.842c1.687-4.313,3.786-9.679,4.038-16.739c0.839-23.452,4.621-24.129,5.05-24.129c3.329,0,8.31,2.917,12.704,5.491c3.826,2.241,7.739,4.526,11.813,5.866l1.253,11.276H89.963z M225.748,307.911c-1.276,1.305-2.493,1.862-4.068,1.862h-99.915l-4.605-41.45h60.615c2.821,0,5.403-1.583,6.684-4.097s1.041-5.533-0.618-7.814c-18.846-25.913-48.743-73.171-48.743-89.672c0-9.199,3.011-16.184,9.204-21.353c15.769-13.163,49.099-11.799,65.282-9.604c4.089,15.278,3.347,31.245,1.607,43.328c-0.955-1.906-1.57-3.09-1.677-3.296c-1.916-3.672-6.443-5.096-10.118-3.18c-3.672,1.916-5.096,6.445-3.181,10.118c0.114,0.219,10.706,20.611,17.003,38.75c-1.605,1.307-2.58,2.165-2.798,2.359c-2.664,2.373-3.288,6.293-1.492,9.376c8.591,14.745,17.1,27.55,25.087,38.527C234.142,282.665,232.06,301.46,225.748,307.911z M225.151,231.199c10.035-7.741,34.517-24.5,59.581-25.606c4.138-0.183,7.345-3.685,7.162-7.823s-3.66-7.336-7.824-7.162c-22.815,1.007-44.397,12.455-58.242,21.65c-1.315-3.528-2.728-7.052-4.156-10.444c2.322-7.818,9.653-36.164,3.61-64.85c37.192,2.635,68.383,20.324,92.816,52.708c16.167,21.427,24.386,43.181,27.063,51.16c-8.988,10.495-37.414,13.952-56.278,11.821c-3.353-4.65-7.032-9.711-10.982-15.087c-2.453-3.339-7.146-4.056-10.484-1.604c-3.338,2.452-4.057,7.146-1.604,10.484c13.479,18.347,23.812,33.046,28.483,39.756l-11.621,19.368C271.88,295.179,249.006,270.857,225.151,231.199z M307.603,279.064c-1.586-2.285-4.18-6.002-7.593-10.831c0.154,0,0.303,0.004,0.457,0.004c4.077,0,8.416-0.18,12.833-0.591c-0.487,1.101-1.098,2.123-1.802,3.299C310.183,273.139,308.699,275.63,307.603,279.064z M303.011,309.773c-1.631,0-3.177-0.547-4.434-1.548l5.125-8.541h30.065c1.992,1.085,5.938,4.989,10.358,10.089H303.011z M334.579,284.684h-12.981c0.591-2.392,1.577-4.043,2.765-6.026c1.921-3.206,4.229-7.076,4.945-13.612c10.385-2.512,19.97-6.723,26.27-13.384c10.032,25.667,10.404,47.773,9.827,58.111h-1.961C344.594,284.698,337.103,284.684,334.579,284.684z M391.251,309.773h-10.792c0.604-11.732-0.039-34.071-9.658-60.267h15.218C395.734,274.75,393.136,299.207,391.251,309.773z"/></svg>
                                </div>
                                <span class="text-center leading-tight font-semibold" style="font-size:9.5px;color:#64748b">Shalat</span>
                            </a>

                            <a href="{{ route('qibla.index') }}" class="flex flex-col items-center gap-1.5 p-2 rounded-xl transition-all duration-150 active:scale-95 no-underline fitur-item">
                                <div class="w-11 h-11 rounded-2xl flex items-center justify-center text-xl" style="background:linear-gradient(135deg,#fbbf24,#ea580c);box-shadow:0 2px 8px rgba(0,0,0,0.18)">🧭</div>
                                <span class="text-center leading-tight font-semibold" style="font-size:9.5px;color:#64748b">Kiblat</span>
                            </a>

                            <a href="{{ route('asmaul-husna.index') }}" class="flex flex-col items-center gap-1.5 p-2 rounded-xl transition-all duration-150 active:scale-95 no-underline fitur-item">
                                <div class="w-11 h-11 rounded-2xl flex items-center justify-center" style="background:linear-gradient(135deg,#a78bfa,#6d28d9);box-shadow:0 2px 8px rgba(0,0,0,0.18)">
                                    <span style="color:white;font-weight:800;font-size:13px;letter-spacing:-1px">99</span>
                                </div>
                                <span class="text-center leading-tight font-semibold" style="font-size:9.5px;color:#64748b">Asmaul</span>
                            </a>

                            <a href="{{ route('doa-pendek.index') }}" class="flex flex-col items-center gap-1.5 p-2 rounded-xl transition-all duration-150 active:scale-95 no-underline fitur-item">
                                <div class="w-11 h-11 rounded-2xl flex items-center justify-center text-xl" style="background:linear-gradient(135deg,#38bdf8,#2563eb);box-shadow:0 2px 8px rgba(0,0,0,0.18)">🌙</div>
                                <span class="text-center leading-tight font-semibold" style="font-size:9.5px;color:#64748b">Doa</span>
                            </a>

                            <a href="{{ route('tasbih.index') }}" class="flex flex-col items-center gap-1.5 p-2 rounded-xl transition-all duration-150 active:scale-95 no-underline fitur-item">
                                <div class="w-11 h-11 rounded-2xl flex items-center justify-center text-xl" style="background:linear-gradient(135deg,#fb7185,#be185d);box-shadow:0 2px 8px rgba(0,0,0,0.18)">📿</div>
                                <span class="text-center leading-tight font-semibold" style="font-size:9.5px;color:#64748b">Tasbih</span>
                            </a>

                        </div>
                    </div>

                    {{-- QUOTE — desktop only di kolom kiri --}}
                    <div class="hidden lg:block rounded-2xl p-5 text-center"
                         style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);backdrop-filter:blur(8px)">
                        <p class="font-arabic text-2xl font-bold text-white mb-2 leading-loose">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                        <p class="text-xs font-medium" style="color:rgba(255,255,255,0.75)">"Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang"</p>
                    </div>

                </div>
                {{-- ═══ END KOLOM KIRI ═══ --}}

                {{-- ═══ KOLOM KANAN — widget ═══ --}}
                <div class="w-full lg:flex-1 flex flex-col gap-4">

                    {{-- WIDGET SHALAT --}}
                    <div x-data="prayerWidget()" x-init="load()">
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                            <div class="px-4 py-3 flex items-center justify-between" style="background:linear-gradient(90deg,#0f766e,#059669)">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">🕌</span>
                                    <span class="text-white font-bold text-sm">Shalat Hari Ini</span>
                                </div>
                                <a href="{{ route('prayer-tracking.index') }}" class="flex items-center gap-1 text-xs font-semibold widget-link" style="text-decoration:none">
                                    Lihat semua
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                            <div class="p-4">
                                <template x-if="loading">
                                    <div class="flex items-center justify-center py-8">
                                        <div class="w-6 h-6 border-2 border-teal-400 border-t-transparent rounded-full animate-spin"></div>
                                    </div>
                                </template>
                                <template x-if="!loading">
                                    <div>
                                        <div class="grid grid-cols-3 gap-2 mb-3">
                                            <div class="rounded-xl px-2 py-2.5 text-center" style="background:#f0fdfa">
                                                <p class="font-extrabold leading-none" style="font-size:16px;color:#0d9488">
                                                    <span x-text="data.performed"></span><span style="font-size:11px;color:#5eead4">/<span x-text="data.total"></span></span>
                                                </p>
                                                <p class="font-semibold mt-1" style="font-size:9px;color:#94a3b8">Hari Ini</p>
                                            </div>
                                            <div class="rounded-xl px-2 py-2.5 text-center" style="background:#fffbeb">
                                                <p class="font-extrabold leading-none" style="font-size:16px;color:#d97706"><span x-text="data.streak"></span> 🔥</p>
                                                <p class="font-semibold mt-1" style="font-size:9px;color:#94a3b8">Berturut</p>
                                            </div>
                                            <div class="rounded-xl px-2 py-2.5 text-center" style="background:#f0fdf4">
                                                <p class="font-extrabold leading-none" style="font-size:16px;color:#059669" x-text="data.percent + '%'"></p>
                                                <p class="font-semibold mt-1" style="font-size:9px;color:#94a3b8">Progress</p>
                                            </div>
                                        </div>
                                        <div class="h-1.5 rounded-full overflow-hidden mb-3" style="background:#f1f5f9">
                                            <div class="h-full rounded-full transition-all duration-500" style="background:linear-gradient(90deg,#2dd4bf,#10b981)" :style="`width: ${data.percent}%`"></div>
                                        </div>
                                        <div class="grid grid-cols-5 gap-2">
                                            <template x-for="prayer in prayers" :key="prayer">
                                                <div class="flex flex-col items-center gap-1 py-2 px-1 rounded-xl transition-colors"
                                                     :class="getStatus(prayer) === 'performed' ? 'bg-teal-50' : 'bg-gray-50'">
                                                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm transition-all"
                                                         :class="getPrayerDotClass(prayer)">
                                                        <span x-text="prayerIcons[prayer]"></span>
                                                    </div>
                                                    <span class="font-semibold text-center leading-tight" style="font-size:8.5px"
                                                          :class="getPrayerTextClass(prayer)" x-text="prayerNames[prayer]"></span>
                                                    <span class="font-bold px-1 py-0.5 rounded-full" style="font-size:8px"
                                                          :class="getStatusBadgeClass(prayer)" x-text="getStatusLabel(prayer)"></span>
                                                </div>
                                            </template>
                                        </div>
                                        <template x-if="data.performed === 0">
                                            <div class="mt-3 text-center">
                                                <a href="{{ route('prayer-tracking.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-white text-xs font-bold rounded-xl shadow hover:shadow-md transition-all hover:-translate-y-0.5" style="background:linear-gradient(90deg,#0f766e,#059669);text-decoration:none">
                                                    Mulai catat shalat hari ini →
                                                </a>
                                            </div>
                                        </template>
                                        <template x-if="data.performed > 0 && data.performed < 5">
                                            <div class="mt-3 p-2.5 rounded-xl text-center" style="background:#fffbeb;border:1px solid #fde68a">
                                                <p class="font-semibold" style="font-size:11px;color:#92400e" x-text="(5 - data.performed) + ' shalat lagi untuk hari yang sempurna! 💪'"></p>
                                            </div>
                                        </template>
                                        <template x-if="data.performed === 5">
                                            <div class="mt-3 p-2.5 rounded-xl text-center" style="background:#f0fdfa;border:1px solid #99f6e4">
                                                <p class="font-semibold" style="font-size:11px;color:#0f766e">✨ MasyaAllah! Shalat hari ini lengkap!</p>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    {{-- WIDGET QURAN --}}
                    <div x-data="quranWidget()" x-init="load()">
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                            <div class="px-4 py-3 flex items-center justify-between" style="background:linear-gradient(90deg,#047857,#0d9488)">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">📖</span>
                                    <span class="text-white font-bold text-sm">Membaca Al-Quran</span>
                                </div>
                                <a href="{{ route('quran-tracking.index') }}" class="flex items-center gap-1 text-xs font-semibold widget-link" style="text-decoration:none">
                                    Lihat semua
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                            <div class="p-4">
                                <template x-if="loading">
                                    <div class="flex items-center justify-center py-8">
                                        <div class="w-6 h-6 border-2 border-emerald-400 border-t-transparent rounded-full animate-spin"></div>
                                    </div>
                                </template>
                                <template x-if="!loading">
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <span class="font-extrabold" style="font-size:22px;color:#059669" x-text="data.total_completed + '/114'"></span>
                                                <span class="text-xs ml-1" style="color:#94a3b8">surah</span>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold" style="font-size:13px;color:#d97706">🔥 <span x-text="data.streak"></span> hari</p>
                                                <p style="font-size:9px;color:#94a3b8">berturut-turut</p>
                                            </div>
                                        </div>
                                        <div class="h-1.5 rounded-full overflow-hidden mb-1" style="background:#f1f5f9">
                                            <div class="h-full rounded-full transition-all duration-700" style="background:linear-gradient(90deg,#34d399,#0d9488)" :style="'width: ' + data.percent + '%'"></div>
                                        </div>
                                        <p class="text-right mb-3" style="font-size:9px;color:#94a3b8" x-text="data.percent + '% surah selesai'"></p>
                                        <template x-if="data.last_read">
                                            <div class="flex items-center justify-between p-3 rounded-xl" style="background:#f0fdf4;border:1px solid #bbf7d0">
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-bold uppercase tracking-wide" style="font-size:8px;color:#059669">Terakhir dibaca</p>
                                                    <p class="font-bold truncate mt-0.5" style="font-size:13px;color:#064e3b" x-text="data.last_read.surah_number + '. ' + data.last_read.surah_name"></p>
                                                    <p style="font-size:10px;color:#059669">Ayat <span x-text="data.last_read.last_verse"></span> · <span x-text="data.last_read.progress"></span>%</p>
                                                </div>
                                                <a :href="'/surah/' + data.last_read.surah_number" class="ml-3 px-3 py-1.5 text-white text-xs font-bold rounded-lg transition-colors btn-lanjut" style="text-decoration:none;white-space:nowrap">
                                                    Lanjut →
                                                </a>
                                            </div>
                                        </template>
                                        <template x-if="!data.last_read">
                                            <div class="text-center py-2">
                                                <a href="{{ route('quran.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-white text-xs font-bold rounded-xl shadow hover:shadow-md transition-all hover:-translate-y-0.5" style="background:linear-gradient(90deg,#34d399,#0d9488);text-decoration:none">
                                                    Mulai membaca Al-Quran →
                                                </a>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    {{-- QUOTE — mobile only --}}
                    <div class="lg:hidden rounded-2xl p-5 text-center"
                         style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);backdrop-filter:blur(8px)">
                        <p class="font-arabic text-2xl font-bold text-white mb-2 leading-loose">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                        <p class="text-xs font-medium" style="color:rgba(255,255,255,0.75)">"Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang"</p>
                    </div>

                </div>
                {{-- ═══ END KOLOM KANAN ═══ --}}

            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    .font-arabic { font-family: 'Amiri', serif; }
    .no-underline { text-decoration: none !important; }
    .fitur-item:hover { background: #f0fdf4; }
    .widget-link { color: rgba(255,255,255,0.75); }
    .widget-link:hover { color: white; }
    .btn-lanjut { background: #059669; }
    .btn-lanjut:hover { background: #047857; }
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
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                });
                this.data = await res.json();
            } catch (e) { console.error(e); }
            this.loading = false;
        },
        getStatus(prayer) { return this.data.today_data?.[prayer]?.status || null; },
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
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                });
                this.data = await res.json();
            } catch (e) { console.error(e); }
            this.loading = false;
        }
    };
}
</script>
@endpush