<?php

namespace Modules\Communications\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Communications\Models\StudentMessage;
use Modules\Communications\Models\TutorMessage;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;

class  SendStudentEmail extends Mailable
{
    use SerializesModels;

    protected $reicever;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(StudentMessage $message, Student $reicever)
    {
        $this->reicever = $reicever;
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
            'reicever' =>$this->reicever,
            'message' => $this->message
        ])
        ->markdown('communications::emails.sendstudentemail');
    }
}
