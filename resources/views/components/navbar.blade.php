<?php

declare(strict_types=1);

?>

@props(['user' => null])

<header class="bg-elevation-01dp border-outline-dark sticky top-0 z-50 border-b">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-end">
            <!-- Right side actions -->
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
                        <g id="theme-toggle-icon">
                            <!-- Default sun icon for dark theme -->
                            <path
                                fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                clip-rule="evenodd"
                            ></path>
                        </g>
                    </svg>
                </button>

                @if (is_null($user))
                    <!-- Login button -->
                    <a
                        href="{{ route('filament.admin.auth.login') }}"
                        class="bg-helper-primary hover:bg-helper-primary-hover focus:ring-helper-primary-focus rounded-md px-3.5 py-2.5 text-sm font-medium text-white shadow-sm focus:ring-2 focus:ring-offset-2 focus:outline-none"
                    >
                        Log in
                    </a>
                @else
                    <!-- User menu -->
                    <div class="relative">
                        <button
                            class="text-text-high hover:text-text-medium flex items-center space-x-2 transition-colors"
                        >
                            <div class="bg-helper-success flex h-8 w-8 items-center justify-center rounded-full">
                                <span class="text-text-dark text-sm font-medium">U</span>
                            </div>
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>
