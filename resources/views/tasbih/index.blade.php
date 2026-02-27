@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif;
    }
    
    @keyframes countPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .count-pulse {
        animation: countPulse 0.3s ease-in-out;
    }

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

    .smooth-transition {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Session dots */
    .session-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 2px solid white;
        background: rgba(255,255,255,0.3);
        transition: all 0.3s ease;
    }
    .session-dot.done {
        background: white;
    }
    .session-dot.active {
        background: rgba(255,255,255,0.7);
        box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
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

        <div x-data="tasbihCounter()" x-init="init()" class="max-w-sm mx-auto">

            {{-- MODAL KONFIRMASI RESET --}}
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
                     class="bg-white rounded-2xl shadow-2xl p-5 w-[90vw] md:w-[360px] text-center">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Reset Counter?</h4>
                    <p class="text-sm text-gray-500 mb-6">Semua hitungan dan sesi akan direset ke awal. Yakin ingin melanjutkan?</p>
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

            {{-- MODAL SESI SELESAI --}}
            <div x-show="showSessionModal"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
                 @click.self="showSessionModal = false">
                <div x-show="showSessionModal"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="bg-white rounded-2xl shadow-2xl p-6 w-[90vw] md:w-[380px] text-center">

                    <template x-if="currentSession < 3">
                        <div>
                            <div class="text-4xl mb-3">✨</div>
                            <h4 class="text-xl font-bold text-gray-800 mb-1">
                                Sesi <span x-text="currentSession"></span> Selesai!
                            </h4>
                            <p class="text-sm text-gray-500 mb-2">
                                <span x-text="currentSession * 33"></span> dari 99 dzikir selesai
                            </p>
                            <p class="text-sm text-teal-600 font-medium mb-6">
                                Lanjutkan sesi <span x-text="currentSession + 1"></span> dari 3
                            </p>
                            <button @click="showSessionModal = false"
                                    class="w-full px-4 py-3 bg-gradient-to-r from-teal-400 to-emerald-500 text-white font-semibold rounded-xl shadow hover:shadow-md transition-all">
                                Lanjutkan →
                            </button>
                        </div>
                    </template>

                    <template x-if="currentSession >= 3">
                        <div>
                            <div class="text-4xl mb-3">🎉</div>
                            <h4 class="text-xl font-bold text-gray-800 mb-1">Alhamdulillah!</h4>
                            <p class="text-sm text-gray-500 mb-2">99 dzikir telah selesai</p>
                            <p class="text-sm text-teal-600 font-medium mb-6">Semua 3 sesi selesai!</p>
                            <button @click="showSessionModal = false"
                                    class="w-full px-4 py-3 bg-gradient-to-r from-teal-400 to-emerald-500 text-white font-semibold rounded-xl shadow hover:shadow-md transition-all">
                                Tutup
                            </button>
                        </div>
                    </template>
                </div>
            </div>
            
            <!-- Main Counter Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-5 mb-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-teal-50 rounded-full -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-emerald-50 rounded-full -ml-16 -mb-16"></div>
                
                <div class="relative z-10">

                    <!-- Indikator 3 Sesi -->
                    <div class="flex items-center justify-center gap-6 mb-3">
                        <template x-for="s in 3" :key="s">
                            <div class="flex flex-col items-center gap-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm smooth-transition"
                                     :class="{
                                        'bg-gradient-to-br from-teal-400 to-emerald-500 text-white shadow-md': s < currentSession || (s === currentSession && count >= 99),
                                        'bg-teal-100 text-teal-700 ring-2 ring-teal-400': s === currentSession && count < 99,
                                        'bg-gray-100 text-gray-400': s > currentSession
                                     }">
                                    <template x-if="s < currentSession || (s === currentSession && count >= 99)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </template>
                                    <template x-if="!(s < currentSession || (s === currentSession && count >= 99))">
                                        <span x-text="s"></span>
                                    </template>
                                </div>
                                <span class="text-xs text-gray-500">Sesi <span x-text="s"></span></span>
                            </div>
                        </template>
                    </div>

                    <!-- Info sesi aktif -->
                    <div class="text-center mb-3">
                        <p class="text-sm text-teal-600 font-semibold">
                            Sesi <span x-text="currentSession"></span> dari 3 &mdash;
                            <span x-text="sessionCount"></span>/33
                        </p>
                        <p class="text-xs text-gray-400 mt-1">Total: <span x-text="count"></span>/99</p>
                    </div>

                    <!-- Counter Display + Button horizontal -->
                    <div class="flex items-center justify-center gap-6 mb-4">
                        
                        <!-- Ring kiri -->
                        <div class="inline-block relative flex-shrink-0">
                            <svg class="transform -rotate-90 w-36 h-36" viewBox="0 0 200 200">
                                <circle cx="100" cy="100" r="85" stroke="#E5E7EB" stroke-width="12" fill="none"/>
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
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <div class="text-4xl font-bold text-gray-800" 
                                     x-text="sessionCount"
                                     :class="{ 'count-pulse': counting }"></div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <span x-text="33 - sessionCount"></span> lagi
                                </div>
                            </div>
                        </div>

                        <!-- Tombol kanan -->
                        <div class="flex flex-col items-center gap-3 flex-shrink-0">
                            <button 
                                @click="increment()"
                                class="ripple w-24 h-24 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 text-white shadow-2xl hover:shadow-3xl transform hover:scale-105 active:scale-95 smooth-transition focus:outline-none focus:ring-4 focus:ring-teal-300"
                                :disabled="count >= 99">
                                <div class="text-2xl font-bold">+1</div>
                                <div class="text-xs mt-0.5">Tap / Space</div>
                            </button>

                            <!-- Reset & Sound di bawah tombol -->
                            <div class="flex gap-2">
                                <button @click="reset()"
                                        class="p-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl smooth-transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </button>
                                <button @click="toggleSound()"
                                        class="p-2 rounded-xl smooth-transition"
                                        :class="soundEnabled ? 'bg-teal-100 text-teal-600' : 'bg-gray-100 text-gray-600'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="soundEnabled">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                                    </svg>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!soundEnabled">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- Completion Message (99x selesai) -->
                    <div x-show="count >= 99" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         class="mt-6 p-4 bg-gradient-to-r from-teal-50 to-emerald-50 border-2 border-teal-200 rounded-2xl text-center">
                        <p class="text-lg font-bold text-teal-700 mb-1">🎉 Alhamdulillah! 🎉</p>
                        <p class="text-sm text-teal-600">99 dzikir telah selesai! Semua 3 sesi tuntas.</p>
                    </div>
                    <!-- Stats inline di dalam card utama -->
                    <div class="grid grid-cols-3 gap-3 mt-4 pt-4 border-t border-gray-100">
                        <div class="text-center">
                            <div class="text-xl font-bold text-teal-600" x-text="totalToday"></div>
                            <div class="text-xs text-gray-500 mt-0.5">Total Dzikir</div>
                        </div>
                        <div class="text-center border-x border-gray-100">
                            <div class="text-xl font-bold text-emerald-600" x-text="(currentSession - 1) + (count >= 99 ? 1 : 0)"></div>
                            <div class="text-xs text-gray-500 mt-0.5">Sesi Selesai</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-teal-600" x-text="count + '/99'"></div>
                            <div class="text-xs text-gray-500 mt-0.5">Progress</div>
                        </div>
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
        count: 0,           // total keseluruhan (0-99)
        currentSession: 1,  // sesi aktif (1, 2, 3)
        soundEnabled: true,
        counting: false,
        totalToday: 0,
        circumference: 2 * Math.PI * 85,
        showResetModal: false,
        showSessionModal: false,

        // Hitung progress per sesi (0-33)
        get sessionCount() {
            return this.count - ((this.currentSession - 1) * 33);
        },

        // Progress ring berdasarkan sesi aktif (33x = penuh)
        get progressOffset() {
            const progress = this.sessionCount / 33;
            return this.circumference - (progress * this.circumference);
        },

        init() {
            const saved = localStorage.getItem('tasbih_today');
            if (saved) {
                const data = JSON.parse(saved);
                const today = new Date().toDateString();
                if (data.date === today) {
                    this.totalToday = data.total || 0;
                }
            }

            document.addEventListener('keydown', (e) => {
                if (e.code === 'Space' && this.count < 99) {
                    e.preventDefault();
                    this.increment();
                }
            });
        },

        increment() {
            if (this.count >= 99) return;

            this.count++;
            this.totalToday++;
            this.counting = true;

            if (this.soundEnabled) this.playSound();
            if (navigator.vibrate) navigator.vibrate(50);

            // Cek apakah sesi selesai (setiap 33x)
            if (this.count % 33 === 0) {
                // Naikan sesi kalau belum sesi 3
                if (this.currentSession < 3) {
                    this.currentSession++;
                }
                this.celebrate();
                this.showSessionModal = true;
            }

            this.saveToday();

            setTimeout(() => { this.counting = false; }, 300);
        },

        reset() {
            this.showResetModal = true;
        },

        confirmReset() {
            this.count = 0;
            this.currentSession = 1;
            this.showResetModal = false;
        },

        toggleSound() {
            this.soundEnabled = !this.soundEnabled;
        },

        playSound() {
            try {
                const ctx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.frequency.value = 800;
                osc.type = 'sine';
                gain.gain.setValueAtTime(0.3, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.1);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.1);
            } catch (e) {}
        },

        celebrate() {
            if (navigator.vibrate) navigator.vibrate([100, 50, 100, 50, 200]);
            if (this.soundEnabled) {
                setTimeout(() => {
                    try {
                        const ctx = new (window.AudioContext || window.webkitAudioContext)();
                        [800, 1000, 1200].forEach((freq, i) => {
                            setTimeout(() => {
                                const osc = ctx.createOscillator();
                                const gain = ctx.createGain();
                                osc.connect(gain);
                                gain.connect(ctx.destination);
                                osc.frequency.value = freq;
                                osc.type = 'sine';
                                gain.gain.setValueAtTime(0.2, ctx.currentTime);
                                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.3);
                                osc.start(ctx.currentTime);
                                osc.stop(ctx.currentTime + 0.3);
                            }, i * 100);
                        });
                    } catch (e) {}
                }, 100);
            }
        },

        saveToday() {
            const today = new Date().toDateString();
            localStorage.setItem('tasbih_today', JSON.stringify({
                date: today,
                total: this.totalToday,
            }));
        }
    };
}
</script>
@endpush