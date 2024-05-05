<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    private $teamNames = [
        'Deutschland' => 'de',
        'Schottland' => 'gb',
        'Ungarn' => 'hu',
        'Schweiz' => 'ch',
        'Spanien' => 'es',
        'Kroatien' => 'hr',
        'Italien' => 'it',
        'Albanien' => 'al',
        'Niederlande' => 'nl',
        'Slowenien' => 'si',
        'Dänemark' => 'dk',
        'England' => 'gb',
        'Rumänien' => 'ro',
        'Slowakei' => 'sk',
        'Serbien' => 'rs',
        'Belgien' => 'be',
        'Österreich' => 'at',
        'Frankreich' => 'fr',
        'Türkei' => 'tr',
        'Portugal' => 'pt',
        'Tschechische Republik' => 'cz',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->teamNames as $name => $countryCode) {
            Team::factory()->create([
                'name' => $name,
                'countrycode' => $countryCode,
            ]);
        }
    }
}
