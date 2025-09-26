<?php

declare(strict_types=1);

?>

<x-layouts.guest>
    <main class="flex">
        <!-- Left Sidebar -->
        <x-sidebar />

        <!-- Main Feed Content -->
        <x-feed username="Usuário">
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
    </main>
</x-layouts.guest>

<?php
