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

        {{-- PILIH LOKASI --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-6 mb-6">
            <div class="flex flex-col md:flex-row gap-4 md:items-end">

                <div class="flex-1">
                    <label class="text-sm font-semibold text-gray-600">
                        📍 Lokasi Waktu Shalat
                    </label>

                    <div class="relative mt-2" id="cityAutocomplete">
                        <input
                            type="text"
                            id="cityInput"
                            placeholder="Ketik nama kota/kabupaten..."
                            autocomplete="off"
                            value="{{ $userCity }}"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                            oninput="onCityInput(this.value)"
                        />
                        {{-- Hidden fields untuk menyimpan data terpilih --}}
                        <input type="hidden" id="cityLat" value="">
                        <input type="hidden" id="cityLng" value="">
                        <input type="hidden" id="cityName" value="{{ $userCity }}">

                        {{-- Dropdown suggestions --}}
                        <ul id="citySuggestions"
                            class="absolute z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 max-h-56 overflow-y-auto hidden">
                        </ul>
                    </div>
                </div>

                {{-- Tombol GPS --}}
                <button type="button" id="gpsBtn" onclick="useGPS()"
                    class="flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition whitespace-nowrap">
                    <svg id="gpsIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span id="gpsBtnText">Lokasi Saya</span>
                </button>

                {{-- Tombol Simpan --}}
                <button type="button" onclick="saveLocation()"
                    class="px-6 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition">
                    Simpan
                </button>

            </div>

            {{-- Status GPS --}}
            <div id="gpsStatus" class="hidden mt-2 text-xs font-medium"></div>

            <p class="text-xs text-gray-400 mt-2">
                💡 Ketik nama kota/kabupaten <span class="text-gray-500 font-medium">atau</span> klik <span class="text-emerald-600 font-semibold">Lokasi Saya</span> untuk akurat sampai level kecamatan
            </p>
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
                    dari {{ now()->daysInMonth * 5 }} target
                </div>
            </div>
        </div>

        {{-- WAKTU IMSAK & BUKA PUASA --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-8 mb-6">
            <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-5 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600">🌙</span>
                Waktu Puasa
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Card Imsak/Sahur --}}
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-5 border-2 border-purple-200">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-3xl">🌄</span>
                        <div>
                            <div class="text-sm text-purple-600 font-semibold">Imsak / Akhir Sahur</div>
                            <div class="text-2xl font-bold text-purple-800">{{ $imsakTime }}</div>
                        </div>
                    </div>
                    <div class="text-xs text-purple-600 mt-2">
                        ⏰ 10 menit sebelum Subuh ({{ $prayerTimes['fajr'] }})
                    </div>
                </div>

                {{-- Card Buka Puasa --}}
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-5 border-2 border-orange-200">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-3xl">🌆</span>
                        <div>
                            <div class="text-sm text-orange-600 font-semibold">Waktu Buka Puasa</div>
                            <div class="text-2xl font-bold text-orange-800">{{ $bukaTime }}</div>
                        </div>
                    </div>
                    <div class="text-xs text-orange-600 mt-2">
                        🕌 Bersamaan dengan waktu Maghrib
                    </div>
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

            {{-- Shalat Cards --}}
            <div class="space-y-3">
                @foreach($prayers as $prayerIndex => $prayer)
                @php
                    $rec = $todayPrayers->get($prayer);
                    $status = $rec ? $rec->status : null;

                    $currentTime    = \Carbon\Carbon::now($locationTimezone ?? config('app.timezone'))->format('H:i');
                    $prayerTime     = $prayerTimes[$prayer];
                    $currentTimeObj = \Carbon\Carbon::createFromFormat('H:i', $currentTime);
                    $prayerTimeObj  = \Carbon\Carbon::createFromFormat('H:i', $prayerTime);
                    $isTimeReached  = $currentTimeObj->greaterThanOrEqualTo($prayerTimeObj);
                    $isToday        = $selectedDate === now()->toDateString();
                    $canCheck       = !$isToday || $isTimeReached;
                @endphp
                <div class="prayer-row border rounded-xl p-4 transition-all duration-300
                    {{ $status === 'performed' ? 'border-teal-200 bg-teal-50' : 'border-gray-200 bg-gray-50' }}
                    {{ !$canCheck && $status !== 'performed' ? 'opacity-60' : '' }}">

                    <div class="flex items-center gap-3">
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
                                @if(isset($nextPrayer) && $nextPrayer['name'] === $prayer && $isToday)
                                    <span class="text-xs bg-amber-100 text-amber-600 px-2 py-0.5 rounded-full font-medium">
                                        Berikutnya
                                    </span>
                                @endif
                            </div>
                            @if($status)
                                <div class="text-xs mt-0.5
                                    {{ $status === 'performed' ? 'text-teal-500' :
                                       ($status === 'qada' ? 'text-amber-500' : 'text-red-400') }}">
                                    {{ $status === 'performed' ? '✓ Tepat waktu' :
                                       ($status === 'qada' ? '⏰ Qada' : '✗ Terlewat') }}
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            @if($status === 'performed')
                                <button
                                    @click="updatePrayer('{{ $prayer }}', 'remove')"
                                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm transition-all duration-200
                                        bg-teal-500 text-white shadow-md hover:bg-teal-600 hover:scale-110 active:scale-95">
                                    ✓
                                </button>
                            @elseif($canCheck)
                                <button
                                    @click="updatePrayer('{{ $prayer }}', 'performed')"
                                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm transition-all duration-200
                                        bg-gray-200 hover:bg-teal-100 text-gray-600 hover:scale-110 active:scale-95">
                                    ✓
                                </button>
                            @else
                                <button
                                    disabled
                                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm
                                        bg-gray-300 text-gray-500 cursor-not-allowed opacity-60">
                                    🔒
                                </button>
                            @endif
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
// ── Prayer Tracker (Alpine.js) ─────────────────────────────────────────────
function prayerTracker() {
    return {
        selectedDate: '{{ $selectedDate }}',
        today: '{{ now()->toDateString() }}',
        flashMsg: '',
        flashTimer: null,

        init() {
            console.log('Prayer Tracker initialized');
        },

        async updatePrayer(prayer, status) {
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
                    this.showFlash('✅ ' + data.message);
                    setTimeout(() => window.location.reload(), 500);
                } else {
                    this.showFlash('🚫 ' + data.message);
                }
            } catch (error) {
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

// ── Autocomplete Lokasi ────────────────────────────────────────────────────
let autocompleteTimeout = null;

async function onCityInput(query) {
    clearTimeout(autocompleteTimeout);
    const list  = document.getElementById('citySuggestions');
    const input = document.getElementById('cityInput');

    // Reset pilihan saat user ketik ulang — hapus data di hidden fields
    document.getElementById('cityLat').value  = '';
    document.getElementById('cityLng').value  = '';
    document.getElementById('cityName').value = '';
    input.removeAttribute('data-selected');
    input.classList.remove('border-teal-400', 'border-red-400');
    input.classList.add('border-gray-200');

    if (query.length < 2) {
        list.classList.add('hidden');
        return;
    }

    autocompleteTimeout = setTimeout(async () => {
        try {
            const res = await fetch(
                '{{ route("prayer-tracking.search-cities") }}?q=' + encodeURIComponent(query),
                { headers: { 'Accept': 'application/json' } }
            );
            const cities = await res.json();

            list.innerHTML = '';

            if (cities.length === 0) {
                list.innerHTML = '<li class="px-4 py-3 text-gray-400 text-sm">Tidak ditemukan</li>';
            } else {
                cities.forEach(city => {
                    const li = document.createElement('li');
                    li.className = 'px-4 py-2.5 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700 cursor-pointer border-b border-gray-50 last:border-0';
                    li.textContent = city.name;
                    li.addEventListener('mousedown', (e) => {
                        // mousedown bukan click agar tidak tertutup oleh blur event
                        e.preventDefault();
                        selectCity(city);
                    });
                    list.appendChild(li);
                });
            }

            list.classList.remove('hidden');
        } catch (err) {
            console.error('Autocomplete error:', err);
        }
    }, 250);
}

function selectCity(city) {
    const input = document.getElementById('cityInput');

    // Simpan semua data ke hidden fields + data-attribute sebagai penanda
    input.value = city.name;
    input.setAttribute('data-selected', '1');
    document.getElementById('cityName').value = city.name;
    document.getElementById('cityLat').value  = String(city.lat);
    document.getElementById('cityLng').value  = String(city.lng);
    document.getElementById('citySuggestions').classList.add('hidden');

    // Visual konfirmasi — border hijau
    input.classList.remove('border-gray-200', 'border-red-400');
    input.classList.add('border-teal-400');

    console.log('City selected:', city.name, city.lat, city.lng);
}

// Tutup dropdown saat blur (klik di luar)
document.addEventListener('click', function (e) {
    const wrapper = document.getElementById('cityAutocomplete');
    if (wrapper && !wrapper.contains(e.target)) {
        document.getElementById('citySuggestions').classList.add('hidden');
    }
});

// ── GPS Lokasi Otomatis ────────────────────────────────────────────────────
function useGPS() {
    if (!navigator.geolocation) {
        showGpsStatus('❌ Browser tidak mendukung GPS', 'text-red-500');
        return;
    }

    const btn      = document.getElementById('gpsBtn');
    const btnText  = document.getElementById('gpsBtnText');
    const gpsIcon  = document.getElementById('gpsIcon');

    // Loading state
    btn.disabled = true;
    btn.classList.add('opacity-70', 'cursor-not-allowed');
    btnText.textContent = 'Mendeteksi...';
    gpsIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>`;
    showGpsStatus('📡 Mendeteksi lokasi GPS...', 'text-emerald-600');

    navigator.geolocation.getCurrentPosition(
        async (position) => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // Reverse geocode pakai nominatim untuk dapat nama lokasi
            try {
                const res = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&accept-language=id`,
                    { headers: { 'Accept': 'application/json' } }
                );
                const geo = await res.json();

                // Ambil nama kecamatan/kabupaten dari hasil reverse geocode
                const addr      = geo.address || {};
                const cityName  = addr.village
                    || addr.suburb
                    || addr.town
                    || addr.city_district
                    || addr.county
                    || addr.city
                    || addr.state
                    || 'Lokasi GPS';

                // Isi input dan hidden fields
                document.getElementById('cityInput').value = cityName;
                document.getElementById('cityName').value  = cityName;
                document.getElementById('cityLat').value   = String(lat);
                document.getElementById('cityLng').value   = String(lng);
                document.getElementById('cityInput').setAttribute('data-selected', '1');
                document.getElementById('cityInput').classList.remove('border-gray-200', 'border-red-400');
                document.getElementById('cityInput').classList.add('border-emerald-400');

                showGpsStatus(`✅ Lokasi terdeteksi: ${cityName}`, 'text-emerald-600');

            } catch (e) {
                // Kalau reverse geocode gagal, tetap pakai koordinat tanpa nama
                document.getElementById('cityInput').value = 'Lokasi GPS';
                document.getElementById('cityName').value  = 'Lokasi GPS';
                document.getElementById('cityLat').value   = String(lat);
                document.getElementById('cityLng').value   = String(lng);
                document.getElementById('cityInput').setAttribute('data-selected', '1');
                showGpsStatus('✅ Koordinat GPS berhasil didapat', 'text-emerald-600');
            }

            // Reset button
            btn.disabled = false;
            btn.classList.remove('opacity-70', 'cursor-not-allowed');
            btnText.textContent = 'Lokasi Saya';
            gpsIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>`;
        },
        (error) => {
            let msg = '❌ Gagal mendapatkan lokasi';
            if (error.code === 1) msg = '❌ Izin lokasi ditolak. Aktifkan di pengaturan browser.';
            if (error.code === 2) msg = '❌ Lokasi tidak tersedia, coba lagi.';
            if (error.code === 3) msg = '❌ Timeout, coba lagi.';

            showGpsStatus(msg, 'text-red-500');
            btn.disabled = false;
            btn.classList.remove('opacity-70', 'cursor-not-allowed');
            btnText.textContent = 'Lokasi Saya';
        },
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
    );
}

function showGpsStatus(msg, colorClass) {
    const el = document.getElementById('gpsStatus');
    el.className = `mt-2 text-xs font-medium ${colorClass}`;
    el.textContent = msg;
    el.classList.remove('hidden');
}


async function saveLocation() {
    const input = document.getElementById('cityInput');
    const lat   = document.getElementById('cityLat').value;
    const lng   = document.getElementById('cityLng').value;
    const city  = document.getElementById('cityName').value;

    console.log('saveLocation called — city:', city, 'lat:', lat, 'lng:', lng, 'data-selected:', input.getAttribute('data-selected'));

    // Validasi: lat & lng harus terisi (hanya ada jika user klik dari dropdown)
    if (!lat || !lng || !city || !input.getAttribute('data-selected')) {
        input.classList.remove('border-gray-200', 'border-teal-400');
        input.classList.add('border-red-400');
        input.focus();
        const originalPlaceholder = input.placeholder;
        input.placeholder = '⚠️ Pilih dari daftar saran terlebih dahulu!';
        setTimeout(() => {
            input.placeholder = originalPlaceholder;
            input.classList.remove('border-red-400');
            input.classList.add('border-gray-200');
        }, 2500);
        return;
    }

    try {
        const res = await fetch('{{ route("prayer-tracking.set-location") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                city     : city,
                latitude : parseFloat(lat),
                longitude: parseFloat(lng)
            })
        });

        const data = await res.json();
        console.log('setLocation response:', data);

        if (data.success) {
            window.location.reload();
        } else {
            alert('Gagal menyimpan lokasi');
        }
    } catch (err) {
        console.error(err);
        alert('Terjadi kesalahan');
    }
}
</script>
@endpush

@push('styles')
<style>
    .prayer-row {
        transition: all 0.2s ease;
    }

    button:disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }

    button:disabled:hover {
        transform: none !important;
    }
</style>
@endpush