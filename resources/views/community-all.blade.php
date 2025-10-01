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
    <!-- Top Nav -->
    <x-navbar />

    <main class="flex">
        <!-- Left Sidebar -->
        <x-sidebar :myCommunities="$myCommunities" :showMyCommunities="$showMyCommunities" />

        <!-- Main Content -->
        <div class="bg-elevation-surface ml-64 min-h-screen w-full">
            <section id="communities-page">
                <div class="px-6 py-8">
                    <!-- Page Title -->
                    <div class="mb-8">
                        <h1 class="font-secondary font-weight-regular text-text-high mb-5 text-3xl">Comunidades</h1>
                        <p class="font-primary font-weight-regular font-size-xs text-text-medium">
                            Confira as comunidades disponíveis na plataforma
                        </p>
                    </div>

                    <div class="mb-6 space-y-4">
                        @foreach ($communities as $community)
                            <article
                                class="bg-elevation-02dp border-outline-dark hover:border-outline-medium group relative overflow-hidden rounded-xl border transition-colors"
                            >
                                <!-- Clickable overlay for navigation -->
                                <a
                                    href="{{ route('community.show', ['community' => $community]) }}"
                                    class="absolute inset-0 z-10"
                                    aria-label="View {{ $community->name }} community"
                                ></a>

                                <div class="flex items-center space-x-4 p-4">
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
                                            <h2 class="font-primary font-weight-bold font-size-lg text-text-high">
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

                                        <p class="font-primary font-weight-regular font-size-sm text-text-medium mt-1">
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
</x-layouts.guest>

<?php
