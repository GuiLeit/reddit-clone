<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CommentVote>
 */
final class CommentVoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment_id' => Comment::factory(),
            'user_id' => User::factory(),
            'type' => fake()->randomElement(['upvote', 'downvote']),
        ];
    }
}
