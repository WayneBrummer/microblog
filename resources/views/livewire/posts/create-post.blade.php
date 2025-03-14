<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

    <div class="max-w-2xl mx-auto p-4">
        <!-- Create Post -->
        <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-sm mb-4">
            <form wire:submit="save">
                <input
                    type="text"
                    class="block p-4 w-full border rounded-md bg-gray-700 text-white focus:ring-gray-500"
                    wire:model="body"
                >
                <div>
                    <x-validation-errors/>
                </div>
                <button
                    type="submit"
                    class="mt-2 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600"
                >
                    Post
                </button>
            </form>
        </div>

        <!-- Posts -->
        <div>
            <livewire:posts.list-post/>
        </div>
    </div>
</div>


