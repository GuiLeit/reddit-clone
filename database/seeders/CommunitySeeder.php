<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Community;
use App\Models\User;
use Illuminate\Database\Seeder;

final class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users first if they don't exist
        if (User::query()->count() === 0) {
            User::factory(10)->create();
        }

        $users = User::all();

        // Create technology communities
        Community::factory()
            ->count(3)
            ->technology()
            ->create([
                'creator_id' => $users->random()->id,
            ]);

        // Create gaming communities
        Community::factory()
            ->count(3)
            ->gaming()
            ->create([
                'creator_id' => $users->random()->id,
            ]);

        // Create sports communities
        Community::factory()
            ->count(2)
            ->sports()
            ->create([
                'creator_id' => $users->random()->id,
            ]);

        // Create some general communities
        Community::factory()
            ->count(4)
            ->create([
                'creator_id' => $users->random()->id,
            ]);

        $this->command->info('Communities seeded successfully!');
    }
}
