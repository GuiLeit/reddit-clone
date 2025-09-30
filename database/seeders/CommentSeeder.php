<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

final class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $users = User::all();

        // Create top-level comments
        $topComments = Comment::factory()->count(50)->create([
            'post_id' => $posts->random()->id,
            'user_id' => $users->random()->id,
            'parent_id' => null,
        ]);

        // Create child comments (replies)
        $middleComments = collect();
        for ($i = 0; $i < 25; $i++) {
            $parentComment = $topComments->random();
            $childComment = Comment::factory()->create([
                'post_id' => $parentComment->post_id,
                'user_id' => $users->random()->id,
                'parent_id' => $parentComment->id,
            ]);
            $middleComments->push($childComment);
        }

        // Create some nested replies (replies to replies)
        for ($i = 0; $i < 25; $i++) {
            $parentComment = $middleComments->random();
            Comment::factory()->create([
                'post_id' => $parentComment->post_id,
                'user_id' => $users->random()->id,
                'parent_id' => $parentComment->id,
            ]);
        }

        $allComments = Comment::all();
        CommentVote::factory()->count(200)->create([
            'comment_id' => $allComments->random()->id,
            'user_id' => $users->random()->id,
        ]);

    }
}
