

@component('mail::message')

Dear- {{$student->first_name}}

Please click on the button below to reset your password, if you did not request for password reset
Let us know.
@component('mail::button', ['url' =>"http://localhost:8080/#/student/password/reset/".$student->recovery_token])
    Reset Password
@endcomponent


Thanks,<br>
Ibt Team
@endcomponent
