@component('mail::message')
# Account Verification

Click the button below to change activate your Account.

@component('mail::button', ['url' => 'http://localhost:8080/login?token='.$token])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
