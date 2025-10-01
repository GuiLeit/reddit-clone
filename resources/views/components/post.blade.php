<?php

declare(strict_types=1);

?>

@props([
    'slug' => null,
    'image' => null,
    'prefix' => '//c',
    'name' => 'comunidade',
    'title' => 'Título do post',
    'body' => null,
    'upvotes' => 0,
    'comments' => 0,
    'postId' => null,
    'userVote' => null,
])

<article
    class="bg-elevation-02dp border-outline-dark hover:border-outline-medium relative overflow-hidden rounded-xl border transition-colors"
>
    <!-- Clickable Overlay -->
    <a href="{{ route('post.show', $slug) }}" class="absolute inset-0 z-10" aria-label="Ver post: {{ $title }}"></a>

    <div class="p-4">
        <!-- Community Header -->
        <div class="mb-3 flex items-center space-x-3">
            <div class="bg-helper-error flex h-8 w-8 items-center justify-center rounded-full">
                @if (! is_null($image))
                    <img src="{{ $image }}" alt="Profile Picture" class="h-8 w-8 rounded-full" />
                @else
                    <span class="text-text-dark text-sm font-medium">
                        {{ strtoupper(substr($name, 0, 1)) }}
                    </span>
                @endif
            </div>
            <div class="text-text-high text-sm font-medium">{{ $prefix }} {{ $name }}</div>
        </div>

        <h3 class="text-text-high mb-3 line-clamp-2 text-lg font-semibold">{{ $title }}</h3>
        <p class="text-text-medium mb-4 line-clamp-3 text-sm">{{ $body }}</p>

        <!-- Action Buttons -->
        <div class="relative z-20 flex items-center space-x-4">
            <!-- Comments -->
            <button
                class="text-icon-medium hover:text-text-high flex items-center space-x-1 transition-colors hover:cursor-pointer"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                    ></path>
                </svg>
                <span class="text-sm">{{ $comments }}</span>
            </button>

            <!-- Upvote -->
            <form
                action="{{ route('post.upvote', $slug) }}"
                method="POST"
                class="inline-block"
                onclick="event.stopPropagation()"
            >
                @csrf
                <button
                    class="{{ $userVote === 'upvote' ? 'text-helper-success' : 'text-icon-medium hover:text-helper-success' }} flex items-center space-x-1 transition-colors hover:cursor-pointer"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"
                        ></path>
                    </svg>
                    <span class="text-sm">{{ $upvotes }}</span>
                </button>
            </form>

            <!-- Downvote -->
            <form
                action="{{ route('post.downvote', $slug) }}"
                method="POST"
                class="inline-block"
                onclick="event.stopPropagation()"
            >
                @csrf
                <button
                    class="{{ $userVote === 'downvote' ? 'text-helper-error' : 'text-icon-medium hover:text-helper-error' }} flex items-center space-x-1 transition-colors hover:cursor-pointer"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018c.163 0 .326.02.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"
                        ></path>
                    </svg>
                </button>
            </form>

            <!-- Reply/Responder -->
            <button
                class="text-icon-medium hover:text-text-high flex items-center space-x-1 transition-colors hover:cursor-pointer"
            >
                <span class="text-sm font-medium">Responder</span>
            </button>
        </div>
    </div>
</article>

<?php
