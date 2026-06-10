<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <style>
        /* Background utama lebih kalem */
        html.dark body, html.dark .bg-slate-100 {
            background-color: #0f172a !important;
            color: #e2e8f0 !important; /* Putihnya agak redup biar nggak sakit di mata */
        }
        
        /* Kotak login dikasih efek melayang (shadow) dan garis tepi tipis */
        html.dark .bg-white {
            background-color: #1e293b !important;
            color: #f8fafc !important;
            border: 1px solid #334155 !important; 
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 8px 10px -6px rgba(0, 0, 0, 0.5) !important; 
        }
        
        /* Kolom inputan dibikin lebih tegas */
        html.dark input {
            background-color: #0f172a !important; /* Warnanya disamain sama background luar */
            color: #f8fafc !important;
            border: 1px solid #475569 !important;
        }
        
        /* Efek biru waktu kolom inputan diklik */
        html.dark input:focus {
            border-color: #3b82f6 !important; 
            outline: none !important;
        }

        /* Tombol ganti tema dibikin mode gelap juga biar nggak silau */
        html.dark #theme-toggle {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
            border: 1px solid #334155 !important;
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
    <div class="absolute top-0 left-0 w-full bg-white px-8 py-4 flex justify-between items-center shadow-lg z-50">
        
        <div class="text-xl font-bold flex items-center gap-2">
            ✨ Hello!
        </div>

        <button onclick="toggleDarkMode()" id="theme-toggle" class="group flex items-center gap-2 px-5 py-2 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-blue-500 dark:hover:border-blue-400 hover:shadow-md transition-all duration-300">
            <span class="text-sm font-bold text-slate-600 dark:text-slate-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Tema</span>
            <span class="text-lg group-hover:rotate-12 transition-transform duration-300">🌓</span>
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
