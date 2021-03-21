<?php

namespace Modules\Communications\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Communications\Models\StudentMessage;

class StudentReiceveMessageRepository
{
    public $user;

    function __construct()
    {
        $this->user = auth()->guard('api-students')->user();

    }


    public function browse($browse_inputs)
    {

        $query = StudentMessage::query()
            ->join('communications_message_students', 'communications_student_messages.id', '=', 'communications_message_students.message_id')
            ->where('communications_message_students.student_id', $this->user->id)
            ->with(['sender']);

        $messages = $query->paginate(15);

        return $messages;
    }

    /**
     * @param $id
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    function read($id)
    {
        $message = StudentMessage::query()
            ->where('communications_student_messages.id', $id)
            ->join('communications_message_students', 'communications_student_messages.id', '=', 'communications_message_students.message_id')
            ->where('communications_message_students.student_id', $this->user->id)
            ->with(['reicever'])
            ->first();

        if ($result = $this->markAsRead($message)) {
            return $message;
        } else {
            return false;
        }

    }

    /**
     * @param $data
     * @return bool
     */
    function delete($data)
    {
        if ($messages = Arr::get($data, 'messages')) {
            $this->user->messages()->detach($messages);
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $message
     * @return int
     */
    function markAsRead($message)
    {
        return DB::table('communications_message_students')
            ->where('message_id', $message->id)
            ->where('student_id', $this->user->id)
            ->update(['read_at' => Carbon::now()]);
    }

    /**
     * @param $message
     * @return int
     */
    function markAsUnRead($message)
    {
        return DB::table('communications_message_students')
            ->where('message_id', $message->id)
            ->where('student_id', $this->user->id)
            ->update(['read_at' => null]);
    }


}
