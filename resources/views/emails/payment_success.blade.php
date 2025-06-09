@component('mail::message')
# Payment Successful

Hi {{ $user->name }},

Your payment for your {{ $type == 'pool' ? 'pool session' : 'court booking' }} (Booking ID: {{ $bookingId }}) was successful!

@component('mail::button', ['url' => $receiptUrl])
View Stripe Receipt
@endcomponent

Thank you for booking with us!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
