<div class="max-w-4xl my-10 p-6 bg-gray-800 rounded-lg shadow-lg border border-gray-700">
    <!-- Form Title -->
    <h1 class="text-2xl font-bold text-gray-100 mb-6">Edit Post</h1>

    <!-- Form -->
    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Content Field -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-300">Content</label>
            <textarea
                name="content"
                id="content"
                rows="6"
                class="mt-1 block w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Enter your post content"
            >{{ $post->content }}</textarea>
        </div>

        <!-- Image Field -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-300">Change Image</label>
            <input
                type="file"
                name="image"
                id="image"
                class="mt-1 block w-full text-sm text-gray-100 bg-gray-700 border border-gray-600 rounded-lg cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
            @if ($post->image)
                <div class="mt-4">
                    <img src="{{ asset($post->image) }}" alt="Current Post Image" class="rounded-lg shadow-sm w-40 h-40 object-cover">
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Update Post
            </button>
        </div>
    </form>
</div>


