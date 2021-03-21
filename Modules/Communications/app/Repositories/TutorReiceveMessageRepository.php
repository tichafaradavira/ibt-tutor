<?php

namespace Modules\Communications\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Communications\Models\TutorMessage;

class TutorReiceveMessageRepository
{
    public $user;

    function __construct()
    {
        $this->user = auth()->guard('api')->user();
    }

    /**
     * @param $browse_inputs
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function browse($browse_inputs)
    {

        $query = TutorMessage::query()
            ->where('communications_tutor_messages.tutor_id', $this->user->id)
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
        if ($result = $this->markAsRead($id)) {
            $message = TutorMessage::query()
                ->where('communications_tutor_messages.id', $id)
                ->where('communications_tutor_messages.tutor_id', $this->user->id)
                ->first();
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
            return DB::table('communications_tutor_messages')
                ->whereIn('id', $messages)
                ->where('tutor_id', $this->user->id)
                ->update(['tutor_deleted_at' => Carbon::now()]);
        } else {
            return false;
        }

    }

    /**
     * @param $message
     * @return int
     */
    function markAsRead($message_id)
    {
        return DB::table('communications_tutor_messages')
            ->where('id', $message_id)
            ->where('tutor_id', $this->user->id)
            ->update(['read_at' => Carbon::now()]);
    }

    /**
     * @param $message
     * @return int
     */
    function markAsUnRead($message)
    {
        return DB::table('communications_tutor_messages')
            ->where('message_id', $message->id)
            ->where('tutor_id', $this->user->id)
            ->update(['read_at' => null]);
    }


}
