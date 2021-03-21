<?php

namespace Modules\Communications\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Modules\Communications\Emails\SendStudentEmail;
use Modules\Communications\Models\Communication;
use Modules\Communications\Models\StudentMessage;
use Modules\Communications\Models\TutorMessage;
use Modules\Users\Models\Student;

class StudentMessageRepository
{
    public $user;

    function __construct()
    {
        $this->user = auth()->guard('api')->user();

    }

    public function browse($browse_inputs)
    {

        $query = StudentMessage::query()
            ->whereNull('tutor_deleted_at')
            ->where('tutor_id', $this->user->id);

        $messages = $query->paginate(15);

        return $messages;
    }

    public function studentBrowse($browse_inputs)
    {

        $query = StudentMessage::query()
            ->join('communications_message_students', 'communications_student_messages.id', '=', 'communications_message_students.message_id')
            ->where('tutor_id', $this->user->id);

        $messages = $query->paginate(15);

        return $messages;
    }


    function add($data)
    {
        if ($students = Arr::get($data, 'students')) {
            $message = new StudentMessage($data);
            $message->sender()->associate($this->user);
            $message->save();
            /**
             * Make sure a tutor messages students that are actually his
             */
            $filtered_students = $this->filterStudents($students);
            $message->reicevers()->sync($filtered_students);
            $this->sendEmails($message, $filtered_students);

            return $message;

        } else {
            return false;
        }
    }


    function read($id)
    {
        $message = StudentMessage::query()
            ->where('tutor_id', $this->user->id)
            ->where('id', $id)
            ->whereNull('tutor_deleted_at')
            ->with(['reicevers'])
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
            $message = StudentMessage::query()
                ->where('tutor_id', $this->user->id)
                ->whereIn('id', $messages)
                ->update(['tutor_deleted_at' => Carbon::now()]);
            return true;
        } else {
            return false;
        }

    }


    function sendEmails($message, $students)
    {
        foreach ($students as $student_id) {
            if($student = Student::find($student_id)){
                Mail::to($student->email)
                    ->send(new SendStudentEmail($message, $student));
            }
        }
        return;
    }

    function filterStudents($data_students){
        $real_students = $this->user->student_ids;
        $filtered_ids = array_intersect($data_students,$real_students );

        return $filtered_ids;

    }


}
