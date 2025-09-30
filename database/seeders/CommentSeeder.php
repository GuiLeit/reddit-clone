<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Comment;
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
        $posts = Post::query()->inRandomOrder()->take(Post::query()->count() * 0.5)->get();
        $users = User::all();

        if ($posts->isEmpty() || $users->isEmpty()) {
            $this->command->warn('No posts or users found. Please run PostSeeder and UserSeeder first.');

            return;
        }

        // Create top-level comments
        $topLevelComments = collect();
        foreach ($posts as $post) {
            $commentCount = random_int(2, 8);
            for ($i = 0; $i < $commentCount; $i++) {
                $comment = Comment::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'parent_id' => null,
                ]);
                $topLevelComments->push($comment);
            }
        }

        // Create child comments (replies)
        foreach ($topLevelComments as $parentComment) {
            $replyCount = random_int(0, 4);
            for ($i = 0; $i < $replyCount; $i++) {
                Comment::factory()->create([
                    'post_id' => $parentComment->post_id,
                    'user_id' => $users->random()->id,
                    'parent_id' => $parentComment->id,
                ]);
            }
        }

        // Create some nested replies (replies to replies)
        $childComments = Comment::query()->whereNotNull('parent_id')->get();
        foreach ($childComments->take(10) as $childComment) {
            if (random_int(0, 1) !== 0) { // 50% chance
                Comment::factory()->create([
                    'post_id' => $childComment->post_id,
                    'user_id' => $users->random()->id,
                    'parent_id' => $childComment->id,
                ]);
            }
        }
    }
}
