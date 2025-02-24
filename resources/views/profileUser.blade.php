<x-app-layout>
    <main class="flex justify-center items-center min-h-screen bg-[#111826] text-white">
        <div class="max-w-4xl w-full px-6 py-10">
            <!-- Profile Header -->
            <div class="bg-[#1f2a37] rounded-2xl shadow-xl p-8 mb-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-6">
                    <!-- Profile Picture -->
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile picture" class="w-40 h-40 rounded-full object-cover border-4 border-[#1f2a37] group-hover:border-[#3b82f6] transition-all duration-300">
                        <div class="absolute bottom-2 right-2 w-4 h-4 bg-green-400 rounded-full border-2 border-[#111826] animate-pulse"></div>
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1 text-center sm:text-left">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-white">{{$user->fullname}}</h1>
                                <p class="text-gray-400 text-lg mt-1">@ {{$user->username}}</p>
                            </div>
                        </div>
                        <p class="mt-4 text-gray-300 max-w-2xl leading-relaxed">
                            {{ $user->bio ?? 'There is no bio yet.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="bg-[#1f2a37] rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <h2 class="text-2xl font-bold text-white mb-6">Profile Information</h2>

                <!-- Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-400">Full Name</h3>
                            <p class="mt-1 text-lg font-semibold text-white">{{$user->fullname}}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-400">Username</h3>
                            <p class="mt-1 text-lg font-semibold text-white">@ {{$user->username}}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-400">Email</h3>
                            <p class="mt-1 text-lg font-semibold text-white">{{$user->email}}</p>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-400">Phone</h3>
                            <p class="mt-1 text-lg font-semibold text-white">{{$user->phone ?? 'Not provided'}}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-400">Location</h3>
                            <p class="mt-1 text-lg font-semibold text-white">{{$user->location ?? 'Not specified'}}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-400">Joined</h3>
                            <p class="mt-1 text-lg font-semibold text-white">{{$user->created_at->format('M d, Y')}}</p>
                        </div>
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
</x-app-layout>