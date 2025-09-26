<?php

declare(strict_types=1);

?>

<header class="bg-elevation-01dp border-outline-dark sticky top-0 z-50 border-b">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo and Brand -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <!-- Logo -->
                    <div class="bg-helper-warning flex h-8 w-8 items-center justify-center rounded-full">
                        <svg class="text-text-dark h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z"></path>
                        </svg>
                    </div>
                    <!-- Brand Name -->
                    <div class="text-text-high">
                        <span class="text-lg font-bold">3Pontos</span>
                        <div class="text-text-medium text-xs">Community</div>
                    </div>
                </div>

                <!-- Home breadcrumb -->
                <div class="text-text-medium hidden items-center text-sm sm:flex">
                    <span>Home</span>
                </div>
            </div>

            <!-- Right side - User menu and actions -->
            <div class="flex items-center space-x-4">
                <!-- Mobile search button -->
                <button class="text-icon-medium hover:text-icon-high p-2 md:hidden">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        ></path>
                    </svg>
                </button>

                <!-- Theme toggle -->
                <button
                    onclick="toggleTheme()"
                    class="text-icon-medium hover:text-icon-high p-2 transition-colors"
                    title="Toggle theme"
                >
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                </button>

                <!-- User menu -->
                <div class="relative">
                    <button class="text-icon-medium hover:text-icon-high flex items-center space-x-2 p-2">
                        <div class="bg-helper-error flex h-8 w-8 items-center justify-center rounded-full">
                            <span class="text-text-high text-sm font-medium">U</span>
                        </div>
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            ></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<?php
