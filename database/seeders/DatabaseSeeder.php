<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Community;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->isLocal() && User::query()->count() === 0) {
            $admin = User::factory()->admin()->create();
            $admin->addMediaFromUrl('https://picsum.photos/200/300')->toMediaCollection('profile-pictures');

            Community::factory()
                ->count(3)
                ->technology()
                ->create([
                    'creator_id' => $admin->id,
                ]);
        }

        User::factory(10)->create();

        // Seed communities and memberships
        $this->call([
            CommunitySeeder::class,
            CommunityMemberSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
