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
        <form action="{{ route('courts.book') }}" method="POST" class="mb-8 bg-gray-800 p-4 rounded-lg">
            @csrf
            <div class="flex flex-col md:flex-row md:space-x-4 items-center">
                <div class="mb-2 md:mb-0 flex-1">
                    <select name="slot_id" id="court_slot_id" class="w-full px-3 py-2 rounded bg-gray-700 text-white" required>
                        <option value="">Select Court</option>
                    </select>
                </div>
                <div class="flex-1">
                    <input type="date" name="date" id="court_date" class="w-full px-3 py-2 rounded bg-gray-700 text-white" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>
            <div id="courtSlotDetails" class="text-gray-300 text-sm mt-2"></div>
        <script>
            window.courtSlotsData = @json($slots);
            window.userCourtBookings = @json($courtBookings);
        </script>
        <script src="{{ asset('js/booking_slots.js') }}"></script>
            <button type="submit" class="mt-3 bg-uni-red hover:bg-red-700 text-white font-semibold px-6 py-2 rounded transition">Book Court</button>
        </form>
        <div class="space-y-4">
            @forelse($courtBookings as $booking)
                <div class="bg-gray-700 p-4 rounded-lg flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="font-semibold text-lg text-white">{{ $booking->court_name }}</div>
                        <div class="text-gray-400">Date: {{ $booking->date }}</div>
                        <div class="text-gray-400">Time: {{ $booking->start_time }} - {{ $booking->end_time }}</div>
                        <div class="text-gray-400">Price: ${{ number_format($booking->price, 2) }}</div>
                        @if(empty($booking->paid) || !$booking->paid)
                            <a href="{{ route('stripe.pay', ['type'=>'court', 'id'=>$booking->id]) }}" class="inline-block mt-2 bg-uni-red hover:bg-red-700 text-white px-4 py-2 rounded font-semibold transition">Pay Now</a>
                        @else
                            <span class="inline-block mt-2 text-green-400 font-semibold">Paid</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-gray-400">You have no court bookings yet.</div>
            @endforelse
        </div>
        </div>
    </div>
</div>
@endsection
