@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-400 via-teal-500 to-teal-600 py-8 md:py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ══ HEADER ══ --}}
        <div class="text-center mb-8">
           <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg mb-2 flex items-center justify-center gap-3">
                Progres Al-Quran
            </h1>
            <p class="text-white/80 text-base md:text-lg">Pantau progres bacaan Al-Quran kamu</p>
        </div>

        {{-- ══ STATISTIK ══ --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-6">
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-1">
                    {{ $totalSurahCompleted }}<span class="text-lg text-gray-400">/114</span>
                </div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">Surah Selesai</div>
                <div class="mt-2 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full transition-all duration-500"
                         style="width: {{ $percentCompleted }}%"></div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-amber-500 mb-1">
                    {{ $streak }}
                </div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">Hari Berturut</div>
                <div class="mt-2 text-xs {{ $readToday ? 'text-emerald-400' : 'text-gray-400' }} font-medium">
                    {{ $readToday ? '✓ Sudah baca hari ini' : 'Belum baca hari ini' }}
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-teal-600 mb-1">
                    {{ number_format($totalVersesRead) }}
                </div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">Ayat Dibaca</div>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center">
                <div class="text-3xl md:text-4xl font-bold text-indigo-600 mb-1">{{ $totalHours }}j</div>
                <div class="text-xs md:text-sm text-gray-500 font-medium">{{ $totalMinutes }} menit</div>
            </div>
        </div>

        {{-- ══ DAFTAR TRACKING ══ --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 md:p-8 mb-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 484.228 484.228" xmlns="http://www.w3.org/2000/svg">
                            <path d="M484.06,210.989L438.305,52.856c-0.328-1.133-1.112-2.079-2.164-2.611c-1.054-0.533-2.278-0.605-3.385-0.197l-12.411,4.561l-1.982-6.582c-0.339-1.127-1.131-2.063-2.186-2.584c-1.055-0.522-2.279-0.583-3.381-0.168c-29.582,11.134-44.034,14.763-107.786,22.14c-40.168,4.647-56.44,21.963-62.954,33.842c-6.469-11.884-22.678-29.195-62.839-33.842c-63.753-7.377-78.205-11.006-107.787-22.14c-1.101-0.415-2.326-0.354-3.381,0.168c-1.055,0.521-1.847,1.457-2.186,2.584l-1.976,6.562l-12.423-4.543c-1.105-0.403-2.332-0.331-3.382,0.201c-1.051,0.533-1.833,1.478-2.161,2.609L0.168,210.989c-0.638,2.207,0.593,4.521,2.779,5.226l141.114,45.496l-59.117,47.54c-1.004,0.807-1.587,2.025-1.587,3.312v32.49c0,1.709,1.023,3.252,2.599,3.916c1.574,0.664,3.394,0.32,4.617-0.872l26.274-25.606c4.096-3.976,10.665-3.88,14.64,0.216l5.087,5.24c1.926,1.983,2.964,4.599,2.923,7.364c-0.041,2.765-1.156,5.348-3.15,7.284l-51.71,50.528c-0.818,0.799-1.279,1.896-1.279,3.04v38.814c0,1.698,1.011,3.233,2.569,3.904c0.542,0.233,1.113,0.346,1.68,0.346c1.066,0,2.117-0.401,2.922-1.163l151.508-143.381l151.74,143.383c0.805,0.761,1.855,1.161,2.92,1.161c0.567,0,1.14-0.114,1.681-0.347c1.559-0.671,2.568-2.206,2.568-3.903v-38.814c0-1.144-0.461-2.24-1.279-3.04l-51.722-50.538c-1.983-1.926-3.099-4.509-3.14-7.274c-0.041-2.765,0.997-5.38,2.923-7.364l5.087-5.24c3.976-4.096,10.542-4.193,14.634-0.223l26.281,25.613c1.224,1.192,3.045,1.536,4.617,0.872c1.575-0.664,2.599-2.207,2.599-3.916v-32.49c0-1.286-0.582-2.503-1.583-3.309l-59.081-47.609l140.999-45.429C483.467,215.51,484.697,213.196,484.06,210.989z"/>
                        </svg>
                    </span>
                    Surah yang Sedang/Sudah Dibaca
                </h2>
                <a href="{{ route('quran.index') }}"
                   class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 hover:underline transition-colors">
                    + Baca Surah Baru
                </a>
            </div>

            @if($trackings->isEmpty())
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700 mb-2">Belum Ada Progress</h3>
                    <p class="text-sm text-gray-500 mb-4">Mulai baca Al-Quran untuk melacak progressmu</p>
                    <a href="{{ route('quran.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-400 to-teal-500 text-white font-semibold rounded-xl shadow hover:shadow-md transition-all hover:-translate-y-0.5">
                        Mulai Sekarang
                    </a>
                </div>
            @else
                {{-- List surah (dikontrol JS pagination) --}}
                <div id="tracking-list" class="space-y-3">
                    @foreach($trackings as $i => $track)
                    <div class="tracking-item border border-gray-200 rounded-xl p-4 transition-all duration-200
                                {{ $track->is_completed ? 'bg-emerald-50 border-emerald-200' : 'bg-white' }}"
                         data-index="{{ $i }}">
                        <div class="flex items-center justify-between gap-4">

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                    <h3 class="font-bold text-gray-800 truncate">
                                        {{ $track->surah_number }}. {{ $track->surah->name }}
                                    </h3>
                                    @if($track->is_completed)
                                        <span class="px-2 py-0.5 bg-emerald-500 text-white text-xs font-semibold rounded-full whitespace-nowrap">
                                            ✓ Selesai
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500">
                                    Ayat {{ $track->last_verse }} / {{ $track->surah->total_verses }}
                                    · {{ $track->progress_percent }}% selesai
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    Terakhir: {{ $track->last_read_date->locale('id')->isoFormat('D MMM YYYY') }}
                                    @if($track->duration_seconds > 0)
                                        · {{ $track->formatted_duration }}
                                    @endif
                                </p>
                            </div>

                            {{-- Progress ring --}}
                            <div class="flex-shrink-0 hidden sm:block">
                                <div class="relative w-14 h-14">
                                    <svg class="transform -rotate-90 w-14 h-14" viewBox="0 0 64 64">
                                        <circle cx="32" cy="32" r="28" stroke="#E5E7EB" stroke-width="6" fill="none"/>
                                        <circle cx="32" cy="32" r="28"
                                                stroke="{{ $track->is_completed ? '#10B981' : '#14B8A6' }}"
                                                stroke-width="6" fill="none" stroke-linecap="round"
                                                stroke-dasharray="{{ 2 * pi() * 28 }}"
                                                stroke-dashoffset="{{ 2 * pi() * 28 * (1 - $track->progress_percent / 100) }}"
                                                class="transition-all duration-500"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-xs font-bold {{ $track->is_completed ? 'text-emerald-600' : 'text-teal-600' }}">
                                            {{ $track->progress_percent }}%
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Action --}}
                            <div class="flex-shrink-0">
                                <a href="{{ route('quran.show', $track->surah_number) }}"
                                   class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-lg transition-colors text-center whitespace-nowrap block">
                                    {{ $track->is_completed ? 'Baca Lagi' : 'Lanjutkan' }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- ══ PAGINATION ══ --}}
                <div id="pagination-wrap" class="mt-6 flex flex-col items-center gap-3">

                    {{-- Info --}}
                    <p id="page-info" class="text-xs text-gray-400"></p>

                    {{-- Controls --}}
                    <div id="pagination-controls" class="flex items-center gap-1 flex-wrap justify-center"></div>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
    /* Pagination buttons */
    .page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 6px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background 0.15s, color 0.15s, transform 0.1s;
        text-decoration: none;
        background: none;
        color: #10b981;
    }
    .page-btn:hover { background: rgba(16,185,129,0.08); transform: translateY(-1px); }
    .page-btn.active {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 2px 8px rgba(16,185,129,0.35);
    }
    .page-btn.active:hover { transform: none; }
    .page-btn.disabled { color: #d1d5db; pointer-events: none; }
    .page-btn-prev-next {
        color: #6b7280;
        font-size: 0.8rem;
        gap: 4px;
    }
    .page-btn-prev-next:hover { color: #10b981; }
    .page-btn-prev-next.disabled { color: #e5e7eb; }

    /* Dots separator */
    .page-dots {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 36px;
        color: #9ca3af;
        font-weight: 700;
        font-size: 0.85rem;
    }

    /* Mobile: smaller buttons */
    @media (max-width: 480px) {
        .page-btn { min-width: 32px; height: 32px; font-size: 0.78rem; }
    }

    /* Smooth item fade */
    .tracking-item {
        transition: opacity 0.2s ease, transform 0.2s ease;
    }
    .tracking-item.hidden-item {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const PER_PAGE    = 5;
    const items       = Array.from(document.querySelectorAll('.tracking-item'));
    const total       = items.length;
    const totalPages  = Math.ceil(total / PER_PAGE);

    if (total <= PER_PAGE) {
        // Semua muat 1 halaman, sembunyikan pagination
        document.getElementById('pagination-wrap').style.display = 'none';
        return;
    }

    let currentPage = 1;

    function showPage(page) {
        currentPage = page;

        // Tampilkan/sembunyikan item
        items.forEach((item, i) => {
            const start = (page - 1) * PER_PAGE;
            const end   = start + PER_PAGE;
            if (i >= start && i < end) {
                item.classList.remove('hidden-item');
            } else {
                item.classList.add('hidden-item');
            }
        });

        // Update info
        const start = (page - 1) * PER_PAGE + 1;
        const end   = Math.min(page * PER_PAGE, total);
        document.getElementById('page-info').textContent =
            `Menampilkan ${start}–${end} dari ${total} surah`;

        renderPagination();

        // Scroll ke atas card
        document.getElementById('tracking-list').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function renderPagination() {
        const wrap = document.getElementById('pagination-controls');
        wrap.innerHTML = '';

        // ─ Prev ─
        const prev = makeBtn('', 'prev');
        prev.classList.add('page-btn-prev-next');
        prev.innerHTML = `<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg><span class="hidden sm:inline">Sebelumnya</span>`;
        if (currentPage === 1) prev.classList.add('disabled');
        prev.addEventListener('click', () => { if (currentPage > 1) showPage(currentPage - 1); });
        wrap.appendChild(prev);

        // ─ Page numbers (Google style) ─
        const pages = getPageRange(currentPage, totalPages);
        pages.forEach(p => {
            if (p === '...') {
                const dots = document.createElement('span');
                dots.className = 'page-dots';
                dots.textContent = '...';
                wrap.appendChild(dots);
            } else {
                const btn = makeBtn(p, 'num');
                if (p === currentPage) btn.classList.add('active');
                btn.addEventListener('click', () => showPage(p));
                wrap.appendChild(btn);
            }
        });

        // ─ Next ─
        const next = makeBtn('', 'next');
        next.classList.add('page-btn-prev-next');
        next.innerHTML = `<span class="hidden sm:inline">Berikutnya</span><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>`;
        if (currentPage === totalPages) next.classList.add('disabled');
        next.addEventListener('click', () => { if (currentPage < totalPages) showPage(currentPage + 1); });
        wrap.appendChild(next);
    }

    function makeBtn(label, type) {
        const btn = document.createElement('button');
        btn.className = 'page-btn';
        btn.textContent = label;
        return btn;
    }

    // Google-style page range: 1 ... 4 5 6 ... 10
    function getPageRange(current, total) {
        if (total <= 7) {
            return Array.from({ length: total }, (_, i) => i + 1);
        }
        const pages = [];
        if (current <= 4) {
            for (let i = 1; i <= 5; i++) pages.push(i);
            pages.push('...');
            pages.push(total);
        } else if (current >= total - 3) {
            pages.push(1);
            pages.push('...');
            for (let i = total - 4; i <= total; i++) pages.push(i);
        } else {
            pages.push(1);
            pages.push('...');
            pages.push(current - 1);
            pages.push(current);
            pages.push(current + 1);
            pages.push('...');
            pages.push(total);
        }
        return pages;
    }

    // Init
    showPage(1);
});
</script>
@endpush