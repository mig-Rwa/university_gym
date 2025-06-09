<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pool_bookings', function (Blueprint $table) {
            $table->string('stripe_payment_id')->nullable();
            $table->string('stripe_receipt_url')->nullable();
        });
        Schema::table('court_bookings', function (Blueprint $table) {
            $table->string('stripe_payment_id')->nullable();
            $table->string('stripe_receipt_url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pool_bookings', function (Blueprint $table) {
            $table->dropColumn(['stripe_payment_id', 'stripe_receipt_url']);
        });
        Schema::table('court_bookings', function (Blueprint $table) {
            $table->dropColumn(['stripe_payment_id', 'stripe_receipt_url']);
        });
    }
};
