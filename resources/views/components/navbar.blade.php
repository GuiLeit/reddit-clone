<?php

declare(strict_types=1);

?>

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

                @auth
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button
                            @click="open = !open"
                            class="text-text-high hover:text-text-medium flex items-center space-x-2 transition-colors"
                            :class="{ 'text-text-medium': open }"
                        >
                            <div class="bg-helper-success flex h-8 w-8 items-center justify-center rounded-full">
                                @if (auth()->user()->profile_picture)
                                    <img
                                        src="{{ auth()->user()->profile_picture }}"
                                        alt="Profile Picture"
                                        class="h-8 w-8 rounded-full"
                                    />
                                @else
                                    <span class="text-text-dark text-sm font-medium">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                            <svg
                                class="h-4 w-4 transition-transform"
                                :class="{ 'rotate-180': open }"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            x-show="open"
                            x-transition:enter="transition duration-100 ease-out"
                            x-transition:enter-start="scale-95 transform opacity-0"
                            x-transition:enter-end="scale-100 transform opacity-100"
                            x-transition:leave="transition duration-75 ease-in"
                            x-transition:leave-start="scale-100 transform opacity-100"
                            x-transition:leave-end="scale-95 transform opacity-0"
                            class="bg-elevation-02dp border-outline-dark ring-opacity-5 absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-lg border shadow-lg ring-1 ring-black focus:outline-none"
                        >
                            <div class="py-1">
                                <!-- User Info -->
                                <div class="border-outline-dark border-b px-4 py-3">
                                    <p class="text-text-high text-sm font-medium">{{ auth()->user()->name }}</p>
                                    <p class="text-text-medium text-xs">{{ auth()->user()->email }}</p>
                                </div>

                                <!-- Navigation Links -->
                                <a
                                    href="{{ route('filament.admin.pages.dashboard') }}"
                                    class="text-text-medium hover:text-text-high hover:bg-elevation-03dp flex items-center px-4 py-2 text-sm transition-colors"
                                >
                                    <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                        ></path>
                                    </svg>
                                    <span class="ml-2">Painel</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <a
                        href="{{ route('filament.admin.auth.login') }}"
                        class="bg-helper-primary hover:bg-helper-primary-hover focus:ring-helper-primary-focus rounded-md px-3.5 py-2.5 text-sm font-medium text-white shadow-sm focus:ring-2 focus:ring-offset-2 focus:outline-none"
                    >
                        Log in
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>
