<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold text-white mb-4">All Posts</h2>

        <!-- New Post Form -->
        <div id="newPostForm" class="bg-[#1f2a37] p-6 rounded-2xl shadow-xl border border-gray-700">
            <h2 class="text-xl font-semibold text-white mb-4">Create a New Post</h2>

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Content Input -->
                <div class="mb-4">
                    <label for="content" class="block text-gray-400 font-medium mb-1">What's on your mind?</label>
                    <textarea name="content" id="content" class="w-full px-4 py-2 bg-[#2a3647] text-white rounded-lg border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none" rows="3" required></textarea>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-400 font-medium mb-1">Upload an Image</label>
                    <input type="file" name="image" id="image" class="w-full px-3 py-2 bg-[#2a3647] text-gray-300 rounded-lg border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-5 py-2 rounded-lg transition-all">
                        Post
                    </button>
                </div>
            </form>
        </div>

        @forelse ($posts as $post)
        <!-- Post Card -->
        <div class="bg-gray-800 my-10 rounded-lg shadow-lg mb-4 border border-gray-700 overflow-hidden">
            <!-- Post Header with More Options Menu -->
            <div class="p-4 flex items-start justify-between">
                <div class="flex items-start">
                    <img class="w-12 h-12 rounded-full object-cover mr-3 border border-gray-600"
                        src="{{ $post->user->profile_photo ? asset('storage/' . $post->user->profile_photo) : asset('default-avatar.png') }}"
                        alt="Profile picture" />

                    <div>
                        <div class="flex items-center">
                            <h3 class="font-bold text-gray-100">{{ $post->user->name }}</h3>
                            <span class="mx-1 text-gray-400">•</span>
                            <span class="text-gray-400 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                @if(Auth::id() === $post->user_id)
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="text-gray-400 hover:text-white focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-gray-700 rounded-md shadow-lg py-1 z-10 border border-gray-600">
                        <a href="{{ route('posts.edit', $post->id) }}"
                            class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Post
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-600 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Post
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>

            <!-- Post Content -->
            <div class="px-4 pb-2">
                <p class="text-white mb-4">
                    {{ $post->content }}
                </p>
            </div>

            <!-- Post Image with Better Handling -->
            @if ($post->image)
            <div class="bg-gray-900 flex justify-center">
                <img class="w-full" src="{{ asset('storage/' . $post->image) }}" alt="Post Image" />
            </div>
            @endif

            <!-- Post Stats -->
            <div class="px-4 py-2 border-t border-gray-700">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <div class="bg-indigo-600 text-white rounded-full h-5 w-5 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                            </svg>
                        </div>
                        <span class="text-gray-400 text-sm">{{ $post->likes->count() }}</span>
                    </div>
                    <div class="text-gray-400 text-sm flex space-x-3">
                        <span>{{ $post->comments->count() }} comments</span>
                        <span>•</span>
                        <span>18 shares</span>
                    </div>
                </div>
            </div>

            <!-- Post Actions -->
            <div class="px-4 py-2 border-t border-gray-700">
                <div class="flex justify-between">
                    <button onclick="toggleLike({{ $post->id }})"
                        class="flex items-center space-x-2 text-gray-400 hover:text-white transition-all duration-300 focus:outline-none px-2 py-1 rounded-md hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                            fill="{{ $post->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                        <span>Like</span>
                    </button>
                    <button onclick="toggleComments({{ $post->id }})"
                        class="flex items-center space-x-2 text-gray-400 hover:text-white px-2 py-1 rounded-md hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <span>Comment</span>
                    </button>
                    <button
                        class="flex items-center space-x-2 text-gray-400 hover:text-white px-2 py-1 rounded-md hover:bg-gray-700">
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
            <div class="px-4 py-3 border-t border-gray-700 flex items-center">
                <img class="w-8 h-8 rounded-full object-cover mr-2 hidden sm:block"
                    src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('default-avatar.png') }}"
                    alt="Your profile" />
                <form action="{{ route('comment.store', $post) }}" method="POST"
                    class="flex-1 bg-gray-700 hover:bg-gray-600 focus-within:bg-gray-600 rounded-full flex items-center px-4 transition duration-200 border border-gray-600 focus-within:border-indigo-500">
                    @csrf
                    <input type="text" name="content" placeholder="Write a comment..."
                        class="bg-transparent w-full outline-none py-2 text-gray-200 placeholder-gray-400">
                    <button type="submit"
                        class="ml-2 text-indigo-400 hover:text-indigo-300 font-medium px-2 py-1 rounded-md hover:bg-indigo-600/20 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Display Comments -->
            <div id="comments-{{ $post->id }}" class="px-4 py-2 hidden">
                @foreach ($post->comments as $comment)
                <div class="flex items-start space-x-3 mb-3">
                    <img class="w-12 h-12 rounded-full object-cover"
                        src="{{ $comment->user->profile_photo ? asset('storage/' . $comment->user->profile_photo) : asset('default-avatar.png') }}"
                        alt="User profile picture" />
                    <div>
                        <p class="text-gray-300 text-sm">
                            <strong>{{ $comment->user->name }}</strong> {{ $comment->content }}
                        </p>
                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>

                        @if (auth()->id() == $comment->user_id)
                        <form action="{{ route('comment.destroy', $comment) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-xs ml-2">Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <p class="text-gray-400 m-4 text-center">No posts available.</p>
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

        function toggleComments(postId) {
            let commentSection = document.getElementById(`comments-${postId}`);
            if (commentSection.classList.contains('hidden')) {
                commentSection.classList.remove('hidden');
            } else {
                commentSection.classList.add('hidden');
            }
        }

        function toggleLike(postId) {
            // Your existing like toggle logic
        }

        function toggleComments(postId) {
            const commentsElement = document.getElementById(`comments-${postId}`);
            if (commentsElement.classList.contains('hidden')) {
                commentsElement.classList.remove('hidden');
            } else {
                commentsElement.classList.add('hidden');
            }
        }
    </script>
    </script>

</x-app-layout>