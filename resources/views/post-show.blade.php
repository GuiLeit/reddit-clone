<?php

declare(strict_types=1);

?>

@props([
    'myCommunities' => collect(),
    'showMyCommunities' => false,
])
<x-layouts.guest>
    <div
        x-data="{ sidebarOpen: false }"
        @resize.window="if (window.innerWidth >= 1024) { sidebarOpen = false; }"
        x-init="sidebarOpen = window.innerWidth >= 1024"
    >
        <!-- Top Nav -->
        <x-navbar :myCommunities="$myCommunities" :showMyCommunities="$showMyCommunities" />

        <main class="flex">
            <!-- Left Sidebar -->
            <x-sidebar :myCommunities="$myCommunities" :showMyCommunities="$showMyCommunities" />

            <!-- Main Feed Content -->
            <div class="bg-elevation-surface min-h-screen w-full lg:ml-64">
                <section id="post-page">
                    <div class="px-6 py-8">
                        <div class="mx-auto">
                            <!-- Post Display -->
                            <div class="mb-6">
                                <div class="bg-elevation-02dp border-outline-dark rounded-xl border p-6">
                                    <article class="mb-4">
                                        <!-- Community Header -->
                                        <div class="mb-4 flex items-center space-x-3">
                                            <div
                                                class="bg-helper-error flex h-10 w-10 items-center justify-center rounded-full"
                                            >
                                                @if ($post->community->image)
                                                    <img
                                                        src="{{ $post->community->image }}"
                                                        alt="Community Image"
                                                        class="h-10 w-10 rounded-full"
                                                    />
                                                @else
                                                    <span class="text-text-dark text-sm font-medium">
                                                        {{ strtoupper(substr($post->community->name, 0, 1)) }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-text-high font-medium">
                                                    //c {{ $post->community->name }}
                                                </div>
                                                <div class="text-text-medium text-sm">
                                                    Posted by
                                                    <strong>//u {{ $post->user->username }}</strong>
                                                    • {{ $post->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Post Content -->
                                        <h1 class="text-text-high mb-4 text-2xl font-bold">{{ $post->title }}</h1>
                                        @if ($post->body)
                                            <div class="text-text-medium mb-6 whitespace-pre-wrap">
                                                {{ $post->body }}
                                            </div>
                                        @endif

                                        <!-- Post Actions -->
                                        <div class="flex items-center space-x-6">
                                            <!-- Upvote -->
                                            <form
                                                action="{{ route('post.upvote', $post->slug) }}"
                                                method="POST"
                                                class="inline-block"
                                            >
                                                @csrf
                                                <button
                                                    class="{{ ($post->userVote ?? null) === 'upvote' ? 'text-helper-success' : 'text-icon-medium hover:text-helper-success' }} flex items-center space-x-2 transition-colors"
                                                >
                                                    <svg
                                                        class="h-5 w-5"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"
                                                        ></path>
                                                    </svg>
                                                    <span class="font-medium">{{ $post->upvotes()->count() }}</span>
                                                </button>
                                            </form>

                                            <!-- Downvote -->
                                            <form
                                                action="{{ route('post.downvote', $post->slug) }}"
                                                method="POST"
                                                class="inline-block"
                                            >
                                                @csrf
                                                <button
                                                    class="{{ ($post->userVote ?? null) === 'downvote' ? 'text-helper-error' : 'text-icon-medium hover:text-helper-error' }} flex items-center space-x-2 transition-colors"
                                                >
                                                    <svg
                                                        class="h-5 w-5"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018c.163 0 .326.02.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </form>

                                            <!-- Comments count -->
                                            <div class="text-icon-medium flex items-center space-x-2">
                                                <svg
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                                    ></path>
                                                </svg>
                                                <span class="font-medium">
                                                    {{ $post->comments()->count() }} comentários
                                                </span>
                                            </div>
                                        </div>
                                    </article>

                                    <!-- Comments Section -->
                                    <div class="space-y-6">
                                        @forelse ($comments as $comment)
                                            <x-comments-post :comment="$comment" :post="$post" />
                                        @empty
                                            <div
                                                class="bg-elevation-02dp border-outline-dark rounded-xl border p-8 text-center"
                                            >
                                                <div class="text-icon-medium mb-2">
                                                    <svg
                                                        class="mx-auto h-12 w-12"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                                        ></path>
                                                    </svg>
                                                </div>
                                                <p class="text-text-medium">Ainda não há comentários neste post.</p>
                                                <p class="text-text-low mt-1 text-sm">Seja o primeiro a comentar!</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <!-- Comment Form -->
                            @auth
                                <div class="mb-6">
                                    <form
                                        action="{{ route('comment.store', $post->slug) }}"
                                        method="POST"
                                        class="bg-elevation-02dp border-outline-dark rounded-xl border p-6"
                                    >
                                        @csrf
                                        <div class="mb-4">
                                            <label for="comment" class="text-text-high mb-2 block text-sm font-medium">
                                                Adicionar comentário
                                            </label>
                                            <textarea
                                                name="body"
                                                id="comment"
                                                rows="4"
                                                class="bg-elevation-01dp border-outline-dark text-text-high placeholder-text-medium focus:border-primary focus:ring-primary w-full rounded-lg border p-3 focus:ring-1 focus:outline-none"
                                                placeholder="O que você está pensando?"
                                                required
                                            ></textarea>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit" class="button-primary">Comentar</button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="mb-6">
                                    <div
                                        class="bg-elevation-02dp border-outline-dark rounded-xl border p-6 text-center"
                                    >
                                        <p class="text-text-medium mb-4">Faça login para comentar neste post</p>
                                        <a
                                            href="{{ route('filament.admin.auth.login') }}"
                                            class="bg-primary hover:bg-primary-dark inline-block rounded-lg px-6 py-2 font-medium text-white transition-colors"
                                        >
                                            Fazer Login
                                        </a>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-layouts.guest>

<?php
