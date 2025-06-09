<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MembershipController extends Controller
{
    public function index()
{
    $memberships = \App\Models\Membership::all();
    $user = \Illuminate\Support\Facades\Auth::user();

    // Fetch membership IDs the user has already purchased
    $purchasedIds = $user->payments->pluck('membership_id')->toArray();

    return view('memberships.index', compact('memberships', 'purchasedIds'));
}

    public function purchase($id)
    {
        $membership = Membership::findOrFail($id);
        $user = Auth::user();

        Payment::create([
            'user_id' => $user->id,
            'membership_id' => $membership->id,
            'amount' => $membership->price,
            'paid_at' => Carbon::now(),
        ]);

        return redirect()->route('memberships.index')->with('success', 'Membership purchased successfully!');
    }
}
