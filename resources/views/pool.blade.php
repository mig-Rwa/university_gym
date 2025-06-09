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
        @if(session('success'))
            <div class="mb-4 bg-green-600 text-white p-2 rounded">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="mb-4 bg-red-600 text-white p-2 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('pool.book') }}" method="POST" class="mb-8 bg-gray-800 p-4 rounded-lg">
            @csrf
            <div class="flex flex-col md:flex-row md:space-x-4 items-center">
                <div class="mb-2 md:mb-0 flex-1">
                    <select name="slot_id" id="slot_id" class="w-full px-3 py-2 rounded bg-gray-700 text-white" required>
                        <option value="">Select Pool Slot</option>
                    </select>
                </div>
                <div class="mb-2 md:mb-0 flex-1">
                    <input type="date" name="date" id="date" class="w-full px-3 py-2 rounded bg-gray-700 text-white" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>
            <div id="slotDetails" class="text-gray-300 text-sm mt-2"></div>
            <button type="submit" class="mt-3 bg-uni-red hover:bg-red-700 text-white font-semibold px-6 py-2 rounded transition">Book Pool Session</button>
        </form>
        <script>
            window.poolSlotsData = @json($slots);
            window.userPoolBookings = @json($poolBookings);
        </script>
        <script src="{{ asset('js/booking_slots.js') }}"></script>
        <div class="mb-4 text-uni-red font-semibold text-lg">Your Pool Bookings</div>
        <div class="space-y-4">
            @forelse($poolBookings as $booking)
                <div class="bg-gray-700 p-4 rounded-lg flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="font-semibold text-lg text-white">{{ $booking->session_name }}</div>
                        <div class="text-gray-400">Date: {{ $booking->date }}</div>
                        <div class="text-gray-400">Time: {{ $booking->start_time }} - {{ $booking->end_time }}</div>
                        <div class="text-gray-400">Price: ${{ number_format($booking->price, 2) }}</div>
                        @if(empty($booking->paid) || !$booking->paid)
                            <a href="{{ route('stripe.pay', ['type'=>'pool', 'id'=>$booking->id]) }}" class="inline-block mt-2 bg-uni-red hover:bg-red-700 text-white px-4 py-2 rounded font-semibold transition">Pay Now</a>
                        @else
                            <span class="inline-block mt-2 text-green-400 font-semibold">Paid</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-gray-400">You have no pool bookings yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
