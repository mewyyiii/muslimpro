@extends('layouts.app')

@push('styles')
<style>
    .feature-card {
        transition: all 0.3s ease;
    }
    .feature-card:hover {
        transform: translateY(-5px);
    }
    .feature-icon {
        transition: transform 0.3s ease;
    }
    .feature-card:hover .feature-icon {
        transform: scale(1.1);
    }
    .coming-soon-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: var(--secondary-accent);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-primary);">
            Assalamu'alaikum
        </h1>
        <p class="text-lg md:text-xl" style="color: var(--text-primary-muted);">
            Selamat datang di Al-Huda - Pendamping Ibadah Anda
        </p>
    </div>

    <!-- Main Features Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Al-Quran -->
        <a href="{{ url('/al-quran') }}" class="feature-card block p-6 rounded-xl shadow-lg relative" style="background-color: var(--surface);">
            <div class="flex flex-col items-center text-center">
                <div class="feature-icon w-20 h-20 rounded-full flex items-center justify-center mb-4" style="background-color: var(--primary-accent);">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--text-primary);">Al-Quran</h3>
                <p class="text-sm" style="color: var(--text-primary-muted);">Baca Al-Quran 30 Juz lengkap dengan terjemahan</p>
            </div>
        </a>

        <!-- Waktu Shalat -->
        <div class="feature-card block p-6 rounded-xl shadow-lg relative opacity-75 cursor-not-allowed" style="background-color: var(--surface);">
            <span class="coming-soon-badge">Segera</span>
            <div class="flex flex-col items-center text-center">
                <div class="feature-icon w-20 h-20 rounded-full flex items-center justify-center mb-4" style="background-color: var(--primary-accent);">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--text-primary);">Waktu Shalat</h3>
                <p class="text-sm" style="color: var(--text-primary-muted);">Jadwal shalat 5 waktu sesuai lokasi Anda</p>
            </div>
        </div>

        <!-- Arah Kiblat -->
        <div class="feature-card block p-6 rounded-xl shadow-lg relative opacity-75 cursor-not-allowed" style="background-color: var(--surface);">
            <span class="coming-soon-badge">Segera</span>
            <div class="flex flex-col items-center text-center">
                <div class="feature-icon w-20 h-20 rounded-full flex items-center justify-center mb-4" style="background-color: var(--primary-accent);">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--text-primary);">Arah Kiblat</h3>
                <p class="text-sm" style="color: var(--text-primary-muted);">Temukan arah kiblat dengan kompas digital</p>
            </div>
        </div>

        <!-- Asmaul Husna -->
        <a href="{{ route('asmaul-husna.index') }}" class="feature-card block p-6 rounded-xl shadow-lg relative" style="background-color: var(--surface);">
            <div class="flex flex-col items-center text-center">
                <div class="feature-icon w-20 h-20 rounded-full flex items-center justify-center mb-4" style="background-color: var(--primary-accent);">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--text-primary);">Asmaul Husna</h3>
                <p class="text-sm" style="color: var(--text-primary-muted);">99 Nama Allah yang Maha Agung</p>
            </div>
        </a>

        <!-- Doa-doa -->
        <a href="{{ route('doa-pendek.index') }}" class="feature-card block p-6 rounded-xl shadow-lg relative" style="background-color: var(--surface);">
            <div class="flex flex-col items-center text-center">
                <div class="feature-icon w-20 h-20 rounded-full flex items-center justify-center mb-4" style="background-color: var(--primary-accent);">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--text-primary);">Doa-doa Pendek</h3>
                <p class="text-sm" style="color: var(--text-primary-muted);">Kumpulan doa harian dan pilihan</p>
            </div>
        </a>

        <!-- Jadwal Puasa -->
        <div class="feature-card block p-6 rounded-xl shadow-lg relative opacity-75 cursor-not-allowed" style="background-color: var(--surface);">
            <span class="coming-soon-badge">Segera</span>
            <div class="flex flex-col items-center text-center">
                <div class="feature-icon w-20 h-20 rounded-full flex items-center justify-center mb-4" style="background-color: var(--primary-accent);">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2" style="color: var(--text-primary);">Jadwal Puasa</h3>
                <p class="text-sm" style="color: var(--text-primary-muted);">Waktu imsak, sahur, dan berbuka puasa</p>
            </div>
        </div>
    </div>

    <!-- Quote Section -->
    <div class="mt-12 p-8 rounded-xl text-center" style="background-color: var(--surface);">
        <p class="text-2xl font-arabic font-bold mb-4" style="color: var(--primary-accent);">
            بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
        </p>
        <p class="text-lg" style="color: var(--text-primary-muted);">
            "Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang"
        </p>
    </div>
</div>
@endsection