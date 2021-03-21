@component('mail::message')

    Dear- {{$user->first_name}}

    Thank you for creating an account on IBT Tutor, please click the button below to verify your email address.
    @component('mail::button', ['url' =>url("/user/email/verify/{$user->id}")])
        Verify Email
    @endcomponent


    Thanks,<br>
    Ibt Team
@endcomponent
