<?php

declare(strict_types=1);

?>

@props([
    'showMyCommunities' => false,
    'myCommunities' => collect(),
    'community',
    'posts' => collect(),
    'userIsMember' => false,
    'userIsOwner' => false,
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
                <section id="community-page">
                    <div class="px-4 py-6 sm:px-6 sm:py-8">
                        <!-- Community Header -->
                        <div class="mb-6 sm:mb-8">
                            <!-- Mobile Layout -->
                            <div class="block sm:hidden">
                                <!-- Community Avatar and Title -->
                                <div class="mb-4 flex items-center space-x-3">
                                    <div
                                        class="bg-neutral-neutral flex h-16 w-16 flex-shrink-0 items-center justify-center overflow-hidden rounded-full"
                                    >
                                        <img
                                            src="{{ $community->image }}"
                                            alt="{{ $community->name }}"
                                            class="h-full w-full rounded-full object-cover"
                                        />
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h1
                                            class="font-primary font-weight-bold text-text-high truncate text-lg sm:text-2xl"
                                        >
                                            {{ $community->displayTitle }}
                                        </h1>
                                        <p class="font-primary font-weight-regular text-text-medium mt-1 text-sm">
                                            {{ Str::limit($community->description, 60) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mb-4 flex items-center space-x-2">
                                    @if ($userIsMember)
                                        @if (! $userIsOwner)
                                            <form
                                                action="{{ route('community.leave', $community) }}"
                                                method="POST"
                                                class="inline-block"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-secundary px-3 py-2 text-sm">
                                                    Sair
                                                </button>
                                            </form>
                                        @endif

                                        <a
                                            href="{{ route('post.create', ['community' => $community->subforum]) }}"
                                            class="button-primary px-3 py-2 text-sm"
                                        >
                                            Criar post
                                        </a>
                                    @else
                                        <form
                                            action="{{ route('community.join', $community) }}"
                                            method="POST"
                                            class="inline-block"
                                        >
                                            @csrf
                                            <button type="submit" class="button-primary px-3 py-2 text-sm">
                                                Entrar
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <!-- Community Stats -->
                                <div class="flex flex-wrap items-center gap-4 text-sm">
                                    <div class="text-text-high flex items-center space-x-1">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"
                                            />
                                        </svg>
                                        <span>{{ $community->members_count }} membros</span>
                                    </div>
                                    <div class="text-text-high flex items-center space-x-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M7 7h10M7 11h10M7 15h10M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V7.828a2 2 0 00-.586-1.414l-4.828-4.828A2 2 0 0013.172 1H5z"
                                            ></path>
                                        </svg>
                                        <span>{{ $community->posts_count }} posts</span>
                                    </div>
                                    <div class="text-text-high flex items-center space-x-1">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        <span>{{ $community->created_at->format('M j, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Desktop Layout -->
                            <div class="items-top hidden justify-between space-x-4 sm:flex">
                                <!-- Community Avatar -->
                                <div
                                    class="bg-neutral-neutral flex h-20 w-20 flex-shrink-0 items-center justify-center overflow-hidden rounded-full"
                                >
                                    <img
                                        src="{{ $community->image }}"
                                        alt="{{ $community->name }}"
                                        class="h-full w-full rounded-full object-cover"
                                    />
                                </div>

                                <!-- Community Details -->
                                <div class="w-full">
                                    <h1 class="font-primary font-weight-bold font-size-2xl text-text-high">
                                        {{ $community->displayTitle }}
                                    </h1>
                                    <p
                                        class="font-primary font-weight-regular font-size-sm text-text-medium mt-1 break-words"
                                    >
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
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 7h10M7 11h10M7 15h10M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V7.828a2 2 0 00-.586-1.414l-4.828-4.828A2 2 0 0013.172 1H5z"
                                                ></path>
                                            </svg>
                                            <span class="font-size-sm">{{ $community->posts_count }} posts</span>
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

                                <!-- Action Buttons -->
                                <div class="flex flex-shrink-0 items-center space-x-3">
                                    @if ($userIsMember)
                                        @if (! $userIsOwner)
                                            <form
                                                action="{{ route('community.leave', $community) }}"
                                                method="POST"
                                                class="inline-block"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-secundary whitespace-nowrap">
                                                    Sair
                                                </button>
                                            </form>
                                        @endif

                                        <a
                                            href="{{ route('post.create', ['community' => $community->subforum]) }}"
                                            class="button-primary whitespace-nowrap"
                                        >
                                            Criar post
                                        </a>
                                    @else
                                        <form
                                            action="{{ route('community.join', $community) }}"
                                            method="POST"
                                            class="inline-block"
                                        >
                                            @csrf
                                            <button type="submit" class="button-primary whitespace-nowrap">
                                                Entrar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Posts Section -->
                        <div class="bg-elevation-01dp border-outline-dark text-text-high rounded-xl border p-4 sm:p-6">
                            <!-- Section Header -->
                            <div class="mb-6">
                                <h2 class="font-primary font-weight-medium font-size-lg text-text-high">
                                    Veja todos os posts da comunidade
                                </h2>
                            </div>

                            <!-- Posts List -->
                            <div class="space-y-6">
                                @foreach ($posts as $post)
                                    <x-post
                                        :slug="$post->slug"
                                        :image="$post->user->profile_picture"
                                        :communityName="$post->community->name"
                                        :username="$post->user->username"
                                        :title="$post->title"
                                        :body="$post->body"
                                        :upvotes="$post->upvotes_count"
                                        :comments="$post->comments_count"
                                        :userVote="$post->userVote"
                                        :createdAt="$post->created_at"
                                    />
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            @if ($posts->hasPages())
                                <div class="mt-8">
                                    {{ $posts->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-layouts.guest>

<?php
