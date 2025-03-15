<div>
    @if($posts)
        @foreach ($posts as $post)
            <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-sm mb-4">
                <div class="flex items-start space-x-3">
                    <div class="p-2">
                        <img
                            class="w-12 h-12 rounded-full"
                            src="{{ $post->user->profile_photo_url }}"
                            alt="User Profile"
                        >
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="font-semibold text-gray-900">
                                    {{ $post->user->name }}
                                </span>
                                <span
                                    class="text-gray-500 text-sm">
                                        <a
                                            wire:navigate
                                            href="/profile/{{ $post->user->username }}">
                                            @ {{ $post->user->username }}
                                        </a>
                                         · {{ $post->created_at->diffForHumans() }}
                                </span>
                            </div>
                            @if(auth()->id() === $post->user_id)
                                <livewire:posts.delete-post :postId="$post->id" :key="'delete-post-' . $post->id"/>
                            @endif
                        </div>
                        <p class="text-gray-800 mt-1">{{ $post->body }}</p>
                    </div>
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    @else
        <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-sm mb-4">
            No posts found.
        </div>
    @endif
</div>
