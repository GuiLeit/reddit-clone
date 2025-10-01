<?php

declare(strict_types=1);

?>

@props([
    'comment',
    'post',
    'depth' => 0,
])

<div class="comment-container {{ $depth === 0 ? 'mb-4' : '' }}">
    <div
        class="{{ $depth === 0 ? 'bg-elevation-02dp' : 'bg-elevation-03dp' }} border-outline-dark rounded-xl border p-4"
    >
        <article class="mb-4">
            <!-- Comment Header -->
            <div class="mb-3 flex items-center space-x-3">
                <div class="bg-helper-info flex h-8 w-8 items-center justify-center rounded-full">
                    <span class="text-text-dark text-sm font-medium">
                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-text-high font-medium">{{ $comment->user->name }}</span>
                    <span class="text-text-low">•</span>
                    <span class="text-text-medium text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
            </div>

            <!-- Comment Body -->
            <div class="text-text-medium mb-4 whitespace-pre-wrap">{{ $comment->body }}</div>

            <!-- Comment Actions -->
            <div class="flex items-center space-x-4">
                <!-- Upvote -->
                @auth
                    <form action="{{ route('comment.upvote', $comment->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button
                            class="{{ $comment->getUserVote() === 'upvote' ? 'text-helper-success' : 'text-icon-medium hover:text-helper-success' }} flex items-center space-x-1 transition-colors"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"
                                ></path>
                            </svg>
                            <span class="text-sm">{{ $comment->upvotes()->count() }}</span>
                        </button>
                    </form>

                    <!-- Downvote -->
                    <form action="{{ route('comment.downvote', $comment->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button
                            class="{{ $comment->getUserVote() === 'downvote' ? 'text-helper-error' : 'text-icon-medium hover:text-helper-error' }} flex items-center space-x-1 transition-colors"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018c.163 0 .326.02.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"
                                ></path>
                            </svg>
                        </button>
                    </form>

                    <!-- Reply Button -->
                    <button
                        onclick="toggleReplyForm({{ $comment->id }})"
                        class="text-icon-medium hover:text-text-high flex items-center space-x-1 transition-colors"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"
                            ></path>
                        </svg>
                        <span class="text-sm">Responder</span>
                    </button>
                @else
                    <!-- Vote counts for non-authenticated users -->
                    <div class="text-icon-medium flex items-center space-x-1">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"
                            ></path>
                        </svg>
                        <span class="text-sm">
                            {{ $comment->upvotes()->count() - $comment->downvotes()->count() }}
                        </span>
                    </div>
                @endauth
            </div>

            <!-- Reply Form (Hidden by default) -->
            @auth
                <div id="reply-form-{{ $comment->id }}" class="mt-4 hidden">
                    <form
                        action="{{ route('comment.reply', $comment->id) }}"
                        method="POST"
                        class="bg-elevation-01dp border-outline-dark rounded-lg border p-4"
                    >
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        <textarea
                            name="body"
                            rows="3"
                            class="bg-elevation-surface border-outline-dark text-text-high placeholder-text-medium focus:border-primary focus:ring-primary w-full rounded-lg border p-3 focus:ring-1 focus:outline-none"
                            placeholder="Sua resposta..."
                            required
                        ></textarea>
                        <div class="mt-3 flex justify-end space-x-2">
                            <button
                                type="button"
                                onclick="toggleReplyForm({{ $comment->id }})"
                                class="button-secundary"
                            >
                                Cancelar
                            </button>
                            <button type="submit" class="button-primary">Responder</button>
                        </div>
                    </form>
                </div>
            @endauth
        </article>
        <!-- Replies -->
        @if ($comment->replies && $comment->replies->count() > 0)
            <div class="replies">
                @foreach ($comment->replies as $reply)
                    <x-comments-post :comment="$reply" :post="$post" :depth="$depth + 1" />
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    function toggleReplyForm(commentId) {
        const form = document.getElementById('reply-form-' + commentId);
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
            form.querySelector('textarea').focus();
        } else {
            form.classList.add('hidden');
            form.querySelector('textarea').value = '';
        }
    }
</script>
