<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourtBooking;

class CourtBookingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $courtBookings = $user->courtBookings()->orderByDesc('date')->get();
        $slots = \App\Models\CourtSlot::all();
        return view('courts', compact('courtBookings', 'slots'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'slot_id' => 'required|exists:court_slots,id',
            'date' => 'required|date',
        ]);
        $user = auth()->user();
        $slot = \App\Models\CourtSlot::find($request->slot_id);
        // Prevent double booking for this slot and date
        $alreadyBooked = $user->courtBookings()->where('court_name', $slot->name)->where('date', $request->date)->exists();
        if ($alreadyBooked) {
            return redirect()->route('courts.index')->withErrors(['You have already booked this court for the selected date.']);
        }
        $user->courtBookings()->create([
            'court_name' => $slot->name,
            'price' => $slot->price,
            'date' => $request->date,
            'start_time' => $slot->start_time,
            'end_time' => $slot->end_time,
        ]);
        return redirect()->route('courts.index')->with('success', 'Court booked successfully!');
    }
}
