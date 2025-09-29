<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Community;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Community>
 */
final class CommunityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Community::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $name = fake()->words(2, true);
            $subforum = Str::studly($name);
        } while (Community::query()->where('subforum', $subforum)->exists());

        return [
            'name' => $name,
            'subforum' => $subforum,
            'description' => fake()->paragraph(),
            'image' => fake()->optional()->imageUrl(640, 480, 'animals', true),
            'creator_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the community is for technology topics.
     */
    public function technology(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => fake()->randomElement([
                'Programming',
                'Web Development',
                'Machine Learning',
                'Data Science',
                'DevOps',
                'Mobile Development',
                'Game Development',
                'Cybersecurity',
                'Open Source',
                'Tech News',
            ]),
            'description' => 'A community for discussing '.mb_strtolower((string) $attributes['name']).' topics and trends.',
        ]);
    }

    /**
     * Indicate that the community is for gaming topics.
     */
    public function gaming(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => fake()->randomElement([
                'PC Gaming',
                'Console Gaming',
                'Indie Games',
                'RPG Games',
                'FPS Games',
                'Strategy Games',
                'Mobile Games',
                'Retro Gaming',
                'Game Reviews',
                'Gaming News',
            ]),
            'description' => 'A community for '.mb_strtolower((string) $attributes['name']).' enthusiasts.',
        ]);
    }

    /**
     * Indicate that the community is for sports topics.
     */
    public function sports(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => fake()->randomElement([
                'Football',
                'Basketball',
                'Soccer',
                'Tennis',
                'Baseball',
                'Hockey',
                'Golf',
                'Swimming',
                'Running',
                'Fitness',
            ]),
            'description' => 'A community for '.mb_strtolower((string) $attributes['name']).' fans and athletes.',
        ]);
    }
}
