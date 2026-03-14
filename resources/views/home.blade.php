@extends('layouts.app')
{{-- Taruh di bagian atas @section('content') --}}
@if(request('upgrade') === 'success')
    <div id="upgrade-notif" class="bg-teal-50 border border-teal-200 text-teal-700 px-6 py-4 rounded-2xl mx-4 mt-4 text-sm flex items-center justify-between">
        <span class="flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L13.09 8.26L19 6L15.45 11.16L21 13.27L15.09 14.5L17 20.5L12 17L7 20.5L8.91 14.5L3 13.27L8.55 11.16L5 6L10.91 8.26L12 2Z" fill="#0d9488" stroke="#0d9488" stroke-width="1.5" stroke-linejoin="round"/>
            </svg>
            Selamat! Kamu sekarang sudah menjadi member <strong>Pro</strong>. Iklan telah dinonaktifkan.
        </span>
        <button onclick="dismissNotif()" class="ml-4 text-teal-400 hover:text-teal-600 font-bold text-lg leading-none">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <script>
        // Hapus query param dari URL tanpa reload
        history.replaceState(null, '', '{{ route('home') }}');
        
        function dismissNotif() {
            document.getElementById('upgrade-notif').remove();
        }
    </script>
@elseif(request('upgrade') === 'pending')
    <div id="upgrade-notif" class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-6 py-4 rounded-2xl mx-4 mt-4 text-sm flex items-center justify-between">
        <span class="flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#d97706" stroke-width="2"/>
                <path d="M12 6V12L16 14" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Pembayaran sedang diproses. Role Pro akan aktif setelah pembayaran dikonfirmasi.
        </span>
        <button onclick="dismissNotif()" class="ml-4 text-yellow-400 hover:text-yellow-600 font-bold text-lg leading-none">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <script>
        history.replaceState(null, '', '{{ route('home') }}');
        
        function dismissNotif() {
            document.getElementById('upgrade-notif').remove();
        }
    </script>
