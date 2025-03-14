@php use Illuminate\Support\Str; @endphp


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
                                        <a class="nav-link"
                                           wire:navigate
                                           href="/profile/{{ Str::of($post->user->name)->replace(' ', '-')->lower() }}">
                                            @ {{ Str::of($post->user->username)->replace(' ', '-')->lower() }}
                                        </a>
                                         · {{ $post->created_at->diffForHumans() }}
                                </span>
                            </div>
                            @if(auth()->id() === $post->user_id)
                                <button wire:click="delete({{ $post->id }})"
                                        class="text-red-500 hover:text-red-700 bg-transparent border border-red-500 px-3 py-1 rounded-md">
                                    Delete
                                </button>
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
