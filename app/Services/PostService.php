<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Community;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class PostService
{
    public function getPostsFromUserCommunities(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        // Get communities where user is member or owner
        $communities = auth()->user()->communities()->pluck('id');

        $posts = Post::query()->whereIn('community_id', $communities)
            ->with(['user', 'community', 'votes' => function ($query) use ($userId): void {
                $query->where('user_id', $userId);
            }])
            ->withCount(['comments', 'upvotes', 'downvotes'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // Add user vote status to each post
        $posts->getCollection()->transform(function ($post): Post {
            $post->userVote = $post->getUserVote();

            return $post;
        });

        return $posts;
    }

    public function getPostsFromCommunity(Community $community, ?int $userId = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Post::query()->where('community_id', $community->id)
            ->with(['user', 'community']);

        if ($userId !== null && $userId !== 0) {
            $query->with(['votes' => function ($q) use ($userId): void {
                $q->where('user_id', $userId);
            }]);
        }

        $posts = $query->withCount(['comments', 'upvotes', 'downvotes'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $posts->getCollection()->transform(function ($post) use ($userId): Post {
            $post->userVote = is_null($userId) ? null : $post->getUserVote();

            return $post;
        });

        return $posts;
    }

    public function getAllPosts(int $perPage = 10): LengthAwarePaginator
    {
        $posts = Post::with(['user', 'community', 'votes'])
            ->withCount(['comments', 'upvotes', 'downvotes'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $posts->getCollection()->transform(function ($post): Post {
            $post->userVote = is_null(auth()->user()) ? null : $post->getUserVote();

            return $post;
        });

        return $posts;
    }
}