@endif
@section('content')
@include('components.ad-banner', ['position' => 'in_content', 'page' => 'home'])
<div class="min-h-screen bg-gradient-to-b from-teal-700 via-teal-600 to-emerald-500">

    {{-- ═══════════════════════════════════════
         HEADER
    ═══════════════════════════════════════ --}}
    <div class="px-4 pt-10 pb-5 md:px-8 lg:px-12">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-white leading-tight flex items-center gap-2">Assalamu'alaikum</h1>
                <p class="text-teal-200 text-xs mt-0.5">NurSteps — Pendamping Ibadah Anda</p>
            </div>
            <div class="w-10 h-10 rounded-xl overflow-hidden flex-shrink-0">
                <!-- NURSTEPS LOGO ICON (NEW) -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" width="40" height="40">
                  <defs>
                    <radialGradient id="bgGradHome" cx="50%" cy="45%" r="65%">
                      <stop offset="0%" stop-color="#2ecf8e"/>
                      <stop offset="100%" stop-color="#1aaa72"/>
                    </radialGradient>
                    <filter id="glowHome" x="-40%" y="-40%" width="180%" height="180%">
                      <feGaussianBlur in="SourceGraphic" stdDeviation="28" result="blur1"/>
                      <feGaussianBlur in="SourceGraphic" stdDeviation="12" result="blur2"/>
                      <feColorMatrix in="blur1" type="matrix"
                        values="0 0 0 0 0.5 0 0 0 0 1 0 0 0 0 0.7 0 0 0 0.6 0" result="colorBlur"/>
                      <feMerge>
                        <feMergeNode in="colorBlur"/>
                        <feMergeNode in="blur2"/>
                        <feMergeNode in="SourceGraphic"/>
                      </feMerge>
                    </filter>
                    <filter id="diamondGlowHome" x="-80%" y="-80%" width="360%" height="360%">
                      <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"/>
                      <feMerge>
                        <feMergeNode in="blur"/>
                        <feMergeNode in="SourceGraphic"/>
                      </feMerge>
                    </filter>
                    <filter id="sparkleGlowHome" x="-100%" y="-100%" width="400%" height="400%">
                      <feGaussianBlur in="SourceGraphic" stdDeviation="4" result="blur"/>
                      <feMerge>
                        <feMergeNode in="blur"/>
                        <feMergeNode in="SourceGraphic"/>
                      </feMerge>
                    </filter>
                    <radialGradient id="centerGlowHome" cx="52%" cy="48%" r="35%">
                      <stop offset="0%" stop-color="white" stop-opacity="0.08"/>
                      <stop offset="100%" stop-color="transparent" stop-opacity="0"/>
                    </radialGradient>
                  </defs>
                  <rect width="1024" height="1024" fill="url(#bgGradHome)"/>
                  <rect width="1024" height="1024" fill="url(#centerGlowHome)"/>
                  <text x="510" y="570" text-anchor="middle" dominant-baseline="middle"
                    font-family="'Noto Naskh Arabic', 'Arabic Typesetting', 'Traditional Arabic', 'Geeza Pro', serif"
                    font-size="430" font-weight="bold" fill="white" direction="rtl"
                    filter="url(#glowHome)">نور</text>
                  <rect x="668" y="168" width="46" height="46" rx="4" ry="4" fill="white"
                    transform="rotate(45, 691, 191)" filter="url(#diamondGlowHome)"/>
                  <g transform="translate(952, 952)" filter="url(#sparkleGlowHome)" fill="white" opacity="0.75">
                    <polygon points="0,-16 4,-4 16,0 4,4 0,16 -4,4 -16,0 -4,-4"/>
                  </g>
                </svg>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         MAIN CONTENT
    ═══════════════════════════════════════ --}}
    <div class="px-4 md:px-8 lg:px-12 pb-10">
        <div class="max-w-4xl mx-auto space-y-3">

            {{-- ─────────────────────────────────────
                 FITUR GRID — ala Muslim Pro
            ───────────────────────────────────── --}}
            <div class="bg-white rounded-2xl shadow-md p-4">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-3">Fitur</p>
                <div class="grid grid-cols-6 gap-2">

                    {{-- Al-Quran --}}
                    <a href="{{ route('quran.index') }}"
                    class="flex flex-col items-center gap-1.5 p-2 rounded-xl
                            hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-12 h-12 rounded-2xl shadow
                                    bg-gradient-to-br from-emerald-400 to-teal-600
                                    flex items-center justify-center">
                            <svg class="w-6 h-6" viewBox="0 0 484.228 484.228" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path d="M484.06,210.989L438.305,52.856c-0.328-1.133-1.112-2.079-2.164-2.611c-1.054-0.533-2.278-0.605-3.385-0.197l-12.411,4.561l-1.982-6.582c-0.339-1.127-1.131-2.063-2.186-2.584c-1.055-0.522-2.279-0.583-3.381-0.168c-29.582,11.134-44.034,14.763-107.786,22.14c-40.168,4.647-56.44,21.963-62.954,33.842c-6.469-11.884-22.678-29.195-62.839-33.842c-63.753-7.377-78.205-11.006-107.787-22.14c-1.101-0.415-2.326-0.354-3.381,0.168c-1.055,0.521-1.847,1.457-2.186,2.584l-1.976,6.562l-12.423-4.543c-1.105-0.403-2.332-0.331-3.382,0.201c-1.051,0.533-1.833,1.478-2.161,2.609L0.168,210.989c-0.638,2.207,0.593,4.521,2.779,5.226l141.114,45.496l-59.117,47.54c-1.004,0.807-1.587,2.025-1.587,3.312v32.49c0,1.709,1.023,3.252,2.599,3.916c1.574,0.664,3.394,0.32,4.617-0.872l26.274-25.606c4.096-3.976,10.665-3.88,14.64,0.216l5.087,5.24c1.926,1.983,2.964,4.599,2.923,7.364c-0.041,2.765-1.156,5.348-3.15,7.284l-51.71,50.528c-0.818,0.799-1.279,1.896-1.279,3.04v38.814c0,1.698,1.011,3.233,2.569,3.904c0.542,0.233,1.113,0.346,1.68,0.346c1.066,0,2.117-0.401,2.922-1.163l151.508-143.381l151.74,143.383c0.805,0.761,1.855,1.161,2.92,1.161c0.567,0,1.14-0.114,1.681-0.347c1.559-0.671,2.568-2.206,2.568-3.903v-38.814c0-1.144-0.461-2.24-1.279-3.04l-51.722-50.538c-1.983-1.926-3.099-4.509-3.14-7.274c-0.041-2.765,0.997-5.38,2.923-7.364l5.087-5.24c3.976-4.096,10.542-4.193,14.634-0.223l26.281,25.613c1.224,1.192,3.045,1.536,4.617,0.872c1.575-0.664,2.599-2.207,2.599-3.916v-32.49c0-1.286-0.582-2.503-1.583-3.309l-59.081-47.609l140.999-45.429C483.467,215.51,484.697,213.196,484.06,210.989z M389.745,110.873h38.663l2.408,8h-6.571c-2.348,0-4.25,1.903-4.25,4.25c0,2.347,1.902,4.25,4.25,4.25h9.131l12.796,42.5h-42.927c-2.348,0-4.25,1.903-4.25,4.25c0,2.347,1.902,4.25,4.25,4.25h45.485l4.066,13.506c-21.982,7.912-73.793,23.604-147.522,27.514c-32.093,1.702-48.683,13.718-56.95,23.5c-0.729,0.862-1.407,1.723-2.04,2.577v-85.096h63.461c2.348,0,4.25-1.903,4.25-4.25c0-2.347-1.902-4.25-4.25-4.25h-63.461v-15.438c0.561-3.152,7.102-31.816,59.703-37.902c61.527-7.119,83.698-13.038,111.668-23.373l8.193,27.212h-36.104c-2.348,0-4.25,1.903-4.25,4.25C385.495,108.97,387.398,110.873,389.745,110.873z M33.24,185.873h26.505c2.348,0,4.25-1.903,4.25-4.25c0-2.347-1.902-4.25-4.25-4.25H35.799l7.376-24.5h62.07c2.348,0,4.25-1.903,4.25-4.25c0-2.347-1.902-4.25-4.25-4.25H45.735l4.968-16.5h23.043c2.348,0,4.25-1.903,4.25-4.25c0-2.347-1.902-4.25-4.25-4.25H53.261l13.492-44.813c29.514,10.936,51.988,17.089,111.488,23.974c52.74,6.103,59.033,34.906,59.543,37.888v48.952h-15.039c-2.348,0-4.25,1.903-4.25,4.25c0,2.347,1.902,4.25,4.25,4.25h15.039v5.5h-34.039c-2.348,0-4.25,1.903-4.25,4.25c0,2.347,1.902,4.25,4.25,4.25h34.039v37.507c-0.609-0.823-1.256-1.65-1.954-2.48c-8.23-9.784-24.779-21.805-56.876-23.507c-73.731-3.91-125.541-19.602-147.522-27.514L33.24,185.873z M246.284,282.998v-17.436c0.469-3.178,6.484-34.874,59.44-37.682c79.464-4.214,134.024-21.977,153.794-29.418c2.093-0.788,3.217-3.062,2.572-5.203L422.8,62.762l8.607-3.163l43.341,149.79L246.284,282.998z M52.822,59.593l8.611,3.149L22.139,193.26c-0.645,2.141,0.479,4.415,2.572,5.203c19.769,7.441,74.328,25.204,153.794,29.418c52.999,2.811,58.835,34.556,59.279,37.671v17.445L9.48,209.39L52.822,59.593z M91.858,397.951l50.42-49.268c3.613-3.507,5.644-8.211,5.719-13.246c0.075-5.035-1.816-9.798-5.322-13.411l-5.087-5.24c-7.239-7.459-19.198-7.637-26.665-0.389l-19.064,18.579v-20.378l61.886-49.766l17.631,5.685l-19.632,19.598c-1.661,1.658-1.663,4.349-0.005,6.01c0.83,0.831,1.919,1.247,3.008,1.247c1.086,0,2.173-0.414,3.003-1.242l22.721-22.682l23.368,7.534l-42.849,42.886c-1.658,1.661-1.657,4.352,0.003,6.01c0.83,0.829,1.917,1.244,3.004,1.244c1.088,0,2.177-0.415,3.007-1.246l45.923-45.964l20.979,6.764L91.858,425.103V397.951z M392.445,314.595v20.381l-19.071-18.586c-7.459-7.24-19.418-7.063-26.659,0.395l-5.087,5.24c-3.507,3.613-5.398,8.376-5.322,13.411c0.075,5.035,2.106,9.739,5.708,13.236l50.432,49.278v27.162L250.173,290.676l26.105-8.411l26.712,26.712c0.829,0.83,1.917,1.245,3.005,1.245s2.176-0.415,3.005-1.245c1.66-1.66,1.66-4.351,0-6.011l-23.63-23.63l45.233-14.574L392.445,314.595z"/>
                                <path d="M148.245,119.373h-33.5c-2.348,0-4.25,1.903-4.25,4.25c0,2.347,1.902,4.25,4.25,4.25h33.5c2.348,0,4.25-1.903,4.25-4.25C152.495,121.276,150.593,119.373,148.245,119.373z"/>
                            </svg>
                        </div>
                        <span class="text-[10px] font-semibold text-gray-500 text-center leading-tight">Al-Quran</span>
                    </a>

                    {{-- Shalat --}}
                    <a href="{{ route('prayer-tracking.index') }}"
                       class="flex flex-col items-center gap-1.5 p-2 rounded-xl
                              hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-12 h-12 rounded-2xl shadow
                                    bg-gradient-to-br from-teal-400 to-cyan-600
                                    flex items-center justify-center">
                            <svg class="w-6 h-6" viewBox="60 120 360 220" xmlns="http://www.w3.org/2000/svg">
                                <path fill="white" d="M397.886,238.967c-1.202-2.712-3.89-4.46-6.856-4.46h-32.162c-3.413-9.876-12.071-31.572-28.48-53.45
                                c-29.019-38.692-68.521-59.229-114.27-59.44c-6.534-1.114-56.24-8.741-81.407,12.237c-9.696,8.083-14.613,19.147-14.613,32.886
                                c0,20.927,28.343,64.929,43.219,86.583H108.78c-2.546,0-7.078-2.654-11.076-4.997c-6.04-3.538-12.887-7.548-20.285-7.548
                                c-18.66,0-19.558,25.105-20.04,38.594c-0.161,4.508-1.549,8.055-3.018,11.81c-1.602,4.096-3.259,8.331-3.259,13.547
                                c0,5.921,3.306,11.342,9.07,14.873c5.603,3.432,13.516,5.172,23.519,5.172c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5
                                c-1.374,0-2.627-0.047-3.813-0.118c3.929-7.999,9.833-13.734,12.735-16.243h12.241l2.743,24.689
                                c0.422,3.798,3.633,6.672,7.454,6.672H221.68c5.604,0,10.723-2.208,14.804-6.385c6.74-6.899,9.872-18.609,11.318-28.744
                                c17.999,21.989,30.988,32.73,31.86,33.441c1.349,1.1,3.025,1.688,4.739,1.688c0.43,0,0.862-0.037,1.292-0.112
                                c2.145-0.375,4.02-1.663,5.139-3.529l0.003-0.005c3.584,2.37,7.781,3.646,12.176,3.646h94.291c3.353,0,6.298-2.225,7.214-5.45
                                C404.979,317.696,415.638,279.012,397.886,238.967z M89.963,278.412c-1.573,0-3.106,0.495-4.383,1.414
                                c-0.55,0.396-12.341,9.011-19.386,23.664c0.261-2.028,1.104-4.204,2.137-6.842c1.687-4.313,3.786-9.679,4.038-16.739
                                c0.839-23.452,4.621-24.129,5.05-24.129c3.329,0,8.31,2.917,12.704,5.491c3.826,2.241,7.739,4.526,11.813,5.866l1.253,11.276
                                H89.963z M225.748,307.911c-1.276,1.305-2.493,1.862-4.068,1.862h-99.915l-4.605-41.45h60.615c2.821,0,5.403-1.583,6.684-4.097
                                s1.041-5.533-0.618-7.814c-18.846-25.913-48.743-73.171-48.743-89.672c0-9.199,3.011-16.184,9.204-21.353
                                c15.769-13.163,49.099-11.799,65.282-9.604c4.089,15.278,3.347,31.245,1.607,43.328c-0.955-1.906-1.57-3.09-1.677-3.296
                                c-1.916-3.672-6.443-5.096-10.118-3.18c-3.672,1.916-5.096,6.445-3.181,10.118c0.114,0.219,10.706,20.611,17.003,38.75
                                c-1.605,1.307-2.58,2.165-2.798,2.359c-2.664,2.373-3.288,6.293-1.492,9.376c8.591,14.745,17.1,27.55,25.087,38.527
                                C234.142,282.665,232.06,301.46,225.748,307.911z M225.151,231.199c10.035-7.741,34.517-24.5,59.581-25.606
                                c4.138-0.183,7.345-3.685,7.162-7.823s-3.66-7.336-7.824-7.162c-22.815,1.007-44.397,12.455-58.242,21.65
                                c-1.315-3.528-2.728-7.052-4.156-10.444c2.322-7.818,9.653-36.164,3.61-64.85c37.192,2.635,68.383,20.324,92.816,52.708
                                c16.167,21.427,24.386,43.181,27.063,51.16c-8.988,10.495-37.414,13.952-56.278,11.821c-3.353-4.65-7.032-9.711-10.982-15.087
                                c-2.453-3.339-7.146-4.056-10.484-1.604c-3.338,2.452-4.057,7.146-1.604,10.484c13.479,18.347,23.812,33.046,28.483,39.756
                                l-11.621,19.368C271.88,295.179,249.006,270.857,225.151,231.199z M307.603,279.064c-1.586-2.285-4.18-6.002-7.593-10.831
                                c0.154,0,0.303,0.004,0.457,0.004c4.077,0,8.416-0.18,12.833-0.591c-0.487,1.101-1.098,2.123-1.802,3.299
                                C310.183,273.139,308.699,275.63,307.603,279.064z M303.011,309.773c-1.631,0-3.177-0.547-4.434-1.548l5.125-8.541h30.065
                                c1.992,1.085,5.938,4.989,10.358,10.089H303.011z M334.579,284.684h-12.981c0.591-2.392,1.577-4.043,2.765-6.026
                                c1.921-3.206,4.229-7.076,4.945-13.612c10.385-2.512,19.97-6.723,26.27-13.384c10.032,25.667,10.404,47.773,9.827,58.111h-1.961
                                C344.594,284.698,337.103,284.684,334.579,284.684z M391.251,309.773h-10.792c0.604-11.732-0.039-34.071-9.658-60.267h15.218
                                C395.734,274.75,393.136,299.207,391.251,309.773z"/>
                            </svg>
                        </div>
                        <span class="text-[10px] font-semibold text-gray-500 text-center leading-tight">Shalat</span>
                    </a>

                    {{-- Kiblat --}}
                    <a href="{{ route('qibla.index') }}"
                    class="flex flex-col items-center gap-1.5 p-2 rounded-xl
                            hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-12 h-12 rounded-2xl shadow
                                    bg-gradient-to-br from-amber-400 to-orange-500
                                    flex items-center justify-center">
                            <svg class="w-6 h-6" viewBox="0 0 338.605 338.605" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <g><path d="M169.303,0.001C75.949,0.001,0,75.949,0,169.303s75.949,169.302,169.303,169.302s169.303-75.949,169.303-169.302S262.656,0.001,169.303,0.001z M169.303,320c-83.095,0-150.697-67.603-150.697-150.698S86.208,18.605,169.303,18.605S320,86.208,320,169.303S252.397,320,169.303,320z"/><path d="M169.303,27.22C90.958,27.22,27.22,90.958,27.22,169.303s63.738,142.083,142.083,142.083s142.083-63.738,142.083-142.083S247.647,27.22,169.303,27.22z M301.309,189.066l-9.702-1.71l-1.201,6.816l9.708,1.711c-1.095,5.393-2.516,10.668-4.24,15.805l-9.258-3.369l-2.367,6.504l9.255,3.369c-2.015,5.1-4.335,10.046-6.939,14.817l-8.509-4.912l-3.459,5.994l8.494,4.903c-2.863,4.657-6.005,9.124-9.399,13.382l-7.492-6.286l-4.449,5.302l7.486,6.282c-3.615,4.085-7.477,7.946-11.561,11.562l-6.286-7.488l-5.301,4.449l6.29,7.493c-4.258,3.396-8.726,6.538-13.384,9.401l-4.901-8.492l-5.994,3.46l4.909,8.506c-4.771,2.603-9.718,4.924-14.818,6.939l-3.369-9.254l-6.504,2.368l3.37,9.255c-5.138,1.725-10.412,3.146-15.805,4.24l-1.714-9.705l-6.816,1.203l1.713,9.698c-5.339,0.796-10.777,1.28-16.301,1.421v-26.382h-6.922v26.382c-5.523-0.141-10.964-0.625-16.303-1.421l1.714-9.697l-6.814-1.204l-1.716,9.705c-5.393-1.094-10.668-2.515-15.806-4.24l3.371-9.254l-6.502-2.369l-3.371,9.254c-5.101-2.015-10.046-4.336-14.818-6.939l4.91-8.506l-5.994-3.46l-4.901,8.492c-4.658-2.863-9.126-6.005-13.384-9.401l6.288-7.493l-5.301-4.449l-6.284,7.488c-4.085-3.616-7.946-7.477-11.562-11.562l7.486-6.282l-4.449-5.302l-7.492,6.286c-3.395-4.257-6.537-8.725-9.399-13.382l8.494-4.902l-3.459-5.994l-8.509,4.911c-2.604-4.771-4.925-9.717-6.939-14.817l9.254-3.368l-2.367-6.504l-9.256,3.369c-1.725-5.137-3.146-10.412-4.24-15.805l9.708-1.711l-1.201-6.816l-9.702,1.71c-0.797-5.339-1.28-10.779-1.422-16.303h26.381v-6.921H35.875c0.142-5.524,0.625-10.963,1.422-16.302l9.702,1.711l1.201-6.816l-9.708-1.711c1.095-5.393,2.516-10.668,4.24-15.806l9.256,3.369l2.367-6.504l-9.254-3.368c2.016-5.1,4.336-10.046,6.939-14.817l8.509,4.911l3.459-5.994l-8.494-4.903c2.862-4.657,6.005-9.125,9.399-13.382l7.492,6.286l4.449-5.302l-7.486-6.282c3.615-4.084,7.477-7.946,11.562-11.562l6.286,7.489l5.301-4.449l-6.29-7.494c4.258-3.396,8.726-6.538,13.384-9.401l4.901,8.492l5.994-3.46l-4.909-8.506c4.771-2.603,9.718-4.924,14.818-6.939l3.369,9.255l6.504-2.367l-3.37-9.258c5.137-1.725,10.412-3.146,15.805-4.24l1.714,9.708l6.816-1.203l-1.713-9.702c5.339-0.796,10.777-1.28,16.301-1.421v9.846h6.922v-9.846c5.523,0.141,10.962,0.625,16.301,1.421l-1.713,9.702l6.816,1.203l1.714-9.708c5.393,1.094,10.667,2.515,15.804,4.239l-3.369,9.258l6.504,2.367l3.368-9.256c5.101,2.015,10.048,4.336,14.819,6.939l-4.909,8.508l5.994,3.459l4.9-8.493c4.658,2.863,9.126,6.005,13.384,9.401l-6.289,7.495l5.301,4.449l6.285-7.49c4.085,3.617,7.946,7.479,11.563,11.563l-7.486,6.283l4.449,5.302l7.492-6.287c3.395,4.257,6.536,8.724,9.398,13.381l-8.494,4.905l3.461,5.993l8.508-4.913c2.603,4.772,4.924,9.718,6.939,14.818l-9.255,3.37l2.367,6.503l9.258-3.371c1.725,5.138,3.146,10.413,4.24,15.807l-9.708,1.711l1.201,6.816l9.702-1.711c0.797,5.339,1.28,10.778,1.422,16.302H276.35v6.921h26.381C302.589,178.287,302.105,183.727,301.309,189.066z"/><path d="M189.766,191.022c4.402-1.555,7.948-7.063,9.68-14.091l-21.099,7.1C181.032,189.691,185.278,192.607,189.766,191.022z"/><path d="M215.203,182.132c4.328-1.53,7.828-6.876,9.592-13.73l-20.868,7.022C206.612,180.9,210.797,183.691,215.203,182.132z"/><path d="M148.846,191.022c4.482,1.585,8.732-1.331,11.414-6.992l-21.1-7.1C140.893,183.958,144.441,189.468,148.846,191.022z"/><path d="M123.4,182.132c4.415,1.559,8.594-1.232,11.281-6.709l-20.868-7.022C115.573,175.255,119.073,180.602,123.4,182.132z"/><path d="M215.471,193.755c-6.798,2.403-13.084-5.339-14.318-17.397l-0.145,0.049c0.6,12.244-4.198,23.842-10.974,26.239c-6.861,2.424-13.194-5.477-14.35-17.718l-6.379,2.146l-6.377-2.146c-1.156,12.241-7.492,20.141-14.348,17.717c-6.785-2.397-11.584-13.997-10.981-26.241l-0.146-0.049c-1.234,12.06-7.52,19.802-14.319,17.399c-6.713-2.375-11.483-13.792-10.984-25.914l-1.959-0.659v44.239l59.115,19.897l59.115-19.897v-44.239l-1.959,0.659C226.96,179.962,222.189,191.379,215.471,193.755z"/><path d="M110.15,128.777l0.039,0.013v23.872l59.115,19.897l59.115-19.897v-23.873l0.035-0.012l-59.15-21.49L110.15,128.777z M169.305,142.929l-42.667-14.35l42.667-15.501l42.664,15.501L169.305,142.929z"/><polygon points="201.225,110.545 169.303,52.664 137.381,110.436 169.303,91.635"/></g>
                            </svg>
                        </div>
                        <span class="text-[10px] font-semibold text-gray-500 text-center leading-tight">Kiblat</span>
                    </a>

                    {{-- Asmaul Husna --}}
                    <a href="{{ route('asmaul-husna.index') }}"
                       class="flex flex-col items-center gap-1.5 p-2 rounded-xl
                              hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-12 h-12 rounded-2xl shadow
                                    bg-gradient-to-br from-violet-400 to-purple-600
                                    flex items-center justify-center">
                            <span class="text-white font-extrabold text-sm tracking-tighter">99</span>
                        </div>
                        <span class="text-[10px] font-semibold text-gray-500 text-center leading-tight">Asmaul</span>
                    </a>

                    {{-- Doa --}}
                    <a href="{{ route('doa-pendek.index') }}"
                    class="flex flex-col items-center gap-1.5 p-2 rounded-xl
                            hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-12 h-12 rounded-2xl shadow
                                    bg-gradient-to-br from-sky-400 to-blue-600
                                    flex items-center justify-center">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="white" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                <polygon points="18.5,3 19.5,5.5 22,5.5 20,7 20.8,9.5 18.5,8 16.2,9.5 17,7 15,5.5 17.5,5.5" fill="white" stroke="white" stroke-width="0.5" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="text-[10px] font-semibold text-gray-500 text-center leading-tight">Doa</span>
                    </a>

                    {{-- Tasbih --}}
                    <a href="{{ route('tasbih.index') }}"
                    class="flex flex-col items-center gap-1.5 p-2 rounded-xl
                            hover:bg-gray-50 active:scale-95 transition-all duration-150">
                        <div class="w-12 h-12 rounded-2xl shadow
                                    bg-gradient-to-br from-rose-400 to-pink-600
                                    flex items-center justify-center">
                            <svg class="w-6 h-6" viewBox="0 0 430 380" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="200" cy="42" r="18"/><circle cx="228" cy="45" r="18"/><circle cx="255" cy="53" r="18"/><circle cx="280" cy="65" r="18"/><circle cx="302" cy="83" r="18"/><circle cx="321" cy="104" r="18"/><circle cx="335" cy="129" r="18"/><circle cx="344" cy="155" r="18"/><circle cx="348" cy="183" r="18"/><circle cx="346" cy="211" r="18"/><circle cx="340" cy="238" r="18"/><circle cx="328" cy="264" r="18"/><circle cx="312" cy="287" r="18"/><circle cx="291" cy="306" r="18"/><circle cx="268" cy="322" r="18"/><circle cx="242" cy="332" r="18"/><circle cx="214" cy="337" r="18"/><circle cx="186" cy="337" r="18"/><circle cx="158" cy="332" r="18"/><circle cx="132" cy="322" r="18"/><circle cx="109" cy="306" r="18"/><circle cx="88" cy="287" r="18"/><circle cx="72" cy="264" r="18"/><circle cx="60" cy="238" r="18"/><circle cx="54" cy="211" r="18"/><circle cx="52" cy="183" r="18"/><circle cx="56" cy="155" r="18"/><circle cx="65" cy="129" r="18"/><circle cx="79" cy="104" r="18"/><circle cx="98" cy="83" r="18"/><circle cx="120" cy="65" r="18"/><circle cx="145" cy="53" r="18"/><circle cx="172" cy="45" r="18"/><circle cx="354" cy="279" r="10"/><polygon points="359,274 352,286 370,296 377,284"/><polygon points="379,280 367,300 393,315 405,295"/>
                            </svg>
                        </div>
                        <span class="text-[10px] font-semibold text-gray-500 text-center leading-tight">Tasbih</span>
                    </a>

                </div>
            </div>

            {{-- ─────────────────────────────────────
                 WIDGET TRACKING SHALAT
            ───────────────────────────────────── --}}
            <div x-data="prayerWidget()" x-init="load()">
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                    {{-- Header --}}
                    <div class="bg-gradient-to-r from-teal-600 to-emerald-500 px-4 py-3
                                flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 20.5 L2 16.5 Q2 16 2.5 16 L7 16 L7 12.5 Q7 12 7.5 12 L11.5 12 L11.5 9 Q11.5 8.5 12 8.5 L16 8.5 L16 5.5 Q16 5 16.5 5 L21.5 5 Q22 5 22 5.5 L22 20.5 Q22 21 21.5 21 L2.5 21 Q2 21 2 20.5 Z"/>
                                <line x1="5" y1="10.5" x2="9.5" y2="6" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                <polyline points="6.5,6 9.5,6 9.5,9" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-white font-bold text-sm">Shalat Hari Ini</span>
                        </div>
                        <a href="{{ route('prayer-tracking.index') }}"
                        class="flex items-center gap-1 text-white/75 hover:text-white text-xs font-semibold transition-colors">
                            Lihat semua
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="p-4">
                        {{-- Loading --}}
                        <template x-if="loading">
                            <div class="flex items-center justify-center py-8">
                                <div class="w-6 h-6 border-2 border-teal-400 border-t-transparent rounded-full animate-spin"></div>
                            </div>
                        </template>

                        <template x-if="!loading">
                            <div>
                                {{-- Stats mini --}}
                                <div class="grid grid-cols-3 gap-2 mb-3">
                                    <div class="bg-teal-50 rounded-xl px-2 py-2.5 text-center">
                                        <p class="text-base font-extrabold text-teal-600 leading-none">
                                            <span x-text="data.performed"></span><span class="text-xs font-semibold text-teal-400">/<span x-text="data.total"></span></span>
                                        </p>
                                        <p class="text-[9px] text-gray-400 font-semibold mt-1">Hari Ini</p>
                                    </div>
                                    <div class="bg-amber-50 rounded-xl px-2 py-2.5 text-center">
                                        <p class="text-base font-extrabold text-amber-500 leading-none flex items-center justify-center gap-1">
                                            <span x-text="data.streak"></span>
                                            <svg viewBox="0 0 200 230" xmlns="http://www.w3.org/2000/svg">
                                                <!-- lapisan luar merah-oranye -->
                                                <path d="M100,215 C55,215 22,185 22,150 C22,118 40,100 55,82 C62,73 65,62 60,48 C75,60 82,78 78,96 C90,78 95,55 88,32 C108,52 118,78 112,102 C120,85 128,62 123,40 C142,62 148,92 138,116 C148,98 156,75 152,54 C168,78 172,108 160,132 C168,118 174,100 170,82 C182,105 182,135 170,158 C158,182 132,215 100,215 Z" fill="#f44"/>
                                                <!-- lapisan oranye -->
                                                <path d="M100,210 C60,210 35,182 35,152 C35,125 50,108 63,92 C68,85 70,76 67,65 C79,75 83,90 80,105 C90,88 95,68 91,48 C108,66 115,90 110,112 C118,96 124,75 120,56 C136,76 140,103 132,124 C140,108 146,88 143,68 C156,90 158,118 148,140 C155,126 159,108 156,90 C165,112 164,140 154,162 C144,185 124,210 100,210 Z" fill="#ff7700"/>
                                                <!-- lapisan oranye muda -->
                                                <path d="M100,205 C68,205 48,180 48,155 C48,132 60,116 71,102 C75,96 77,88 75,79 C85,88 88,101 86,114 C94,99 98,80 95,62 C109,78 114,100 110,120 C116,105 121,86 118,68 C130,86 132,110 125,130 C131,116 135,98 133,80 C141,100 141,126 132,148 C124,170 113,205 100,205 Z" fill="#ff9900"/>
                                                <!-- inti kuning -->
                                                <path d="M100,195 C84,195 74,178 74,162 C74,148 82,138 88,128 C90,123 91,117 90,111 C97,118 99,128 98,138 C103,128 106,116 104,104 C112,116 114,132 110,146 C114,136 117,123 115,110 C121,124 121,142 116,156 C111,172 106,195 100,195 Z" fill="#ffdd00"/>
                                            </svg>
                                        </p>
                                        <p class="text-[9px] text-gray-400 font-semibold mt-1">Berturut</p>
                                    </div>
                                    <div class="bg-emerald-50 rounded-xl px-2 py-2.5 text-center">
                                        <p class="text-base font-extrabold text-emerald-600 leading-none" x-text="data.percent + '%'"></p>
                                        <p class="text-[9px] text-gray-400 font-semibold mt-1">Progress</p>
                                    </div>
                                </div>

                                {{-- Progress bar --}}
                                <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden mb-3">
                                    <div class="h-full bg-gradient-to-r from-teal-400 to-emerald-500 rounded-full transition-all duration-500"
                                         :style="`width: ${data.percent}%`"></div>
                                </div>

                                {{-- 5 waktu --}}
                                <div class="grid grid-cols-5 gap-1.5">
                                    <template x-for="prayer in prayers" :key="prayer">
                                        <div class="flex flex-col items-center gap-1 py-2 px-1 rounded-xl transition-colors"
                                             :class="getStatus(prayer) === 'performed' ? 'bg-teal-50' : 'bg-gray-50'">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm transition-all"
                                                 :class="getPrayerDotClass(prayer)">
                                                <span x-html="prayerIcons[prayer]"></span>
                                            </div>
                                            <span class="text-[8.5px] font-semibold text-center leading-tight"
                                                  :class="getPrayerTextClass(prayer)"
                                                  x-text="prayerNames[prayer]"></span>
                                            <span class="text-[8px] px-1 py-0.5 rounded-full font-bold flex items-center justify-center"
                                                  :class="getStatusBadgeClass(prayer)"
                                                  x-html="getStatusLabel(prayer)"></span>
                                        </div>
                                    </template>
                                </div>

                                {{-- CTA / motivasi --}}
                                <template x-if="data.performed === 0">
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('prayer-tracking.index') }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2
                                                  bg-gradient-to-r from-teal-500 to-emerald-400
                                                  text-white text-xs font-bold rounded-xl shadow
                                                  hover:shadow-md transition-all hover:-translate-y-0.5">
                                            Mulai catat shalat hari ini →
                                        </a>
                                    </div>
                                </template>
                                <template x-if="data.performed > 0 && data.performed < 5">
                                    <div class="mt-3 p-2.5 bg-amber-50 border border-amber-100 rounded-xl text-center">
                                        <p class="text-[11px] text-amber-700 font-semibold"
                                           x-text="(5 - data.performed) + ' shalat lagi untuk hari yang sempurna!'"></p>
                                    </div>
                                </template>
                                <template x-if="data.performed === 5">
                                    <div class="mt-3 p-2.5 bg-teal-50 border border-teal-100 rounded-xl text-center">
                                        <p class="text-[11px] text-teal-700 font-semibold flex items-center justify-center gap-1">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2L13.5 8.5L20 7L15.5 12L20 17L13.5 15.5L12 22L10.5 15.5L4 17L8.5 12L4 7L10.5 8.5L12 2Z" fill="#0d9488"/>
                                            </svg>
                                            MasyaAllah! Shalat hari ini lengkap!
                                        </p>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- ─────────────────────────────────────
                 WIDGET TRACKING MENGAJI
            ───────────────────────────────────── --}}
            <div x-data="quranWidget()" x-init="load()">
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                    {{-- Header --}}
                    <div class="bg-gradient-to-r from-emerald-600 to-teal-500 px-4 py-3
                                flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6" viewBox="0 0 484.228 484.228" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path d="M484.06,210.989L438.305,52.856c-0.328-1.133-1.112-2.079-2.164-2.611c-1.054-0.533-2.278-0.605-3.385-0.197l-12.411,4.561l-1.982-6.582c-0.339-1.127-1.131-2.063-2.186-2.584c-1.055-0.522-2.279-0.583-3.381-0.168c-29.582,11.134-44.034,14.763-107.786,22.14c-40.168,4.647-56.44,21.963-62.954,33.842c-6.469-11.884-22.678-29.195-62.839-33.842c-63.753-7.377-78.205-11.006-107.787-22.14c-1.101-0.415-2.326-0.354-3.381,0.168c-1.055,0.521-1.847,1.457-2.186,2.584l-1.976,6.562l-12.423-4.543c-1.105-0.403-2.332-0.331-3.382,0.201c-1.051,0.533-1.833,1.478-2.161,2.609L0.168,210.989c-0.638,2.207,0.593,4.521,2.779,5.226l141.114,45.496l-59.117,47.54c-1.004,0.807-1.587,2.025-1.587,3.312v32.49c0,1.709,1.023,3.252,2.599,3.916c1.574,0.664,3.394,0.32,4.617-0.872l26.274-25.606c4.096-3.976,10.665-3.88,14.64,0.216l5.087,5.24c1.926,1.983,2.964,4.599,2.923,7.364c-0.041,2.765-1.156,5.348-3.15,7.284l-51.71,50.528c-0.818,0.799-1.279,1.896-1.279,3.04v38.814c0,1.698,1.011,3.233,2.569,3.904c0.542,0.233,1.113,0.346,1.68,0.346c1.066,0,2.117-0.401,2.922-1.163l151.508-143.381l151.74,143.383c0.805,0.761,1.855,1.161,2.92,1.161c0.567,0,1.14-0.114,1.681-0.347c1.559-0.671,2.568-2.206,2.568-3.903v-38.814c0-1.144-0.461-2.24-1.279-3.04l-51.722-50.538c-1.983-1.926-3.099-4.509-3.14-7.274c-0.041-2.765,0.997-5.38,2.923-7.364l5.087-5.24c3.976-4.096,10.542-4.193,14.634-0.223l26.281,25.613c1.224,1.192,3.045,1.536,4.617,0.872c1.575-0.664,2.599-2.207,2.599-3.916v-32.49c0-1.286-0.582-2.503-1.583-3.309l-59.081-47.609l140.999-45.429C483.467,215.51,484.697,213.196,484.06,210.989z M389.745,110.873h38.663l2.408,8h-6.571c-2.348,0-4.25,1.903-4.25,4.25c0,2.347,1.902,4.25,4.25,4.25h9.131l12.796,42.5h-42.927c-2.348,0-4.25,1.903-4.25,4.25c0,2.347,1.902,4.25,4.25,4.25h45.485l4.066,13.506c-21.982,7.912-73.793,23.604-147.522,27.514c-32.093,1.702-48.683,13.718-56.95,23.5c-0.729,0.862-1.407,1.723-2.04,2.577v-85.096h63.461c2.348,0,4.25-1.903,4.25-4.25c0-2.347-1.902-4.25-4.25-4.25h-63.461v-15.438c0.561-3.152,7.102-31.816,59.703-37.902c61.527-7.119,83.698-13.038,111.668-23.373l8.193,27.212h-36.104c-2.348,0-4.25,1.903-4.25,4.25C385.495,108.97,387.398,110.873,389.745,110.873z M33.24,185.873h26.505c2.348,0,4.25-1.903,4.25-4.25c0-2.347-1.902-4.25-4.25-4.25H35.799l7.376-24.5h62.07c2.348,0,4.25-1.903,4.25-4.25c0-2.347-1.902-4.25-4.25-4.25H45.735l4.968-16.5h23.043c2.348,0,4.25-1.903,4.25-4.25c0-2.347-1.902-4.25-4.25-4.25H53.261l13.492-44.813c29.514,10.936,51.988,17.089,111.488,23.974c52.74,6.103,59.033,34.906,59.543,37.888v48.952h-15.039c-2.348,0-4.25,1.903-4.25,4.25c0,2.347,1.902,4.25,4.25,4.25h15.039v5.5h-34.039c-2.348,0-4.25,1.903-4.25,4.25c0,2.347,1.902,4.25,4.25,4.25h34.039v37.507c-0.609-0.823-1.256-1.65-1.954-2.48c-8.23-9.784-24.779-21.805-56.876-23.507c-73.731-3.91-125.541-19.602-147.522-27.514L33.24,185.873z M246.284,282.998v-17.436c0.469-3.178,6.484-34.874,59.44-37.682c79.464-4.214,134.024-21.977,153.794-29.418c2.093-0.788,3.217-3.062,2.572-5.203L422.8,62.762l8.607-3.163l43.341,149.79L246.284,282.998z M52.822,59.593l8.611,3.149L22.139,193.26c-0.645,2.141,0.479,4.415,2.572,5.203c19.769,7.441,74.328,25.204,153.794,29.418c52.999,2.811,58.835,34.556,59.279,37.671v17.445L9.48,209.39L52.822,59.593z M91.858,397.951l50.42-49.268c3.613-3.507,5.644-8.211,5.719-13.246c0.075-5.035-1.816-9.798-5.322-13.411l-5.087-5.24c-7.239-7.459-19.198-7.637-26.665-0.389l-19.064,18.579v-20.378l61.886-49.766l17.631,5.685l-19.632,19.598c-1.661,1.658-1.663,4.349-0.005,6.01c0.83,0.831,1.919,1.247,3.008,1.247c1.086,0,2.173-0.414,3.003-1.242l22.721-22.682l23.368,7.534l-42.849,42.886c-1.658,1.661-1.657,4.352,0.003,6.01c0.83,0.829,1.917,1.244,3.004,1.244c1.088,0,2.177-0.415,3.007-1.246l45.923-45.964l20.979,6.764L91.858,425.103V397.951z M392.445,314.595v20.381l-19.071-18.586c-7.459-7.24-19.418-7.063-26.659,0.395l-5.087,5.24c-3.507,3.613-5.398,8.376-5.322,13.411c0.075,5.035,2.106,9.739,5.708,13.236l50.432,49.278v27.162L250.173,290.676l26.105-8.411l26.712,26.712c0.829,0.83,1.917,1.245,3.005,1.245s2.176-0.415,3.005-1.245c1.66-1.66,1.66-4.351,0-6.011l-23.63-23.63l45.233-14.574L392.445,314.595z"/>
                                <path d="M148.245,119.373h-33.5c-2.348,0-4.25,1.903-4.25,4.25c0,2.347,1.902,4.25,4.25,4.25h33.5c2.348,0,4.25-1.903,4.25-4.25C152.495,121.276,150.593,119.373,148.245,119.373z"/>
                            </svg>
                            <span class="text-white font-bold text-sm">Membaca Al-Quran</span>
                        </div>
                        <a href="{{ route('quran-tracking.index') }}"
                           class="flex items-center gap-1 text-white/75 hover:text-white text-xs font-semibold transition-colors">
                            Lihat semua
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="p-4">
                        {{-- Loading --}}
                        <template x-if="loading">
                            <div class="flex items-center justify-center py-8">
                                <div class="w-6 h-6 border-2 border-emerald-400 border-t-transparent rounded-full animate-spin"></div>
                            </div>
                        </template>

                        <template x-if="!loading">
                            <div>
                                {{-- Progress surah + streak --}}
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="text-xl font-extrabold text-emerald-600"
                                              x-text="data.total_completed + '/114'"></span>
                                        <span class="text-xs text-gray-400 ml-1">surah</span>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-amber-500 flex items-center gap-1 justify-end">
                                            <svg viewBox="0 0 200 230" xmlns="http://www.w3.org/2000/svg">
                                                <!-- lapisan luar merah-oranye -->
                                                <path d="M100,215 C55,215 22,185 22,150 C22,118 40,100 55,82 C62,73 65,62 60,48 C75,60 82,78 78,96 C90,78 95,55 88,32 C108,52 118,78 112,102 C120,85 128,62 123,40 C142,62 148,92 138,116 C148,98 156,75 152,54 C168,78 172,108 160,132 C168,118 174,100 170,82 C182,105 182,135 170,158 C158,182 132,215 100,215 Z" fill="#f44"/>
                                                <!-- lapisan oranye -->
                                                <path d="M100,210 C60,210 35,182 35,152 C35,125 50,108 63,92 C68,85 70,76 67,65 C79,75 83,90 80,105 C90,88 95,68 91,48 C108,66 115,90 110,112 C118,96 124,75 120,56 C136,76 140,103 132,124 C140,108 146,88 143,68 C156,90 158,118 148,140 C155,126 159,108 156,90 C165,112 164,140 154,162 C144,185 124,210 100,210 Z" fill="#ff7700"/>
                                                <!-- lapisan oranye muda -->
                                                <path d="M100,205 C68,205 48,180 48,155 C48,132 60,116 71,102 C75,96 77,88 75,79 C85,88 88,101 86,114 C94,99 98,80 95,62 C109,78 114,100 110,120 C116,105 121,86 118,68 C130,86 132,110 125,130 C131,116 135,98 133,80 C141,100 141,126 132,148 C124,170 113,205 100,205 Z" fill="#ff9900"/>
                                                <!-- inti kuning -->
                                                <path d="M100,195 C84,195 74,178 74,162 C74,148 82,138 88,128 C90,123 91,117 90,111 C97,118 99,128 98,138 C103,128 106,116 104,104 C112,116 114,132 110,146 C114,136 117,123 115,110 C121,124 121,142 116,156 C111,172 106,195 100,195 Z" fill="#ffdd00"/>
                                                </svg>
                                            <span x-text="data.streak"></span> hari
                                        </p>
                                        <p class="text-[9px] text-gray-400">berturut-turut</p>
                                    </div>
                                </div>

                                <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden mb-1">
                                    <div class="h-full bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full transition-all duration-700"
                                         :style="'width: ' + data.percent + '%'"></div>
                                </div>
                                <p class="text-[9px] text-gray-400 text-right mb-3"
                                   x-text="data.percent + '% surah selesai'"></p>

                                {{-- Last read --}}
                                <template x-if="data.last_read">
                                    <div class="flex items-center justify-between p-3
                                                bg-emerald-50 border border-emerald-100 rounded-xl">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-[9px] text-emerald-600 font-bold uppercase tracking-wide">Terakhir dibaca</p>
                                            <p class="text-sm font-bold text-emerald-900 truncate mt-0.5"
                                               x-text="data.last_read.surah_number + '. ' + data.last_read.surah_name"></p>
                                            <p class="text-[10px] text-emerald-600 mt-0.5">
                                                Ayat <span x-text="data.last_read.last_verse"></span>
                                                · <span x-text="data.last_read.progress"></span>%
                                            </p>
                                        </div>
                                        <a :href="'/surah/' + data.last_read.surah_number"
                                           class="ml-3 px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600
                                                  text-white text-xs font-bold rounded-lg transition-colors whitespace-nowrap">
                                            Lanjut →
                                        </a>
                                    </div>
                                </template>

                                <template x-if="!data.last_read">
                                    <div class="text-center py-2">
                                        <a href="{{ route('quran.index') }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2
                                                  bg-gradient-to-r from-emerald-400 to-teal-500
                                                  text-white text-xs font-bold rounded-xl shadow
                                                  hover:shadow-md transition-all hover:-translate-y-0.5">
                                            Mulai membaca Al-Quran →
                                        </a>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- ─────────────────────────────────────
                 QUOTE BISMILLAH
            ───────────────────────────────────── --}}
            <div class="rounded-2xl p-6 text-center
                        bg-white/15 backdrop-blur-sm border border-white/25">
                <p class="font-arabic text-3xl font-bold text-white mb-3 leading-loose" style="font-family: 'Amiri', serif; direction: rtl;">
                    بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                </p>
                <p class="text-white/80 text-xs font-medium">
                    "Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang"
                </p>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif !important;
        direction: rtl;
    }
    /* Ensure teal background always visible */
    body {
        background-color: #0f766e;
    }
