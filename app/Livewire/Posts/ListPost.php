<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('My Feed')]
class ListPost extends Component
{
    use WithPagination;

    public bool $profileView = false;

    protected $listeners = ['postDeleted'];

    public function mount($profileView = false): void
    {
        $this->profileView = $profileView;
    }

    public function postDeleted(int $deletedPostId): void
    {
        // Refresh the posts list or update the UI as needed
        // For example, you might refresh the pagination
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.posts.list-post')
            ->with([
                'posts' => $this->profileView
                    ? Post::whereUserId(Auth::id())->latest()->paginate(5)
                    : Post::latest()->paginate(5),
            ]);
    }
}
