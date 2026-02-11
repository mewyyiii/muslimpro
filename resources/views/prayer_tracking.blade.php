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
                 todayPrayers: @json($todayPrayers->map(fn($r) => ['status' => $r->status])->toArray()),
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
                <div class="prayer-row border rounded-xl p-4 transition-all duration-300"
                     x-bind:class="getPrayerClass('{{ $prayer }}')">
                    <div class="flex items-center gap-3">
                        {{-- Icon & Nama --}}
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl flex-shrink-0
                        {{ $status === 'performed'
                            ? 'bg-teal-100'
                            : ($status === 'qada'
                                ? 'bg-amber-100'
                                : 'bg-gray-100'
                            )
                        }}">
                            {{ ['fajr'=>'🌅','dhuhr'=>'☀️','asr'=>'🌤️','maghrib'=>'🌇','isha'=>'🌙'][$prayer] }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-gray-800">{{ $prayerNames[$prayer] }}</div>
                            <div class="text-xs text-gray-500 capitalize">
                                @if($status === 'performed')
                                    <span class="text-teal-600 font-medium">✓ Terlaksana</span>
                                @elseif($status === 'qada')
                                    <span class="text-amber-600 font-medium">↩ Qada</span>
                                @else
                                    <span class="text-gray-400">Belum dicatat</span>
                                @endif
                            </div>
                        </div>

                        {{-- Tombol Status --}}
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <button @click="updatePrayer('{{ $prayer }}', 'performed', selectedDate)"
                                    x-bind:title="getPrayerButtonTooltip('{{ $prayer }}', 'performed', {{ $prayerIndex }}, '{{ $status ?? '' }}')"
                                    x-bind:disabled="!isToday() || !isPrayerCurrentlyAvailable('{{ $prayer }}', {{ $prayerIndex }}) || '{{ $status ?? '' }}' === 'performed'"
                                    :class="{
                                        'opacity-50 cursor-not-allowed': (!isToday() || !isPrayerCurrentlyAvailable('{{ $prayer }}', {{ $prayerIndex }}) || '{{ $status ?? '' }}' === 'performed'),
                                        'text-gray-400': (isToday() && !isPrayerCurrentlyAvailable('{{ $prayer }}', {{ $prayerIndex }})),
                                        'bg-teal-500 text-white shadow-md': ('{{ $status ?? '' }}' === 'performed'),
                                        'bg-gray-100 hover:bg-teal-100 text-gray-500': ('{{ $status ?? '' }}' !== 'performed')
                                    }"
                                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm transition-all duration-200 hover:scale-110 active:scale-95">
                                <span x-html="getPrayerButtonIcon('{{ $prayer }}', 'performed', {{ $prayerIndex }}, '{{ $status ?? '' }}')"></span>
                            </button>
                            <button @click="updatePrayer('{{ $prayer }}', 'qada', selectedDate)"
                                    x-bind:title="getPrayerButtonTooltip('{{ $prayer }}', 'qada', {{ $prayerIndex }}, '{{ $status ?? '' }}')"
                                    x-bind:disabled="!isToday() || !isPrayerCurrentlyAvailable('{{ $prayer }}', {{ $prayerIndex }}) || '{{ $status ?? '' }}' === 'qada'"
                                    :class="{
                                        'opacity-50 cursor-not-allowed': (!isToday() || !isPrayerCurrentlyAvailable('{{ $prayer }}', {{ $prayerIndex }}) || '{{ $status ?? '' }}' === 'qada'),
                                        'text-gray-400': (isToday() && !isPrayerCurrentlyAvailable('{{ $prayer }}', {{ $prayerIndex }})),
                                        'bg-amber-400 text-white shadow-md': ('{{ $status ?? '' }}' === 'qada'),
                                        'bg-gray-100 hover:bg-amber-100 text-gray-500': ('{{ $status ?? '' }}' !== 'qada')
                                    }"
                                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm transition-all duration-200 hover:scale-110 active:scale-95">
                                ↩
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
                    <span class="w-3 h-3 rounded-full bg-amber-400 inline-block"></span>
                    Sebagian
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-gray-200 inline-block"></span>
                    Belum dicatat
                </span>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             KALENDER BULAN INI
        ══════════════════════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-8 mb-6">
            <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-5 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600">📅</span>
                {{ now()->locale('id')->isoFormat('MMMM YYYY') }}
            </h2>
            <div class="grid grid-cols-7 gap-1.5">
                @foreach(['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $dayLabel)
                    <div class="text-center text-xs font-semibold text-gray-400 pb-1">{{ $dayLabel }}</div>
                @endforeach

                {{-- Offset awal bulan --}}
                @php
                    $startOfMonth = now()->startOfMonth();
                    $dayOfWeek    = $startOfMonth->dayOfWeek; // 0=Sun,1=Mon,...
                    $offset       = $dayOfWeek === 0 ? 6 : $dayOfWeek - 1;
                @endphp
                @for($i = 0; $i < $offset; $i++)
                    <div></div>
                @endfor

                @foreach($monthlyStats as $day)
                <div class="aspect-square rounded-lg flex items-center justify-center text-xs font-semibold
                            {{ $day['is_today'] ? 'ring-2 ring-teal-500 ring-offset-1' : '' }}
                            {{ $day['performed'] === 5 ? 'bg-gradient-to-br from-teal-400 to-emerald-500 text-white' :
                               ($day['performed'] > 0  ? 'bg-amber-100 text-amber-700' :
                                                         'bg-gray-100 text-gray-400') }}">
                    {{ $day['day'] }}
                </div>
                @endforeach
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════════
             HISTORI TABEL
        ═════════════════════════════════════════════════════════════════ --}}
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

        init() {
            // Optional: you might want to refresh currentServerTime every second if real-time update is desired
            // setInterval(() => { this.currentServerTime = new Date().toLocaleTimeString('en-GB', {hour: '2-digit', minute:'2-digit'}); }, 1000);
        },

        getPrayerClass(prayer) {
            const s = this.prayerStatus[prayer]?.status;
            if (s === 'performed') return 'border-teal-200 bg-teal-50';
            if (s === 'qada')      return 'border-amber-200 bg-amber-50';
            // Removed 'missed' status from here
            return 'border-gray-200 bg-gray-50';
        },

        isToday() {
            return this.selectedDate === this.today;
        },

        prevDay() {
            const d = new Date(this.selectedDate);
            d.setDate(d.getDate() - 1);
            this.selectedDate = d.toISOString().split('T')[0];
            this.loadDay();
        },

        nextDay() {
            if (this.selectedDate >= this.today) return;
            const d = new Date(this.selectedDate);
            d.setDate(d.getDate() + 1);
            this.selectedDate = d.toISOString().split('T')[0];
            this.loadDay();
        },

        loadDay() {
            window.location.href = '{{ route("prayer-tracking.index") }}?date=' + this.selectedDate;
        },

        // New logic for prayer button availability
        isPrayerCurrentlyAvailable(prayerName, prayerIndex) {
            if (!this.isToday()) {
                return true; // Always available for past days
            }

            const currentTime = new Date(`2000-01-01T${this.currentServerTime}:00`); // Use a dummy date for time comparison
            const prayerStartTimeStr = this.prayerTimes[prayerName];
            const prayerStartTime = new Date(`2000-01-01T${prayerStartTimeStr}:00`);

            let nextPrayerStartTime = new Date('2000-01-01T23:59:59'); // Default to end of day for Isha
            if (prayerIndex < this.allPrayers.length - 1) {
                const nextPrayerName = this.allPrayers[prayerIndex + 1];
                const nextPrayerStartTimeStr = this.prayerTimes[nextPrayerName];
                nextPrayerStartTime = new Date(`2000-01-01T${nextPrayerStartTimeStr}:00`);
            }

            // Prayer is available if current time is >= its start time AND < next prayer's start time
            return currentTime >= prayerStartTime && currentTime < nextPrayerStartTime;
        },

        // New function to get the appropriate icon
        getPrayerButtonIcon(prayerName, statusType, prayerIndex, currentStatus) {
            const normalizedCurrentStatus = currentStatus || ''; // Normalize to empty string if null/undefined

            // If already tracked, show solid checkmark for performed, or original icon for qada
            if (statusType === 'performed' && normalizedCurrentStatus === 'performed') return '✓';
            if (statusType === 'qada' && normalizedCurrentStatus === 'qada') return '↩';
            // No 'missed' status anymore in UI

            // If not currently available (for today's prayers)
            if (this.isToday() && !this.isPrayerCurrentlyAvailable(prayerName, prayerIndex)) {
                return '—'; // Use em dash for visually inactive/disabled
            }

            // If available and not yet tracked
            if (statusType === 'performed') return '&#9675;'; // Empty circle for performed
            if (statusType === 'qada') return '↩';
            // No 'missed' status anymore in UI
            
            return ''; // Final fallback
        },

        // New function to get the appropriate tooltip
        getPrayerButtonTooltip(prayerName, statusType, prayerIndex, currentStatus) {
            if (this.isToday() && !this.isPrayerCurrentlyAvailable(prayerName, prayerIndex)) {
                return 'Belum masuk waktu shalat';
            }
            if (currentStatus === statusType) {
                if (statusType === 'performed') return 'Sudah tercatat: Terlaksana';
                if (statusType === 'qada') return 'Sudah tercatat: Qada';
                // No 'missed' status anymore in UI
            }
            if (statusType === 'performed') return 'Tandai sebagai Terlaksana';
            if (statusType === 'qada') return 'Tandai sebagai Qada';
            // No 'missed' status anymore in UI

            return ''; // Fallback to empty string
        },

        async updatePrayer(prayerName, status, date) {
            // Prevent submission if not today AND not available, or if already has this status
            const isButtonDisabled = this.isToday() && (!this.isPrayerCurrentlyAvailable(prayerName, this.allPrayers.indexOf(prayerName)) || this.prayerStatus[prayerName]?.status === status);
            
            if (isButtonDisabled) {
                this.showFlash('🚫 Aksi tidak diizinkan saat ini.');
                return;
            }

            try {
                const res = await fetch('{{ route("prayer-tracking.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ prayer_name: prayerName, prayer_date: date, status, notes: '' }), // notes hardcoded to empty string
                });
                const data = await res.json();
                if (data.success) {
                    if (!this.prayerStatus[prayerName]) this.prayerStatus[prayerName] = {};
                    this.prayerStatus[prayerName].status = status;
                    this.showFlash('✅ ' + data.message);
                } else {
                    this.showFlash('🚫 ' + data.message); // Display error message from backend
                }
            } catch (e) {
                this.showFlash('❌ Gagal menyimpan. Coba lagi.');
            }
        },

        showFlash(msg) {
            this.flashMsg = msg;
            clearTimeout(this.flashTimer);
            this.flashTimer = setTimeout(() => { this.flashMsg = ''; }, 3000);
        },
    };
}
</script>
@endpush

@push('styles')
<style>
    .prayer-row { transition: all 0.2s ease; }
    .prayer-row:hover { transform: translateX(2px); }
</style>
@endpush

@push('styles')
<style>
    .prayer-row { transition: all 0.2s ease; }
    .prayer-row:hover { transform: translateX(2px); }
</style>
@endpush