<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Leaderboard extends Component
{
    public $page = 'dashboard';
    public $users = false;

    public function render()
    {
        return view('livewire.leaderboard');
    }

    public function mount()
    {
        $this->users = User::orderBy('points', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        $rank = 1;
        $prevPoints = $this->users->first()->points;
        foreach ($this->users as $user) {
            if ($user->points < $prevPoints) {
                $rank++;
            }
            $user->rank = $rank;
            $prevPoints = $user->points;
        }
//        dd($this->users);
    }


}
