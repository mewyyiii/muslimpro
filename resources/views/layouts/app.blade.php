<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NurSteps') }} - Pendamping Ibadah Anda</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- ★ IKLAN IN-CONTENT — tampil di bawah header, sebelum konten utama --}}
            {{--
                'page' bisa diisi sesuai nama halaman masing-masing.
                Untuk global (semua halaman), biarkan tanpa parameter 'page'.
                Jika ingin per-halaman, set variable $adPage di tiap controller:
                    return view('quran.index', ['adPage' => 'quran', ...]);
            --}}
            @include('components.ad-banner', [
                'position' => 'in_content',
                'page'     => $adPage ?? 'all',
            ])

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        {{-- ★ IKLAN FOOTER STICKY — tampil di bawah layar --}}
        @include('components.ad-banner', [
            'position' => 'footer_sticky',
            'page'     => $adPage ?? 'all',
        ])

        @stack('scripts')
    </body>
</html>