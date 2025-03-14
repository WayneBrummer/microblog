<div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
{{--    <x-application-logo class="block h-12 w-auto" />--}}



    <div class="max-w-2xl mx-auto p-4">
        <!-- Create Post -->
        <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-sm mb-4">

                    <textarea class=""
                              placeholder="What's on your mind?"></textarea>


            <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Post</button>
            <x-input  />
            <x-button />
        </div>

        <!-- Feed -->
        <div>
            @foreach ($posts ?? [] as $post)
                <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-sm mb-4">
                    <div class="flex items-start space-x-3">
                        <img class="w-12 h-12 rounded-full" src="https://via.placeholder.com/48" alt="User Profile">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="font-semibold text-gray-900">{{ $post->user->name }}</span>
                                    <span class="text-gray-500 text-sm">@{{ $post->user->username }} · {{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <p class="text-gray-800 mt-1">{{ $post->content }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>


