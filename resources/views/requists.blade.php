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

        @foreach ($friendRequests as $request)
            <div class="p-4 bg-white shadow rounded-lg flex justify-between">
                <p>{{ $request->sender->fullname }} veut être votre ami.</p>
                <div>
                    <form action="{{ route('friend.request.accept', $request->id) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg">Accepter</button>
                    </form>

                    <form action="{{ route('friend.request.reject', $request->id) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-red-500 text-white px-4 py-2 rounded-lg">Refuser</button>
                    </form>
                </div>
            </div>
        @endforeach

    </ul>
</x-app-layout>
