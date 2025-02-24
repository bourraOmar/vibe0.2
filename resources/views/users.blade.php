<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="p-4">
        <form class="flex gap-4 my-2" action="{{ url('/search') }}" method="GET">
            <input name="term" type="text" placeholder="Search users..."
                class="w-full pl-10 pr-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600" />
            <div>
                <input type="submit" value="Search"
                    class="w-full mx-2 px-28 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 cursor-pointer">
            </div>
        </form>
    </div>
    <ul class="space-y-6 px-4">
        @foreach ($listusers as $user)
            <li
                class="flex items-center justify-between bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('profileUser', $user->id) }}">
                        <div class="p-2">
                            <img style="width: 50px;" class="w-12 h-12 rounded-full object-cover"
                                src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo">
                        </div>
                    </a>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $user->fullname }}
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">@ {{ $user->username }}</p>
                    </div>
                </div>
                @if ($user->id != auth()->id())
                    <button
                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300">
                        Ajouter ami
                    </button>
                @endif
            </li>
        @endforeach
    </ul>
</x-app-layout>
