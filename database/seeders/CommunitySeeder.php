<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Community::factory()->create(['name' => 'Global Standings', 'created_by' => 1]);
        // Every user is part of the global standings community
        foreach (User::all() as $user) {
            $user->communities()->attach(1);
        }

        Community::factory(40)->create();

        foreach (Community::limit(30)->get() as $community) {
            $idsToAttach = User::inRandomOrder()->limit(rand(1,5))->pluck('id');
            $community->users()->attach($idsToAttach);
        }
    }
}
