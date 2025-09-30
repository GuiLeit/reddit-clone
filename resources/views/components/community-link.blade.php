<?php

declare(strict_types=1);

?>

@props([
    'title',
    'subforum' => null,
    'icon' => null,
    'isActive' => false,
])

<a
    href="{{ route('community.show', ['community' => $subforum]) }}"
    class="text-text-medium hover:text-text-high hover:bg-elevation-02dp {{ $isActive ? 'bg-elevation-02dp text-text-high' : '' }} flex items-center space-x-3 rounded-lg px-3 py-2 transition-colors"
    title="{{ $subforum }} - {{ $title }}"
>
    @if ($icon)
        <img src="{{ $icon }}" alt="{{ $subforum }} - {{ $title }}" class="h-5 w-5 rounded-full" />
    @else
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    @endif

    <span class="font-satoshi font-weight-regular font-size-xs">{{ $subforum }}</span>
</a>

<?php
