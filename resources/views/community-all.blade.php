<?php

declare(strict_types=1);

?>

@props([
    'showMyCommunities' => false,
    'myCommunities' => collect(),
    'communities' => collect(),
    'userBelongs' => false,
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

            <!-- Main Content -->
            <div class="bg-elevation-surface min-h-screen w-full lg:ml-64">
                <section id="communities-page">
                    <div class="px-4 py-6 sm:px-6 sm:py-8">
                        <!-- Page Title -->
                        <div class="mb-6 sm:mb-8">
                            <h1
                                class="font-secondary font-weight-regular text-text-high mb-3 text-2xl sm:mb-5 sm:text-3xl"
                            >
                                Comunidades
                            </h1>
                            <p class="font-primary font-weight-regular sm:font-size-xs text-text-medium text-sm">
                                Confira as comunidades disponíveis na plataforma
                            </p>
                        </div>

                        <div class="space-y-3 sm:space-y-4">
                            @foreach ($communities as $community)
                                <article
                                    class="bg-elevation-02dp border-outline-dark hover:border-outline-medium group relative mb-4 overflow-hidden rounded-xl border transition-colors sm:mb-0"
                                >
                                    <!-- Clickable overlay for navigation -->
                                    <a
                                        href="{{ route('community.show', ['community' => $community]) }}"
                                        class="absolute inset-0 z-10"
                                        aria-label="View {{ $community->name }} community"
                                    ></a>

                                    <div class="p-3 sm:p-4">
                                        <!-- Mobile Layout -->
                                        <div class="block sm:hidden">
                                            <!-- Community Header -->
                                            <div class="mb-3 flex items-start space-x-3">
                                                <!-- Community Avatar -->
                                                <div
                                                    class="bg-neutral-neutral relative flex h-12 w-12 flex-shrink-0 items-center justify-center overflow-hidden rounded-full"
                                                >
                                                    @if ($community->image)
                                                        <img
                                                            src="{{ $community->image }}"
                                                            alt="{{ $community->name }}"
                                                            class="h-full w-full rounded-full object-cover"
                                                        />
                                                    @else
                                                        <div
                                                            class="bg-helper-warning flex h-full w-full items-center justify-center rounded-full"
                                                        >
                                                            <span class="text-text-dark text-sm font-bold">
                                                                {{ substr($community->name, 0, 2) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Community Info -->
                                                <div class="min-w-0 flex-1">
                                                    <div class="mb-1 flex items-center space-x-2">
                                                        <h2
                                                            class="font-primary font-weight-bold text-text-high truncate text-base"
                                                        >
                                                            {{ $community->displayTitle ?? '//c ' . $community->subforum . ' - ' . $community->name }}
                                                        </h2>
                                                        <!-- Membership Badge -->
                                                        @auth
                                                            @if ($community->userBelongs ?? false)
                                                                <span
                                                                    class="bg-indigo-primary flex-shrink-0 rounded-full px-2 py-1 text-xs font-medium text-white"
                                                                >
                                                                    Membro
                                                                </span>
                                                            @endif
                                                        @endauth
                                                    </div>

                                                    <p
                                                        class="font-primary font-weight-regular text-text-medium line-clamp-2 text-sm"
                                                    >
                                                        {{ Str::limit($community->description, 100) }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Community Stats and Action -->
                                            <div class="flex items-center justify-between">
                                                <div class="text-text-medium flex flex-wrap items-center gap-2 text-xs">
                                                    <span>{{ $community->members_count ?? 0 }} membros</span>
                                                    <span>•</span>
                                                    <span>{{ $community->posts_count ?? 0 }} posts</span>
                                                    <span>•</span>
                                                    <span>
                                                        Criado em {{ $community->created_at->format('M j, Y') }}
                                                    </span>
                                                </div>

                                                <!-- Action Button -->
                                                @if (! $community->userBelongs)
                                                    <div class="relative z-20">
                                                        <form
                                                            action="{{ route('community.join', $community) }}"
                                                            method="POST"
                                                            class="inline"
                                                        >
                                                            @csrf
                                                            <button type="submit" class="button-primary">Entrar</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Desktop Layout -->
                                        <div class="hidden items-center space-x-4 sm:flex">
                                            <!-- Community Avatar -->
                                            <div
                                                class="bg-neutral-neutral relative flex h-12 w-12 items-center justify-center overflow-hidden rounded-full"
                                            >
                                                @if ($community->image)
                                                    <img
                                                        src="{{ $community->image }}"
                                                        alt="{{ $community->name }}"
                                                        class="h-full w-full rounded-full object-cover"
                                                    />
                                                @else
                                                    <div
                                                        class="bg-helper-warning flex h-full w-full items-center justify-center rounded-full"
                                                    >
                                                        <span class="text-text-dark text-sm font-bold">
                                                            {{ substr($community->name, 0, 2) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Community Details -->
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2">
                                                    <h2
                                                        class="font-primary font-weight-bold font-size-lg text-text-high"
                                                    >
                                                        {{ $community->displayTitle ?? '//c ' . $community->subforum . ' - ' . $community->name }}
                                                    </h2>

                                                    <!-- Membership Badge -->
                                                    @auth
                                                        @if ($community->userBelongs ?? false)
                                                            <span
                                                                class="bg-indigo-primary rounded-full px-2 py-1 text-xs font-medium text-white"
                                                            >
                                                                Membro
                                                            </span>
                                                        @endif
                                                    @endauth
                                                </div>

                                                <p
                                                    class="font-primary font-weight-regular font-size-sm text-text-medium mt-1"
                                                >
                                                    {{ $community->description }}
                                                </p>
                                                <p class="font-size-xs text-text-medium mt-2">
                                                    {{ $community->members_count ?? 0 }} membros •
                                                    {{ $community->posts_count ?? 0 }} posts • Criado em
                                                    {{ $community->created_at->format('M j, Y') }}
                                                </p>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="relative z-20 flex items-center space-x-3">
                                                @if (! $community->userBelongs)
                                                    <!-- Non-member can join community -->
                                                    <form
                                                        action="{{ route('community.join', $community) }}"
                                                        method="POST"
                                                        class="inline"
                                                    >
                                                        @csrf
                                                        <button type="submit" class="button-primary">Entrar</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if ($communities->hasPages())
                            <div class="mt-8">
                                {{ $communities->links() }}
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-layouts.guest>

<?php
