<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\CommunityMember;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommunityMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $communities = Community::all();

        if ($users->isEmpty() || $communities->isEmpty()) {
            $this->command->warn('Users or Communities not found. Make sure to run UserSeeder and CommunitySeeder first.');
            return;
        }

        // Ensure each community creator is automatically a member of their community
        foreach ($communities as $community) {
            CommunityMember::firstOrCreate([
                'community_id' => $community->id,
                'user_id' => $community->creator_id,
            ]);
        }

        // Create random memberships
        foreach ($users as $user) {
            // Each user joins 1-5 random communities
            $randomCommunities = $communities
                ->random(rand(1, min(5, $communities->count())));

            foreach ($randomCommunities as $community) {
                // Avoid duplicates
                CommunityMember::firstOrCreate([
                    'community_id' => $community->id,
                    'user_id' => $user->id,
                ]);
            }
        }

        // Ensure popular communities have more members
        $popularCommunities = $communities->random(3);
        foreach ($popularCommunities as $community) {
            $extraMembers = $users->random(rand(3, 7));
            foreach ($extraMembers as $user) {
                CommunityMember::firstOrCreate([
                    'community_id' => $community->id,
                    'user_id' => $user->id,
                ]);
            }
        }

        $membershipCount = CommunityMember::count();
        $this->command->info("Community memberships seeded successfully! Total memberships: {$membershipCount}");
    }
}