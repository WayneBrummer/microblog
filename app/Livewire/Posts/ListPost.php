<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListPost extends Component
{
    use WithPagination;

    public bool $profileView = false;

    public function mount($profileView = false)
    {
        $this->profileView = $profileView;
    }

    public function delete(int $id)
    {
        Post::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.posts.list-post')->with([
            'posts' => $this->profileView
                ? Post::whereUserId(Auth::id())->latest()->paginate(5)
                : Post::latest()->paginate(5),
        ]);
    }
}
