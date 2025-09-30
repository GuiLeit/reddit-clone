<?php

declare(strict_types=1);

?>

@props([
    'community',
    'showMyCommunities' => false,
    'posts' => collect(),
    'myCommunities' => collect(),
    'userIsMember' => false,
    'userIsOwner' => false,
])

<x-layouts.guest>
    <!-- Top Nav -->
    <x-navbar />

    <main class="flex">
        <!-- Left Sidebar -->
        <x-sidebar :myCommunities="$myCommunities" :showMyCommunities="$showMyCommunities" />

        <!-- Main Content -->
        <div class="bg-elevation-surface ml-64 min-h-screen w-full">
            <section id="community-page">
                <div class="px-6 py-8">
                    <!-- Community Header -->
                    <div class="mb-8 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <!-- Community Avatar -->
                            <div
                                class="bg-neutral-neutral flex h-20 w-20 items-center justify-center overflow-hidden rounded-full"
                            >
                                <img
                                    src="{{ $community->image }}"
                                    alt="{{ $community->name }}"
                                    class="h-full w-full rounded-full object-cover"
                                />
                            </div>

                            <!-- Community Details -->
                            <div>
                                <h1 class="font-primary font-weight-bold font-size-2xl text-text-high">
                                    {{ $community->displayTitle }}
                                </h1>
                                <p class="font-primary font-weight-regular font-size-sm text-text-medium mt-1">
                                    {{ $community->description }}
                                </p>

                                <!-- Community Stats -->
                                <div class="mt-3 flex items-center space-x-6">
                                    <div class="text-text-high flex items-center space-x-2">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"
                                            />
                                        </svg>
                                        <span class="font-size-sm">{{ $community->members_count }} membros</span>
                                    </div>
                                    <div class="text-text-high flex items-center space-x-2">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        <span class="font-size-sm">
                                            Criado em {{ $community->created_at->format('M j, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center space-x-3">
                            @if ($userIsMember)
                                @if (! $userIsOwner)
                                    <form
                                        action="{{ route('community.leave', $community) }}"
                                        method="POST"
                                        class="inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button-secundary">Sair</button>
                                    </form>
                                @endif

                                <button class="button-primary">Criar post</button>
                            @else
                                <form action="{{ route('community.join', $community) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="button-primary">Entrar</button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- Posts Section -->
                    <div class="bg-elevation-01dp border-outline-dark text-text-high rounded-xl border p-6">
                        <!-- Section Header -->
                        <div class="mb-6">
                            <h2 class="font-primary font-weight-medium font-size-lg text-text-high">
                                Veja todos os posts da comunidade
                            </h2>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layouts.guest>

<?php
