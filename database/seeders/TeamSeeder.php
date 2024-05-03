<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    private $teamNames = [
        'Deutschland',
        'Schottland',
        'Ungarn',
        'Schweiz',
        'Spanien',
        'Kroatien',
        'Italien',
        'Albanien',
        'Niederlande',
        'Slowenien',
        'Dänemark',
        'England',
        'Rumänien',
        'Slowakei',
        'Serbien',
        'Belgien',
        'Österreich',
        'Frankreich',
        'Türkei',
        'Portugal',
        'Tschechische Republik',
        'Deutschland',
        'Schweiz',
        'Slowakei',
        'Kroatien',
        'Frankreich',
        'England',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->teamNames as $teamName) {
            \App\Models\Team::factory()->create([
                'name' => $teamName,
            ]);
        }
    }
}
