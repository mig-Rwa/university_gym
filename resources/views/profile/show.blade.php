<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <div class="flex flex-col md:flex-row md:items-center md:space-x-8 mb-8">
            <!-- Profile Picture -->
            <div class="flex-shrink-0 flex flex-col items-center mb-4 md:mb-0">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&size=128" alt="Profile Picture" class="rounded-full w-32 h-32 shadow-md border-4 border-blue-100">
                <button class="mt-2 text-xs text-blue-600 hover:underline">Change Photo</button>
            </div>
            <!-- Basic Info -->
            <div class="flex-1">
                <h2 class="text-2xl font-bold mb-2">{{ Auth::user()->name }}</h2>
                <p class="text-gray-600 mb-1">{{ Auth::user()->email }}</p>
                <p class="text-gray-500 text-sm">Member since {{ Auth::user()->created_at->format('F Y') }}</p>
                <div class="mt-4 flex flex-col sm:flex-row sm:space-x-4">
                    <a href="{{ route('profile.edit') }}" class="inline-block px-4 py-2 mb-2 sm:mb-0 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Edit Profile</a>
                    <a href="{{ route('password.request') }}" class="inline-block px-4 py-2 bg-gray-200 text-blue-700 rounded-lg font-semibold hover:bg-gray-300 transition">Change Password</a>
                </div>
            </div>
        </div>

        <!-- Membership Details -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h3 class="text-lg font-bold mb-2 text-blue-700">Membership Details</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <span class="font-semibold">Type:</span> Student
                </div>
                <div>
                    <span class="font-semibold">Status:</span> Active
                </div>
                <div>
                    <span class="font-semibold">Start Date:</span> 2024-01-01
                </div>
                <div>
                    <span class="font-semibold">Expires:</span> 2025-12-31
                </div>
            </div>
            <button class="mt-4 px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 font-semibold transition">Renew Membership</button>
        </div>

        <!-- Upcoming Bookings -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h3 class="text-lg font-bold mb-2 text-blue-700">Upcoming Bookings</h3>
            <ul class="divide-y divide-gray-200">
                <li class="py-2 flex justify-between items-center">
                    <span>Basketball Court</span>
                    <span class="text-gray-500 text-sm">June 12, 14:00</span>
                </li>
                <li class="py-2 flex justify-between items-center">
                    <span>Swimming Pool</span>
                    <span class="text-gray-500 text-sm">June 15, 10:00</span>
                </li>
            </ul>
            <button class="mt-4 px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 font-semibold transition">View All Bookings</button>
        </div>

        <!-- Account Actions -->
        <div class="flex flex-col sm:flex-row sm:space-x-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">Log Out</button>
            </form>
            <a href="#" class="mt-2 sm:mt-0 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">Contact Support</a>
        </div>

        <div class="text-center text-xs text-gray-400 pt-10">&copy; {{ date('Y') }} METU NCC Sports Center. All rights reserved.</div>
    </div>
</x-app-layout>
