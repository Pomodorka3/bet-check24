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
    public $currentUserInLastSevenUsers;
    public $currentUserInFirstThreeUsers;
    public $matches;
    public $communityId;
    public string $usernameToSearch = '';

    public function render()
    {
        return view('livewire.leaderboard');
    }

    public function mount($communityId)
    {
        $this->communityId = $communityId;

        $this->calculateOffsets(calledFromMount: true);
        $this->reloadLeaderboard();
    }

    public function refresh()
    {
        if ($this->usernameToSearch !== '')
            $this->searchUser();
        else {
            $this->calculateOffsets(false);
            $this->reloadLeaderboard();
        }
    }

    public function calculateOffsets($calledFromMount)
    {
        $this->users = User::with(['bets', 'bets.match'])
            ->whereHas('communities', function ($query) {
                $query->where('id', $this->communityId);
            })
            ->orderBy('points', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $this->currentUserOrder = $this->users->search(function ($user) {
                return $user->id === auth()->id();
            }); // e.g. 100
        if ($calledFromMount) $this->offset2 = $this->currentUserOrder;

        if ($this->currentUserOrder > $this->users->count() - 8) {
            if ($calledFromMount) $this->offset2 = $this->users->count() - 8;
            $this->currentUserInLastSevenUsers = true;
        }

        if ($this->currentUserOrder <= 3) {
            $this->currentUserInFirstThreeUsers = true;
        }
    }

    public function reloadLeaderboard()
    {
        if ($this->users->count() < $this->usersPerPage) {

            $this->users1 = $this->users;
            $this->users2 = null;
        } else {
            $this->users1 = $this->users->slice(0, $this->limit1);

            if ($this->currentUserInLastSevenUsers) {
                $this->users2 = $this->users->slice($this->offset2);
            } else {
                $this->users2 = $this->users->slice($this->offset2, $this->currentUserOrder - $this->offset2 + 1)
                    ->merge($this->users->slice($this->users->count() - ($this->usersPerPage - 3 - 1), $this->users->count()));
            }

        }

        // Load matches
        $this->matches = FootballMatch::orderBy('starts_at', 'asc')
            ->get();

        $this->loadPinnedUsers();
        $this->checkUsersExpandable();
        $this->calculateUsersRank();
    }

    public function searchUser()
    {
        if ($this->usernameToSearch === '') {
            $this->reloadLeaderboard();
            return;
        }

        $this->users = User::with('bets', 'bets.match')
            ->whereHas('communities', function ($query) {
                $query->where('id', $this->communityId);
            })
            ->where('name', 'like', '%' . $this->usernameToSearch . '%')
            ->orderBy('points', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $this->users1 = $this->users;
        $this->users2 = null;

        $this->users1Expandable = false;
        $this->users2Expandable = false;
        $this->calculateUsersRank();
    }

    private function checkUserListsAreConnected()
    {
        $users1LastUserOrder = $this->users?->search(function ($user) {
            return $user->id === $this->users1?->last()->id;
        });

        $users2LastUserOrder = $this->users?->search(function ($user) {
            return $user->id === $this->users2?->first()->id;
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
            && !$this->checkUserListsAreConnected()
            && !$this->currentUserInFirstThreeUsers;
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
        $pinnedUsers = auth()->user()->settings()->get('leaderboard.' . $this->communityId, []);
        if (!in_array($user->id, $pinnedUsers))
            $pinnedUsers[] = $user->id;

        auth()->user()->settings()->set('leaderboard.' . $this->communityId, $pinnedUsers);
        $this->reloadLeaderboard();
    }

    public function unpinUser(User $user)
    {
        $pinnedUsers = auth()->user()->settings()->get('leaderboard.' . $this->communityId, []);
        if (!in_array($user->id, $pinnedUsers))
            return false; // Error

        $pinnedUsers = array_diff($pinnedUsers, [$user->id]);
        auth()->user()->settings()->set('leaderboard.' . $this->communityId, $pinnedUsers);
        $this->reloadLeaderboard();
    }

    public function loadPinnedUsers()
    {
        $pinnedUsers = auth()->user()->settings()->get('leaderboard.' . $this->communityId, []);

        // Check if pinned user is still part of the community
        $pinnedUsers = $this->checkIfPinnedUsersUpToDate($pinnedUsers);

        // Prepend pinned users to the beginning of the users1 list
        // and remove from the whole users list to avoid duplicates
        foreach ($pinnedUsers as $pinnedUserId) {
            if (isset($this->users1)) {
                $this->users1 = $this->users1->reject(function ($user) use ($pinnedUserId) {
                    return $user->id === $pinnedUserId;
                });
            }
            if (isset($this->users2)) {
                $this->users2 = $this->users2->reject(function ($user) use ($pinnedUserId) {
                    return $user->id === $pinnedUserId;
                });
            }

            $userToPin = $this->users->where('id', $pinnedUserId)->first();
            $userToPin->pinned = true;
            $this->users1->prepend($userToPin);
        }

    }

    public function checkIfPinnedUsersUpToDate($pinnedUsers)
    {
        $pinnedUsersChecked = array_filter($pinnedUsers, function ($pinnedUserId) {
            return $this->users->contains('id', $pinnedUserId);
        });
        if ($pinnedUsers !== $pinnedUsersChecked) {
            auth()->user()->settings()->set('leaderboard.' . $this->communityId, $pinnedUsersChecked);
            $pinnedUsers = $pinnedUsersChecked;
        }

        return $pinnedUsers;
    }

}
