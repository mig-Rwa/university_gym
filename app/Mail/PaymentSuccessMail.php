<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $type;
    public $bookingId;
    public $receiptUrl;

    public function __construct($user, $type, $bookingId, $receiptUrl)
    {
        $this->user = $user;
        $this->type = $type;
        $this->bookingId = $bookingId;
        $this->receiptUrl = $receiptUrl;
    }

    public function build()
    {
        return $this->subject('Your Gym Booking Payment was Successful')
            ->markdown('emails.payment_success');
    }
}
