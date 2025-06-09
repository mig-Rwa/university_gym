@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 text-white py-12">
    <div class="w-full max-w-md bg-gray-900 rounded-xl shadow-lg p-8">
        <div class="flex items-center mb-6">
            <span class="inline-flex items-center justify-center w-12 h-12 bg-uni-red rounded-full mr-4">
                <!-- Court Icon SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-7 h-7 text-white">
                  <rect x="4" y="4" width="16" height="16" rx="2" stroke-width="2" stroke="currentColor" fill="none" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16M4 12h16" />
                </svg>
            </span>
            <h2 class="text-2xl font-bold">Court Bookings</h2>
            <span class="ml-auto text-uni-red font-semibold text-sm">Court Bookings</span>
        </div>
        <div class="space-y-4">
            <div class="bg-gray-900 border border-uni-red rounded-lg p-4 mb-2">
                <div class="font-bold text-uni-red">Basketball Court</div>
                <div class="text-gray-300 text-sm mb-2">Date: April 10, 2024</div>
                <button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-5 py-2 rounded transition">Book</button>
            </div>
            <div class="bg-gray-900 border border-uni-red rounded-lg p-4 mb-2">
                <div class="font-bold text-uni-red">Tennis Court</div>
                <div class="text-gray-300 text-sm mb-2">Date: April 15, 2024</div>
                <button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-5 py-2 rounded transition">Book</button>
            </div>
            <div class="bg-gray-900 border border-uni-red rounded-lg p-4 mb-2">
                <div class="font-bold text-uni-red">Football Pitch</div>
                <div class="text-gray-300 text-sm mb-2">Date: April 20, 2024</div>
                <button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-5 py-2 rounded transition">Book</button>
            </div>
        </div>
    </div>
</div>
@endsection
