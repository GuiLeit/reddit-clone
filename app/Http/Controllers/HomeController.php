<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class HomeController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {}

    public function index(Request $request): Factory|View
    {
        if (auth()->check()) {
            $posts = $this->postService->getPostsFromUserCommunities(auth()->id());

            // Get dashboard statistics efficiently
            $totalMembers = auth()->user()->communities()->withCount('members')->get()->sum('members_count');
            $totalPosts = auth()->user()->communities()->withCount('posts')->get()->sum('posts_count');
            $totalComments = auth()->user()->communities()
                ->with(['posts' => function ($query): void {
                    $query->withCount('comments');
                }])
                ->get()
                ->flatMap(fn ($community) => $community->posts)
                ->sum('comments_count');

            return view('home', [
                'posts' => $posts,
                'totalMembers' => $totalMembers,
                'totalPosts' => $totalPosts,
                'totalComments' => $totalComments,
            ]);
        }

        $posts = $this->postService->getAllPosts();

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
