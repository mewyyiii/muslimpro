@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-500 py-8 md:py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- DATE HEADER --}}
        @php
            // ── Pure-PHP Hijri converter (no calendar extension required) ──
            // Algorithm: Fliegel & Van Flandern via Julian Day Number
            $d = (int)\Carbon\Carbon::parse($selectedDate)->format('d');
            $m = (int)\Carbon\Carbon::parse($selectedDate)->format('m');
            $y = (int)\Carbon\Carbon::parse($selectedDate)->format('Y');

            // Gregorian → Julian Day Number
            $jdn = (int)(365.25 * ($y + 4716))
                 + (int)(30.6001 * ($m + 1))
                 + $d - 1524;
            if ($m <= 2) {
                $jdn = (int)(365.25 * ($y - 1 + 4716))
                     + (int)(30.6001 * ($m + 13))
                     + $d - 1524;
            }
            $a = $jdn - 1867216 - 1;
            // Gregorian correction
            $b = (int)(($jdn + 0.5 - 1867216.25) / 36524.25);
            if ($jdn >= 2299161) {
                $a = $jdn + 1 + $b - (int)($b / 4);
            }

            // JDN → Islamic
            $l  = $jdn - 1948440 + 10632;
            $n  = (int)(($l - 1) / 10631);
            $l  = $l - 10631 * $n + 354;
            $j  = (int)((10985 - $l) / 5316) * (int)((50 * $l) / 17719)
                + (int)($l / 5670) * (int)((43 * $l) / 15238);
            $l  = $l - (int)((30 - $j) / 15) * (int)((17719 * $j) / 50)
                - (int)($j / 16) * (int)((15238 * $j) / 43) + 29;
            $hYear  = 30 * $n + $j - 29;
            $hMonth = (int)(24 * $l / 709);
            $hDay   = $l - (int)(709 * $hMonth / 24);

            $hijriMonths = ['Muharram','Safar','Rabiul Awal','Rabiul Akhir',
                            'Jumadil Awal','Jumadil Akhir','Rajab','Syaban',
                            'Ramadan','Syawal','Dzulkaidah','Dzulhijjah'];
            $hijriMonthName = $hijriMonths[$hMonth - 1] ?? '';
        @endphp

        <div class="mb-5">
            <div class="text-white text-xl md:text-2xl font-bold drop-shadow">
                {{ \Carbon\Carbon::parse($selectedDate)->locale('id')->translatedFormat('l, j F Y') }}
            </div>
            <div class="text-white/75 text-sm font-medium mt-0.5">
                {{ $hDay }} {{ $hijriMonthName }} {{ $hYear }} H
            </div>
        </div>

        {{-- PILIH LOKASI --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-6 mb-6">
            <div class="flex flex-col md:flex-row gap-4 md:items-end">

                <div class="flex-1">
                    <label class="text-sm font-semibold text-gray-600">
                        Lokasi Waktu Shalat
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
                    <svg id="gpsIcon" class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span id="gpsBtnText">Lokasi Saya</span>
                </button>

                {{-- Tombol Pilih di Peta --}}
                <button type="button" onclick="openMapPicker()"
                    class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition whitespace-nowrap">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span>Pilih di Peta</span>
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
                Ketik nama kota/kabupaten <span class="font-medium text-gray-500">atau</span> klik <span class="text-emerald-600 font-semibold">Lokasi Saya</span> untuk akurat sampai kecamatan
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

            {{-- Next Prayer Reminder --}}
            <div class="bg-white rounded-2xl p-4 md:p-6 shadow-xl text-center">
                @if(isset($nextPrayer) && $selectedDate === now()->toDateString())
                    @php
                        $npNames = ['fajr'=>'Subuh','dhuhr'=>'Dzuhur','asr'=>'Ashar','maghrib'=>'Maghrib','isha'=>'Isya'];
                        $npSvg = [
                            'fajr'    => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><path d="M12 3V5M5.5 6.5L7 8M18.5 6.5L17 8M3 13H5M19 13H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M8 13C8 10.79 9.79 9 12 9C14.21 9 16 10.79 16 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M3 17H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M6 20H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
                            'dhuhr'   => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><circle cx="12" cy="12" r="4" fill="currentColor"/><path d="M12 2V4M12 20V22M2 12H4M20 12H22M5.5 5.5L7 7M17 17L18.5 18.5M5.5 18.5L7 17M17 7L18.5 5.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
                            'asr'     => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.8"/><path d="M12 2V4M12 20V22M2 12H4M20 12H22M5.5 5.5L7 7M17 17L18.5 18.5M5.5 18.5L7 17M17 7L18.5 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M4 18L20 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
                            'maghrib' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><path d="M5 12C5 8.13 8.13 5 12 5C14.76 5 17.16 6.53 18.42 8.82" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.8"/><path d="M3 17H21M6 20H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
                            'isha'    => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        ];
                        $npKey   = $nextPrayer['name'];
                        $npTime  = $nextPrayer['time'];
                        $remMin  = (int)($nextPrayer['remaining_minutes'] ?? 0);
                        $remH    = floor($remMin / 60);
                        $remM    = $remMin % 60;
                        $countdownStr = $remH > 0 ? "{$remH}j {$remM}m lagi" : "{$remM}m lagi";
                    @endphp
                    <div class="flex justify-center mb-0.5 text-teal-500">{!! $npSvg[$npKey] ?? '<svg viewBox="0 0 24 24" fill="none" class="w-6 h-6"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>' !!}</div>
                    <div class="text-2xl md:text-3xl font-bold text-teal-600 leading-tight">{{ $npTime }}</div>
                    <div class="text-xs md:text-sm text-gray-500 font-medium mt-0.5">{{ $npNames[$npKey] ?? ucfirst($npKey) }}</div>
                    <div class="mt-2 text-xs font-semibold text-teal-500 bg-teal-50 rounded-full px-3 py-0.5 inline-block">
                        {{ $countdownStr }}
                    </div>
                @else
                    <div class="flex justify-center mb-1"><svg class="w-8 h-8 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9" stroke-width="2"/><polyline points="9 12 11 14 15 10"/></svg></div>
                    <div class="text-xl font-bold text-emerald-600">Selesai</div>
                    <div class="text-xs text-gray-500 font-medium mt-0.5">Shalat Hari Ini</div>
                    <div class="mt-2 text-xs text-emerald-400 font-medium">Alhamdulillah!</div>
                @endif
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
                <span class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                Waktu Puasa
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Card Imsak/Sahur --}}
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-5 border-2 border-purple-200">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-3xl flex items-center justify-center w-12 h-12 bg-purple-200 rounded-xl text-purple-700"><svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 3V5M5.5 6.5L7 8M18.5 6.5L17 8M3 13H5M19 13H21"/><path d="M8 13C8 10.79 9.79 9 12 9C14.21 9 16 10.79 16 13"/><path d="M3 17H21"/><path d="M6 20H18"/></svg></span>
                        <div>
                            <div class="text-sm text-purple-600 font-semibold">Imsak / Akhir Sahur</div>
                            <div class="text-2xl font-bold text-purple-800">{{ $imsakTime }}</div>
                        </div>
                    </div>
                    <div class="text-xs text-purple-600 mt-2">
                        <svg class="w-3.5 h-3.5 inline-block mr-1 -mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M12 6v6l4 2"/><path d="M6.5 3.5L4 6M17.5 3.5L20 6"/></svg> 10 menit sebelum Subuh ({{ $prayerTimes['fajr'] }})
                    </div>
                </div>

                {{-- Card Buka Puasa --}}
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-5 border-2 border-orange-200">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-3xl flex items-center justify-center w-12 h-12 bg-orange-200 rounded-xl text-orange-700"><svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M5 12C5 8.13 8.13 5 12 5C14.76 5 17.16 6.53 18.42 8.82"/><circle cx="12" cy="12" r="3.5" stroke-width="1.8"/><path d="M3 17H21M6 20H18"/></svg></span>
                        <div>
                            <div class="text-sm text-orange-600 font-semibold">Waktu Buka Puasa</div>
                            <div class="text-2xl font-bold text-orange-800">{{ $bukaTime }}</div>
                        </div>
                    </div>
                    <div class="text-xs text-orange-600 mt-2">
                        <svg class="w-3.5 h-3.5 inline-block mr-1 -mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V10l7-7 7 7v11M9 21v-6h6v6"/><path d="M12 3v4M10 7h4"/></svg> Bersamaan dengan waktu Maghrib
                    </div>
                </div>
            </div>
        </div>

        {{-- CHECKLIST SHALAT HARIAN --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-8 mb-6"
             x-data="prayerTracker()"
             x-init="init()">

            <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600 text-base"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="2" width="8" height="4" rx="1"/><path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/><path d="M9 12l2 2 4-4"/></svg></span>
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
                    {{ $status === 'performed' ? 'border-teal-200 bg-teal-50' : 'border-gray-100 bg-white' }}"
                >

                    @php
                        $prayerSvg = [
                            'fajr'    => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M12 3V5M5.5 6.5L7 8M18.5 6.5L17 8M3 13H5M19 13H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M8 13C8 10.79 9.79 9 12 9C14.21 9 16 10.79 16 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M3 17H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M6 20H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
                            'dhuhr'   => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><circle cx="12" cy="12" r="4" fill="currentColor"/><path d="M12 2V4M12 20V22M2 12H4M20 12H22M5.5 5.5L7 7M17 17L18.5 18.5M5.5 18.5L7 17M17 7L18.5 5.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
                            'asr'     => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.8"/><path d="M12 2V4M12 20V22M2 12H4M20 12H22M5.5 5.5L7 7M17 17L18.5 18.5M5.5 18.5L7 17M17 7L18.5 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M4 18L20 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
                            'maghrib' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M5 12C5 8.13 8.13 5 12 5C14.76 5 17.16 6.53 18.42 8.82" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.8"/><path d="M3 17H21M6 20H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
                            'isha'    => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                        ];
                    @endphp
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                                    {{ $status === 'performed' ? 'bg-teal-100 text-teal-600' : 'bg-gray-100 text-gray-500' }}">
                            {!! $prayerSvg[$prayer] !!}
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
                                {{-- Sudah shalat: lingkaran teal berisi centang --}}
                                <button
                                    @click="updatePrayer('{{ $prayer }}', 'remove')"
                                    class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-200
                                        bg-teal-500 text-white shadow-md hover:bg-teal-600 hover:scale-110 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                </button>
                            @elseif($canCheck)
                                {{-- Waktunya sudah tiba, belum shalat: lingkaran outline kosong --}}
                                <button
                                    @click="updatePrayer('{{ $prayer }}', 'performed')"
                                    class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-200
                                        border-2 border-gray-300 bg-white hover:border-teal-400 hover:bg-teal-50 hover:scale-110 active:scale-95">
                                </button>
                            @else
                                {{-- Belum waktunya: lingkaran outline kosong, redup --}}
                                <button
                                    disabled
                                    class="w-10 h-10 rounded-full flex items-center justify-center
                                        border-2 border-gray-200 bg-white opacity-40 cursor-not-allowed">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"><rect x="5" y="11" width="14" height="10" rx="2" stroke="currentColor" stroke-width="2"/><path d="M8 11V7a4 4 0 018 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
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
                <span class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="12" width="4" height="9" rx="1"/><rect x="10" y="7" width="4" height="14" rx="1"/><rect x="17" y="3" width="4" height="18" rx="1"/></svg></span>
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

{{-- ══ MAP PICKER MODAL ══════════════════════════════════════════════ --}}
<div id="mapPickerModal"
     class="fixed inset-0 z-50 items-center justify-center bg-black/60 backdrop-blur-sm"
     style="display:none; padding: 16px">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl flex flex-col"
         style="height: min(90vh, 620px)">

        {{-- Header --}}
        <div class="flex items-center justify-between px-5 py-3 border-b border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-base">Pilih Lokasi di Peta</h3>
                    <p class="text-xs text-gray-400">Klik titik manapun di peta untuk menentukan lokasi</p>
                </div>
            </div>
            <button onclick="closeMapPicker()"
                    class="w-8 h-8 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 transition flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Search inside modal --}}
        <div class="px-4 py-2.5 border-b border-gray-100 bg-gray-50 flex-shrink-0">
            <div class="flex gap-2">
                <input id="mapSearchInput"
                       type="text"
                       placeholder="Cari kota atau alamat..."
                       class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                       onkeydown="if(event.key==='Enter') searchOnMap()"/>
                <button onclick="searchOnMap()"
                        class="px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition whitespace-nowrap">
                    Cari
                </button>
                <button onclick="centerToMyGPS()"
                        title="Pakai GPS saya"
                        class="px-3 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Map — mengisi sisa ruang --}}
        <div id="leafletMap" style="flex:1; min-height:0; z-index:1; overflow:hidden"></div>

        {{-- Footer: info lokasi + tombol -- selalu di bawah, tidak pernah terpotong --}}
        <div class="px-4 py-3 border-t border-gray-100 bg-white flex-shrink-0">
            {{-- Info lokasi dipilih --}}
            <div id="mapSelectedInfo" class="hidden items-center gap-3 mb-2.5">
                <div class="w-7 h-7 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-400">Lokasi dipilih</p>
                    <p id="mapSelectedName" class="text-sm font-semibold text-gray-800 truncate">—</p>
                    <p id="mapSelectedCoords" class="text-xs text-gray-400 font-mono"></p>
                </div>
            </div>
            <p id="mapHint" class="text-xs text-gray-400 mb-2.5"> Klik di peta untuk menentukan lokasi shalat</p>

            {{-- Tombol aksi --}}
            <div class="flex gap-2">
                <button onclick="closeMapPicker()"
                        class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-600 font-semibold rounded-xl hover:bg-gray-200 transition text-sm">
                    Batal
                </button>
                <button id="mapConfirmBtn"
                        onclick="confirmMapLocation()"
                        disabled
                        class="flex-1 px-4 py-2.5 bg-teal-500 text-white font-bold rounded-xl hover:bg-teal-600 transition text-sm disabled:opacity-40 disabled:cursor-not-allowed">
                    ✓ Gunakan Lokasi Ini
                </button>
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

// ── GPS Lokasi Otomatis ────────────────────────────────────────────────────
function useGPS() {
    if (!navigator.geolocation) {
        showGpsStatus('❌ Browser tidak mendukung GPS', 'text-red-500');
        return;
    }

    const btn     = document.getElementById('gpsBtn');
    const btnText = document.getElementById('gpsBtnText');
    const gpsIcon = document.getElementById('gpsIcon');

    // Loading state
    btn.disabled = true;
    btn.classList.add('opacity-70', 'cursor-not-allowed');
    btnText.textContent = 'Mendeteksi...';
    showGpsStatus('📡 Mendeteksi lokasi GPS...', 'text-emerald-600');

    navigator.geolocation.getCurrentPosition(
        async (position) => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // Reverse geocode → nama kecamatan/desa
            try {
                const res = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&accept-language=id`,
                    { headers: { 'Accept': 'application/json' } }
                );
                const geo  = await res.json();
                const addr = geo.address || {};
                const cityName = addr.village
                    || addr.suburb
                    || addr.town
                    || addr.city_district
                    || addr.county
                    || addr.city
                    || addr.state
                    || 'Lokasi GPS';

                setGpsCity(cityName, lat, lng);
                showGpsStatus(`✅ Lokasi: ${cityName}`, 'text-emerald-600');
            } catch (e) {
                setGpsCity('Lokasi GPS', lat, lng);
                showGpsStatus('✅ Koordinat GPS berhasil didapat', 'text-emerald-600');
            }

            // Reset button
            btn.disabled = false;
            btn.classList.remove('opacity-70', 'cursor-not-allowed');
            btnText.textContent = 'Lokasi Saya';
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

function setGpsCity(name, lat, lng) {
    const input = document.getElementById('cityInput');
    input.value = name;
    input.setAttribute('data-selected', '1');
    input.classList.remove('border-gray-200', 'border-red-400');
    input.classList.add('border-emerald-400');
    document.getElementById('cityName').value = name;
    document.getElementById('cityLat').value  = String(lat);
    document.getElementById('cityLng').value  = String(lng);
}

function showGpsStatus(msg, colorClass) {
    const el = document.getElementById('gpsStatus');
    el.className = `mt-2 text-xs font-medium ${colorClass}`;
    el.textContent = msg;
    el.classList.remove('hidden');
}

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

// ── Simpan Lokasi ──────────────────────────────────────────────────────────
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

// ══════════════════════════════════════════════════════════════════
// 🔔 AZAN POLLING — cek setiap 30 detik, bunyi kalau sudah jamnya
// ══════════════════════════════════════════════════════════════════
(function initAzanPolling() {

    // Waktu shalat hari ini dari server (sudah sesuai lokasi user via aladhan API)
    const prayerTimes = {
        fajr    : '{{ $prayerTimes["fajr"] }}',
        dhuhr   : '{{ $prayerTimes["dhuhr"] }}',
        asr     : '{{ $prayerTimes["asr"] }}',
        maghrib : '{{ $prayerTimes["maghrib"] }}',
        isha    : '{{ $prayerTimes["isha"] }}',
    };

    const prayerLabels = {
        fajr: 'Subuh', dhuhr: 'Dzuhur', asr: 'Ashar', maghrib: 'Maghrib', isha: 'Isya'
    };
    const prayerIcons = {
        fajr:    `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:2.2rem;height:2.2rem;flex-shrink:0"><path d="M12 3V5M5.5 6.5L7 8M18.5 6.5L17 8M3 13H5M19 13H21" stroke="white" stroke-width="1.8" stroke-linecap="round"/><path d="M8 13C8 10.79 9.79 9 12 9C14.21 9 16 10.79 16 13" stroke="white" stroke-width="1.8" stroke-linecap="round"/><path d="M3 17H21" stroke="white" stroke-width="1.8" stroke-linecap="round"/><path d="M6 20H18" stroke="white" stroke-width="1.8" stroke-linecap="round"/></svg>`,
        dhuhr:   `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:2.2rem;height:2.2rem;flex-shrink:0"><circle cx="12" cy="12" r="4" fill="white"/><path d="M12 2V4M12 20V22M2 12H4M20 12H22M5.5 5.5L7 7M17 17L18.5 18.5M5.5 18.5L7 17M17 7L18.5 5.5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>`,
        asr:     `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:2.2rem;height:2.2rem;flex-shrink:0"><circle cx="12" cy="12" r="3.5" stroke="white" stroke-width="1.8"/><path d="M12 2V4M12 20V22M2 12H4M20 12H22M5.5 5.5L7 7M17 17L18.5 18.5M5.5 18.5L7 17M17 7L18.5 5.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/><path d="M4 18L20 18" stroke="white" stroke-width="1.8" stroke-linecap="round"/></svg>`,
        maghrib: `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:2.2rem;height:2.2rem;flex-shrink:0"><path d="M5 12C5 8.13 8.13 5 12 5C14.76 5 17.16 6.53 18.42 8.82" stroke="white" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="3.5" stroke="white" stroke-width="1.8"/><path d="M3 17H21M6 20H18" stroke="white" stroke-width="1.8" stroke-linecap="round"/></svg>`,
        isha:    `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:2.2rem;height:2.2rem;flex-shrink:0"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>`,
    };
    const audioUrls = {
        makkah  : 'https://www.islamcan.com/audio/adhan/azan1.mp3',
        madinah : 'https://www.islamcan.com/audio/adhan/azan2.mp3',
        mesir   : 'https://www.islamcan.com/audio/adhan/azan3.mp3',
    };

    // Catat azan yang sudah dibunyikan hari ini
    const todayStr = new Date().toDateString();
    const firedKey = 'azanFired_' + todayStr;
    let firedList  = [];
    try { firedList = JSON.parse(sessionStorage.getItem(firedKey) || '[]'); } catch(e) {}

    // Setting azan — default dulu, lalu update dari server setelah fetch selesai
    // Default: semua aktif, muadzin Makkah
    let azanSetting = {
        azan_enabled    : true,
        muadzin         : 'makkah',
        fajr_enabled    : true,
        dhuhr_enabled   : true,
        asr_enabled     : true,
        maghrib_enabled : true,
        isha_enabled    : true,
    };
    let settingLoaded = false;

    // Fetch setting dari server — update azanSetting begitu dapat response
    fetch('{{ route("azan-settings.show") }}', { headers: { 'Accept': 'application/json' } })
        .then(r => r.json())
        .then(data => {
            if (data.setting) {
                azanSetting   = data.setting;
                settingLoaded = true;
                console.log('[Azan] ✅ Setting loaded:', azanSetting);
            }
        })
        .catch(() => {
            settingLoaded = true; // tetap jalan walau gagal, pakai default
            console.warn('[Azan] ⚠️ Gagal load setting, pakai default (semua aktif, Makkah).');
        });

    // Kirim prayer times ke Service Worker supaya SW juga bisa cek
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.ready.then(reg => {
            if (reg.active) {
                reg.active.postMessage({
                    type     : 'UPDATE_ALL',
                    settings : azanSetting,
                    times    : prayerTimes,
                });
                console.log('[Azan] ✅ Data dikirim ke SW:', prayerTimes);
            }
        });
    }

    function getCurrentHHMM() {
        const now = new Date();
        return String(now.getHours()).padStart(2,'0') + ':' + String(now.getMinutes()).padStart(2,'0');
    }

    // Toleransi 0–1 menit dari waktu azan
    function isWithinMinute(current, target) {
        const [ch, cm] = current.split(':').map(Number);
        const [th, tm] = target.split(':').map(Number);
        const diff = (ch * 60 + cm) - (th * 60 + tm);
        return diff >= 0 && diff <= 1;
    }

    function checkAzan() {
        if (!azanSetting.azan_enabled) return;

        const current = getCurrentHHMM();

        for (const prayer of ['fajr', 'dhuhr', 'asr', 'maghrib', 'isha']) {
            const time    = prayerTimes[prayer];
            const enabled = azanSetting[prayer + '_enabled'];

            if (!time || !enabled)           continue;
            if (firedList.includes(prayer))  continue;
            if (!isWithinMinute(current, time)) continue;

            // Tandai sudah dibunyikan
            firedList.push(prayer);
            try { sessionStorage.setItem(firedKey, JSON.stringify(firedList)); } catch(e) {}

            triggerAzan(prayer);
        }
    }

    function triggerAzan(prayer) {
        const label    = prayerLabels[prayer];
        const icon     = prayerIcons[prayer];
        const muadzin  = azanSetting?.muadzin || 'makkah';
        const audioUrl = audioUrls[muadzin] || audioUrls.makkah;

        console.log(`[Azan] 🔔 Waktunya ${label}! Memutar ${muadzin}...`);

        // Kalau app.blade.php sudah punya fungsi playAzan global, pakai itu
        if (typeof playAzan === 'function') {
            playAzan(audioUrl, label, icon);
            return;
        }

        // Fallback: play langsung dari sini
        const audio = new Audio(audioUrl);
        audio.play()
            .then(() => {
                showAzanBannerLocal(label, icon, null);
            })
            .catch(() => {
                // Autoplay diblokir → tampilkan banner + tombol play manual
                showAzanBannerLocal(label, icon, audioUrl);
            });
    }

    function showAzanBannerLocal(label, icon, manualAudioUrl) {
        // Kalau app.blade.php sudah punya showAzanBanner global, pakai itu
        if (typeof showAzanBanner === 'function') {
            showAzanBanner(label, icon, manualAudioUrl);
            return;
        }

        const old = document.getElementById('azanBanner');
        if (old) old.remove();

        const banner = document.createElement('div');
        banner.id = 'azanBanner';
        banner.style.cssText = [
            'position:fixed','top:20px','left:50%','transform:translateX(-50%)',
            'z-index:9999','min-width:300px','max-width:92vw',
            'background:linear-gradient(135deg,#0d9488,#059669)',
            'color:white','border-radius:16px','padding:16px 20px',
            'box-shadow:0 20px 60px rgba(0,0,0,0.35)',
            'display:flex','align-items:center','gap:12px',
            'animation:azanSlideIn 0.4s cubic-bezier(0.34,1.56,0.64,1)',
            'font-family:inherit'
        ].join(';');

        banner.innerHTML = `
            <style>
                @keyframes azanSlideIn {
                    from { transform:translateX(-50%) translateY(-80px); opacity:0; }
                    to   { transform:translateX(-50%) translateY(0); opacity:1; }
                }
            </style>
            ${icon}
            <div style="flex:1">
                <div style="font-weight:700;font-size:1rem;margin-bottom:2px">Waktu ${label}</div>
                <div style="font-size:0.75rem;opacity:0.9">Allahu Akbar, segera shalat...</div>
            </div>
            ${manualAudioUrl
                ? `<button onclick="(new Audio('${manualAudioUrl}')).play();this.style.display='none'"
                     style="background:rgba(255,255,255,0.25);border:none;color:white;
                            padding:8px 14px;border-radius:8px;cursor:pointer;
                            font-size:0.8rem;font-weight:600;white-space:nowrap">
                     ▶ Play Azan
                   </button>`
                : ''}
            <button onclick="document.getElementById('azanBanner').remove()"
                    style="background:rgba(255,255,255,0.2);border:none;color:white;
                           width:28px;height:28px;border-radius:50%;cursor:pointer;
                           font-size:1rem;flex-shrink:0">✕</button>
        `;

        document.body.appendChild(banner);

        // Auto hilang setelah 60 detik
        setTimeout(() => {
            const b = document.getElementById('azanBanner');
            if (b) b.remove();
        }, 60000);
    }

    // Mulai polling — cek langsung, lalu tiap 30 detik
    checkAzan();
    setInterval(checkAzan, 30000);

    console.log('[Azan] ✅ Polling aktif. Jadwal hari ini:', prayerTimes);

})();

// ══════════════════════════════════════════════════════════════════
// 🗺️  MAP PICKER — Leaflet.js
// ══════════════════════════════════════════════════════════════════
(function loadLeaflet() {
    const script = document.createElement('script');
    script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
    script.onload = initMapPicker;
    document.head.appendChild(script);
})();

let mapInstance   = null;
let mapMarker     = null;
let mapSelectedLat = null;
let mapSelectedLng = null;
let mapSelectedName = null;

function initMapPicker() {
    // Inisialisasi dilakukan sekali saat pertama kali modal dibuka
}

function openMapPicker() {
    const modal = document.getElementById('mapPickerModal');
    modal.style.display = 'flex';

    // Cegah scroll body
    document.body.style.overflow = 'hidden';

    // Inisialisasi peta kalau belum
    setTimeout(() => {
        if (!mapInstance) {
            // Default center: Indonesia tengah (atau pakai lokasi user kalau ada)
            const initLat = parseFloat(document.getElementById('cityLat').value) || -2.5;
            const initLng = parseFloat(document.getElementById('cityLng').value) || 118.0;
            const initZoom = (document.getElementById('cityLat').value) ? 12 : 5;

            mapInstance = L.map('leafletMap', { zoomControl: true }).setView([initLat, initLng], initZoom);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(mapInstance);

            // Kalau sudah ada lokasi sebelumnya, taruh marker
            if (document.getElementById('cityLat').value) {
                placeMapMarker(initLat, initLng, document.getElementById('cityName').value || 'Lokasi tersimpan');
            }

            // Klik pada peta → taruh/pindah marker
            mapInstance.on('click', async function (e) {
                const { lat, lng } = e.latlng;
                const name = await reverseGeocodeMap(lat, lng);
                placeMapMarker(lat, lng, name);
            });
        } else {
            mapInstance.invalidateSize();
        }
    }, 100);
}

function closeMapPicker() {
    document.getElementById('mapPickerModal').style.display = 'none';
    document.body.style.overflow = '';
}

// Tutup modal klik di luar
document.addEventListener('click', function (e) {
    const modal = document.getElementById('mapPickerModal');
    if (e.target === modal) closeMapPicker();
});

function placeMapMarker(lat, lng, name) {
    // Hapus marker lama
    if (mapMarker) mapMarker.remove();

    // Custom icon berupa pin teal
    const icon = L.divIcon({
        className: '',
        html: `<div style="
            width:32px;height:32px;
            background:linear-gradient(135deg,#0d9488,#059669);
            border:3px solid #fff;
            border-radius:50% 50% 50% 0;
            transform:rotate(-45deg);
            box-shadow:0 4px 14px rgba(0,0,0,0.25);
        "></div>`,
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -34],
    });

    mapMarker = L.marker([lat, lng], { icon }).addTo(mapInstance);
    mapInstance.panTo([lat, lng]);

    // Simpan ke variabel sementara
    mapSelectedLat  = lat;
    mapSelectedLng  = lng;
    mapSelectedName = name;

    // Update UI info bawah peta
    document.getElementById('mapSelectedInfo').style.display = 'flex';
    document.getElementById('mapSelectedName').textContent   = name;
    document.getElementById('mapSelectedCoords').textContent = `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
    document.getElementById('mapHint').style.display         = 'none';
    document.getElementById('mapConfirmBtn').disabled        = false;
}

async function reverseGeocodeMap(lat, lng) {
    try {
        const res  = await fetch(
            `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&accept-language=id`,
            { headers: { 'Accept': 'application/json' } }
        );
        const data = await res.json();
        const addr = data.address || {};
        return addr.village
            || addr.suburb
            || addr.town
            || addr.city_district
            || addr.county
            || addr.city
            || addr.state
            || `${lat.toFixed(4)}, ${lng.toFixed(4)}`;
    } catch {
        return `${lat.toFixed(4)}, ${lng.toFixed(4)}`;
    }
}

async function searchOnMap() {
    const query = document.getElementById('mapSearchInput').value.trim();
    if (!query) return;

    try {
        const res  = await fetch(
            `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query)}&format=json&limit=1&accept-language=id`,
            { headers: { 'Accept': 'application/json' } }
        );
        const results = await res.json();

        if (results.length === 0) {
            alert('Lokasi tidak ditemukan. Coba kata kunci lain.');
            return;
        }

        const r    = results[0];
        const lat  = parseFloat(r.lat);
        const lng  = parseFloat(r.lon);
        const name = r.display_name.split(',')[0];

        mapInstance.setView([lat, lng], 14);
        placeMapMarker(lat, lng, name);
    } catch {
        alert('Gagal mencari lokasi. Coba lagi.');
    }
}

function centerToMyGPS() {
    if (!navigator.geolocation) { alert('GPS tidak tersedia di browser ini.'); return; }
    navigator.geolocation.getCurrentPosition(
        async (pos) => {
            const lat  = pos.coords.latitude;
            const lng  = pos.coords.longitude;
            const name = await reverseGeocodeMap(lat, lng);
            mapInstance.setView([lat, lng], 14);
            placeMapMarker(lat, lng, name);
        },
        () => alert('Gagal mendapatkan lokasi GPS.')
    );
}

async function confirmMapLocation() {
    if (!mapSelectedLat || !mapSelectedLng) return;

    const btn = document.getElementById('mapConfirmBtn');
    btn.disabled     = true;
    btn.textContent  = 'Menyimpan...';

    try {
        const res = await fetch('{{ route("prayer-tracking.set-location") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                city     : mapSelectedName,
                latitude : mapSelectedLat,
                longitude: mapSelectedLng,
            }),
        });

        const data = await res.json();

        if (data.success) {
            closeMapPicker();
            window.location.reload();
        } else {
            alert('Gagal menyimpan lokasi.');
            btn.disabled    = false;
            btn.textContent = 'Gunakan Lokasi Ini';
        }
    } catch {
        alert('Terjadi kesalahan.');
        btn.disabled    = false;
        btn.textContent = 'Gunakan Lokasi Ini';
    }
}
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
    /* ── Map Modal ── */
    #leafletMap .leaflet-container { font-family: inherit; }
    #leafletMap { cursor: crosshair; }

    /* Custom marker pulse */
    .map-pin-pulse {
        width: 16px; height: 16px;
        background: #0d9488;
        border: 3px solid #fff;
        border-radius: 50%;
        box-shadow: 0 0 0 4px rgba(13,148,136,0.3);
        animation: mapPinPulse 1.5s infinite;
    }
    @keyframes mapPinPulse {
        0%   { box-shadow: 0 0 0 0   rgba(13,148,136,0.4); }
        70%  { box-shadow: 0 0 0 10px rgba(13,148,136,0);   }
        100% { box-shadow: 0 0 0 0   rgba(13,148,136,0);   }
    }

    .prayer-row { transition: all 0.2s ease; }
    button:disabled { cursor: not-allowed; opacity: 0.6; }
    button:disabled:hover { transform: none !important; }
</style>
@endpush