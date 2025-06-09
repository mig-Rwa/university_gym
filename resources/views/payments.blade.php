@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 text-white py-12">
    <div class="w-full max-w-2xl bg-gray-900 rounded-xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center mb-8 text-uni-red">Payment History</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-lg text-white">
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">Receipt</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr class="bg-gray-900 border border-uni-red rounded-lg">
                            <td class="px-4 py-2">
                                {{ $payment->membership->type ?? 'Other Payment' }}
                                <div class="text-gray-400">Paid at: {{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('F j, Y') : '-' }}</div>
                                @if(isset($payment->stripe_receipt_url) && $payment->stripe_receipt_url)
                                    <a href="{{ $payment->stripe_receipt_url }}" target="_blank" class="inline-block mt-1 bg-blue-600 hover:bg-blue-800 text-white px-3 py-1 rounded text-xs font-semibold transition">Download Receipt</a>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($payment->paid_at)->format('F j, Y') }}
                            </td>
                            <td class="px-4 py-2 text-uni-red font-semibold">
                                ${{ number_format($payment->amount, 2) }}
                            </td>
                            <td class="px-4 py-2">
                                <button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-4 py-2 rounded transition">View</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-400">No payment history found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
