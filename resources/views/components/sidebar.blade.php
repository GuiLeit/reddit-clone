<?php

declare(strict_types=1);

?>

<aside
    class="bg-elevation-01dp border-outline-dark fixed top-0 left-0 z-[60] min-h-screen w-64 overflow-y-auto border-r"
>
    <div class="p-4">
        <!-- User Info Section -->
        <div class="mb-6">
            <div class="text-text-medium mb-2 text-sm">Lorem Ipsum</div>
        </div>

        <!-- Main Navigation -->
        <nav class="mb-8 space-y-1">
            <a href="#" class="text-text-high bg-elevation-02dp flex items-center space-x-3 rounded-lg px-3 py-2">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                    ></path>
                </svg>
                <span>Home</span>
            </a>

            <a
                href="#"
                class="text-text-medium hover:text-text-high hover:bg-elevation-02dp flex items-center space-x-3 rounded-lg px-3 py-2 transition-colors"
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
                href="#"
                class="text-text-medium hover:text-text-high hover:bg-elevation-02dp flex items-center space-x-3 rounded-lg px-3 py-2 transition-colors"
            >
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        fill-rule="evenodd"
                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
                <span>Perfil</span>
            </a>
        </nav>

        <!-- Communities Section -->
        <div>
            <h3 class="text-text-medium mb-3 text-sm font-medium tracking-wide uppercase">Minhas comunidades</h3>
            <nav class="space-y-1">
                <x-community
                    title="Flamengo"
                    url="/communities/flamengo"
                    icon="/images/flamengo-logo.png"
                    :isActive="false"
                />
                <x-community
                    title="UI/UX"
                    url="/communities/flamengo"
                    icon="/images/flamengo-logo.png"
                    :isActive="false"
                />
                <x-community
                    title="Jardinagem"
                    url="/communities/flamengo"
                    icon="/images/flamengo-logo.png"
                    :isActive="false"
                />
                <x-community
                    title="Dev"
                    url="/communities/flamengo"
                    icon="/images/flamengo-logo.png"
                    :isActive="false"
                />
            </nav>
        </div>
    </div>
</aside>

<?php
