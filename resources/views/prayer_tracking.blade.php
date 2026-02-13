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
             x-data="prayerTracker()"
             x-init="init()">

            <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600 text-base">📋</span>
                Catat Shalat - {{ $userCity }}
            </h2>

            {{-- Debug Info --}}
            <div class="mb-4 p-3 bg-gray-50 rounded-lg text-xs">
                <strong>DEBUG:</strong> 
                Waktu Sekarang: {{ $currentServerTime }} | 
                Shalat Berikutnya: {{ ucfirst($nextPrayer['name']) }} ({{ $nextPrayer['time'] }})
            </div>

            {{-- Shalat Cards --}}
            <div class="space-y-3">
                @foreach($prayers as $prayerIndex => $prayer)
                @php
                    $rec = $todayPrayers->get($prayer);
                    $status = $rec ? $rec->status : null;
                @endphp
                <div class="prayer-row border rounded-xl p-4 transition-all duration-300
                    {{ $status === 'performed' ? 'border-teal-200 bg-teal-50' : 'border-gray-200 bg-gray-50' }}">

                    <div class="flex items-center gap-3">
                        {{-- Icon & Nama --}}
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl flex-shrink-0
                                    {{ $status === 'performed' ? 'bg-teal-100' : 'bg-gray-100' }}">
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
                                @if($status === 'performed')
                                    <span class="text-teal-600 font-medium">✓ Terlaksana</span>
                                @else
                                    <span class="text-gray-400">Belum dicatat</span>
                                @endif
                            </div>
                        </div>

                        {{-- Tombol Status (TANPA DISABLE DULU) --}}
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <button
                                @click="updatePrayer('{{ $prayer }}', '{{ $status === 'performed' ? '' : 'performed' }}')"
                                class="w-9 h-9 rounded-lg flex items-center justify-center text-sm transition-all duration-200
                                    hover:scale-110 active:scale-95
                                    {{ $status === 'performed' ? 'bg-teal-500 text-white shadow-md' : 'bg-gray-200 hover:bg-teal-100 text-gray-600' }}">
                                ✓
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

@push('scripts')
<script>
function prayerTracker() {
    return {
        selectedDate: '{{ $selectedDate }}',
        today: '{{ now()->toDateString() }}',
        flashMsg: '',
        flashTimer: null,

        init() {
            console.log('Prayer Tracker initialized');
            console.log('Selected date:', this.selectedDate);
            console.log('Today:', this.today);
        },

        async updatePrayer(prayer, status) {
            console.log('Button clicked!', prayer, status);
            
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

                console.log('Response status:', res.status);
                const data = await res.json();
                console.log('Response data:', data);

                if (data.success) {
                    this.showFlash('✅ ' + data.message);
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