<?php

namespace Modules\Users\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Users\Emails\AddTutorVerifyUserEmail;
use Modules\Users\Emails\SendEmailVerifyUserEmail;
use Modules\Users\Models\User;

class LessonRepository
{
    protected $user;

    function __construct()
    {
        $this->user = auth()->guard('api')->user();

    }

    public function browse($browse_inputs, $course)
    {

        $query = Lesson::query()
            ->where('course_id', $course->id)
            ->with(['course']);

        $courses = $query->paginate(15);

        return $courses;
    }


    function add($data, $course)
    {
        $data['objectives'] = $data['objectives'];

        $data['content'] = $data['content'];

        $lesson = new Lesson($data);
        $lesson->course()->associate($course);

        if ($lesson->save()) {
            return $lesson;
        } else {
            return false;
        }


    }

    function edit($data, $course, $lesson_id)
    {
        $data['objectives'] = $data['objectives'];

        $data['content'] = $data['content'];

        $lesson = Lesson::where('course_id', $course->id)
            ->where('id', $lesson_id)
            ->update($data);

        if ($lesson) {
            $lesson = $this->getLesson($lesson_id, $course);
            return $lesson;
        } else {
            return false;
        }

    }

    function read($lesson_id, $course)
    {
        $lesson = $this->getLesson($lesson_id, $course);
        if ($lesson) {
            return $lesson;
        } else {
            return false;
        }

    }

    function delete($lesson_id, $course)
    {
        $lesson = $this->getLesson($lesson_id, $course);

        if ($lesson) {
            $lesson->delete();
            return $lesson;
        } else {
            return false;
        }

    }

    function getLesson($id, $course)
    {
        $lesson = Lesson::query()
            ->where('course_id', $course->id)
            ->where('lessons.id', $id)
            ->first();

        return $lesson;
    }


}
