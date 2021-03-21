<?php

namespace Modules\CornerHub\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\CornerHub\Entities\User;

class SendEmailPasswordResult extends Mailable
{
    use SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@realtorparc.com')
        ->with([
            'user' =>$this->user
        ])
        ->markdown('cornerhub::emails.resetResult');
    }
}
