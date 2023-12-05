<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\User;
use Livewire\Component;

class SearchUser extends Component
{
    public $searchedUsers = [];
    public $searchText = "";

    public $addedUsers = [];

    public function search()
    {
        if ($this->searchText != "")
        {
            $this->searchedUsers = User::where('name', 'like', '%' . $this->searchText . '%')->get();
        } else {
            $this->searchedUsers = [];
        }
    }

    public function addUser(User $user)
    {
        if (!in_array($user, $this->addedUsers))
        {
            array_push($this->addedUsers, $user);
        }
    }

    public function render()
    {
        return view('livewire.search-user');
    }
}
