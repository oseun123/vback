@component('mail::message')
# Password Reset Request

Hello, kindly click the button below to reset your password.

@component('mail::button', ['url' => 'http://localhost:8080/response-password?token='.$token])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
