@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-500 py-8 md:py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ══════════════════════════════════════════════════════════════
             HEADER
        ══════════════════════════════════════════════════════════════ --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg mb-2">
                🕌 Tracking Shalat
            </h1>
            <p class="text-white/80 text-base md:text-lg">Catat & pantau ibadah shalat harianmu</p>
        </div>

        {{-- ★ BARU: WIDGET LOKASI & WAKTU SHALAT BERIKUTNYA --}}
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-4 mb-6" x-data="locationPicker()">
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
                <button @click="showModal = true" 
                        class="px-4 py-2 bg-teal-500 hover:bg-teal-600 text-white text-sm font-medium rounded-lg transition-colors">
                    Ubah Lokasi
                </button>
            </div>

            {{-- Modal Lokasi --}}
            <div x-show="showModal" 
                 x-cloak
                 @click.away="showModal = false"
                 class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
                <div @click.stop class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">📍 Pilih Lokasi</h3>
                    
                    {{-- GPS Auto-detect --}}
                    <button @click="detectLocation()" 
                            :disabled="detecting"
                            class="w-full mb-4 px-4 py-3 bg-gradient-to-r from-teal-400 to-emerald-500 hover:from-teal-500 hover:to-emerald-600 text-white font-medium rounded-xl transition-all disabled:opacity-50">
                        <span x-show="!detecting">🎯 Deteksi Lokasi Otomatis</span>
                        <span x-show="detecting">⏳ Mendeteksi...</span>
                    </button>

                    <div class="text-center text-sm text-gray-500 mb-4">atau</div>

                    {{-- Search Kota --}}
                    <div class="relative mb-4">
                        <input type="text" 
                               x-model="searchQuery"
                               @input="searchCities()"
                               placeholder="🔍 Cari kota (Jakarta, Surabaya...)"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-teal-400 focus:outline-none">
                        
                        {{-- Dropdown hasil search --}}
                        <div x-show="cities.length > 0" 
                             class="absolute top-full mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-lg max-h-48 overflow-y-auto z-10">
                            <template x-for="city in cities" :key="city">
                                <button @click="selectCity(city)" 
                                        class="w-full px-4 py-2 text-left hover:bg-teal-50 transition-colors"
                                        x-text="city">
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- Selected City Display --}}
                    <div x-show="selectedCity" class="mb-4 p-3 bg-teal-50 border border-teal-200 rounded-xl">
                        <div class="text-sm text-gray-600">Kota dipilih:</div>
                        <div class="font-bold text-teal-700" x-text="selectedCity"></div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-3">
                        <button @click="showModal = false" 
                                class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors">
                            Batal
                        </button>
                        <button @click="saveLocation()" 
                                :disabled="!selectedCity"
                                class="flex-1 px-4 py-2 bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-xl transition-colors disabled:opacity-50">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             STATISTIK RINGKASAN (CARDS ATAS)
        ═════════════════════════════════════════════════════════════════ --}}
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

        {{-- ══════════════════════════════════════════════════════════════
             CHECKLIST SHALAT HARIAN
        ══════════════════════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-8 mb-6"
             x-data="prayerTracker({
                 prayerTimes: @json($prayerTimes),
                 currentServerTime: '{{ $currentServerTime }}',
                 allPrayers: @json($prayers),
                 todayPrayers: @json($todayPrayers->mapWithKeys(fn($r) => [$r->prayer_name => ['status' => $r->status]])->toArray()),
                 prayerNames: @json($prayerNames)
             })"
             x-init="init()">

            {{-- Pilih Tanggal --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600 text-base">📋</span>
                    Catat Shalat
                </h2>
                <div class="flex items-center gap-2">
                    <button @click="prevDay()"
                            class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-teal-50 hover:text-teal-600 transition-colors flex items-center justify-center text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <input type="date"
                           x-model="selectedDate"
                           @change="loadDay()"
                           :max="today"
                           class="px-3 py-1.5 rounded-lg border border-gray-200 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400">
                    <button @click="nextDay()"
                            :disabled="selectedDate >= today"
                            :class="selectedDate >= today ? 'opacity-30 cursor-not-allowed' : 'hover:bg-teal-50 hover:text-teal-600'"
                            class="w-8 h-8 rounded-lg bg-gray-100 transition-colors flex items-center justify-center text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <span x-show="isToday()"
                          class="px-2 py-0.5 bg-teal-100 text-teal-700 text-xs font-semibold rounded-full">
                        Hari Ini
                    </span>
                </div>
            </div>

            {{-- Shalat Cards --}}
            <div class="space-y-3">
                @foreach($prayers as $prayerIndex => $prayer)
                @php
                    $rec    = $todayPrayers->get($prayer);
                    $status = $rec ? $rec->status : null;
                @endphp
                <div class="prayer-row border rounded-xl p-4 transition-all duration-300
                    {{ $status === 'performed' ? 'border-teal-200 bg-teal-50' :
                    ($status === 'qada'     ? 'border-amber-200 bg-amber-50' :
                    ($status === 'missed'   ? 'border-red-200 bg-red-50' :
                                                'border-gray-200 bg-gray-50')) }}"
                    x-bind:class="getPrayerClass('{{ $prayer }}')">

                    <div class="flex items-center gap-3">
                        {{-- Icon & Nama --}}
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl flex-shrink-0
                                    {{ $status === 'performed' ? 'bg-teal-100' :
                                       ($status === 'qada'     ? 'bg-amber-100' :
                                       ($status === 'missed'   ? 'bg-red-100' : 'bg-gray-100')) }}">
                            {{ ['fajr'=>'🌅','dhuhr'=>'☀️','asr'=>'🌤️','maghrib'=>'🌇','isha'=>'🌙'][$prayer] }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <div class="font-semibold text-gray-800">{{ $prayerNames[$prayer] }}</div>
                                {{-- ★ BARU: Tampilkan waktu shalat --}}
                                <div class="text-xs font-semibold text-teal-600 px-2 py-0.5 bg-teal-50 rounded-full">
                                    {{ $prayerTimes[$prayer] }}
                                </div>
                            </div>
                            <div class="text-xs text-gray-500">
                                @if($status === 'performed')
                                    <span class="text-teal-600 font-medium">✓ Terlaksana</span>
                                @else
                                    {{-- ★ BARU: Countdown / Status waktu --}}
                                    <span x-text="getPrayerTimeStatus('{{ $prayer }}', {{ $prayerIndex }})"></span>
                                @endif
                            </div>
                        </div>

                        {{-- Tombol Status --}}
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <button
                                @click="updatePrayer('{{ $prayer }}', '{{ $status === 'performed' ? '' : 'performed' }}', selectedDate)"
                                x-bind:disabled="isCurrentlyDisabled('{{ $prayer }}', {{ $prayerIndex }})"
                                :class="{'opacity-40 cursor-not-allowed': isCurrentlyDisabled('{{ $prayer }}', {{ $prayerIndex }})}"
                                class="w-9 h-9 rounded-lg flex items-center justify-center text-sm transition-all duration-200
                                    hover:scale-110 active:scale-95
                                    {{ $status === 'performed' ? 'bg-teal-500 text-white shadow-md' : 'bg-gray-100 hover:bg-teal-100 text-gray-500' }}">
                                ✓
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Flash message --}}
            <div x-show="flashMsg"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-end="opacity-0"
                 class="mt-4 p-3 bg-teal-50 border border-teal-200 text-teal-700 rounded-xl text-sm text-center font-medium"
                 x-text="flashMsg">
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             STATISTIK 7 HARI TERAKHIR
        ══════════════════════════════════════════════════════════════ --}}
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
                                   ($day['performed'] > 0  ? 'bg-gradient-to-br from-amber-300 to-amber-400' :
                                                             'bg-gray-100') }}
                                {{ $day['is_today'] ? 'ring-2 ring-teal-400 ring-offset-1' : '' }}">
                        <span class="text-sm font-bold {{ $day['performed'] > 0 ? 'text-white' : 'text-gray-400' }}">
                            {{ $day['performed'] }}
                        </span>
                    </div>
                    <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500
                                    {{ $day['performed'] === 5 ? 'bg-teal-500' : 'bg-amber-400' }}"
                             style="width: {{ $day['percent'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4 flex items-center gap-4 text-xs text-gray-500 justify-center">
                <span class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 inline-block"></span>
                    Lengkap (5/5)
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-gradient-to-br from-amber-300 to-amber-400 inline-block"></span>
                    Sebagian
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-gray-100 inline-block"></span>
                    Belum
                </span>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             RIWAYAT 7 HARI
        ══════════════════════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-8">
            <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-5 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600">📜</span>
                Riwayat 7 Hari Terakhir
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left py-3 px-3 text-gray-500 font-semibold">Tanggal</th>
                            @foreach($prayers as $prayer)
                                <th class="text-center py-3 px-2 text-gray-500 font-semibold">
                                    {{ ['fajr'=>'🌅','dhuhr'=>'☀️','asr'=>'🌤️','maghrib'=>'🌇','isha'=>'🌙'][$prayer] }}
                                    <br><span class="text-xs font-normal">{{ $prayerNames[$prayer] }}</span>
                                </th>
                            @endforeach
                            <th class="text-center py-3 px-2 text-gray-500 font-semibold">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(array_reverse($weeklyStats) as $dayStat)
                        @php
                            $rowData = \App\Models\PrayerTracking::where('user_id', auth()->id())
                                ->where('prayer_date', $dayStat['date'])
                                ->get()->keyBy('prayer_name');
                        @endphp
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors
                                   {{ $dayStat['is_today'] ? 'bg-teal-50' : '' }}">
                            <td class="py-3 px-3">
                                <div class="font-semibold text-gray-800">{{ $dayStat['day'] }}</div>
                                <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($dayStat['date'])->format('d M') }}</div>
                            </td>
                            @foreach($prayers as $prayer)
                            @php $rec = $rowData->get($prayer); @endphp
                            <td class="text-center py-3 px-2">
                                @if($rec && $rec->status === 'performed')
                                    <span class="inline-flex w-7 h-7 items-center justify-center rounded-full bg-teal-100 text-teal-600 text-base">✓</span>
                                @elseif($rec && $rec->status === 'qada')
                                    <span class="inline-flex w-7 h-7 items-center justify-center rounded-full bg-amber-100 text-amber-600 text-xs font-bold">Q</span>
                                @elseif($rec && $rec->status === 'missed')
                                    <span class="inline-flex w-7 h-7 items-center justify-center rounded-full bg-red-100 text-red-400 text-base">✗</span>
                                @else
                                    <span class="inline-flex w-7 h-7 items-center justify-center rounded-full bg-gray-100 text-gray-300 text-base">–</span>
                                @endif
                            </td>
                            @endforeach
                            <td class="text-center py-3 px-2">
                                <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-full text-xs font-bold
                                             {{ $dayStat['performed'] === 5 ? 'bg-teal-100 text-teal-700' :
                                                ($dayStat['performed'] > 0 ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-400') }}">
                                    {{ $dayStat['performed'] }}/5
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
// ★ Location Picker Component
function locationPicker() {
    return {
        showModal: false,
        detecting: false,
        searchQuery: '',
        cities: [],
        selectedCity: '{{ $userCity }}',

        async detectLocation() {
            this.detecting = true;
            
            if (!navigator.geolocation) {
                alert('Browser tidak support geolocation');
                this.detecting = false;
                return;
            }

            navigator.geolocation.getCurrentPosition(
                async (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    await this.saveLocationCoords(lat, lng);
                    this.detecting = false;
                    this.showModal = false;
                    window.location.reload();
                },
                (error) => {
                    alert('Gagal mendapatkan lokasi. Gunakan pencarian kota.');
                    this.detecting = false;
                }
            );
        },

        async searchCities() {
            if (this.searchQuery.length < 2) {
                this.cities = [];
                return;
            }

            try {
                const res = await fetch(`{{ route('prayer-tracking.search-cities') }}?q=${this.searchQuery}`);
                this.cities = await res.json();
            } catch (e) {
                console.error(e);
            }
        },

        selectCity(city) {
            this.selectedCity = city;
            this.cities = [];
            this.searchQuery = '';
        },

        async saveLocation() {
            try {
                const res = await fetch('{{ route("prayer-tracking.set-location") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ city: this.selectedCity })
                });

                if (res.ok) {
                    this.showModal = false;
                    window.location.reload();
                }
            } catch (e) {
                alert('Gagal menyimpan lokasi');
            }
        },

        async saveLocationCoords(lat, lng) {
            try {
                await fetch('{{ route("prayer-tracking.set-location") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ latitude: lat, longitude: lng })
                });
            } catch (e) {
                console.error(e);
            }
        }
    };
}

// ★ Prayer Tracker Component (Updated)
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
            // Update time setiap menit
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

            let end = 24 * 60; // End of day
            if (prayerIndex < this.allPrayers.length - 1) {
                const next = this.allPrayers[prayerIndex + 1];
                end = this.timeToMinutes(this.prayerTimes[next]);
            }

            return now >= start && now < end;
        },

        isCurrentlyDisabled(prayer, index) {
            return !this.isPrayerCurrentlyAvailable(prayer, index);
        },

        getPrayerTimeStatus(prayer, index) {
            if (!this.isToday()) return 'Belum dicatat';
            
            const now = this.timeToMinutes(this.currentTime);
            const prayerTime = this.timeToMinutes(this.prayerTimes[prayer]);
            
            if (now < prayerTime) {
                const diff = prayerTime - now;
                const hours = Math.floor(diff / 60);
                const mins = diff % 60;
                if (hours > 0) {
                    return `⏳ ${hours} jam ${mins} menit lagi`;
                } else {
                    return `⏳ ${mins} menit lagi`;
                }
            } else if (this.isPrayerCurrentlyAvailable(prayer, index)) {
                return '🕐 Waktu berlangsung';
            } else {
                return 'Waktu terlewat';
            }
        },

        timeToMinutes(time) {
            const [h, m] = time.split(':').map(Number);
            return h * 60 + m;
        },

        async updatePrayer(prayer, status, date) {
            const index = this.allPrayers.indexOf(prayer);
            if (this.isCurrentlyDisabled(prayer, index)) {
                this.showFlash('🚫 Belum masuk waktu shalat');
                return;
            }

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
                        prayer_date: date,
                        status
                    })
                });

                const data = await res.json();

                if (data.success) {
                    this.prayerStatus[prayer] = { status };
                    this.showFlash('✅ ' + data.message);
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    this.showFlash('🚫 ' + data.message);
                }
            } catch {
                this.showFlash('❌ Gagal menyimpan');
            }
        },

        showFlash(msg) {
            this.flashMsg = msg;
            clearTimeout(this.flashTimer);
            this.flashTimer = setTimeout(() => this.flashMsg = '', 3000);
        },

        prevDay() {
            const date = new Date(this.selectedDate);
            date.setDate(date.getDate() - 1);
            this.selectedDate = date.toISOString().split('T')[0];
            this.loadDay();
        },

        nextDay() {
            const date = new Date(this.selectedDate);
            date.setDate(date.getDate() + 1);
            if (this.selectedDate < this.today) {
                this.selectedDate = date.toISOString().split('T')[0];
                this.loadDay();
            }
        },

        loadDay() {
            window.location.href = `{{ route('prayer-tracking.index') }}?date=${this.selectedDate}`;
        }
    }
}
</script>
@endpush

@push('styles')
<style>
    /* Smooth transitions for prayer cards */
    .prayer-row { 
        transition: all 0.2s ease; 
    }
    
    /* Alpine x-cloak */
    [x-cloak] { 
        display: none !important; 
    }
</style>
@endpush