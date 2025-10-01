<?php

declare(strict_types=1);

?>

@props(['myCommunities' => collect(), 'showMyCommunities' => false])

<!-- Mobile overlay backdrop -->
<div
    x-show="sidebarOpen"
    x-transition:enter="transition-opacity duration-300 ease-linear"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity duration-300 ease-linear"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="sidebarOpen = false"
    class="bg-opacity-50 fixed inset-0 z-40 bg-black lg:hidden"
></div>

<!-- Sidebar -->
<aside
    class="bg-elevation-01dp border-outline-dark fixed top-16 left-0 z-50 h-[calc(100vh-4rem)] w-64 overflow-y-auto border-r pt-14 transition-transform duration-300 ease-in-out lg:top-0 lg:z-40 lg:h-screen lg:translate-x-0"
    :class="{
        'translate-x-0': sidebarOpen || window.innerWidth >= 1024,
        '-translate-x-full': !sidebarOpen && window.innerWidth < 1024
    }"
    x-show="sidebarOpen || window.innerWidth >= 1024"
    @click.away="if (window.innerWidth < 1024) sidebarOpen = false"
>
    <div class="p-4">
        <!-- Main Navigation -->
        <nav class="mb-8 space-y-1">
            <a
                href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'text-text-high bg-elevation-02dp' : 'text-text-medium hover:text-text-high hover:bg-elevation-02dp' }} flex items-center space-x-3 rounded-lg px-3 py-2"
            >
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                    ></path>
                </svg>
                <span>Home</span>
            </a>

            <a
                href="{{ route('community.all') }}"
                class="{{ request()->routeIs('community.all') ? 'text-text-high bg-elevation-02dp' : 'text-text-medium hover:text-text-high hover:bg-elevation-02dp' }} flex items-center space-x-3 rounded-lg px-3 py-2"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    ></path>
                </svg>
                <span>Explorar comunidades</span>
            </a>

            <a
                href="{{ route('post.create') }}"
                class="text-text-medium hover:text-text-high hover:bg-elevation-02dp flex items-center space-x-3 rounded-lg px-3 py-2 transition-colors"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Criar post</span>
            </a>
        </nav>

        <!-- Communities Section -->
        @auth
            <div>
                <h3 class="text-text-medium mb-3 text-sm font-medium tracking-wide">Minhas comunidades</h3>

                @if ($myCommunities->isNotEmpty())
                    <nav class="space-y-1">
                        @foreach ($myCommunities as $community)
                            <x-community-link
                                title="{{ $community->name }}"
                                subforum="{{ $community->subforum }}"
                                icon="{{ $community->image }}"
                                :isActive="false"
                            />
                        @endforeach
                    </nav>

                    @if (! $showMyCommunities && $myCommunities->count() >= 10)
                        <div class="mt-4">
                            <a
                                href="{{ request()->fullUrlWithQuery(['show_my_communities' => 'true']) }}"
                                class="text-neutral-neutral hover:text-neutral-neutral/80 text-sm font-medium transition-colors"
                            >
                                Ver mais
                            </a>
                        </div>
                    @endif
                @else
                    <p class="text-text-medium text-sm">Você ainda não faz parte de nenhuma comunidade.</p>
                @endif
            </div>
        @endauth
    </div>
</aside>
