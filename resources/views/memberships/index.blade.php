@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Available Memberships</h1>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($memberships as $membership)
            <div class="p-6 border rounded shadow-sm">
                <h2 class="text-xl font-semibold mb-2">{{ $membership->type }}</h2>
                <p>Price: ${{ number_format($membership->price, 2) }}</p>
                <p>Duration: {{ $membership->duration_days }} days</p>

                @php
                    $payment = auth()->user()->payments->where('membership_id', $membership->id)->sortByDesc('paid_at')->first();
                @endphp
                @if($payment && $payment->stripe_receipt_url)
                    <span class="inline-block mt-4 px-4 py-2 rounded bg-green-500 text-white">Purchased</span>
                    <a href="{{ $payment->stripe_receipt_url }}" target="_blank" class="inline-block mt-4 ml-2 bg-blue-600 hover:bg-blue-800 text-white px-3 py-1 rounded text-xs font-semibold transition">Download Receipt</a>
                @else
                    <a href="{{ route('memberships.pay', $membership->id) }}" class="inline-block mt-4 px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">Pay Now</a>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
