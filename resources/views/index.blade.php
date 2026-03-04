@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700&display=swap');

    .font-arabic {
        font-family: 'Amiri', serif;
    }

    .surah-card {
        position: relative;
        overflow: hidden;
    }

    /* Badge "sudah dibaca" — kanan bawah */
    .read-badge {
        position: absolute;
        bottom: 10px;
        right: 10px;
        display: flex;
        align-items: center;
        gap: 4px;
        background: rgba(255,255,255,0.22);
        border: 1px solid rgba(255,255,255,0.35);
        backdrop-filter: blur(4px);
        border-radius: 99px;
        padding: 3px 9px 3px 6px;
        font-size: 0.65rem;
        font-weight: 700;
        color: #fff;
        letter-spacing: 0.04em;
    }

    .read-badge svg {
        flex-shrink: 0;
    }

    /* Badge "sedang dibaca" (progress < 100%) */
    .reading-badge {
        position: absolute;
        bottom: 10px;
        right: 10px;
        display: flex;
        align-items: center;
        gap: 4px;
        background: rgba(253,224,71,0.2);
        border: 1px solid rgba(253,224,71,0.45);
        backdrop-filter: blur(4px);
        border-radius: 99px;
        padding: 3px 9px 3px 6px;
        font-size: 0.65rem;
        font-weight: 700;
        color: #fde047;
        letter-spacing: 0.04em;
    }

    /* Mini progress bar inside card (for in-progress surahs) */
    .card-progress-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: rgba(255,255,255,0.15);
        border-radius: 0 0 12px 12px;
        overflow: hidden;
    }

    .card-progress-fill {
        height: 100%;
        background: rgba(255,255,255,0.7);
        border-radius: 0 0 12px 12px;
        transition: width 0.4s ease;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen py-10 px-4 sm:px-6 lg:px-8" style="background: var(--bg-primary);">
    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-2" style="color: var(--text-primary);">
                Al-Quran
            </h1>
        </div>

        {{-- Search --}}
        <div class="mb-8">
            <input
                type="text"
                id="search-input"
                placeholder="Cari surah (Al-Fatihah, Pembukaan)"
                class="w-full px-5 py-3 rounded-xl border-2 text-base transition focus:outline-none"
                style="
                    border-color: rgba(20,184,166,0.35);
                    background: var(--bg-secondary, #fff);
                    color: var(--text-primary);
                "
                oninput="filterSurahs(this.value)"
            >
        </div>

        {{-- Surah Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4" id="surah-grid">
            @foreach($surahs as $surah)
                @php
                    $tracking = $trackingMap[$surah->number] ?? null;
                    $isCompleted = $tracking && $tracking->is_completed;
                    $isReading   = $tracking && !$tracking->is_completed && $tracking->last_verse > 0;
                    $progress    = $tracking ? $tracking->progress_percent : 0;
                @endphp

                <a href="{{ route('quran.show', $surah->number) }}"
                   class="surah-card block rounded-xl p-4 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
                   style="background: linear-gradient(135deg, #1FAF90, #10B981);"
                   data-name="{{ strtolower($surah->name) }}"
                   data-arabic="{{ $surah->arabic_name }}"
                   data-translation="{{ strtolower($surah->translation) }}">

                    {{-- Number + Arabic name --}}
                    <div class="flex justify-between items-start mb-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold"
                              style="background: rgba(255,255,255,0.2); color: #fff;">
                            {{ $surah->number }}
                        </span>
                        <span class="font-arabic text-2xl text-white leading-snug">
                            {{ $surah->arabic_name }}
                        </span>
                    </div>

                    {{-- Latin name & translation --}}
                    <div class="mt-2">
                        <p class="font-bold text-white text-sm">{{ $surah->name }}</p>
                        <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.75);">
                            "{{ $surah->translation }}"
                        </p>
                        <p class="text-xs mt-1" style="color:rgba(255,255,255,0.65);">
                            {{ $surah->total_verses }} Ayat
                        </p>
                    </div>

                    {{-- Badge: Selesai --}}
                    @if($isCompleted)
                        <div class="read-badge">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Selesai
                        </div>
                        {{-- Full green bar --}}
                        <div class="card-progress-bar">
                            <div class="card-progress-fill" style="width:100%"></div>
                        </div>

                    {{-- Badge: Sedang dibaca --}}
                    @elseif($isReading)
                        <div class="reading-badge">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                            </svg>
                            Ayat {{ $tracking->last_verse }}
                        </div>
                        {{-- Progress bar --}}
                        <div class="card-progress-bar">
                            <div class="card-progress-fill" style="width:{{ $progress }}%"></div>
                        </div>
                    @endif

                </a>
            @endforeach
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
function filterSurahs(query) {
    const q = query.toLowerCase().trim();
    document.querySelectorAll('#surah-grid a').forEach(card => {
        const name        = card.dataset.name || '';
        const translation = card.dataset.translation || '';
        const match       = name.includes(q) || translation.includes(q);
        card.style.display = match ? '' : 'none';
    });
}
</script>
@endpush