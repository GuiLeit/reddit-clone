<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post): View|Factory
    {
        $post->load(['user', 'community']);

        // Fetch comments with their relationships
        $comments = $post->comments()
            ->whereNull('parent_id')
            ->with([
                'user',
                'replies.user',
                'votes',
                'replies.votes',
            ])
            ->latest()
            ->get();

        // Load comment votes for authenticated users
        if (Auth::check()) {
            $post->load([
                'votes' => function ($query): void {
                    $query->where('user_id', Auth::id());
                },
            ]);
            $post->userVote = $post->getUserVote();

            // Load user votes for comments and replies
            $comments->load([
                'votes' => function ($query): void {
                    $query->where('user_id', Auth::id());
                },
                'replies.votes' => function ($query): void {
                    $query->where('user_id', Auth::id());
                },
            ]);
        }

        return view('post-show', [
            'post' => $post,
            'comments' => $comments,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }

    public function upvote(Request $request, Post $post): RedirectResponse
    {
        $post->upvote();

        return back();
    }

    public function downvote(Request $request, Post $post): RedirectResponse
    {
        $post->downvote();

        return back();
    }
}
