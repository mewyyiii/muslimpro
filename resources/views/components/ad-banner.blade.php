{{-- Sembunyikan iklan untuk user pro & admin --}}
@auth
    @if(Auth::user()->hasAnyRole(['pro', 'admin']))
        @php return; @endphp
    @endif
@endauth

@php
    $ad = \App\Models\Ad::active()
        ->forPage($page ?? 'all')
        ->where('position', $position ?? 'in_content')
        ->inRandomOrder()
        ->first();
@endphp

@if($ad)
    @if($position === 'footer_sticky')
    {{-- Footer Sticky --}}
    <div x-data="{ show: true }" x-show="show"
         class="fixed bottom-0 left-0 right-0 z-50 flex justify-center px-4 pb-3"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0">
        <div class="relative max-w-lg w-full bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">

            {{-- Tombol tutup --}}
            <button @click="show = false"
                    class="absolute top-2 right-2 z-10 bg-black/40 hover:bg-black/60 text-white
                           w-6 h-6 rounded-full text-xs flex items-center justify-center transition">
                ✕
            </button>

            {{-- Label iklan --}}
            <span class="absolute top-2 left-2 bg-black/40 text-white text-xs px-2 py-0.5 rounded-full">
                Iklan
            </span>

            @if($ad->url)
                <a href="{{ $ad->url }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}"
                         class="w-full object-cover max-h-24">
                </a>
            @else
                <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}"
                     class="w-full object-cover max-h-24">
            @endif

        </div>
    </div>

    @else
    {{-- In Content --}}
    <div class="w-full px-4 py-3">
        <div class="relative max-w-2xl mx-auto rounded-2xl overflow-hidden border border-gray-100 shadow-sm">

            {{-- Label iklan --}}
            <span class="absolute top-2 left-2 bg-black/40 text-white text-xs px-2 py-0.5 rounded-full z-10">
                Iklan
            </span>

            @if($ad->url)
                <a href="{{ $ad->url }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}"
                         class="w-full object-cover max-h-32">
                </a>
            @else
                <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}"
                     class="w-full object-cover max-h-32">
            @endif

            {{-- Upgrade Pro hint --}}
            @auth
            <div class="bg-gray-50 px-4 py-2 flex items-center justify-between">
                <p class="text-xs text-gray-400">Ingin bebas iklan?</p>
                <a href="{{ route('payment.upgrade') }}"
                   class="text-xs text-teal-600 font-semibold hover:underline">
                    Upgrade Pro ✨
                </a>
            </div>
            @endauth

        </div>
    </div>
    @endif

@endif