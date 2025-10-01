<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class CommentController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $post->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Comentário adicionado com sucesso!');
    }

    public function reply(Request $request, Comment $comment): RedirectResponse
    {
        $request->validate([
            'body' => ['required', 'string', 'max:1000'],
            'post_id' => ['required', 'exists:posts,id'],
        ]);

        Comment::query()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'parent_id' => $comment->id,
        ]);

        return back()->with('success', 'Resposta adicionada com sucesso!');
    }

    public function upvote(Request $request, Comment $comment): RedirectResponse
    {
        $comment->upvote();

        return back();
    }

    public function downvote(Request $request, Comment $comment): RedirectResponse
    {
        $comment->downvote();

        return back();
    }
}
