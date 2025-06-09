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
    Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships.index');
    Route::post('/memberships/purchase/{id}', [MembershipController::class, 'purchase'])->name('memberships.purchase');
    Route::get('/pool-sessions', function () {
        return view('pool');
    })->name('pool.index');
    Route::get('/court-bookings', function () {
        return view('courts');
    })->name('courts.index');
    Route::get('/payment-history', function () {
        return view('payments');
    })->name('payments.history');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



