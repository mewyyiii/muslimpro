@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif;
    }
    
    /* Compass animations */
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes pulse-ring {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.1);
            opacity: 0.5;
        }
    }
    
    .compass-ring {
        animation: pulse-ring 2s ease-in-out infinite;
    }
    
    .smooth-transition {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .arrow-transition {
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Glow effect */
    .glow-green {
        box-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
    }

    .glow-teal {
        box-shadow: 0 0 30px rgba(20, 184, 166, 0.5);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-500 py-8 md:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow-lg">Arah Kiblat</h1>
            <p class="text-white/90 text-sm md:text-base">Temukan arah Ka'bah dari lokasi Anda</p>
        </div>

        <div x-data="qiblaFinder()" x-init="init()">
            
            <!-- Main Compass Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-6 md:p-10 mb-6 relative overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-teal-50 rounded-full -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-emerald-50 rounded-full -ml-16 -mb-16"></div>
                
                <div class="relative z-10">
                    
                    <!-- Status Messages -->
                    <div class="text-center mb-6">
                        <!-- Loading -->
                        <div x-show="status === 'loading'" class="py-4">
                            <div class="inline-block w-12 h-12 border-4 border-teal-200 border-t-teal-500 rounded-full animate-spin mb-3"></div>
                            <p class="text-gray-600 font-medium">Mendapatkan lokasi Anda...</p>
                        </div>

                        <!-- Need Permission -->
                        <div x-show="status === 'need-permission'" class="py-4">
                            <div class="text-5xl mb-3">📍</div>
                            <p class="text-gray-700 font-medium mb-4">Izinkan akses lokasi untuk menemukan arah kiblat</p>
                            <button @click="requestLocation()" 
                                    class="px-6 py-3 bg-gradient-to-r from-teal-400 to-emerald-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl smooth-transition transform hover:-translate-y-1">
                                Aktifkan Lokasi
                            </button>
                        </div>

                        <!-- Error -->
                        <div x-show="status === 'error'" class="py-4">
                            <div class="text-5xl mb-3">⚠️</div>
                            <p class="text-red-600 font-medium mb-2" x-text="errorMessage"></p>
                            <p class="text-sm text-gray-600 mb-4">Coba aktifkan GPS atau input lokasi manual</p>
                            <button @click="requestLocation()" 
                                    class="px-6 py-3 bg-gradient-to-r from-teal-400 to-emerald-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl smooth-transition">
                                Coba Lagi
                            </button>
                        </div>

                        <!-- Success - Show Compass -->
                        <div x-show="status === 'success'" class="space-y-6">
                            
                            <!-- Location Info -->
                            <div class="bg-gradient-to-r from-teal-50 to-emerald-50 rounded-2xl p-4">
                                <div class="flex items-center justify-center gap-2 text-sm text-gray-700">
                                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="font-medium">Lokasi Anda</span>
                                </div>
                                <div class="text-xs text-gray-600 mt-1">
                                    <span x-text="userLocation.lat?.toFixed(4)"></span>°, 
                                    <span x-text="userLocation.lng?.toFixed(4)"></span>°
                                </div>
                            </div>

                            <!-- Main Compass -->
                            <div class="relative flex justify-center items-center">
                                <!-- Compass Container -->
                                <div class="relative w-72 h-72 md:w-80 md:h-80">
                                    
                                    <!-- Outer Ring -->
                                    <div class="absolute inset-0 rounded-full border-4 border-teal-200"></div>
                                    
                                    <!-- Pulsing Ring -->
                                    <div class="absolute inset-0 rounded-full border-4 border-teal-400 compass-ring"></div>
                                    
                                    <!-- Compass Rose Background -->
                                    <div class="absolute inset-4 rounded-full bg-gradient-to-br from-gray-50 to-gray-100 shadow-inner"
                                         :style="`transform: rotate(${-heading}deg)`">
                                        
                                        <!-- Cardinal Directions -->
                                        <div class="absolute inset-0">
                                            <!-- North (Red) -->
                                            <div class="absolute top-2 left-1/2 -translate-x-1/2 text-red-600 font-bold text-lg">
                                                N
                                            </div>
                                            <!-- East -->
                                            <div class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600 font-bold">
                                                E
                                            </div>
                                            <!-- South -->
                                            <div class="absolute bottom-2 left-1/2 -translate-x-1/2 text-gray-600 font-bold">
                                                S
                                            </div>
                                            <!-- West -->
                                            <div class="absolute left-2 top-1/2 -translate-y-1/2 text-gray-600 font-bold">
                                                W
                                            </div>
                                        </div>

                                        <!-- Degree Markers -->
                                        <template x-for="i in 36" :key="i">
                                            <div class="absolute top-1/2 left-1/2 w-0.5 h-3 bg-gray-400 origin-bottom"
                                                 :style="`transform: translate(-50%, -50%) rotate(${i * 10}deg) translateY(-${i % 3 === 0 ? '130px' : '135px'})`">
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Center Point -->
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-3 h-3 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 shadow-lg"></div>
                                    </div>

                                    <!-- Qibla Arrow (Green) -->
                                    <div class="absolute inset-0 flex items-center justify-center arrow-transition"
                                         :style="`transform: rotate(${getNeedleAngle()}deg)`">
                                        <div class="relative">
                                            <!-- Arrow Body -->
                                            <div class="w-2 h-32 bg-gradient-to-t from-emerald-600 to-emerald-400 rounded-full shadow-lg glow-green"
                                                 style="transform: translateY(-50px);">
                                            </div>
                                            <!-- Arrow Head -->
                                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[12px] border-l-transparent border-r-[12px] border-r-transparent border-b-[20px] border-b-emerald-500"
                                                 style="filter: drop-shadow(0 0 6px rgba(16, 185, 129, 0.6));">
                                            </div>
                                            <!-- Ka'bah Icon at Arrow Tip -->
                                            <div class="absolute -top-10 left-1/2 -translate-x-1/2 text-2xl" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2))">
                                                🕋
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Qibla Info -->
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Direction -->
                                <div class="bg-gradient-to-br from-teal-50 to-emerald-50 rounded-2xl p-4 text-center">
                                    <div class="text-xs text-gray-600 mb-1">Arah Kiblat</div>
                                    <div class="text-2xl font-bold text-teal-600">
                                        <span x-text="Math.round(qiblaAngle)"></span>°
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1" x-text="getCardinalDirection(qiblaAngle)"></div>
                                </div>

                                <!-- Distance -->
                                <div class="bg-gradient-to-br from-teal-50 to-emerald-50 rounded-2xl p-4 text-center">
                                    <div class="text-xs text-gray-600 mb-1">Jarak ke Ka'bah</div>
                                    <div class="text-2xl font-bold text-emerald-600">
                                        <span x-text="distanceToKaaba"></span>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">kilometer</div>
                                </div>
                            </div>

                            <!-- Compass Calibration Notice -->
                            <div x-show="!compassAvailable" class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-4 text-center">
                                <div class="text-amber-600 text-sm">
                                    <span class="font-semibold">💡 Mode Desktop:</span> 
                                    Arah kiblat ditampilkan relatif dari Utara. Gunakan smartphone untuk kompas digital.
                                </div>
                            </div>

                            <div x-show="compassAvailable" class="bg-teal-50 border-2 border-teal-200 rounded-2xl p-4 text-center">
                                <div class="text-teal-700 text-sm">
                                    <span class="font-semibold">📱 Kompas Aktif!</span> 
                                    Putar device Anda, panah hijau akan selalu menunjuk ke Ka'bah.
                                </div>
                            </div>
                            <div x-show="needsCompassPermission" class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-4 text-center mt-3">
                                <div class="text-amber-700 text-sm mb-3">
                                    <span class="font-semibold">🧭 Izin Kompas Dibutuhkan</span>
                                    <div>Tekan tombol di bawah untuk mengaktifkan kompas.</div>
                                </div>

                                <button type="button"
                                        @click="requestCompassPermission()"
                                        class="px-4 py-2 rounded-xl bg-teal-600 text-white font-semibold shadow hover:bg-teal-700 transition">
                                    Aktifkan Kompas
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Manual Location Input -->
            <div x-show="status === 'success' || status === 'error'" class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    Input Lokasi Manual
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                        <input type="number" 
                               x-model="manualLat"
                               step="0.0001"
                               placeholder="Contoh: -7.7956"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-teal-400 focus:ring-4 focus:ring-teal-100 focus:outline-none smooth-transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input type="number" 
                               x-model="manualLng"
                               step="0.0001"
                               placeholder="Contoh: 110.3695"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-teal-400 focus:ring-4 focus:ring-teal-100 focus:outline-none smooth-transition">
                    </div>
                </div>
                <button @click="setManualLocation()"
                        class="w-full px-6 py-3 bg-gradient-to-r from-teal-400 to-emerald-500 text-white rounded-xl font-medium shadow-md hover:shadow-lg smooth-transition transform hover:-translate-y-1">
                    Hitung Arah Kiblat
                </button>
            </div>

            <!-- Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <!-- How to Use -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-2xl">📖</span>
                        Cara Menggunakan
                    </h3>
                    <ol class="text-sm text-gray-700 space-y-2">
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-teal-600 min-w-[20px]">1.</span>
                            <span>Klik tombol "Aktifkan Lokasi"</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-teal-600 min-w-[20px]">2.</span>
                            <span>Izinkan browser mengakses lokasi Anda</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-teal-600 min-w-[20px]">3.</span>
                            <span>Panah hijau akan menunjukkan arah Ka'bah</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-teal-600 min-w-[20px]">4.</span>
                            <span>Di smartphone, kompas akan mengikuti orientasi device</span>
                        </li>
                    </ol>
                </div>

                <!-- Tips -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-2xl">💡</span>
                        Tips
                    </h3>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li class="flex items-start gap-2">
                            <span class="text-teal-600">•</span>
                            <span>Gunakan di tempat terbuka untuk GPS akurat</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-teal-600">•</span>
                            <span>Kalibrasi kompas dengan gerakan angka 8</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-teal-600">•</span>
                            <span>Jauhkan dari benda logam/magnet</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-teal-600">•</span>
                            <span>Fitur kompas hanya tersedia di smartphone</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Ka'bah Info -->
            <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-6 text-center">
                <div class="text-4xl mb-3">🕋</div>
                <h3 class="text-xl font-arabic font-bold text-gray-800 mb-2">
                    الْكَعْبَة الْمُشَرَّفَة
                </h3>
                <p class="text-sm text-gray-600 mb-3">Ka'bah Al-Musharrafah</p>
                <div class="text-xs text-gray-500">
                    Lokasi: Masjidil Haram, Makkah, Arab Saudi<br>
                    Koordinat: 21.4225° N, 39.8262° E
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function qiblaFinder() {
    return {
        status: 'need-permission', // need-permission, loading, success, error
        errorMessage: '',
        userLocation: { lat: null, lng: null },
        manualLat: null,
        manualLng: null,
        qiblaAngle: 0,
        distanceToKaaba: 0,
        heading: 0,
        compassAvailable: false,
        needsCompassPermission: false,
        
        // Ka'bah coordinates
        kaabaLat: 21.4225,
        kaabaLng: 39.8262,

        init() {
            // Check if geolocation is available
            if (!navigator.geolocation) {
                this.status = 'error';
                this.errorMessage = 'Browser Anda tidak mendukung Geolocation';
            }
            
            // Check if device orientation is available (for compass)
            if (window.DeviceOrientationEvent) {
                this.setupCompass();
            }
        },

        requestLocation() {
            this.status = 'loading';
            this.errorMessage = '';

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    this.userLocation.lat = position.coords.latitude;
                    this.userLocation.lng = position.coords.longitude;
                    this.calculateQibla();
                    this.status = 'success';
                },
                (error) => {
                    this.status = 'error';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            this.errorMessage = 'Akses lokasi ditolak. Izinkan akses lokasi di pengaturan browser.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            this.errorMessage = 'Informasi lokasi tidak tersedia. Pastikan GPS aktif.';
                            break;
                        case error.TIMEOUT:
                            this.errorMessage = 'Request lokasi timeout. Coba lagi.';
                            break;
                        default:
                            this.errorMessage = 'Error mendapatkan lokasi. Coba lagi.';
                    }
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        },

        setManualLocation() {
            if (this.manualLat && this.manualLng) {
                this.userLocation.lat = parseFloat(this.manualLat);
                this.userLocation.lng = parseFloat(this.manualLng);
                this.calculateQibla();
                this.status = 'success';
            } else {
                alert('Masukkan latitude dan longitude yang valid');
            }
        },

        calculateQibla() {
            // Convert to radians
            const lat1 = this.toRadians(this.userLocation.lat);
            const lng1 = this.toRadians(this.userLocation.lng);
            const lat2 = this.toRadians(this.kaabaLat);
            const lng2 = this.toRadians(this.kaabaLng);

            // Calculate qibla direction using formula
            const dLng = lng2 - lng1;
            const y = Math.sin(dLng);
            const x = Math.cos(lat1) * Math.tan(lat2) - Math.sin(lat1) * Math.cos(dLng);
            
            let bearing = Math.atan2(y, x);
            bearing = this.toDegrees(bearing);
            
            // Normalize to 0-360
            this.qiblaAngle = (bearing + 360) % 360;

            // Calculate distance
            this.calculateDistance();
        },

        calculateDistance() {
            const R = 6371; // Earth radius in km
            const lat1 = this.toRadians(this.userLocation.lat);
            const lat2 = this.toRadians(this.kaabaLat);
            const dLat = this.toRadians(this.kaabaLat - this.userLocation.lat);
            const dLng = this.toRadians(this.kaabaLng - this.userLocation.lng);

            const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                      Math.cos(lat1) * Math.cos(lat2) *
                      Math.sin(dLng/2) * Math.sin(dLng/2);
            
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            const distance = R * c;

            this.distanceToKaaba = Math.round(distance).toLocaleString();
        },

        
        setupCompass() {
            // iOS 13+ butuh permission dari user gesture (klik tombol)
            if (typeof DeviceOrientationEvent !== 'undefined' && typeof DeviceOrientationEvent.requestPermission === 'function') {
                this.needsCompassPermission = true;
                this.compassAvailable = false;
                return;
            }

            // selain iOS: langsung mulai listener kompas
            this.startCompassListener();
        },

        async requestCompassPermission() {
            try {
                const res = await DeviceOrientationEvent.requestPermission();
                if (res === 'granted') {
                    this.needsCompassPermission = false;
                    this.startCompassListener();
                } else {
                    this.compassAvailable = false;
                    this.errorMessage = 'Izin kompas ditolak.';
                }
            } catch (e) {
                this.compassAvailable = false;
                this.errorMessage = 'Gagal meminta izin kompas.';
            }
        },

        startCompassListener() {
            const handler = (event) => {
                let heading = null;

                // iOS Safari: heading sudah dalam derajat (0..360)
                if (event.webkitCompassHeading != null) {
                    heading = event.webkitCompassHeading;
                } else if (event.alpha != null) {
                    // Android/Chrome: alpha sering berlawanan arah jarum jam
                    heading = 360 - event.alpha;
                }

                if (heading == null) return;

                // koreksi orientasi layar
                const screenAngle =
                    (screen.orientation && typeof screen.orientation.angle === 'number')
                        ? screen.orientation.angle
                        : (typeof window.orientation === 'number' ? window.orientation : 0);

                heading = (heading + screenAngle + 360) % 360;

                this.heading = heading;
                this.compassAvailable = true;
            };

            window.addEventListener('deviceorientationabsolute', handler, true);
            window.addEventListener('deviceorientation', handler, true);
        },

        getNeedleAngle() {
            // jarum Ka'bah = arah kiblat - arah HP (heading)
            return (this.qiblaAngle - this.heading + 360) % 360;
        },

        getCardinalDirection(angle) {
            const directions = ['Utara', 'Timur Laut', 'Timur', 'Tenggara', 'Selatan', 'Barat Daya', 'Barat', 'Barat Laut'];
            const index = Math.round(angle / 45) % 8;
            return directions[index];
        },

        toRadians(degrees) {
            return degrees * Math.PI / 180;
        },

        toDegrees(radians) {
            return radians * 180 / Math.PI;
        }
    };
}
</script>
@endpush