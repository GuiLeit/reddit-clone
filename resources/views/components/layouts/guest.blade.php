<?php

declare(strict_types=1);

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-elevation-surface h-full" data-theme="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>3Pontos Community • Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet" />
        <!-- Note: Satoshi and Cal Sans are premium fonts. You'll need to purchase and self-host them or find alternatives -->
        <!-- For now, we'll use Inter as fallback -->

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            // Theme toggle functionality
            function toggleTheme() {
                const html = document.documentElement;
                const currentTheme = html.getAttribute('data-theme') || 'dark';
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                // Update the data-theme attribute
                html.setAttribute('data-theme', newTheme);

                // Save to localStorage
                localStorage.setItem('theme', newTheme);

                // Update the theme toggle button icon
                updateThemeIcon(newTheme);
            }

            // Update the theme icon based on current theme
            function updateThemeIcon(theme) {
                const themeButton = document.querySelector('#theme-toggle-icon');
                if (themeButton) {
                    if (theme === 'dark') {
                        // Sun icon for dark theme (indicates you can switch to light)
                        themeButton.innerHTML =
                            '<path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>';
                    } else {
                        // Moon icon for light theme (indicates you can switch to dark)
                        themeButton.innerHTML =
                            '<path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>';
                    }
                }
            }

            // Load saved theme on page load
            document.addEventListener('DOMContentLoaded', function () {
                const savedTheme = localStorage.getItem('theme') || 'dark';
                document.documentElement.setAttribute('data-theme', savedTheme);
                updateThemeIcon(savedTheme);
            });
        </script>
    </head>
    <body class="bg-elevation-surface text-text-high min-h-full">
        <!-- Content -->
        {{ $slot }}
    </body>
</html>

<?php
