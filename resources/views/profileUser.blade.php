<x-app-layout>
    <main class="flex justify-center items-center min-h-screen bg-[#111826] text-white">
        <div class="max-w-4xl w-full px-6 py-10">
            <!-- Profile Header -->
            <div class="bg-[#1f2a37] rounded-2xl shadow-xl p-8 mb-8">
                <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-6">
                    <!-- Profile Picture -->
                    <div class="relative">
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile picture" class="w-40 h-40 rounded-full object-cover border-4 border-[#1f2a37]">
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1 text-center sm:text-left">
                        <h1 class="text-3xl font-bold text-white">{{$user->fullname}}</h1>
                        <p class="text-gray-400 text-lg mt-1">@ {{$user->username}}</p>
                        <p class="text-gray-400 text-lg mt-1">500 Friends</p>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- About Section -->
                <div class="bg-[#1f2a37] rounded-2xl shadow-xl p-6">
                    <h2 class="text-2xl font-bold text-white mb-4">bio</h2>
                    <p class="text-gray-300">
                        {{ $user->bio ?? 'There is no bio yet.' }}
                    </p>
                </div>

                <!-- Posts Section -->
                <div class="col-span-2 bg-[#1f2a37] rounded-2xl shadow-xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-white">Posts</h2>
                        <button id="addPostButton" class="bg-[#3b82f6] text-white px-4 py-2 rounded-lg hover:bg-[#60a5fa] transition-all duration-300">
                            Add Post
                        </button>
                    </div>
                    <!-- Existing Posts -->
                    <div class="bg-[#2a3647] rounded-lg p-4 mb-4">
                        <p class="text-gray-300">Hello, this is a sample post!</p>
                        <p class="text-gray-500 text-sm mt-2">2 hours ago</p>
                    </div>
                    <div class="bg-[#2a3647] rounded-lg p-4 mb-4">
                        <p class="text-gray-300">Another post here. Enjoy the dark theme!</p>
                        <p class="text-gray-500 text-sm mt-2">5 hours ago</p>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="{{ url('/users') }}" class="inline-flex items-center text-[#3b82f6] hover:text-[#60a5fa] transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
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
            <form id="postForm">
                <div class="mb-4">
                    <label for="postContent" class="block text-gray-300 text-sm font-medium mb-2">Content</label>
                    <textarea id="postContent" name="content" rows="4" class="w-full bg-[#2a3647] text-white rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#3b82f6]" placeholder="Write your post here..."></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" id="cancelPostButton" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all duration-300">
                        Cancel
                    </button>
                    <button type="submit" class="bg-[#3b82f6] text-white px-4 py-2 rounded-lg hover:bg-[#60a5fa] transition-all duration-300">
                        Post
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addPostButton = document.getElementById('addPostButton');
            const postFormPopup = document.getElementById('postFormPopup');
            const cancelPostButton = document.getElementById('cancelPostButton');
            const postForm = document.getElementById('postForm');

            // Show the popup form when the "Add Post" button is clicked
            addPostButton.addEventListener('click', function() {
                postFormPopup.classList.remove('hidden');
            });

            // Hide the popup form when the "Cancel" button is clicked
            cancelPostButton.addEventListener('click', function() {
                postFormPopup.classList.add('hidden');
            });

            // Handle form submission
            postForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const postContent = document.getElementById('postContent').value;

                // Here you can handle the form submission, e.g., send the data to the server
                console.log('Post Content:', postContent);

                // Clear the form and hide the popup
                postForm.reset();
                postFormPopup.classList.add('hidden');
            });
        });
    </script>

    <style>
        #postFormPopup {
            transition: opacity 0.3s ease-in-out;
        }
        #postFormPopup.hidden {
            opacity: 0;
            pointer-events: none;
        }
    </style>
</x-app-layout>