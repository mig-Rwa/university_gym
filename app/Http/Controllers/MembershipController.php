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

    public function pay(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);
        $user = Auth::user();
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $membership->type,
                    ],
                    'unit_amount' => (int)($membership->price * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'customer_email' => $user->email,
            'success_url' => route('memberships.success', ['id' => $membership->id]) . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('memberships.index'),
        ]);
        return redirect($checkoutSession->url);
    }

    public function success(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);
        $user = Auth::user();
        $sessionId = $request->query('session_id');
        $receiptUrl = null;
        $stripePaymentId = null;
        if ($sessionId) {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if ($session && isset($session->payment_intent)) {
                $intent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
                $stripePaymentId = $intent->id;
                $receiptUrl = $intent->charges->data[0]->receipt_url ?? null;
            }
        }
        $payment = Payment::create([
            'user_id' => $user->id,
            'membership_id' => $membership->id,
            'amount' => $membership->price,
            'paid_at' => now(),
            'stripe_payment_id' => $stripePaymentId,
            'stripe_receipt_url' => $receiptUrl,
        ]);

        // Enable user's membership status only after successful payment
        $user->membership_id = $membership->id;
        $user->save();

        if ($receiptUrl) {
            \Mail::to($user->email)->send(new \App\Mail\PaymentSuccessMail($user, 'membership', $payment->id, $receiptUrl));
        }
        return redirect()->route('memberships.index')->with('success', 'Membership purchased and paid successfully!');
    }
}
