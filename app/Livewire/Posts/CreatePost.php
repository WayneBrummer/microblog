<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CreatePost extends Component
{
    #[Validate('required|min:2|max:280')]
    public string $body = '';

    public function mount(): void
    {
        abort_unless(Auth::check(), Response::HTTP_UNAUTHORIZED);
    }

    public function save(): void
    {
        $this->validate();

        Post::create([
            'body' => $this->body,
            'user_id' => Auth::id(),
        ]);

        $this->redirect(route('feed'), navigate: true);
    }

    public function render()
    {
        return view('livewire.posts.create-post');
    }
}
