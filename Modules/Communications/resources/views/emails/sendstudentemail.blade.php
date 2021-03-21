

@component('mail::message')

Dear- {{$reicever->first_name}}

{{$message->sender->first_name}} sent you a message on IBT Tutor:
<br/>

{{$message->message}}

Regards,<br>
Ibt Tutor Team.
@endcomponent
