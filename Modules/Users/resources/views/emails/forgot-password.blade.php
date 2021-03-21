

@component('mail::message')

Dear- {{$user->first_name}}

This is an email to help you with password recovery.Click the following link to help you with recovery:
@component('mail::button', ['url' =>"http://localhost:8080/#/password/reset/".$user->recovery_token])
    Reset Password
@endcomponent


Thanks,<br>
Ibt Team
@endcomponent
