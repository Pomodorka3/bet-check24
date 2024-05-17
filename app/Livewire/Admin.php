<?php

namespace App\Livewire;

use App\Models\FootballMatch;
use Livewire\Component;

class Admin extends Component
{
    public $runningMatches;
    public $status;
    public $teams;
    public $scoresToSet;

    public function render()
    {
        return view('livewire.admin');
    }

    public function mount() {
        $this->loadRunningMatches();
        $this->loadScoresToSet();
    }

    public function loadScoresToSet() {
        foreach ($this->runningMatches as $match) {
            $this->scoresToSet[$match->id] = $match->team_1_score . ':' . $match->team_2_score;
        }
    }

    public function loadRunningMatches()
    {
        $this->runningMatches = FootballMatch::where('starts_at', '<=', now())
            ->where('evaluated', false)
            ->get();
    }

    public function setScore($matchId)
    {
        $score = $this->scoresToSet[$matchId];
        if (strpos($score, ':') === false) {
//            $this->addError('score', 'The score must be in the format "number:number".');
            $this->status = [
                'type' => 'error', // 'success', 'error', 'warning', 'info
                'message' => 'The score must be in the format "number:number".',
            ];
            return;
        }

        $score = explode(':', $score);
        $match = FootballMatch::find($matchId);
        $match->update([
            'team_1_score' => $score[0],
            'team_2_score' => $score[1],
        ]);
        $match->save();

        $this->status = [
            'type' => 'success',
            'message' => 'The score has been updated.',
        ];

        $this->loadRunningMatches();
    }

    public function resetStatus() {
        $this->status = null;
}
}
