<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800 dark:text-gray-200">
                    Selamat datang, {{ Auth::user()->name }}!
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400">
                    Dashboard Pendamping Ibadah Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Card: Al-Quran -->
                <a href="{{ url('/al-quran') }}" class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mb-4 bg-indigo-500 text-white">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Al-Quran</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Baca Al-Quran 30 Juz lengkap dengan terjemahan</p>
                    </div>
                </a>

                <!-- Card: Waktu Shalat -->
                <div class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg opacity-75 cursor-not-allowed transition-transform transform hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mb-4 bg-teal-500 text-white">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Waktu Shalat</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Jadwal shalat 5 waktu sesuai lokasi Anda</p>
                    </div>
                </div>

                <!-- Card: Asmaul Husna -->
                <a href="{{ route('asmaul-husna.index') }}" class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mb-4 bg-purple-500 text-white">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Asmaul Husna</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">99 Nama Allah yang Maha Agung</p>
                    </div>
                </a>

                <!-- Card: Doa-doa -->
                <a href="{{ route('doa-pendek.index') }}" class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mb-4 bg-orange-500 text-white">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Doa-doa Pendek</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Kumpulan doa harian dan pilihan</p>
                    </div>
                </a>
                
                <!-- Card: Pelacakan Shalat -->
                <div class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg opacity-75 cursor-not-allowed transition-transform transform hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mb-4 bg-red-500 text-white">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Pelacakan Shalat</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Catat waktu shalat Anda setiap hari</p>
                    </div>
                </div>

                <!-- Card: Jadwal Puasa -->
                <div class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg opacity-75 cursor-not-allowed transition-transform transform hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mb-4 bg-blue-500 text-white">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Jadwal Puasa</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Waktu imsak, sahur, dan berbuka puasa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>