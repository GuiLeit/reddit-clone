<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
    public function create(Request $request): View|Factory
    {
        $communities = auth()->user()->communities()->get();
        $selectedCommunity = null;

        // Check if a community is pre-selected via query parameter
        if ($request->has('community')) {
            $selectedCommunity = Community::query()->where('subforum', $request->get('community'))->first();
        }

        return view('post-create', [
            'communities' => $communities,
            'selectedCommunity' => $selectedCommunity,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:300'],
            'body' => ['nullable', 'string', 'max:10000'],
            'community_id' => ['required', 'exists:communities,id'],
        ]);

        $post = Post::query()->create([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title),
            'body' => $request->body,
            'user_id' => Auth::id(),
            'community_id' => $request->community_id,
        ]);

        return redirect()->route('post.show', $post->slug)
            ->with('success', 'Post criado com sucesso!');
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

    /**
     * Generate a unique slug for the post.
     */
    private function generateUniqueSlug(string $title): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (Post::query()->where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
