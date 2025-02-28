<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold text-white mb-4">All Posts</h2>

        @forelse ($posts as $post)
            <div class="bg-[#2a3647] rounded-lg p-4 mb-4 shadow-lg">
                <p class="text-gray-300 mb-4">{{ $post->content }}</p>
                <p class="text-gray-500 text-sm mb-4">{{ $post->created_at->diffForHumans() }}</p>

                <div class="flex gap-4 items-center space-x-6 border-t border-gray-600 pt-4">
                    <!-- Like Button -->
                    <button
                        class="flex items-center space-x-2 text-gray-400 hover:text-red-500 transition-all duration-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span class="text-sm">Like</span>
                    </button>

                    <!-- Comment Button -->
                    <button
                        class="flex items-center space-x-2 text-gray-400 hover:text-blue-500 transition-all duration-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <span class="text-sm">Comment</span>
                    </button>

                    <!-- Share Button -->
                    <button
                        class="flex items-center space-x-2 text-gray-400 hover:text-green-500 transition-all duration-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        <span class="text-sm">Share</span>
                    </button>
                </div>
            </div>
        @empty
            <p class="text-gray-400">No posts available.</p>
        @endforelse
    </div>
</x-app-layout>
