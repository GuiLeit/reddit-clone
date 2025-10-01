<?php

declare(strict_types=1);

?>

@props([
    'totalMembers' => null,
    'totalPosts' => null,
    'totalComments' => null,
])
<section id="feed">
    <div class="px-4 py-6 sm:px-6 sm:py-8">
        @auth
            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="font-secondary font-weight-regular text-text-high mb-5 text-3xl">
                    Olá,
                    <span class="text-indigo-600">{{ auth()->user()->name }}</span>
                </h1>
                <p class="font-primary font-weight-regular font-size-xs text-text-medium">
                    Confira as estatísticas das comunidades que você segue
                </p>
            </div>

            <!-- Statistics Cards -->
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
                <!-- Card 1 - Usuários -->
                <div class="bg-elevation-01dp border-outline-dark text-text-high rounded-xl border p-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center rounded-lg bg-blue-500 p-3">
                            <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-text-medium mb-1 text-sm">Quantidade de usuários</div>
                            <div class="text-text-high text-2xl font-bold">{{ $totalMembers }}</div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 - Posts -->
                <div class="bg-elevation-01dp border-outline-dark text-text-high rounded-xl border p-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center rounded-lg bg-yellow-500 p-3">
                            <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-text-medium mb-1 text-sm">Quantidade de posts</div>
                            <div class="text-text-high text-2xl font-bold">{{ $totalPosts }}</div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 - Replies -->
                <div class="bg-elevation-01dp border-outline-dark text-text-high rounded-xl border p-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center rounded-lg bg-purple-500 p-3">
                            <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-text-medium mb-1 text-sm">Quantidade de replies</div>
                            <div class="text-text-high text-2xl font-bold">{{ $totalComments }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endauth

        <!-- Posts Section -->
        <div class="bg-elevation-01dp border-outline-dark rounded-2xl border p-6">
            <h2 class="text-text-high mb-6 text-xl font-semibold">
                @auth
                    Veja os últimos posts das comunidades que você segue
                @else
                    Veja os posts mais recentes
                @endauth
            </h2>
            <div class="space-y-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>

<?php