</style>
@endpush

@push('scripts')
<script>
function prayerWidget() {
    return {
        loading: true,
        data: { performed: 0, total: 5, percent: 0, streak: 0, today_data: {} },
        prayers: ['fajr','dhuhr','asr','maghrib','isha'],
        prayerNames: { fajr:'Subuh', dhuhr:'Dzuhur', asr:'Ashar', maghrib:'Maghrib', isha:'Isya' },
        prayerIcons: {
            fajr: `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M12 3V5M5.5 6.5L7 8M18.5 6.5L17 8M3 13H5M19 13H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M8 13C8 10.79 9.79 9 12 9C14.21 9 16 10.79 16 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M3 17H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M6 20H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>`,
            dhuhr: `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><circle cx="12" cy="12" r="4" fill="currentColor"/><path d="M12 2V4M12 20V22M2 12H4M20 12H22M5.5 5.5L7 7M17 17L18.5 18.5M5.5 18.5L7 17M17 7L18.5 5.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>`,
            asr: `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><circle cx="12" cy="13" r="3.5" stroke="currentColor" stroke-width="1.8"/><path d="M12 3V5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M5.5 6.5L7 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M18.5 6.5L17 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M3 13H5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M19 13H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M3 19H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M6 22H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>`,
            maghrib: `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M5 12C5 8.13 8.13 5 12 5C14.76 5 17.16 6.53 18.42 8.82" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.8"/><path d="M3 17H21M6 20H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>`,
            isha:  `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>`,
        },

        async load() {
            try {
                const res = await fetch('{{ route("prayer-tracking.summary") }}', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                this.data = await res.json();
            } catch (e) { console.error(e); }
            this.loading = false;
        },

        getStatus(prayer) {
            return this.data.today_data?.[prayer]?.status || null;
        },

        getPrayerDotClass(prayer) {
            const s = this.getStatus(prayer);
            if (s === 'performed') return 'bg-gradient-to-br from-teal-400 to-emerald-500 shadow-md';
            if (s === 'qada')      return 'bg-amber-100';
            if (s === 'missed')    return 'bg-red-100';
            return 'bg-gray-100';
        },

        getPrayerTextClass(prayer) {
            const s = this.getStatus(prayer);
            if (s === 'performed') return 'text-teal-700';
            if (s === 'qada')      return 'text-amber-600';
            if (s === 'missed')    return 'text-red-400';
            return 'text-gray-400';
        },

        getStatusBadgeClass(prayer) {
            const s = this.getStatus(prayer);
            if (s === 'performed') return 'bg-teal-100 text-teal-700';
            if (s === 'qada')      return 'bg-amber-100 text-amber-600';
            if (s === 'missed')    return 'bg-red-100 text-red-400';
            return 'bg-gray-100 text-gray-300';
        },

        getStatusLabel(prayer) {
            const s = this.getStatus(prayer);
            if (s === 'performed') return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`;
            if (s === 'qada')      return 'Q';
            if (s === 'missed')    return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>`;
            return '–';
        },
    };
}

function quranWidget() {
    return {
        loading: true,
        data: { total_completed: 0, total_surah: 114, percent: 0, streak: 0, last_read: null },

        async load() {
            try {
                const res = await fetch('{{ route("quran-tracking.summary") }}', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                this.data = await res.json();
            } catch (e) { console.error(e); }
            this.loading = false;
        }
    };
}
</script>
@endpush