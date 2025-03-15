<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DeletePost extends Component
{
    public int $postId;

    public function mount(int $postId): void
    {
        $this->postId = $postId;
    }

    public function delete(): void
    {
        $post = Post::findOrFail($this->postId);

        abort_unless(Gate::allows('delete', $post), Response::HTTP_FORBIDDEN);

        $post->delete();

        $this->dispatch('postDeleted', $this->postId);
    }

    public function render()
    {
        return view('livewire.posts.delete-post');
    }
}
