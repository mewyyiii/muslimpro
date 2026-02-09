<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Al-Huda - Pendamping Ibadah Anda</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --background: #fdfaf6;

                --text-primary: #374151;
                --primary-accent: #14b8a6; /* Teal */
                --secondary-accent: #d97706; /* Amber/Gold */
                --surface: #f3f4f6;
                --text-primary-muted: #6b7280; /* Gray 500/600 */
                --primary-accent-light: #ccfbf1; /* Tailwinc CSS teal-100 */
            }

            .dark:root {
                --background: #111827; /* Gray 900 */

                --text-primary: #d1d5db; /* Gray 300 */
                --primary-accent: #14b8a6; /* Teal */
                --secondary-accent: #f59e0b; /* Amber/Gold */
                --surface: #1f2937; /* Gray 800 */
                --text-primary-muted: #9ca3af; /* Gray 400 */
                --primary-accent-light: #134e4a; /* Dark teal */
            }

            body {
                background-color: var(--background);
                color: var(--text-primary);
                font-family: 'Figtree', sans-serif;
            }
        }

        /* Custom font for Arabic text */
        @import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        .font-arabic {
            font-family: 'Amiri', serif;
        }

        /* Styles for playing verse indicator */
        .verse-item.playing {
            background-color: var(--primary-accent-light); /* Light teal */
            border-left-color: var(--primary-accent);
            border-left-width: 4px;
        }
        .dark .verse-item.playing {
            background-color: var(--primary-accent-light); /* Dark teal for dark mode */
        }
    </style>
    @stack('styles')
</head>
<body class="antialiased">
    <div class="min-h-screen">
        <header class="py-4 shadow-sm" style="background-color: var(--surface)">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-2xl font-bold" style="color: var(--text-primary)">
                        Al-Huda
                    </a>
                    <nav class="hidden md:flex space-x-4">
                        <a href="{{ route('al-quran.index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition-colors
                           {{ request()->routeIs('al-quran.index') || request()->routeIs('surah.show') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                           style="color: var(--text-primary);">
                            Al-Quran
                        </a>
                        <a href="{{ route('asmaul-husna.index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition-colors
                           {{ request()->routeIs('asmaul-husna.index') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                           style="color: var(--text-primary);">
                            Asmaul Husna
                        </a>
                        <a href="{{ route('doa-pendek.index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition-colors
                           {{ request()->routeIs('doa-pendek.index') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                           style="color: var(--text-primary);">
                            Doa-doa Pendek
                        </a>
                    </nav>
                </div>
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm-.707 10.607a1 1 0 010-1.414l.707.707a1 1 0 111.414 1.414l-.707.707a1 1 0 01-1.414 0zM3 11a1 1 0 100-2H2a1 1 0 100 2h1z"></path></svg>
                </button>
            </div>
        </header>

        <main class="py-8">
            @yield('content')
        </main>
    </div>
    
    @stack('scripts')

    <script>
        // This script is placed at the end of the body to ensure all elements are loaded.
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // Function to apply the correct theme and icon state
        function applyThemeAndIcon() {
            const theme = localStorage.getItem('color-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDarkMode = theme === 'dark' || (!theme && prefersDark);

            document.documentElement.classList.toggle('dark', isDarkMode);
            
            // Show sun icon in dark mode, moon in light mode
            lightIcon.classList.toggle('hidden', !isDarkMode);
            darkIcon.classList.toggle('hidden', isDarkMode);
        }

        // Apply on initial page load
        applyThemeAndIcon();

        // Add click listener for the toggle button
        themeToggleBtn.addEventListener('click', function() {
            // Toggle the 'dark' class on the <html> element
            const isDarkMode = document.documentElement.classList.toggle('dark');

            // Update localStorage with the new theme preference
            localStorage.setItem('color-theme', isDarkMode ? 'dark' : 'light');
            
            // Update the icon visibility by toggling them both
            lightIcon.classList.toggle('hidden');
            darkIcon.classList.toggle('hidden');
        });
    </script>
</body>
</html>