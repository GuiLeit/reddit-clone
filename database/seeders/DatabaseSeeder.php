<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->isLocal() && User::count() === 0) {
            User::factory()->admin()->create();
        }

        User::factory(10)->create();

        // Seed communities and memberships
        $this->call([
            CommunitySeeder::class,
            CommunityMemberSeeder::class,
        ]);
    }
}
