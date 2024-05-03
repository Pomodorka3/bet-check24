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
        Community::factory(40)->create();

        foreach (Community::limit(30)->get() as $community) {
            $idsToAttach = User::inRandomOrder()->limit(rand(1,5))->pluck('id');
            $community->users()->attach($idsToAttach);
        }
    }
}
