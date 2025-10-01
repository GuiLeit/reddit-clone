<?php

declare(strict_types=1);

?>

@props([
    'myCommunities' => collect(),
    'showMyCommunities' => false,
    'posts' => collect(),
    'totalMembers' => null,
    'totalPosts' => null,
    'totalComments' => null,
])
<x-layouts.guest>
    <!-- Top Nav -->
    <x-navbar />

    <main class="flex">
        <!-- Left Sidebar -->
        <x-sidebar :myCommunities="$myCommunities" :showMyCommunities="$showMyCommunities" />

        <!-- Main Feed Content -->
        <div class="bg-elevation-surface ml-64 min-h-screen w-full">
            <x-feed :totalMembers="$totalMembers" :totalPosts="$totalPosts" :totalComments="$totalComments">
                <!-- Sample Posts -->
                @foreach ($posts as $post)
                    <x-post
                        :slug="$post->slug"
                        :image="$post->community->image"
                        :communityName="$post->community->name"
                        :username="$post->user->username"
                        :title="$post->title"
                        :body="$post->body"
                        :upvotes="$post->upvotes_count"
                        :comments="$post->comments_count"
                        :postId="$post->id"
                        :userVote="$post->userVote"
                        :createdAt="$post->created_at"
                    />
                @endforeach

                <!-- Pagination -->
                @if ($posts->hasPages())
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                @endif
            </x-feed>
        </div>
    </main>
</x-layouts.guest>

<?php
