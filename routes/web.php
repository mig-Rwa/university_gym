<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembershipController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $current = null;
    if ($user) {
        $payment = $user->payments()->latest('paid_at')->first();
        if ($payment) {
            $current = \App\Models\Membership::find($payment->membership_id);
        }
    }
    return view('dashboard', compact('current'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/pay', [\App\Http\Controllers\StripePaymentController::class, 'pay'])->name('stripe.pay');
    Route::get('/pay/success', [\App\Http\Controllers\StripePaymentController::class, 'success'])->name('stripe.success');
    Route::get('/pay/cancel', [\App\Http\Controllers\StripePaymentController::class, 'cancel'])->name('stripe.cancel');
    Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships.index');
    Route::get('/memberships/pay/{id}', [MembershipController::class, 'pay'])->name('memberships.pay');
    Route::get('/memberships/success/{id}', [MembershipController::class, 'success'])->name('memberships.success');
    Route::post('/memberships/purchase/{id}', [MembershipController::class, 'purchase'])->name('memberships.purchase');
    Route::get('/pool-sessions', [\App\Http\Controllers\PoolBookingController::class, 'index'])->name('pool.index');
    Route::post('/pool-sessions/book', [\App\Http\Controllers\PoolBookingController::class, 'store'])->name('pool.book');
    Route::get('/court-bookings', [\App\Http\Controllers\CourtBookingController::class, 'index'])->name('courts.index');
    Route::post('/court-bookings/book', [\App\Http\Controllers\CourtBookingController::class, 'store'])->name('courts.book');
    Route::get('/payment-history', [\App\Http\Controllers\PaymentController::class, 'index'])->name('payments.history');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



