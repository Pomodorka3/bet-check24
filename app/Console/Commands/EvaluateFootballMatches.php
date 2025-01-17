<?php

namespace App\Console\Commands;

use App\Models\FootballMatch;
use Illuminate\Console\Command;

class EvaluateFootballMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:evaluate-football-matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Evaluate football matches and update points of every user.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $matches = FootballMatch::where('evaluated', false)
            ->get()
            ->filter(function ($match) {
                return $match->starts_at->addMinutes(90) <= now();
            });

        foreach ($matches as $match) {
            $match->evaluate();
        }
    }
}
