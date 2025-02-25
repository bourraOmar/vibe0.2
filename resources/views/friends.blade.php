@if ($friends->isEmpty())
    <p class="text-center text-gray-500 dark:text-gray-400">Vous n'avez pas encore d'amis.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach ($friends as $friend)
            <div class="p-4 bg-white dark:bg-gray-800 shadow-lg rounded-xl flex items-center space-x-4">
                <img class="h-12 w-12 rounded-full object-cover border dark:border-gray-600"
                     src="{{ asset('storage/' . $friend->profile_photo) }}"
                     alt="Photo de {{ $friend->fullname }}">
                <div>
                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $friend->fullname }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">@{{ $friend->username }}</p>
                </div>
                <form action="{{ route('friend.remove', $friend->id) }}" method="POST" class="ml-auto">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg dark:bg-red-700 dark:hover:bg-red-800">
                        ❌ Supprimer
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif
