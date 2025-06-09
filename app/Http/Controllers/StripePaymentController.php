<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\CourtBooking;
use App\Models\PoolBooking;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripePaymentController extends Controller
{
    // Show payment page for a booking (court or pool)
    public function pay(Request $request)
    {
        $type = $request->query('type'); // 'court' or 'pool'
        $bookingId = $request->query('id');
        $user = Auth::user();
        if ($type === 'court') {
            $booking = CourtBooking::where('id', $bookingId)->where('user_id', $user->id)->firstOrFail();
            $desc = $booking->court_name . ' ' . $booking->date . ' ' . $booking->start_time . '-' . $booking->end_time;
            $amount = $booking->price;
        } elseif ($type === 'pool') {
            $booking = PoolBooking::where('id', $bookingId)->where('user_id', $user->id)->firstOrFail();
            $desc = $booking->session_name . ' ' . $booking->date;
            $amount = $booking->price;
        } else {
            abort(404);
        }
        // Create Stripe Checkout Session
        Stripe::setApiKey(config('services.stripe.secret'));
        $checkoutSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $desc,
                    ],
                    'unit_amount' => (int)($amount * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'customer_email' => $user->email,
            'success_url' => route('stripe.success', ['type' => $type, 'id' => $bookingId]) . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel', ['type' => $type, 'id' => $bookingId]),
        ]);
        return redirect($checkoutSession->url);
    }

    // Handle successful payment
    public function success(Request $request)
    {
        $type = $request->query('type');
        $bookingId = $request->query('id');
        $sessionId = $request->query('session_id');
        $user = Auth::user();
        $receiptUrl = null;
        $stripePaymentId = null;
        if ($sessionId) {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if ($session && isset($session->payment_intent)) {
                $intent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
                $stripePaymentId = $intent->id;
                $receiptUrl = $intent->charges->data[0]->receipt_url ?? null;
            }
        }
        if ($type === 'court') {
            $booking = CourtBooking::where('id', $bookingId)->where('user_id', $user->id)->firstOrFail();
            $booking->paid = true;
            $booking->stripe_payment_id = $stripePaymentId;
            $booking->stripe_receipt_url = $receiptUrl;
            $booking->save();
        } elseif ($type === 'pool') {
            $booking = PoolBooking::where('id', $bookingId)->where('user_id', $user->id)->firstOrFail();
            $booking->paid = true;
            $booking->stripe_payment_id = $stripePaymentId;
            $booking->stripe_receipt_url = $receiptUrl;
            $booking->save();
        }
        // Send email notification
        if ($receiptUrl) {
            \Mail::to($user->email)->send(new \App\Mail\PaymentSuccessMail($user, $type, $bookingId, $receiptUrl));
        }
        Session::flash('success', 'Payment successful! Your booking is confirmed.');
        return redirect('/dashboard');
    }

    // Handle cancelled payment
    public function cancel(Request $request)
    {
        Session::flash('error', 'Payment was cancelled. Your booking is not confirmed.');
        return redirect('/dashboard');
    }
}
