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

                <form method="POST" action="{{ route('memberships.purchase', $membership->id) }}" class="mt-4">
                    @csrf
                    <button 
                        type="submit" 
                        class="px-4 py-2 rounded 
                            {{ in_array($membership->id, $purchasedIds) ? 'bg-gray-300 text-black cursor-not-allowed opacity-70' : 'bg-blue-600 hover:bg-blue-700 text-white' }}"
                        {{ in_array($membership->id, $purchasedIds) ? 'disabled' : '' }}>
                        {{ in_array($membership->id, $purchasedIds) ? 'Purchased' : 'Purchase' }}
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
