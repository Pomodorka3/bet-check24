<?php

namespace App\Livewire;

use Livewire\Component;

class Communities extends Component
{
    public $communities;
    public $userCommunities;

    public function render()
    {
        return view('livewire.communities', [
            'communities' => $this->communities,
            'userCommunities' => $this->userCommunities
        ]);
    }


}
