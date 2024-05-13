<?php

namespace App\Livewire;

use App\Models\Bet;
use App\Models\FootballMatch;
use Livewire\Component;

class Dashboard extends Component
{
    public $upcomingMatches;
    public $runningMatches;
    public $pastMatches;
    public $bets;

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function mount()
    {
        $this->loadMatches();
    }

    public function placeBet($matchId, $team1Score, $team2Score)
    {
        // TODO: check if already betted
        // TODO: check if match is running
        Bet::create([
            'match_id' => $matchId,
            'team_1_score' => $team1Score,
            'team_2_score' => $team2Score,
            'user_id' => auth()->id(),
        ]);
        $this->loadMatches();
    }

    public function updateBet($matchId, $team1Score, $team2Score)
    {
        // TODO: check if already betted
        // TODO: check if match is running
        $bet = Bet::where('match_id', $matchId)
            ->where('user_id', auth()->id())
            ->first();
        $bet->update(['team_1_score' => $team1Score, 'team_2_score' => $team2Score]);
        $this->loadMatches();
    }

    public function deleteBet($betId)
    {
        // TODO: check if already betted
        // TODO: check if match is running
        $bet = Bet::find($betId);
        $bet->delete();
        $this->loadMatches();
    }

    private function loadMatches() {
        $this->loadUpcomingMatches();
        $this->loadRunningMatches();
        $this->loadPastMatches();
    }

    public function loadUpcomingMatches()
    {
        // First show betted matches
        $this->upcomingMatches = FootballMatch::where('starts_at', '>', now())
            ->get()->sortBy(function ($match) {
                return auth()->user()->bets->contains('match_id', $match->id);
            }, SORT_REGULAR, true);
        foreach ($this->upcomingMatches as $match) {
            $match->bet = auth()->user()->bets->where('match_id', $match->id)->first();
        }
    }

    public function loadRunningMatches()
    {
        $this->runningMatches = FootballMatch::where('starts_at', '<=', now())
            ->where('evaluated', false)
            ->get();
    }

    public function loadPastMatches()
    {
        $this->pastMatches = FootballMatch::where('starts_at', '<=', now())
            ->where('evaluated', true)
            ->get();
    }
}
