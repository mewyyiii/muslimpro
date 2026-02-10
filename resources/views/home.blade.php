@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-500 py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12 md:mb-16">
            <div class="inline-block mb-6">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                    <svg
                        viewBox="0 0 120 120"
                        class="w-6 h-6"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <!-- string -->
                        <path d="M60 8 Q65 12 60 16" stroke="#48bb78" stroke-width="3" fill="none"/>

                        <!-- beads -->
                        <circle cx="48" cy="22" r="6" fill="#48bb78"/>
                        <circle cx="60" cy="20" r="6" fill="#48bb78"/>
                        <circle cx="72" cy="22" r="6" fill="#48bb78"/>

                        <circle cx="44" cy="34" r="6" fill="#48bb78"/>
                        <circle cx="76" cy="34" r="6" fill="#48bb78"/>

                        <circle cx="46" cy="48" r="6" fill="#48bb78"/>
                        <circle cx="74" cy="48" r="6" fill="#48bb78"/>

                        <circle cx="52" cy="62" r="6" fill="#48bb78"/>
                        <circle cx="68" cy="62" r="6" fill="#48bb78"/>

                        <!-- tassel -->
                        <path
                            d="M56 72 L54 84
                            M60 72 L60 88
                            M64 72 L66 84"
                            stroke="#48bb78"
                            stroke-width="2"
                            stroke-linecap="round"
                        />
                    </svg>
                </div>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 text-white drop-shadow-lg">
                Assalamu'alaikum
            </h1>
            <p class="text-lg md:text-xl lg:text-2xl text-white/90 font-medium">
                Selamat datang di Al-Huda - Pendamping Ibadah Anda
            </p>
        </div>

        <!-- Main Features Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-12">
            <!-- Al-Quran -->
            <a href="{{ route('quran.index') }}" 
               class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center mb-4 md:mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Al-Quran</h3>
                    <p class="text-sm md:text-base text-gray-600">Baca Al-Quran 30 Juz lengkap dengan terjemahan</p>
                </div>
            </a>

            <!-- Waktu Shalat -->
            <div class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl relative overflow-hidden opacity-75 cursor-not-allowed">
                <span class="absolute top-3 right-3 px-3 py-1 bg-gray-400 text-white rounded-full text-xs font-semibold shadow-md z-20">Segera</span>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Waktu Shalat</h3>
                    <p class="text-sm md:text-base text-gray-600">Jadwal shalat 5 waktu sesuai lokasi Anda</p>
                </div>
            </div>

            <!-- Arah Kiblat -->
            <div class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl relative overflow-hidden opacity-75 cursor-not-allowed">
                <span class="absolute top-3 right-3 px-3 py-1 bg-gray-400 text-white rounded-full text-xs font-semibold shadow-md z-20">Segera</span>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Arah Kiblat</h3>
                    <p class="text-sm md:text-base text-gray-600">Temukan arah kiblat dengan kompas digital</p>
                </div>
            </div>

            <!-- Asmaul Husna -->
            <a href="{{ route('asmaul-husna.index') }}" 
               class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center mb-4 md:mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Asmaul Husna</h3>
                    <p class="text-sm md:text-base text-gray-600">99 Nama Allah yang Maha Agung</p>
                </div>
            </a>

            <!-- Doa-doa -->
            <a href="{{ route('doa-pendek.index') }}" 
               class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center mb-4 md:mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Doa-doa Pendek</h3>
                    <p class="text-sm md:text-base text-gray-600">Kumpulan doa harian dan pilihan</p>
                </div>
            </a>

            <!-- Jadwal Puasa -->
            <div class="group feature-card bg-white rounded-2xl p-6 md:p-8 shadow-xl relative overflow-hidden opacity-75 cursor-not-allowed">
                <span class="absolute top-3 right-3 px-3 py-1 bg-gray-400 text-white rounded-full text-xs font-semibold shadow-md z-20">Segera</span>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2 text-gray-800">Jadwal Puasa</h3>
                    <p class="text-sm md:text-base text-gray-600">Waktu imsak, sahur, dan berbuka puasa</p>
                </div>
            </div>
        </div>

        <!-- Quote Section -->
        <div class="mt-8 md:mt-12 p-6 md:p-10 rounded-2xl text-center bg-white shadow-2xl">
            <p class="text-2xl md:text-3xl lg:text-4xl font-arabic font-bold mb-4 md:mb-6 text-teal-600">
                بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
            </p>
            <p class="text-base md:text-lg lg:text-xl text-gray-700 font-medium">
                "Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang"
            </p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    
    .font-arabic {
        font-family: 'Amiri', serif;
    }
    
    .feature-card {
        cursor: pointer;
    }
    
    @media (max-width: 640px) {
        .feature-card:not(.opacity-75):active {
            transform: translateY(-4px);
        }
    }
</style>
@endpush