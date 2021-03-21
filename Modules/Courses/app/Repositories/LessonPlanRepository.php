<?php

namespace Modules\Users\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Courses\Models\LessonPlan;
use Modules\Users\Emails\AddTutorVerifyUserEmail;
use Modules\Users\Emails\SendEmailVerifyUserEmail;
use Modules\Users\Models\User;

class LessonPlanRepository
{
    protected $user;

    function __construct()
    {
        $this->user = auth()->guard('api')->user();

    }

    public function browse($browse_inputs, $course)
    {

        $query = LessonPlan::query()
            ->where('lesson_plans.course_id', $course->id)
            ->with(['course']);

        $plans = $query->paginate(15);

        return $plans;
    }


    function add($data, $course)
    {
        $data['objectives'] = $data['objectives'];
        $data['lesson_at'] = Carbon::parse($data['lesson_at']);

        if ($study_material = Arr::get($data, 'study_material')) {
            $data['study_material'] = $data['study_material'];
        }

        if ($activities = Arr::get($data, 'activities')) {
            $data['activities'] = $data['activities'];
        }

        if ($learning_aids = Arr::get($data, 'learning_aids')) {
            $data['learning_aids'] = $data['learning_aids'];
        }

        if ($lesson_outcomes = Arr::get($data, 'lesson_outcomes')) {
            $data['lesson_outcomes'] = $data['lesson_outcomes'];
        }

        $lessonPLan = new LessonPlan($data);
        $lessonPLan->course()->associate($course);

        if ($lessonPLan->save()) {
            return $lessonPLan;
        } else {
            return false;
        }


    }

    function edit($data, $lesson_plan_id, $course)
    {
        $data['lesson_at'] = Carbon::parse($data['lesson_at']);
        $data['objectives'] = $data['objectives'];

        if (Arr::get($data, 'course')) {
            Arr::forget($data, 'course');
        }

        if ($study_material = Arr::get($data, 'study_material')) {
            $data['study_material'] = $data['study_material'];
        }

        if ($activities = Arr::get($data, 'activities')) {
            $data['activities'] = $data['activities'];
        }

        if ($learning_aids = Arr::get($data, 'learning_aids')) {
            $data['learning_aids'] = $data['learning_aids'];
        }

        if ($lesson_outcomes = Arr::get($data, 'lesson_outcomes')) {
            $data['lesson_outcomes'] = $data['lesson_outcomes'];
        }


        $saved = LessonPlan::where('course_id', $course->id)
            ->where('id', $lesson_plan_id)
            ->update($data);

        if ($saved) {
            return true;
        } else {
            return false;
        }

    }

    function read($lesson_plan_id, $course)
    {
        $lessonPlan = LessonPlan::query()
            ->where('course_id', $course->id)
            ->where('lesson_plans.id', $lesson_plan_id)
            ->first();

        if ($lessonPlan) {
            return $lessonPlan;
        } else {
            return false;
        }

    }

    function delete($lesson_plan_id, $course)
    {
        $lessonPlan = LessonPlan::query()
            ->where('course_id', $course->id)
            ->where('lesson_plans.id', $lesson_plan_id)
            ->first();

        if ($lessonPlan) {
            $lessonPlan->delete();
            return $lessonPlan;
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
