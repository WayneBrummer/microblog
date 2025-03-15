<?php

namespace App\Livewire\Profiles;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

#[Title('My Friends Feed')]
class PublicListPost extends Component
{
    public User $user;

    public function mount(User $user): void
    {
        abort_unless(Auth::check(), Response::HTTP_UNAUTHORIZED);
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.profiles.show-public');
    }
}
