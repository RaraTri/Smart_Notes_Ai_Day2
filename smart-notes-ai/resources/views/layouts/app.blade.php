<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
            @laravelPWA
        @endif

<style>
        /* Memaksa background layar dan area utama jadi gelap */
        html.dark body, html.dark main, html.dark .bg-slate-100 {
            background-color: #0f172a !important;
            color: #ffffff !important;
        }
        /* Memaksa kotak-kotak card putih jadi abu-abu gelap */
        html.dark .bg-white {
            background-color: #1e293b !important;
            color: #ffffff !important;
            border: none !important;
        }
        /* Memaksa semua teks di dalam main jadi putih */
        html.dark main * {
            color: #ffffff !important;
        }
    </style>
    </head>
    <body>
        <div class="flex min-h-screen">
            <aside class="hidden md:block w-64 bg-slate-800 text-white p-6" id="aside">
                <div>
                    <h1 class="text-x font-bold mb-6">
                        Smart Notes AI
                    </h1>

                    <nav>
                        <a href="/" class="block">Dashboard</a>
                        <a href="/notes" class="block">Notes</a>
                        <a href="/quiz" class="block">Quiz</a>
                        <a href="/chat" class="block">Chat</a>
                    </nav>
                </div>
            </aside>

            <main class="flex-1 bg-slate-100">
                <header class="bg-white border-b px-6 py-4 flex justify-between">
    <div class="flex gap-2">
        <!-- Taruh tombolnya di sini -->
        <button onclick="toggleDarkMode()" id="theme-toggle" class="group flex items-center gap-2 px-5 py-2 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-blue-500 dark:hover:border-blue-400 hover:shadow-md transition-all duration-300">
            <span class="text-sm font-bold text-slate-600 dark:text-slate-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Tema</span>
            <span class="text-lg group-hover:rotate-12 transition-transform duration-300">🌓</span>
        </button>
        
        <!-- (Mungkin di bawah sini ada kode bawaan lain, biarkan saja) -->
    </div>
</header>

                <div class="p-4">
                    @yield('content')
                </div>
            </main>
        </div>
        <script>

        const currentTheme = localStorage.getItem('theme');
        const htmlElement = document.documentElement;

        if (currentTheme === 'dark') {
            htmlElement.classList.add('dark');
        }

        function toggleDarkMode() {
            htmlElement.classList.toggle('dark');
            if (htmlElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        }
    </script>
    </body>
</html>
