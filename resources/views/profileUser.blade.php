<x-app-layout>
    <main class="flex justify-center items-center min-h-screen bg-[#111826] text-white">
        <div class="max-w-4xl w-full px-6 py-10">
            <!-- Profile Header -->
            <div class="bg-[#1f2a37] rounded-2xl shadow-xl p-8 mb-8">
                <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-6">
                    <!-- Profile Picture -->
                    <div class="relative">
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile picture"
                            class="w-40 h-40 rounded-full object-cover border-4 border-[#1f2a37]">
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1 text-center sm:text-left">
                        <h1 class="text-3xl font-bold text-white">{{ $user->fullname }}</h1>
                        <p class="text-gray-400 text-lg mt-1">@ {{ $user->username }}</p>
                        <p class="text-gray-400 text-lg mt-1">500 Friends</p>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- About Section -->
                <div class="bg-[#1f2a37] rounded-2xl shadow-xl p-6">
                    <h2 class="text-2xl font-bold text-white mb-4">Bio</h2>
                    <p class="text-gray-300">
                        {{ $user->bio ?? 'There is no bio yet.' }}
                    </p>
                </div>

                <!-- Posts Section -->
                <div class="col-span-2 bg-[#1f2a37] rounded-2xl shadow-xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-white">Posts</h2>
                        @if (auth()->id() === $user->id)
                            <button id="addPostButton"
                                class="bg-[#3b82f6] text-white px-4 py-2 rounded-lg hover:bg-[#60a5fa] transition-all duration-300">
                                Add Post
                            </button>
                        @endif
                    </div>

                    <!-- Existing Posts -->
                    @foreach ($user->posts as $post)
                        <div class="bg-[#2a3647] rounded-lg p-4 mb-4 shadow-lg">
                            <!-- Post Content -->
                            <p class="text-gray-300 mb-4">{{ $post->content }}</p>

                            <!-- Post Metadata (Timestamp) -->
                            <p class="text-gray-500 text-sm mb-4">{{ $post->created_at->diffForHumans() }}</p>

                            <!-- Action Buttons (Like, Comment, Share) -->
                            <div class="flex gap-4 items-center space-x-6 border-t border-gray-600 pt-4">
                                <!-- Like Button -->
                                <button
                                    class="flex items-center space-x-2 text-gray-400 hover:text-red-500 transition-all duration-300 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    <span class="text-sm">Like</span>
                                </button>

                                <!-- Comment Button -->
                                <button
                                    class="flex items-center space-x-2 text-gray-400 hover:text-blue-500 transition-all duration-300 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span class="text-sm">Comment</span>
                                </button>

                                <!-- Share Button -->
                                <button
                                    class="flex items-center space-x-2 text-gray-400 hover:text-green-500 transition-all duration-300 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    <span class="text-sm">Share</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="{{ url('/users') }}"
                    class="inline-flex items-center text-[#3b82f6] hover:text-[#60a5fa] transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="text-lg font-medium">Back to Users</span>
                </a>
            </div>
        </div>
    </main>

    <!-- Popup Form -->
    <div id="postFormPopup" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-[#1f2a37] rounded-2xl shadow-xl p-8 w-full max-w-md mx-8">
            <h2 class="text-2xl font-bold text-white mb-4">Add a New Post</h2>
            <form id="postForm" action="{{ route('posts.store') }}" method="POST">
                @csrf
                <!-- Post Content -->
                <textarea name="content" class="w-full p-3 rounded-lg bg-[#2a3647] text-gray-300" placeholder="What's on your mind?"
                    rows="3"></textarea>

                <!-- OR Upload Photo -->
                <div class="mt-4">
                    <label class="block text-gray-300">Upload a Photo:</label>
                    <input type="file" name="photo" class="mt-2 w-full bg-gray-700 text-gray-300 p-2 rounded-lg">
                </div>

                <button type="submit"
                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all">
                    Post
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addPostButton = document.getElementById('addPostButton');
            const postFormPopup = document.getElementById('postFormPopup');
            const cancelPostButton = document.getElementById('cancelPostButton');

            addPostButton?.addEventListener('click', function() {
                postFormPopup.classList.remove('hidden');
            });

            cancelPostButton.addEventListener('click', function() {
                postFormPopup.classList.add('hidden');
            });
        });
    </script>
</x-app-layout>
