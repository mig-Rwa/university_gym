<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoolBooking;

class PoolBookingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $poolBookings = $user->poolBookings()->orderByDesc('date')->get();
        $slots = \App\Models\PoolSlot::all();
        return view('pool', compact('poolBookings', 'slots'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'slot_id' => 'required|exists:pool_slots,id',
            'date' => 'required|date',
        ]);
        $user = auth()->user();
        $slot = \App\Models\PoolSlot::find($request->slot_id);
        // Prevent double booking for this slot and date
        $alreadyBooked = $user->poolBookings()->where('session_name', $slot->name)->where('date', $request->date)->exists();
        if ($alreadyBooked) {
            return redirect()->route('pool.index')->withErrors(['You have already booked this slot for the selected date.']);
        }
        $user->poolBookings()->create([
            'session_name' => $slot->name,
            'price' => $slot->price,
            'date' => $request->date,
            'start_time' => $slot->start_time,
            'end_time' => $slot->end_time,
        ]);
        return redirect()->route('pool.index')->with('success', 'Pool session booked successfully!');
    }
}
