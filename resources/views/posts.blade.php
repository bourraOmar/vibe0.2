<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold text-white mb-4">All Posts</h2>

        @forelse ($posts as $post)
            <!-- Post Card -->
            <div class="bg-gray-800 my-10 rounded-lg shadow-lg mb-4 border border-gray-700">
                <!-- Post Header -->
                <div class="p-4 flex items-start">
                    <img class="h-10 w-10 rounded-full mr-3"
                        src="{{ $post->user->profile_photo_url ?? asset('default-avatar.png') }}" alt="Profile picture" />
                    <div>
                        <div class="flex items-center">
                            <h3 class="font-bold text-gray-100">{{ $post->user->name }}</h3>
                            <span class="mx-1 text-gray-400">•</span>
                            <span class="text-gray-400 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-400 text-sm">Public</p>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="px-4 pb-2">
                    <p class="text-white mb-4">
                        {{ $post->content }}
                    </p>
                </div>

                {{-- <!-- Post Image -->
                <div class="pb-2">
                    <img class="w-full" src="/api/placeholder/600/400" alt="Sunset Peak Hiking" />
                </div> --}}

                <!-- Post Stats -->
                <div class="px-4 py-2 border-t border-gray-700">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-1">
                            <div class="bg-indigo-600 text-white rounded-full h-5 w-5 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                </svg>
                            </div>
                            <span class="text-gray-400 text-sm">{{ $post->likes->count() }}</span>
                        </div>
                        <div class="text-gray-400 text-sm">42 comments • 18 shares</div>
                    </div>
                </div>

                <!-- Post Actions -->
                <div class="px-4 py-2 border-t border-gray-700">
                    <div class="flex justify-between">
                        <button onclick="toggleLike({{ $post->id }})"
                            class="flex items-center space-x-2 text-gray-400 hover:text-white transition-all duration-300 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                fill="{{ $post->isLikedBy(auth()->user()) ? 'white' : 'none' }}" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                            </svg>
                            <span>Likes</span>
                        </button>
                        <button
                            class="flex items-center space-x-2 text-gray-400 hover:bg-gray-700 px-2 py-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <span>Comment</span>
                        </button>
                        <button
                            class="flex items-center space-x-2 text-gray-400 hover:bg-gray-700 px-2 py-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            <span>Share</span>
                        </button>
                    </div>
                </div>

                <!-- Comment Input -->
                <div class="px-4 py-3 border-t border-gray-700 flex">
                    <img class="h-8 w-8 rounded-full mr-3" src="/api/placeholder/32/32" alt="Your profile" />
                    <div class="flex-1 bg-gray-700 rounded-full flex items-center px-4">
                        <input type="text" placeholder="Write a comment..."
                            class="bg-transparent w-full outline-none py-1 text-gray-200 placeholder-gray-400" />
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-400">No posts available.</p>
        @endforelse
    </div>

    <script>
        function toggleLike(postId) {
            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            }).then(response => response.json())
            .then(data => {
                location.reload(); // Refresh to update like count
            });
        }
    </script>

</x-app-layout>
