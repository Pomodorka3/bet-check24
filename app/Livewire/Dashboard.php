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

    public function validateBetAndMatch($matchId) {
        return
            // Check if user has not already bet
            !auth()->user()->bets->contains('match_id', $matchId)

            // Check if match is running
            && FootballMatch::find($matchId)->starts_at < now();
    }

    public function placeBet($matchId, $team1Score, $team2Score)
    {
        if ($this->validateBetAndMatch($matchId)) return;

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
        if ($this->validateBetAndMatch($matchId)) return;

        $bet = Bet::where('match_id', $matchId)
            ->where('user_id', auth()->id())
            ->first();
        $bet->update(['team_1_score' => $team1Score, 'team_2_score' => $team2Score]);
        $this->loadMatches();
    }

    public function deleteBet($matchId)
    {
        if ($this->validateBetAndMatch($matchId)) return;

        $bet = Bet::where('match_id', $matchId)
            ->where('user_id', auth()->id())
            ->first();
        $bet->delete();
        $this->loadMatches();
    }

    public function loadMatches() {
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
        foreach ($this->runningMatches as $match) {
            $match->bet = auth()->user()->bets->where('match_id', $match->id)->first();
        }
    }

    public function loadPastMatches()
    {
        $this->pastMatches = FootballMatch::where('starts_at', '<=', now())
            ->where('evaluated', true)
            ->get();
        foreach ($this->pastMatches as $match) {
            $match->bet = auth()->user()->bets->where('match_id', $match->id)->first();
        }
    }
}
