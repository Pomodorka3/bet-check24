<?php

namespace App\Livewire;

use App\Models\Bet;
use App\Models\FootballMatch;
use Livewire\Component;

class Dashboard extends Component
{
    public $upcomingMatches;
    public $runningMatches;
    public $bets;

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function mount()
    {
        $this->loadMatches();

        $this->runningMatches = FootballMatch::where('starts_at', '<=', now())
            ->where('evaluated', false)
            ->get();
    }

    public function placeBet($matchId, $team1Score, $team2Score) {
        dd($matchId, $team1Score, $team2Score);
        Bet::create([
            'match_id' => $matchId,
            'team_1_score' => $team1Score,
            'team_2_score' => $team2Score,
            'user_id' => auth()->id(),
        ]);
        $this->loadMatches();
    }

    public function loadMatches() {
        // First show betted matches
        $this->upcomingMatches = FootballMatch::where('starts_at', '>', now())
            ->get()->sortBy(function ($match) {
                return auth()->user()->bets->contains('match_id', $match->id);
            }, SORT_REGULAR, true);
        foreach ($this->upcomingMatches as $match) {
            $match->bet = auth()->user()->bets->where('match_id', $match->id)->first();
        }
    }
}
