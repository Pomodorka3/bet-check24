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
        $this->users = collect();
        $this->community = $community;

        $this->reloadSneakPreview();
    }

    public function refresh()
    {
        $this->users = collect();
        $this->reloadSneakPreview();
    }

    public function reloadSneakPreview()
    {
        $users = User::with(['bets', 'bets.match'])
            ->whereHas('communities', function ($query) {
                $query->where('id', $this->community->id);
            })
            ->orderBy('points', 'desc')
            ->orderBy('created_at', 'desc') // Newest users first
            ->get();

        $currentUserOrder = $users->search(function ($user) {
                return $user->id === auth()->id();
            });

        $currentUserInLastTwoUsers = false;
        $currentUserInFirstThreeUsers = false;
        if ($currentUserOrder <= 3) {
            $currentUserInFirstThreeUsers = true;
        }
        if ($currentUserOrder > $users->count() - 3) {
            $offset2 = $users->count() - 3;
            $currentUserInLastTwoUsers = true;
        }

        $this->calculateUsersRank($users);

        if ($users->count() <= 7) {
            // Simply show all seven users ordered by points
            $this->users = $users;
            return;
        } else {
            // Community has more than 7 users
            // All possible cases:
            if ($currentUserInFirstThreeUsers && !$currentUserInLastTwoUsers) {
                $this->users = $this->users->merge($users->take(6));
                $this->users->push($users->reverse()->first());
            } elseif (!$currentUserInFirstThreeUsers && $currentUserInLastTwoUsers) {
                $this->users = $this->users->merge($users->take(3));
                $this->users = $this->users->merge($users->slice($users->count() - 4));
            } else {
                $this->users = $this->users->merge($users->take(3));
                $this->users->push($users->slice($currentUserOrder - 1, 1)->first());
                $this->users->push(auth()->user());
                $this->users->push($users->slice($currentUserOrder + 1, 1)->first());
                $this->users = $this->users->add($users->slice($users->count() - 1)->first());
            }
        }

    }

    public function calculateUsersRank(&$users)
    {
        if ($users->isEmpty()) return;
        // Calculate the rank - two users can have same rank if they have same amount of points
        $rank = 1;
        $prevPoints = $users->first()->points;
        foreach ($users as $user) {
            if ($user->points < $prevPoints) {
                $rank++;
            }
            $user->rank = $rank;
            $prevPoints = $user->points;
        }
    }
}
