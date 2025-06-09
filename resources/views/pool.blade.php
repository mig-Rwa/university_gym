@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 text-white py-12">
    <div class="w-full max-w-md bg-gray-900 rounded-xl shadow-lg p-8">
        <div class="flex items-center mb-6">
            <span class="inline-flex items-center justify-center w-12 h-12 bg-uni-red rounded-full mr-4">
                <!-- Pool Icon SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-7 h-7 text-white">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18c.978 0 1.955-.244 2.933-.733C7.911 16.244 8.889 16 9.867 16c.978 0 1.955.244 2.933.733C13.911 17.756 14.889 18 15.867 18c.978 0 1.955-.244 2.933-.733C19.911 16.244 20.889 16 21.867 16" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12c.978 0 1.955-.244 2.933-.733C7.911 10.244 8.889 10 9.867 10c.978 0 1.955.244 2.933.733C13.911 11.756 14.889 12 15.867 12c.978 0 1.955-.244 2.933-.733C19.911 10.244 20.889 10 21.867 10" />
                </svg>
            </span>
            <h2 class="text-2xl font-bold">Pool Sessions</h2>
        </div>
        <div class="mb-4 text-uni-red font-semibold text-lg">Available Pool Sessions</div>
        <div class="space-y-4">
            <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-between">
                <div>
                    <div class="font-bold text-white">Early Morning</div>
                    <div class="text-uni-red font-semibold">$10.00</div>
                    <div class="text-gray-400 text-sm">Duration: 6:00 AM - 8:00 AM</div>
                </div>
                <button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-5 py-2 rounded transition">Book</button>
            </div>
            <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-between">
                <div>
                    <div class="font-bold text-white">Afternoon</div>
                    <div class="text-uni-red font-semibold">$15.00</div>
                    <div class="text-gray-400 text-sm">Duration: 1:00 PM - 3:00 PM</div>
                </div>
                <button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-5 py-2 rounded transition">Book</button>
            </div>
            <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-between">
                <div>
                    <div class="font-bold text-white">Evening</div>
                    <div class="text-uni-red font-semibold">$20.00</div>
                    <div class="text-gray-400 text-sm">Duration: 6:00 PM - 8:00 PM</div>
                </div>
                <button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-5 py-2 rounded transition">Book</button>
            </div>
        </div>
    </div>
</div>
@endsection
