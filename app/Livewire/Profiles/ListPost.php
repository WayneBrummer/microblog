<?php

namespace App\Livewire\Profiles;

use App\Models\User;
use Livewire\Component;

class ListPost extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.profiles.list-post')->with([
            'posts' => $this->user
                ->posts()
                ->latest()
                ->paginate(5),
        ]);
    }
}
