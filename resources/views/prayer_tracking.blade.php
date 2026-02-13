@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-500 py-8 md:py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg mb-2">
                🕌 Tracking Shalat
            </h1>
            <p class="text-white/80 text-base md:text-lg">Catat & pantau ibadah shalat harianmu</p>
        </div>

        {{-- WIDGET LOKASI --}}
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-4 mb-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center text-teal-600">
                        📍
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-800">{{ $userCity }}</div>
                        <div class="text-xs text-gray-500">
                            Shalat berikutnya: <span class="font-semibold text-teal-600">{{ ucfirst($nextPrayer['name']) }} ({{ $nextPrayer['time'] }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATISTIK RINGKASAN --}}
        <div class="grid grid-cols-3 gap-3 md:gap-4 mb-6">
            {{-- Hari Ini --}}
            <div class="bg-white rounded-2xl p-4 md:p-6 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-teal-600 mb-1">
                    {{ $todayPerformed }}<span class="text-lg text-gray-400">/5</span>
                </div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">Hari Ini</div>
                <div class="mt-2 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-teal-400 to-emerald-500 rounded-full transition-all duration-500"
                         style="width: {{ $todayPercent }}%"></div>
                </div>
            </div>

            {{-- Streak --}}
            <div class="bg-white rounded-2xl p-4 md:p-6 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-amber-500 mb-1">
                    {{ $streak }}<span class="text-lg text-gray-400"> 🔥</span>
                </div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">Hari Berturut</div>
                <div class="mt-2 text-xs text-amber-400 font-medium">
                    {{ $streak > 0 ? 'Pertahankan!' : 'Mulai sekarang!' }}
                </div>
            </div>

            {{-- Bulan Ini --}}
            <div class="bg-white rounded-2xl p-4 md:p-6 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-1">
                    {{ $monthTotal }}
                </div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">Shalat Bulan Ini</div>
                <div class="mt-2 text-xs text-emerald-400 font-medium">
                    dari {{ now()->day * 5 }} target
                </div>
            </div>
        </div>

        {{-- CHECKLIST SHALAT HARIAN --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-8 mb-6"
             x-data="prayerTracker({
                 prayerTimes: @json($prayerTimes),
                 currentServerTime: '{{ $currentServerTime }}',
                 allPrayers: @json($prayers),
                 todayPrayers: @json($todayPrayers->mapWithKeys(fn($r) => [$r->prayer_name => ['status' => $r->status]])->toArray()),
                 prayerNames: @json($prayerNames)
             })"
             x-init="init()">

            <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600 text-base">📋</span>
                Catat Shalat
            </h2>

            {{-- Shalat Cards --}}
            <div class="space-y-3">
                @foreach($prayers as $prayerIndex => $prayer)
                @php
                    $rec = $todayPrayers->get($prayer);
                    $status = $rec ? $rec->status : null;
                @endphp
                <div class="prayer-row border rounded-xl p-4 transition-all duration-300"
                     :class="getPrayerClass('{{ $prayer }}')">

                    <div class="flex items-center gap-3">
                        {{-- Icon & Nama --}}
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl flex-shrink-0 bg-gray-100">
                            {{ ['fajr'=>'🌅','dhuhr'=>'☀️','asr'=>'🌤️','maghrib'=>'🌇','isha'=>'🌙'][$prayer] }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <div class="font-semibold text-gray-800">{{ $prayerNames[$prayer] }}</div>
                                <div class="text-xs font-semibold text-teal-600 px-2 py-0.5 bg-teal-50 rounded-full">
                                    {{ $prayerTimes[$prayer] }}
                                </div>
                            </div>
                            <div class="text-xs text-gray-500">
                                <span x-text="getPrayerTimeStatus('{{ $prayer }}', {{ $prayerIndex }})"></span>
                            </div>
                        </div>

                        {{-- Tombol Status - TOGGLE SIMPLE --}}
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <button
                                @click="updatePrayer('{{ $prayer }}', '{{ $status === 'performed' ? '' : 'performed' }}')"
                                x-bind:disabled="isCurrentlyDisabled('{{ $prayer }}', {{ $prayerIndex }})"
                                :class="{
                                    'opacity-40 cursor-not-allowed': isCurrentlyDisabled('{{ $prayer }}', {{ $prayerIndex }}),
                                    'hover:scale-110 active:scale-95': !isCurrentlyDisabled('{{ $prayer }}', {{ $prayerIndex }}),
                                    'bg-teal-500 text-white shadow-lg ring-2 ring-teal-200': prayerStatus['{{ $prayer }}']?.status === 'performed',
                                    'bg-gray-200 hover:bg-gray-300 text-gray-600': prayerStatus['{{ $prayer }}']?.status !== 'performed' && !isCurrentlyDisabled('{{ $prayer }}', {{ $prayerIndex }}),
                                    'bg-gray-100 text-gray-400': isCurrentlyDisabled('{{ $prayer }}', {{ $prayerIndex }})
                                }"
                                class="w-12 h-12 rounded-xl flex flex-col items-center justify-center text-sm transition-all duration-200 relative"
                                :title="getButtonTooltip('{{ $prayer }}', {{ $prayerIndex }})">
                                
                                {{-- Icon berubah sesuai state --}}
                                <template x-if="isCurrentlyDisabled('{{ $prayer }}', {{ $prayerIndex }})">
                                    <span class="text-lg">🔒</span>
                                </template>
                                
                                <template x-if="!isCurrentlyDisabled('{{ $prayer }}', {{ $prayerIndex }}) && prayerStatus['{{ $prayer }}']?.status !== 'performed'">
                                    <span class="text-xl">✓</span>
                                </template>
                                
                                <template x-if="prayerStatus['{{ $prayer }}']?.status === 'performed'">
                                    <div class="flex flex-col items-center">
                                        <span class="text-xl">✓</span>
                                        <span class="text-[9px] font-semibold opacity-90">TAP UNDO</span>
                                    </div>
                                </template>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Flash message --}}
            <div x-show="flashMsg"
                 x-transition
                 class="mt-4 p-3 bg-teal-50 border border-teal-200 text-teal-700 rounded-xl text-sm text-center font-medium"
                 x-text="flashMsg">
            </div>
        </div>

        {{-- 7 HARI TERAKHIR --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-8 mb-6">
            <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-5 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600">📊</span>
                7 Hari Terakhir
            </h2>
            <div class="grid grid-cols-7 gap-2">
                @foreach($weeklyStats as $day)
                <div class="flex flex-col items-center gap-1.5">
                    <span class="text-xs font-semibold {{ $day['is_today'] ? 'text-teal-600' : 'text-gray-400' }}">
                        {{ $day['day'] }}
                    </span>
                    <div class="relative w-full aspect-square rounded-xl flex items-center justify-center
                                {{ $day['performed'] === 5 ? 'bg-gradient-to-br from-teal-400 to-emerald-500' :
                                   ($day['performed'] > 0  ? 'bg-gradient-to-br from-amber-300 to-amber-400' : 'bg-gray-100') }}
                                {{ $day['is_today'] ? 'ring-2 ring-teal-400 ring-offset-1' : '' }}">
                        <span class="text-sm font-bold {{ $day['performed'] > 0 ? 'text-white' : 'text-gray-400' }}">
                            {{ $day['performed'] }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection

{{-- ═══════════════════════════════════════════════════════════════
     COPY PASTE BAGIAN INI KE BAWAH FILE prayer_tracking.blade.php
     (setelah @endsection, REPLACE seluruh @push('scripts') yang lama)
═══════════════════════════════════════════════════════════════ --}}

@push('scripts')
<script>
function prayerTracker(config) {
    return {
        selectedDate: '{{ $selectedDate }}',
        today: '{{ now()->toDateString() }}',
        prayerStatus: config.todayPrayers,
        flashMsg: '',
        flashTimer: null,
        prayerTimes: config.prayerTimes,
        currentServerTime: config.currentServerTime,
        allPrayers: config.allPrayers,
        currentTime: null,

        init() {
            this.currentTime = this.currentServerTime;
            console.log('Prayer Tracker initialized');
            console.log('Current time:', this.currentTime);
            console.log('Prayer times:', this.prayerTimes);
            
            setInterval(() => {
                this.updateCurrentTime();
            }, 60000);
        },

        updateCurrentTime() {
            const [h, m] = this.currentTime.split(':').map(Number);
            let newM = m + 1;
            let newH = h;
            if (newM >= 60) {
                newM = 0;
                newH = (h + 1) % 24;
            }
            this.currentTime = `${String(newH).padStart(2, '0')}:${String(newM).padStart(2, '0')}`;
        },

        getPrayerClass(prayer) {
            const s = this.prayerStatus[prayer]?.status ?? null;
            if (s === 'performed') return 'border-teal-200 bg-teal-50';
            return 'border-gray-200 bg-gray-50';
        },

        isToday() {
            return this.selectedDate === this.today;
        },

        isPrayerCurrentlyAvailable(prayerName, prayerIndex) {
            if (!this.isToday()) return true;

            const now = this.timeToMinutes(this.currentTime);
            const start = this.timeToMinutes(this.prayerTimes[prayerName]);

            let end = 24 * 60;
            if (prayerIndex < this.allPrayers.length - 1) {
                const next = this.allPrayers[prayerIndex + 1];
                end = this.timeToMinutes(this.prayerTimes[next]);
            }

            return now >= start && now < end;
        },

        isCurrentlyDisabled(prayer, index) {
            if (this.prayerStatus[prayer]?.status === 'performed') {
                return false;
            }
            return !this.isPrayerCurrentlyAvailable(prayer, index);
        },

        getPrayerTimeStatus(prayer, index) {
            if (this.prayerStatus[prayer]?.status === 'performed') {
                return '✓ Terlaksana';
            }
            
            if (!this.isToday()) return 'Belum dicatat';
            
            const now = this.timeToMinutes(this.currentTime);
            const prayerTime = this.timeToMinutes(this.prayerTimes[prayer]);
            
            if (now < prayerTime) {
                const diff = prayerTime - now;
                const hours = Math.floor(diff / 60);
                const mins = diff % 60;
                if (hours > 0) {
                    return `🔒 ${hours} jam ${mins} menit lagi`;
                } else {
                    return `🔒 ${mins} menit lagi`;
                }
            } else if (this.isPrayerCurrentlyAvailable(prayer, index)) {
                return '🕐 Waktu berlangsung';
            } else {
                return '⏸️ Waktu terlewat';
            }
        },

        timeToMinutes(time) {
            const [h, m] = time.split(':').map(Number);
            return h * 60 + m;
        },

        getButtonTooltip(prayer, index) {
            const status = this.prayerStatus[prayer]?.status;
            
            if (status === 'performed') {
                return '✅ Sudah dicatat. Klik lagi untuk batalkan';
            }
            
            if (this.isCurrentlyDisabled(prayer, index)) {
                return '🔒 Belum masuk waktu shalat';
            }
            
            return '✓ Klik untuk catat shalat';
        },

        async updatePrayer(prayer, status) {
            const index = this.allPrayers.indexOf(prayer);
            
            if (status === 'performed' && this.isCurrentlyDisabled(prayer, index)) {
                this.showFlash('🚫 Belum masuk waktu shalat ' + prayer);
                return;
            }

            console.log('Updating prayer:', prayer, 'status:', status);

            try {
                const res = await fetch('{{ route("prayer-tracking.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        prayer_name: prayer,
                        prayer_date: this.selectedDate,
                        status: status
                    })
                });

                const data = await res.json();

                if (data.success) {
                    if (status) {
                        this.prayerStatus[prayer] = { status: status };
                        this.showFlash('✅ Shalat ' + config.prayerNames[prayer] + ' tercatat');
                    } else {
                        delete this.prayerStatus[prayer];
                        this.showFlash('↩️ Dibatalkan');
                    }
                    
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                } else {
                    this.showFlash('🚫 ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                this.showFlash('❌ Gagal menyimpan');
            }
        },

        showFlash(msg) {
            this.flashMsg = msg;
            clearTimeout(this.flashTimer);
            this.flashTimer = setTimeout(() => this.flashMsg = '', 3000);
        }
    }
}
</script>
@endpush

@push('styles')
<style>
    .prayer-row { 
        transition: all 0.2s ease; 
    }
</style>
@endpush

