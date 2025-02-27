<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Friends') }}
        </h2>
    </x-slot>

    <ul class="space-y-6 px-4 py-12">
        @if ($friendRequests->isEmpty())
            <p class="text-center text-gray-500">Aucune demande d'ami en attente.</p>
        @else
            @foreach ($friendRequests as $request)
            <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <!-- User Information -->
                <div class="flex items-center space-x-4">
                    <!-- Profile Picture -->
                    <div class="relative">
                        <img class="w-12 h-12 rounded-full object-cover"
                            src="{{ asset('storage/' . $request->sender->profile_photo) }}"
                            alt="Photo de {{ $request->sender->fullname }}">
                    </div>
            
                    <!-- User Details -->
                    <div>
                        <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $request->sender->fullname }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            @ {{ $request->sender->username }}
                        </p>
                    </div>
                </div>
            
                <!-- Action Buttons -->
                <div class="flex space-x-3 mt-4 sm:mt-0">
                    <!-- Accept Button -->
                    <form action="{{ route('friend.request.accept', $request->id) }}" method="POST">
                        @csrf
                        <button
                            class="flex items-center bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition-all duration-300 
                                   dark:bg-green-700 dark:hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <span class="mr-2">✅</span>
                            <span>Accepter</span>
                        </button>
                    </form>
            
                    <!-- Reject Button -->
                    <form action="{{ route('friend.request.reject', $request->id) }}" method="POST">
                        @csrf
                        <button
                            class="flex items-center bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md transition-all duration-300 
                                   dark:bg-red-700 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <span class="mr-2">❌</span>
                            <span>Refuser</span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        @endif
    </ul>
</x-app-layout>
