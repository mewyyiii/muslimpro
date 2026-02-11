@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif;
    }
    
    /* Counter animation */
    @keyframes countPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .count-pulse {
        animation: countPulse 0.3s ease-in-out;
    }

    /* Ripple effect untuk tombol */
    .ripple {
        position: relative;
        overflow: hidden;
    }
    
    .ripple::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .ripple:active::after {
        width: 300px;
        height: 300px;
    }

    /* Smooth transitions */
    .smooth-transition {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-500 py-8 md:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow-lg">Tasbih Digital</h1>
            <p class="text-white/90 text-sm md:text-base">Hitung dzikir Anda dengan mudah</p>
        </div>

        <div x-data="tasbihCounter()" x-init="init()">

            {{-- ══════════════════════════════════════════
                 MODAL KONFIRMASI RESET
            ══════════════════════════════════════════ --}}
            <div x-show="showResetModal"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
                 @click.self="showResetModal = false">
                <div x-show="showResetModal"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="bg-white rounded-2xl shadow-2xl p-5 w-full max-w-xs md:max-w-[260px] text-center">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Reset Counter?</h4>
                    <p class="text-sm text-gray-500 mb-6">Hitungan dzikir saat ini akan direset ke 0. Yakin ingin melanjutkan?</p>
                    <div class="flex gap-3">
                        <button @click="showResetModal = false"
                                class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors text-sm">
                            Batal
                        </button>
                        <button @click="confirmReset()"
                                class="flex-1 px-4 py-2.5 bg-gradient-to-r from-teal-400 to-emerald-500 text-white font-semibold rounded-xl shadow hover:shadow-md transition-all text-sm">
                            Ya, Reset
                        </button>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════
                 MODAL ERROR CUSTOM TARGET
            ══════════════════════════════════════════ --}}
            <div x-show="showCustomErrorModal"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
                 @click.self="showCustomErrorModal = false">
                <div x-show="showCustomErrorModal"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="bg-white rounded-2xl shadow-2xl p-5 w-full max-w-xs md:max-w-[260px] text-center">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Target Tidak Valid</h4>
                    <p class="text-sm text-gray-500 mb-6">Masukkan target antara <span class="font-semibold text-teal-600">1 hingga 9999</span>.</p>
                    <button @click="showCustomErrorModal = false"
                            class="w-full px-4 py-2.5 bg-gradient-to-r from-teal-400 to-emerald-500 text-white font-semibold rounded-xl shadow hover:shadow-md transition-all text-sm">
                        Mengerti
                    </button>
                </div>
            </div>
            
            <!-- Main Counter Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-6 md:p-10 mb-6 relative overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-teal-50 rounded-full -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-emerald-50 rounded-full -ml-16 -mb-16"></div>
                
                <div class="relative z-10">
                    <!-- Selected Dzikir Title -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl md:text-3xl font-arabic font-bold text-gray-800 mb-2" x-text="selectedDzikir.arabic"></h2>
                        <p class="text-sm md:text-base text-gray-600" x-text="selectedDzikir.translation"></p>
                        <p class="text-xs text-teal-600 mt-1">
                            Target: <span x-text="selectedDzikir.target"></span>x
                        </p>
                    </div>

                    <!-- Counter Display -->
                    <div class="text-center mb-8">
                        <div class="inline-block relative">
                            <!-- Progress Ring -->
                            <svg class="transform -rotate-90 w-48 h-48 md:w-64 md:h-64" viewBox="0 0 200 200">
                                <!-- Background circle -->
                                <circle cx="100" cy="100" r="85" stroke="#E5E7EB" stroke-width="12" fill="none"/>
                                <!-- Progress circle -->
                                <circle 
                                    cx="100" 
                                    cy="100" 
                                    r="85" 
                                    stroke="url(#gradient)" 
                                    stroke-width="12" 
                                    fill="none"
                                    stroke-linecap="round"
                                    :stroke-dasharray="circumference"
                                    :stroke-dashoffset="progressOffset"
                                    class="smooth-transition"
                                />
                                <defs>
                                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#2DD4BF;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#10B981;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                            
                            <!-- Counter Number -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <div class="text-5xl md:text-7xl font-bold text-gray-800" 
                                     x-text="count"
                                     :class="{ 'count-pulse': counting }"></div>
                                <div class="text-sm md:text-base text-gray-500 mt-2">
                                    <span x-text="selectedDzikir.target - count"></span> lagi
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Count Button -->
                    <div class="flex justify-center mb-6">
                        <button 
                            @click="increment()"
                            class="ripple w-32 h-32 md:w-40 md:h-40 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 text-white shadow-2xl hover:shadow-3xl transform hover:scale-105 active:scale-95 smooth-transition focus:outline-none focus:ring-4 focus:ring-teal-300"
                            :disabled="count >= selectedDzikir.target">
                            <div class="text-3xl md:text-4xl font-bold">+1</div>
                            <div class="text-xs md:text-sm mt-1">Tap / Space</div>
                        </button>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 justify-center">
                        <button 
                            @click="reset()"
                            class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-medium smooth-transition shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-300">
                            <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </button>
                        
                        <button 
                            @click="toggleSound()"
                            class="px-6 py-3 rounded-xl font-medium smooth-transition shadow-md hover:shadow-lg focus:outline-none focus:ring-2"
                            :class="soundEnabled ? 'bg-teal-100 hover:bg-teal-200 text-teal-700 focus:ring-teal-300' : 'bg-gray-100 hover:bg-gray-200 text-gray-700 focus:ring-gray-300'">
                            <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="soundEnabled">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path>
                            </svg>
                            <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!soundEnabled">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" clip-rule="evenodd"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path>
                            </svg>
                            <span x-text="soundEnabled ? 'Suara On' : 'Suara Off'"></span>
                        </button>
                    </div>

                    <!-- Completion Message -->
                    <div x-show="count >= selectedDzikir.target" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         class="mt-6 p-4 bg-gradient-to-r from-teal-50 to-emerald-50 border-2 border-teal-200 rounded-2xl text-center">
                        <p class="text-lg font-bold text-teal-700 mb-1">✨ Alhamdulillah! ✨</p>
                        <p class="text-sm text-teal-600">Target dzikir tercapai!</p>
                    </div>
                </div>
            </div>

            <!-- Preset Dzikir Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <template x-for="(dzikir, index) in dzikirPresets" :key="index">
                    <button 
                        @click="selectDzikir(index)"
                        class="bg-white rounded-2xl p-5 shadow-lg hover:shadow-xl smooth-transition transform hover:-translate-y-1 text-left relative overflow-hidden focus:outline-none focus:ring-4 focus:ring-teal-300"
                        :class="{ 'ring-4 ring-teal-400': selectedIndex === index }">
                        
                        <!-- Selected indicator -->
                        <div x-show="selectedIndex === index" 
                             class="absolute top-3 right-3 w-6 h-6 bg-teal-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <div class="mb-3">
                            <h3 class="text-xl font-arabic font-bold text-gray-800 mb-1" x-text="dzikir.arabic"></h3>
                            <p class="text-xs text-gray-600" x-text="dzikir.translation"></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-teal-600" x-text="dzikir.target + 'x'"></span>
                            <span class="text-xs text-gray-500" x-text="dzikir.name"></span>
                        </div>
                    </button>
                </template>
            </div>

            <!-- Custom Target Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    Target Custom
                </h3>
                <div class="flex gap-3">
                    <input 
                        type="number" 
                        x-model.number="customTarget"
                        placeholder="Contoh: 100"
                        min="1"
                        max="9999"
                        class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-teal-400 focus:ring-4 focus:ring-teal-100 focus:outline-none smooth-transition">
                    <button 
                        @click="setCustomTarget()"
                        class="px-6 py-3 bg-gradient-to-r from-teal-400 to-emerald-500 text-white rounded-xl font-medium shadow-md hover:shadow-lg smooth-transition transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-teal-300">
                        Set Target
                    </button>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Statistik Hari Ini
                </h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-gradient-to-br from-teal-50 to-emerald-50 rounded-xl">
                        <div class="text-2xl font-bold text-teal-600" x-text="totalToday"></div>
                        <div class="text-xs text-gray-600 mt-1">Total Dzikir</div>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-teal-50 to-emerald-50 rounded-xl">
                        <div class="text-2xl font-bold text-emerald-600" x-text="completedSessions"></div>
                        <div class="text-xs text-gray-600 mt-1">Sesi Selesai</div>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-teal-50 to-emerald-50 rounded-xl">
                        <div class="text-2xl font-bold text-teal-600" x-text="count"></div>
                        <div class="text-xs text-gray-600 mt-1">Sesi Ini</div>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="mt-6 bg-teal-50 border-2 border-teal-100 rounded-2xl p-5">
                <div class="flex items-start gap-3">
                    <div class="text-2xl">💡</div>
                    <div>
                        <h4 class="font-bold text-teal-800 mb-1">Tips:</h4>
                        <ul class="text-sm text-teal-700 space-y-1">
                            <li>• Tekan <kbd class="px-2 py-1 bg-white rounded shadow-sm font-mono text-xs">Space</kbd> untuk hitung cepat</li>
                            <li>• Aktifkan suara untuk feedback audio</li>
                            <li>• Fokus dan khusyuk dalam berdzikir</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function tasbihCounter() {
    return {
        count: 0,
        customTarget: null,
        selectedIndex: 0,
        soundEnabled: true,
        counting: false,
        totalToday: 0,
        completedSessions: 0,
        circumference: 2 * Math.PI * 85,
        showResetModal: false,
        showCustomErrorModal: false,
        
        dzikirPresets: [
            {
                name: 'Tasbih',
                arabic: 'سُبْحَانَ اللّٰهِ',
                translation: 'Maha Suci Allah',
                target: 33
            },
            {
                name: 'Tahmid',
                arabic: 'اَلْحَمْدُ لِلّٰهِ',
                translation: 'Segala Puji Bagi Allah',
                target: 33
            },
            {
                name: 'Takbir',
                arabic: 'اَللّٰهُ اَكْبَرُ',
                translation: 'Allah Maha Besar',
                target: 34
            }
        ],

        get selectedDzikir() {
            return this.dzikirPresets[this.selectedIndex];
        },

        get progressOffset() {
            const progress = this.count / this.selectedDzikir.target;
            return this.circumference - (progress * this.circumference);
        },

        init() {
            // Load from localStorage
            const saved = localStorage.getItem('tasbih_today');
            if (saved) {
                const data = JSON.parse(saved);
                const today = new Date().toDateString();
                if (data.date === today) {
                    this.totalToday = data.total || 0;
                    this.completedSessions = data.completed || 0;
                } else {
                    // Reset for new day
                    this.saveToday();
                }
            }

            // Keyboard shortcut
            document.addEventListener('keydown', (e) => {
                if (e.code === 'Space' && this.count < this.selectedDzikir.target) {
                    e.preventDefault();
                    this.increment();
                }
            });
        },

        increment() {
            if (this.count >= this.selectedDzikir.target) return;
            
            this.count++;
            this.totalToday++;
            this.counting = true;
            
            // Play sound
            if (this.soundEnabled) {
                this.playSound();
            }

            // Vibrate on mobile
            if (navigator.vibrate) {
                navigator.vibrate(50);
            }

            // Check completion
            if (this.count >= this.selectedDzikir.target) {
                this.completedSessions++;
                this.celebrate();
            }

            // Save progress
            this.saveToday();

            // Remove animation class
            setTimeout(() => {
                this.counting = false;
            }, 300);
        },

        reset() {
            this.showResetModal = true;
        },

        confirmReset() {
            this.count = 0;
            this.showResetModal = false;
        },

        selectDzikir(index) {
            this.selectedIndex = index;
            this.count = 0;
        },

        setCustomTarget() {
            if (this.customTarget && this.customTarget > 0 && this.customTarget <= 9999) {
                this.dzikirPresets.push({
                    name: 'Custom',
                    arabic: 'ذِكْرٌ',
                    translation: 'Dzikir Custom',
                    target: this.customTarget
                });
                this.selectedIndex = this.dzikirPresets.length - 1;
                this.count = 0;
                this.customTarget = null;
            } else {
                this.showCustomErrorModal = true;
            }
        },

        toggleSound() {
            this.soundEnabled = !this.soundEnabled;
        },

        playSound() {
            // Simple beep using Web Audio API
            try {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();
                
                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);
                
                oscillator.frequency.value = 800;
                oscillator.type = 'sine';
                
                gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.1);
                
                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.1);
            } catch (e) {
                console.log('Audio not supported');
            }
        },

        celebrate() {
            // Vibrate pattern for completion
            if (navigator.vibrate) {
                navigator.vibrate([100, 50, 100, 50, 200]);
            }

            // Play completion sound
            if (this.soundEnabled) {
                setTimeout(() => this.playCompletionSound(), 100);
            }
        },

        playCompletionSound() {
            try {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                
                // Play a nice chord
                [800, 1000, 1200].forEach((freq, i) => {
                    setTimeout(() => {
                        const oscillator = audioContext.createOscillator();
                        const gainNode = audioContext.createGain();
                        
                        oscillator.connect(gainNode);
                        gainNode.connect(audioContext.destination);
                        
                        oscillator.frequency.value = freq;
                        oscillator.type = 'sine';
                        
                        gainNode.gain.setValueAtTime(0.2, audioContext.currentTime);
                        gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
                        
                        oscillator.start(audioContext.currentTime);
                        oscillator.stop(audioContext.currentTime + 0.3);
                    }, i * 100);
                });
            } catch (e) {
                console.log('Audio not supported');
            }
        },

        saveToday() {
            const today = new Date().toDateString();
            localStorage.setItem('tasbih_today', JSON.stringify({
                date: today,
                total: this.totalToday,
                completed: this.completedSessions
            }));
        }
    };
}
</script>
@endpush