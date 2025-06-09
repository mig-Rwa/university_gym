@extends('layouts.app')

@section('content')
<div class="min-h-screen flex bg-gray-100 dark:bg-gray-900">
    {{-- Sidebar --}}
    @php
        $items = [
            ['label' => 'Memberships', 'url' => route('memberships.index'), 'active' => 'memberships.index'],
            ['label' => 'Pool Sessions', 'url' => route('pool.index'), 'active' => 'pool.index'],
            ['label' => 'Court Bookings', 'url' => route('courts.index'), 'active' => 'courts.index'],
            ['label' => 'Payment History', 'url' => route('payments.history'), 'active' => 'payments.history'],
        ];
    @endphp
    @include('components.sidebar', ['items' => $items])

    {{-- Main Content --}}
    <div class="flex-1 p-8">
        <div class="flex flex-col md:flex-row md:justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Dashboard</h1>
            <div class="text-lg text-gray-600 dark:text-gray-300">Welcome, {{ auth()->user()->name }}</div>
        </div>

        {{-- Current Membership Card --}}
        @if(isset($current))
        <div class="bg-uni-red text-white rounded-2xl p-8 max-w-md mb-8">
            <h2 class="text-2xl font-bold mb-2">Current Membership</h2>
            <div class="text-3xl font-extrabold mb-2">{{ $current->name ?? $current->type }} - {{ $current->duration_days }} days</div>
            <div class="text-lg font-semibold mb-1">${{ number_format($current->price, 2) }}</div>
        </div>
        @endif

        <div class="flex flex-col md:flex-row gap-4 max-w-2xl">
            <div class="flex-1 bg-gray-900 text-white rounded-xl p-6">
                <div class="font-semibold text-lg mb-2">Current Pool Booking</div>
                <div class="text-md">None</div>
            </div>
            <div class="flex-1 bg-gray-900 text-white rounded-xl p-6">
                <div class="font-semibold text-lg mb-2">Current Court Booking</div>
                <div class="text-md">None</div>
            </div>
        </div>
    </div>
</div>
@endsection
