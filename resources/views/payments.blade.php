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
                    <tr class="bg-gray-900 border border-uni-red rounded-lg">
                        <td class="px-4 py-2">Monthly Membership</td>
                        <td class="px-4 py-2">April 2, 2024</td>
                        <td class="px-4 py-2 text-uni-red font-semibold">$29.99</td>
                        <td class="px-4 py-2"><button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-4 py-2 rounded transition">View</button></td>
                    </tr>
                    <tr class="bg-gray-900 border border-uni-red rounded-lg">
                        <td class="px-4 py-2">Tennis Court Booking</td>
                        <td class="px-4 py-2">March 25, 2024</td>
                        <td class="px-4 py-2 text-uni-red font-semibold">$25.00</td>
                        <td class="px-4 py-2"><button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-4 py-2 rounded transition">View</button></td>
                    </tr>
                    <tr class="bg-gray-900 border border-uni-red rounded-lg">
                        <td class="px-4 py-2">Quarterly Membership</td>
                        <td class="px-4 py-2">January 1, 2024</td>
                        <td class="px-4 py-2 text-uni-red font-semibold">$79.99</td>
                        <td class="px-4 py-2"><button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-4 py-2 rounded transition">View</button></td>
                    </tr>
                    <tr class="bg-gray-900 border border-uni-red rounded-lg">
                        <td class="px-4 py-2">Pool Session</td>
                        <td class="px-4 py-2">December 12, 2023</td>
                        <td class="px-4 py-2 text-uni-red font-semibold">$15.00</td>
                        <td class="px-4 py-2"><button class="bg-uni-red hover:bg-red-700 text-white font-semibold px-4 py-2 rounded transition">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
