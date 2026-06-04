<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <style>
    /* Memaksa warna berubah menjadi gelap saat class 'dark' aktif */
    html.dark body {
        background-color: #0f172a !important; /* Latar belakang layar menjadi gelap */
        color: #ffffff !important; /* Teks menjadi putih */
    }
    html.dark .bg-white {
        background-color: #1e293b !important; /* Kotak form login menjadi abu-abu gelap */
        color: #ffffff !important;
        border: none !important;
    }
    html.dark input {
        background-color: #334155 !important;
        color: #ffffff !important;
        border: 1px solid #475569 !important;
    }
</style>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

    </head>
    <body class="bg-gray-50 dark:bg-slate-900 dark:text-white transition-colors duration-300">
    <div class="p-4 flex justify-end">
        <button onclick="toggleDarkMode()" id="theme-toggle" class="p-2 bg-gray-200 dark:bg-gray-800 rounded text-sm">
            Ganti Tema 🌓
        </button>
    </div>

    @yield('content')

    <!-- Script persis di atas /body -->
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
