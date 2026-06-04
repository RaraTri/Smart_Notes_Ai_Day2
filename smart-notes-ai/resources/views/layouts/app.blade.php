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
                    </nav>
                </div>
            </aside>

            <main class="flex-1 bg-slate-100">
                <header class="bg-white border-b px-6 py-4 flex justify-between">
    <div class="flex gap-2">
        <!-- Taruh tombolnya di sini -->
        <button onclick="toggleDarkMode()" id="theme-toggle" class="p-2 bg-gray-200 dark:bg-gray-800 rounded text-sm">
            Ganti Tema 🌓
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
