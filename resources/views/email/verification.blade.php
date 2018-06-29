@component('mail::message')
# Click the Link To Verify Your Email

Click the following link to verify your email

@component('mail::button', ['url' => url('/verifyemail/'.$email_token)])
Verify Email
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent