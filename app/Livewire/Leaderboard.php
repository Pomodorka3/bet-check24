<?php

namespace App\Livewire;

use App\Models\FootballMatch;
use App\Models\User;
use Livewire\Component;

class Leaderboard extends Component
{
    public $page = 'dashboard';
    public $users;
    public $users1;
    public $users2;
    public $limit1 = 3;
    public $offset2;
    public $usersPerPage = 10;
    public $users1Expandable = false;
    public $users2Expandable = false;
    public $currentUserOrder;
    public $matches;

    public function render()
    {
        return view('livewire.leaderboard');
    }

    public function mount()
    {
        $this->users = User::with('bets', 'bets.match')
            ->orderBy('points', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        $this->offset2 = $this->currentUserOrder = $this->users->search(function ($user) {
            return $user->id === auth()->id();
        }); // e.g. 100

        $this->reloadLeaderboard();
    }

    public function reloadLeaderboard()
    {
//        $this->currentUserOrder = $this->users->search(function ($user) {
//            return $user->id === auth()->id();
//        }); // e.g. 100

        $this->users1 = $this->users->slice(0, $this->limit1);

//        dd($this->currentUserOrder - $this->offset2 + 1);
        $this->users2 = $this->users->slice($this->offset2, $this->currentUserOrder - $this->offset2 + 1)
            ->merge($this->users->slice($this->users->count() - ($this->usersPerPage - 3 - 1), $this->users->count()));

        // TODO: append pinned users to the beginning
        // TODO: remove pinned users from the list (to avoid duplicates)

        // Load matches
        $this->matches = FootballMatch::orderBy('starts_at', 'asc')
            ->get();

        $this->checkUsersExpandable();
        $this->calculateUsersRank();
    }

    public function searchUser($username)
    {
        $this->users = User::with('bets', 'bets.match')
            ->where('name', 'like', '%' . $username . '%')
            ->orderBy('points', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        $this->calculateUsersRank();
    }

    private function checkUserListsAreConnected()
    {
        $users1LastUserOrder = $this->users->search(function ($user) {
            return $user->id === $this->users1->last()->id;
        });

        $users2LastUserOrder = $this->users->search(function ($user) {
            return $user->id === $this->users2->first()->id;
        });

        return $users1LastUserOrder + 1 === $users2LastUserOrder;
    }

    public function checkUsersExpandable()
    {
        $this->users1Expandable =
            $this->limit1 < $this->offset2
            && !$this->checkUserListsAreConnected();

        $this->users2Expandable =
            $this->offset2 > $this->limit1
            && !$this->checkUserListsAreConnected();
    }

    public function expandUsers1()
    {
        if ($this->users1Expandable) {
            if ($this->limit1 + $this->usersPerPage > $this->offset2)
                $this->limit1 = $this->offset2;
            else
                $this->limit1 += $this->usersPerPage;

            $this->reloadLeaderboard();
        }
    }

    public function expandUsers2()
    {
        if ($this->users2Expandable) {
            if ($this->offset2 - $this->usersPerPage < $this->limit1)
                $this->offset2 = $this->limit1;
            else
                $this->offset2 -= $this->usersPerPage;

            $this->reloadLeaderboard();
        }
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

    public function pinUser(User $user)
    {
        dd($user);
    }

}
