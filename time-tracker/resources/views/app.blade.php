<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class= "dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{asset('images/logo.svg') }}">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @viteReactRefresh
        @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        <button id="darkModeToggle" class="fixed top-2 right-4 p-2 bg-gray-800 text-white rounded">
            <img id="darkModeIcon" src="{{asset('images/planet/sun.svg') }}" alt="Chuyển đổi chế độ">
        </button>
        @inertia
    
        <!-- Dark Mode Toggle Script -->
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const toggleButton = document.getElementById('darkModeToggle');
                const darkModeIcon = document.getElementById('darkModeIcon');
                const htmlElement = document.documentElement;
    
                toggleButton.addEventListener('click', () => {
                    if (htmlElement.classList.contains('dark')) {
                        htmlElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                        darkModeIcon.src = "{{ asset('images/planet/sun.svg') }}"; // Đổi thành ảnh chế độ sáng
                    } else {
                        htmlElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                        darkModeIcon.src = "{{ asset('images/planet/moon.svg') }}"; // Đổi thành ảnh chế độ tối
                    }
                });
    
                // On page load, check local storage and set theme
                if (localStorage.getItem('theme') === 'dark') {
                    htmlElement.classList.add('dark');
                    darkModeIcon.src = "{{ asset('images/planet/moon.svg') }}"; // Đặt ảnh chế độ tối
                } else {
                    htmlElement.classList.remove('dark');
                    darkModeIcon.src = "{{ asset('images/planet/sun.svg') }}"; // Đặt ảnh chế độ sáng
                }
            });
        </script>
    </body>
</html>

