<?php

namespace App\Livewire;

use App\Models\Community;
use App\Models\User;
use Livewire\Component;

class SneakPreview extends Component
{
    public $community;
    public $users;

    public function render()
    {
        return view('livewire.sneak-preview');
    }

    public function mount(Community $community)
    {
        $this->community = $community;

        $this->reloadSneakPreview();
    }

    public function refresh()
    {
        $this->reloadSneakPreview();
    }

    public function reloadSneakPreview()
    {
        $this->users = User::limit(5)->get();

        $this->calculateUsersRank();
    }

    public function calculateUsersRank()
    {
        if ($this->users->isEmpty()) return;
        // Calculate the rank - two users can have same rank if they have same amount of points
        $rank = 1;
        $prevPoints = $this->users->first()->points;
        foreach ($this->users as $user) {
            if ($user->points < $prevPoints) {
                $rank++;
            }
            $user->rank = $rank;
            $prevPoints = $user->points;
        }
    }
}
