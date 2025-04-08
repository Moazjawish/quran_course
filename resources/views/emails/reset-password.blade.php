@component('mail::message')
# Reset Password

Click the button below to reset your password:

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
