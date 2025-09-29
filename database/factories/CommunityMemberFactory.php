<?php

namespace Database\Factories;

use App\Models\Community;
use App\Models\CommunityMember;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommunityMember>
 */
class CommunityMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommunityMember::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'community_id' => Community::factory(),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Create a membership for an existing community and user.
     */
    public function forCommunityAndUser(Community $community, User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'community_id' => $community->id,
            'user_id' => $user->id,
        ]);
    }
}