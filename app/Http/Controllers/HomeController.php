<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class HomeController extends Controller
{
    public function index(Request $request): Factory|View
    {
        $posts = collect();

        if (auth()->check()) {
            // Get communities where user is member or owner
            $communities = auth()->user()->communities()->pluck('id');

            $posts = Post::whereIn('community_id', $communities)
                ->with(['user', 'community', 'votes' => function($query) {
                    $query->where('user_id', auth()->id());
                }])
                ->withCount(['comments', 'upvotes', 'downvotes'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            // Add user vote status to each post
            $posts->getCollection()->transform(function ($post) {
                $post->userVote = $post->getUserVote();
                return $post;
            });

            // Get dashboard statistics efficiently
            $totalMembers = auth()->user()->communities()->withCount('members')->get()->sum('members_count');
            $totalPosts = auth()->user()->communities()->withCount('posts')->get()->sum('posts_count');
            $totalComments = auth()->user()->communities()
                ->with(['posts' => function ($query) {
                    $query->withCount('comments');
                }])
                ->get()
                ->flatMap(function ($community) {
                    return $community->posts;
                })
                ->sum('comments_count');

            return view('home', [
                'posts' => $posts,
                'totalMembers' => $totalMembers,
                'totalPosts' => $totalPosts,
                'totalComments' => $totalComments,
            ]);
        }

        $posts = Post::with(['user', 'community', 'votes'])
            ->withCount(['comments', 'upvotes', 'downvotes'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('home', [
            'posts' => $posts
        ]);
    }
}
