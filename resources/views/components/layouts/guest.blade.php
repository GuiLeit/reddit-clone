<?php

declare(strict_types=1);

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-elevation-surface h-full">
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
    </head>
    <body class="bg-elevation-surface text-text-high min-h-full">
        <!-- Top Nav -->
        <x-navbar />

        <!-- Content -->
        {{ $slot }}
    </body>
</html>

<?php
