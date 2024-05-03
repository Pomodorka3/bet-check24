<?php

namespace Database\Seeders;

use App\Models\FootballMatch;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;

class FootballMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = Reader::createFromPath(Storage::disk('local')->path('game_schedule.csv'), 'r');
        $reader->setDelimiter(';');
        $reader->setHeaderOffset(0); //set the CSV header offset
        $records = $reader->getRecords();
        foreach ($records as $offset => $record) {
            $teamHomeName = $record['team_home_name'];
            $teamAwayName = $record['team_away_name'];
            $gameStartsAt = $record['game_starts_at'];

            $team1 = Team::where('name', $teamHomeName)->first();
            $team2 = Team::where('name', $teamAwayName)->first();

            if (!$team1 || !$team2) {
                continue;
            }

            $footballMatch = new FootballMatch();
            $footballMatch->team1()->associate($team1);
            $footballMatch->team2()->associate($team2);
            $footballMatch->starts_at = Carbon::parse($gameStartsAt);
            $footballMatch->save();
        }

    }
}
