<?php

declare(strict_types=1);

?>

@props([
    'myCommunities' => collect(),
    'showMyCommunities' => false,
    'selectedCommunity' => null,
    'communities' => collect(),
])

<x-layouts.guest>
    <!-- Top Nav -->
    <x-navbar />

    <main class="flex">
        <!-- Left Sidebar -->
        <x-sidebar :myCommunities="$myCommunities" :showMyCommunities="$showMyCommunities" />

        <!-- Main Content -->
        <div class="bg-elevation-surface ml-64 min-h-screen w-full">
            <section id="create-post-page">
                <div class="px-6 py-8">
                    <div class="mx-auto space-y-4">
                        <!-- Page Header -->
                        <div class="mb-8">
                            <h1 class="text-text-high mb-2 text-3xl font-bold">Criar Post</h1>
                            <p class="text-text-medium">Compartilhe suas ideias com a comunidade</p>
                        </div>

                        <!-- Create Post Form -->
                        <div class="bg-elevation-02dp border-outline-dark rounded-xl border p-6">
                            <form action="{{ route('post.store') }}" method="POST" class="space-y-6">
                                @csrf

                                <!-- Community Selection -->
                                <div>
                                    <label for="community_id" class="text-text-high mb-2 block text-sm font-medium">
                                        Comunidade *
                                    </label>
                                    <select
                                        name="community_id"
                                        id="community_id"
                                        class="bg-elevation-01dp border-outline-dark text-text-high focus:border-primary focus:ring-primary w-full rounded-lg border p-3 focus:ring-1 focus:outline-none"
                                        required
                                    >
                                        <option value="">Selecione uma comunidade</option>
                                        @foreach ($communities as $community)
                                            <option
                                                value="{{ $community->id }}"
                                                {{ $selectedCommunity && $selectedCommunity->id == $community->id ? 'selected' : '' }}
                                            >
                                                //c {{ $community->subforum }} - {{ $community->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('community_id')
                                        <p class="text-helper-error mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Post Title -->
                                <div>
                                    <label for="title" class="text-text-high mb-2 block text-sm font-medium">
                                        Título *
                                    </label>
                                    <input
                                        type="text"
                                        name="title"
                                        id="title"
                                        value="{{ old('title') }}"
                                        placeholder="Digite o título do seu post..."
                                        class="bg-elevation-01dp border-outline-dark text-text-high placeholder-text-medium focus:border-primary focus:ring-primary w-full rounded-lg border p-3 focus:ring-1 focus:outline-none"
                                        required
                                        maxlength="300"
                                    />
                                    @error('title')
                                        <p class="text-helper-error mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Post Body -->
                                <div>
                                    <label for="body" class="text-text-high mb-2 block text-sm font-medium">
                                        Conteúdo
                                    </label>
                                    <textarea
                                        name="body"
                                        id="body"
                                        rows="8"
                                        placeholder="Escreva o conteúdo do seu post... (opcional)"
                                        class="bg-elevation-01dp border-outline-dark text-text-high placeholder-text-medium focus:border-primary focus:ring-primary resize-vertical w-full rounded-lg border p-3 focus:ring-1 focus:outline-none"
                                    >
{{ old('body') }}</textarea
                                    >
                                    @error('body')
                                        <p class="text-helper-error mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Form Actions -->
                                <div class="flex items-center justify-between pt-4">
                                    <a href="{{ url()->previous() }}" class="button-secundary">Cancelar</a>
                                    <button type="submit" class="button-primary">Publicar Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layouts.guest>
