<?php

declare(strict_types=1);

?>

@props([
    'myCommunities' => collect(),
    'showMyCommunities' => false,
])
<x-layouts.guest>
    <!-- Top Nav -->
    <x-navbar />

    <main class="flex">
        <!-- Left Sidebar -->
        <x-sidebar :myCommunities="$myCommunities" :showMyCommunities="$showMyCommunities" />

        <!-- Main Feed Content -->
        <div class="bg-elevation-surface ml-64 min-h-screen w-full">
            <x-feed>
                <!-- Sample Posts -->
                <x-post
                    icon="🏴"
                    url="#"
                    communityName="//r CRF - Clube de Regatas do Flamengo"
                    title="Petição pro Mc Poze do Rodo virar nosso embaixador"
                    content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget felis tincidunt, auctor leo quis, dictum neque. Proin convallis dictum hendrerit..."
                    upvotes="1"
                    comments="2"
                />

                <x-post
                    icon="🏴"
                    url="#"
                    communityName="//r CRF - Clube de Regatas do Flamengo"
                    title="Lorem ipsum dolor sit amet"
                    content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget felis tincidunt, auctor leo quis, dictum neque. Proin convallis dictum hendrerit..."
                    upvotes="0"
                    comments="4"
                />
            </x-feed>
        </div>
    </main>
</x-layouts.guest>

<?php
