<?php

namespace Modules\Communications\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Modules\Communications\Emails\SendTutorEmail;
use Modules\Communications\Models\Communication;
use Modules\Communications\Models\TutorMessage;
use Modules\Users\Models\User;

class TutorMessageRepository
{
    public $user;

    function __construct()
    {
        $this->user = auth()->guard('api-students')->user();

    }

    public function browse($browse_inputs)
    {

        $query = TutorMessage::query()
            ->whereNull('student_deleted_at')
            ->where('student_id', $this->user->id);

        $messages = $query->paginate(15);

        return $messages;
    }

    function add($data)
    {
        if ($id = Arr::get($data, 'tutor')) {
            $message = new TutorMessage($data);
            if($tutor = User::find($id)){
                $message->sender()->associate($this->user);
                $message->reicever()->associate($tutor);
                $message->save();
                Mail::to($message->reicever->email)
                    ->send(new SendTutorEmail($message));
            }

            return $message;

        } else {
            return false;
        }
    }


    function read($id)
    {
        $message = TutorMessage::query()
            ->where('student_id', $this->user->id)
            ->where('id', $id)
            ->whereNull('student_deleted_at')
            ->with(['reicever'])
            ->first();

        if ($message) {
            return $message;
        } else {
            return false;
        }

    }

    function delete($data)
    {
        if ($messages = Arr::get($data, 'messages')) {
            $message = TutorMessage::query()
                ->where('student_id', $this->user->id)
                ->whereIn('id', $messages)
                ->update(['student_deleted_at' => Carbon::now()]);
            return true;
        } else {
            return false;
        }

    }



}
