<?php

namespace Modules\Communications\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Communications\Models\TutorMessage;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;

class  SendTutorEmail extends Mailable
{
    use SerializesModels;

    protected $user;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TutorMessage $message)
    {
        $this->user = auth()->guard('api-students')->user();
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@ibttutor.com')
        ->with([
            'reicever' =>$this->message->reicever(),
            'message' => $this->message
        ])
        ->markdown('communications::emails.sendtutoremail');
    }
}
