<?php

declare(strict_types=1);

?>

@props([
    'title',
    'icon' => null,
    'url' => '#',
    'isActive' => false,
])

<a
    href="{{ $url }}"
    class="text-text-medium hover:text-text-high hover:bg-elevation-02dp {{ $isActive ? 'bg-elevation-02dp text-text-high' : '' }} flex items-center space-x-3 rounded-lg px-3 py-2 transition-colors"
>
    @if ($icon)
        <img src="{{ $icon }}" alt="{{ $title }}" class="h-5 w-5 rounded-full" />
    @else
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    @endif

    <span class="font-satoshi font-weight-regular font-size-xs">{{ $title }}</span>
</a>

<?php
