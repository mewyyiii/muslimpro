{{--
    Komponen Ad Banner — tampil hanya untuk free user.

    CARA PAKAI di blade manapun:
    @include('components.ad-banner', ['position' => 'in_content', 'page' => 'quran'])
    @include('components.ad-banner', ['position' => 'footer_sticky'])

    Parameter:
    - position : 'footer_sticky' | 'in_content'
    - page     : nama halaman (opsional, default 'all')
--}}

@php
    use App\Models\Advertisement;

    // Jangan tampilkan iklan untuk user Pro
    $showAds = !auth()->check() || !auth()->user()->isProActive();

    if ($showAds) {
        $ad = Advertisement::getForDisplay(
            $position ?? 'footer_sticky',
            $page ?? 'all'
        );

        // Record impression
        if ($ad) {
            $ad->recordImpression();
        }
    }
@endphp

@if($showAds && isset($ad) && $ad)

    {{-- ═══════════════════════════════════════════
         FOOTER STICKY
    ═══════════════════════════════════════════ --}}
    @if(($position ?? '') === 'footer_sticky')
    <div id="adFooterSticky"
         class="fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-gray-200 shadow-lg"
         x-data="{ visible: true }"
         x-show="visible"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100">

        <div class="max-w-4xl mx-auto px-3 py-2 flex items-center gap-3">

            {{-- Label iklan --}}
            <span class="text-[9px] text-gray-400 font-semibold uppercase tracking-wider flex-shrink-0 border border-gray-200 px-1.5 py-0.5 rounded">
                Iklan
            </span>

            {{-- Banner image atau teks --}}
            <a href="{{ $ad->url ?? '#' }}"
               target="{{ $ad->url ? '_blank' : '_self' }}"
               rel="noopener noreferrer"
               onclick="recordAdClick({{ $ad->id }})"
               class="flex-1 flex items-center gap-3 min-w-0">
                @if($ad->image_path)
                    <img src="{{ $ad->image_url }}"
                         alt="{{ $ad->title }}"
                         class="h-10 w-auto rounded-lg object-cover flex-shrink-0 max-w-[120px]">
                @endif
                <span class="text-sm font-semibold text-gray-700 truncate">{{ $ad->title }}</span>
            </a>

            {{-- Upgrade CTA --}}
            <a href="{{ route('pro.upgrade') }}"
               class="flex-shrink-0 text-[10px] font-bold text-teal-600 hover:text-teal-700
                      border border-teal-200 hover:border-teal-400 px-2.5 py-1.5 rounded-lg
                      transition-colors whitespace-nowrap bg-teal-50 hover:bg-teal-100">
                👑 Hapus Iklan
            </a>

            {{-- Tutup --}}
            <button @click="visible = false"
                    class="flex-shrink-0 w-6 h-6 flex items-center justify-center
                           text-gray-400 hover:text-gray-600 hover:bg-gray-100
                           rounded-full transition-colors text-sm">
                ✕
            </button>
        </div>
    </div>

    {{-- Spacer supaya konten tidak tertutup sticky ad --}}
    <div class="h-14" x-data="{ visible: true }" x-show="visible" id="adFooterSpacer"></div>
    @endif

    {{-- ═══════════════════════════════════════════
         IN-CONTENT
    ═══════════════════════════════════════════ --}}
    @if(($position ?? '') === 'in_content')
    <div class="my-4 rounded-2xl overflow-hidden border border-gray-100 shadow-sm bg-white"
         x-data="{ visible: true }"
         x-show="visible">

        <div class="flex items-center justify-between px-3 py-1.5 bg-gray-50 border-b border-gray-100">
            <span class="text-[9px] text-gray-400 font-semibold uppercase tracking-wider">Iklan</span>
            <div class="flex items-center gap-2">
                <a href="{{ route('pro.upgrade') }}"
                   class="text-[9px] font-bold text-teal-600 hover:underline">
                    👑 Hapus iklan
                </a>
                <button @click="visible = false"
                        class="text-gray-300 hover:text-gray-500 text-xs transition-colors">✕</button>
            </div>
        </div>

        <a href="{{ $ad->url ?? '#' }}"
           target="{{ $ad->url ? '_blank' : '_self' }}"
           rel="noopener noreferrer"
           onclick="recordAdClick({{ $ad->id }})"
           class="block">
            @if($ad->image_path)
                <img src="{{ $ad->image_url }}"
                     alt="{{ $ad->title }}"
                     class="w-full max-h-32 object-cover">
            @else
                <div class="px-4 py-5 bg-gradient-to-r from-teal-50 to-emerald-50">
                    <p class="font-semibold text-gray-700 text-sm">{{ $ad->title }}</p>
                </div>
            @endif
        </a>
    </div>
    @endif

@endif

@once
@push('scripts')
<script>
function recordAdClick(adId) {
    fetch(`/ads/${adId}/click`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    }).catch(() => {});
}
</script>
@endpush
@endonce