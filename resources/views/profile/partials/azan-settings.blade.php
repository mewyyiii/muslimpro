{{--
    resources/views/profile/partials/azan-settings.blade.php
--}}
<div class="bg-white rounded-3xl p-8 shadow-2xl"
     x-data="azanSettings()"
     x-init="init()">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-gray-100">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl flex items-center justify-center shadow-md">
                <span class="text-2xl">📢</span>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-800">Pengaturan Azan</h3>
                <p class="text-sm text-gray-500">Atur notifikasi azan otomatis</p>
            </div>
        </div>

        {{-- Master Toggle --}}
        <div class="flex items-center gap-3">
            <span class="text-sm font-semibold text-gray-600" x-text="azanEnabled ? 'Aktif' : 'Nonaktif'"></span>
            <button
                @click="toggleMaster()"
                :class="azanEnabled ? 'bg-teal-500' : 'bg-gray-200'"
                class="relative w-14 h-7 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2">
                <span
                    :class="azanEnabled ? 'translate-x-7' : 'translate-x-1'"
                    class="absolute top-0.5 w-6 h-6 bg-white rounded-full shadow transition-transform duration-300 flex items-center justify-center text-xs">
                    <span x-text="azanEnabled ? '🔔' : '🔕'"></span>
                </span>
            </button>
        </div>
    </div>

    {{-- Konten (hanya tampil kalau azan aktif) --}}
    <div x-show="azanEnabled" x-transition class="space-y-6">

        {{-- Pilih Muadzin --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-3">🎙️ Pilih Muadzin</label>
            <div class="grid grid-cols-3 gap-3">
                @foreach(App\Models\AzanSetting::muadzinList() as $key => $info)
                <button
                    type="button"
                    @click="selectMuadzin('{{ $key }}')"
                    :class="muadzin === '{{ $key }}'
                        ? 'border-teal-500 bg-teal-50 text-teal-700 shadow-md scale-105'
                        : 'border-gray-200 bg-white text-gray-600 hover:border-teal-300'"
                    class="flex flex-col items-center gap-2 p-4 border-2 rounded-2xl transition-all duration-200 focus:outline-none">
                    <span class="text-3xl">{{ $info['emoji'] }}</span>
                    <span class="text-sm font-semibold">{{ $info['label'] }}</span>
                    <div :class="muadzin === '{{ $key }}' ? 'bg-teal-500' : 'bg-gray-200'"
                         class="w-2 h-2 rounded-full transition-colors"></div>
                </button>
                @endforeach
            </div>

            {{-- Preview audio --}}
            <div class="mt-3 flex items-center gap-3">
                <button
                    type="button"
                    @click="previewAzan()"
                    :disabled="isPreviewing"
                    class="flex items-center gap-2 px-4 py-2 bg-teal-500 hover:bg-teal-600 disabled:opacity-60 disabled:cursor-not-allowed text-white text-sm font-semibold rounded-xl transition-all shadow-md">
                    <span x-text="isPreviewing ? '⏸ Memutar...' : '▶ Preview Azan'"></span>
                </button>
                <span x-show="isPreviewing" class="text-xs text-gray-400 animate-pulse">Memutar contoh azan...</span>
            </div>
        </div>

        {{-- Toggle Per Waktu --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-3">⏰ Aktifkan Azan Per Waktu</label>
            <div class="space-y-2">
                @php
                    $prayerList = [
                        'fajr'    => ['label' => 'Subuh',   'emoji' => '🌅'],
                        'dhuhr'   => ['label' => 'Dzuhur',  'emoji' => '☀️'],
                        'asr'     => ['label' => 'Ashar',   'emoji' => '🌤️'],
                        'maghrib' => ['label' => 'Maghrib', 'emoji' => '🌇'],
                        'isha'    => ['label' => 'Isya',    'emoji' => '🌙'],
                    ];
                @endphp

                @foreach($prayerList as $key => $info)
                <div class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <span class="text-xl w-8 text-center">{{ $info['emoji'] }}</span>
                        <span class="font-semibold text-gray-800 text-sm">{{ $info['label'] }}</span>
                    </div>
                    <button
                        type="button"
                        @click="togglePrayer('{{ $key }}')"
                        :class="prayers['{{ $key }}'] ? 'bg-teal-500' : 'bg-gray-200'"
                        class="relative w-12 h-6 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-1">
                        <span
                            :class="prayers['{{ $key }}'] ? 'translate-x-6' : 'translate-x-0.5'"
                            class="absolute top-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform duration-300">
                        </span>
                    </button>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- State nonaktif --}}
    <div x-show="!azanEnabled" x-transition class="py-6 text-center text-gray-400">
        <div class="text-4xl mb-2">🔕</div>
        <p class="text-sm font-medium">Notifikasi azan dinonaktifkan</p>
        <p class="text-xs mt-1">Aktifkan toggle di atas untuk mengatur azan</p>
    </div>

    {{-- Tombol Simpan --}}
    <div class="mt-6 pt-4 border-t border-gray-100 flex items-center gap-4">
        <button
            type="button"
            @click="saveSettings()"
            :disabled="isSaving"
            class="px-8 py-3 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 disabled:opacity-60 disabled:cursor-not-allowed text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
            <span x-text="isSaving ? '⏳ Menyimpan...' : 'Simpan Pengaturan'"></span>
        </button>

        <div x-show="saveSuccess" x-transition class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-xl text-sm font-bold">
            ✓ Pengaturan azan disimpan!
        </div>
        <div x-show="saveError" x-transition class="px-4 py-2 bg-red-100 text-red-600 rounded-xl text-sm font-bold">
            ❌ Gagal menyimpan, coba lagi
        </div>
    </div>

    {{-- Info notifikasi --}}
    <div class="mt-4 p-3 bg-amber-50 border border-amber-200 rounded-xl">
        <p class="text-xs text-amber-700">
            <span class="font-bold">💡 Info:</span>
            Azan berbunyi otomatis saat waktu shalat tiba, bahkan saat browser diminimize.
            <button @click="requestPermission()" class="underline font-semibold hover:text-amber-900 ml-1">
                Aktifkan Izin Notifikasi →
            </button>
        </p>
    </div>
</div>

@push('scripts')
<script>
function azanSettings() {
    return {
        azanEnabled : {{ $azanSetting->azan_enabled ? 'true' : 'false' }},
        muadzin     : '{{ $azanSetting->muadzin }}',
        prayers     : {
            fajr    : {{ $azanSetting->fajr_enabled    ? 'true' : 'false' }},
            dhuhr   : {{ $azanSetting->dhuhr_enabled   ? 'true' : 'false' }},
            asr     : {{ $azanSetting->asr_enabled     ? 'true' : 'false' }},
            maghrib : {{ $azanSetting->maghrib_enabled ? 'true' : 'false' }},
            isha    : {{ $azanSetting->isha_enabled    ? 'true' : 'false' }},
        },
        audioUrls    : @json(App\Models\AzanSetting::audioUrls()),
        isSaving     : false,
        isPreviewing : false,
        saveSuccess  : false,
        saveError    : false,
        previewAudio : null,

        init() {},

        toggleMaster() {
            this.azanEnabled = !this.azanEnabled;
        },

        selectMuadzin(key) {
            this.muadzin = key;
            if (this.previewAudio) {
                this.previewAudio.pause();
                this.previewAudio = null;
                this.isPreviewing = false;
            }
        },

        togglePrayer(key) {
            this.prayers[key] = !this.prayers[key];
        },

        previewAzan() {
            if (this.isPreviewing && this.previewAudio) {
                this.previewAudio.pause();
                this.previewAudio = null;
                this.isPreviewing = false;
                return;
            }
            const url = this.audioUrls[this.muadzin];
            this.previewAudio = new Audio(url);
            this.isPreviewing  = true;
            this.previewAudio.play().catch(() => { this.isPreviewing = false; });
            // Stop preview otomatis setelah 20 detik
            setTimeout(() => {
                if (this.previewAudio) {
                    this.previewAudio.pause();
                    this.previewAudio = null;
                    this.isPreviewing = false;
                }
            }, 20000);
            this.previewAudio.onended = () => {
                this.isPreviewing = false;
                this.previewAudio = null;
            };
        },

        async requestPermission() {
            const result = await Notification.requestPermission();
            if (result === 'granted') {
                alert('✅ Izin notifikasi berhasil! Azan akan berbunyi otomatis.');
            } else {
                alert('❌ Izin ditolak. Aktifkan manual di pengaturan browser.');
            }
        },

        async saveSettings() {
            this.isSaving    = true;
            this.saveSuccess = false;
            this.saveError   = false;
            try {
                const res = await fetch('{{ route("azan-settings.store") }}', {
                    method  : 'POST',
                    headers : {
                        'Content-Type' : 'application/json',
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content,
                        'Accept'       : 'application/json',
                    },
                    body: JSON.stringify({
                        azan_enabled    : this.azanEnabled,
                        muadzin         : this.muadzin,
                        fajr_enabled    : this.prayers.fajr,
                        dhuhr_enabled   : this.prayers.dhuhr,
                        asr_enabled     : this.prayers.asr,
                        maghrib_enabled : this.prayers.maghrib,
                        isha_enabled    : this.prayers.isha,
                    }),
                });
                const data = await res.json();
                if (data.success) {
                    this.saveSuccess = true;
                    setTimeout(() => this.saveSuccess = false, 3000);
                    // Update service worker dengan setting terbaru
                    if ('serviceWorker' in navigator) {
                        navigator.serviceWorker.ready.then(reg => {
                            reg.active?.postMessage({ type: 'UPDATE_AZAN_SETTINGS', settings: data.setting });
                        });
                    }
                } else {
                    this.saveError = true;
                    setTimeout(() => this.saveError = false, 3000);
                }
            } catch (e) {
                this.saveError = true;
                setTimeout(() => this.saveError = false, 3000);
            } finally {
                this.isSaving = false;
            }
        }
    };
}
</script>
@endpush