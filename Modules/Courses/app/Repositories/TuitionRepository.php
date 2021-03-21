<?php

namespace Modules\Users\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;

class TuitionRepository
{
    protected $user;

    function __construct()
    {
        $this->user = auth()->guard('api-students')->user();

    }

    /**
     * @param $browse_inputs
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function browseCourses($browse_inputs)
    {

        $query = Course::query()
            ->join('student_courses', 'student_courses.course_id', '=', 'courses.id')
            ->where('student_courses.student_id', $this->user->id)
        ->with(['tutor']);

        $courses = $query->paginate(15);

        return $courses;
    }

    /**
     * @param $browse_inputs
     * @param $course
     * @return string
     */
    function browseCourseLessons($browse_inputs, $course)
    {
        if ($this->checkStudentCourseEnrollment($course)) {
            $lessons = $course->lessons;
            return $lessons;

        } else {
            return false;
        }

    }

    /**
     * @param $lesson_id
     * @param $course
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|string|null
     */
    function read($lesson_id, $course)
    {
        if ($this->checkStudentCourseEnrollment($course)) {
            $lesson = $this->getLesson($lesson_id, $course);
            return $lesson;

        } else {
            return 'Not Enrolled';
        }

    }

    /**
     * @param $lesson_id
     * @param $course
     * @return bool|string
     */
    function complete($lesson_id, $course)
    {
        if (!$this->checkCourseLesson($lesson_id, $course)) {
            return 'Invalid lesson';
        }

        if ($this->checkStudentCourseEnrollment($course)) {
            $this->user->lessons()->syncWithoutDetaching([$lesson_id]);
            return true;
        } else {
            return 'Not Enrolled';
        }

    }

    function markIncomplete($lesson_id, $course)
    {
        if (!$this->checkCourseLesson($lesson_id, $course)) {
            return 'Invalid lesson';
        }

        if ($this->checkStudentCourseEnrollment($course)) {
            $this->user->lessons()->detach($lesson_id);
            return true;
        } else {
            return 'Not Enrolled';
        }

    }

    /**
     * @param $id
     * @param $course
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    function getLesson($id, $course)
    {
        $lesson = Lesson::query()
            ->where('course_id', $course->id)
            ->where('lessons.id', $id)
            ->first();

        return $lesson;
    }

    /**
     * @param $course
     * @return bool
     */
    function checkStudentCourseEnrollment($course)
    {
        $enrollment = DB::table('student_courses')
            ->where('course_id', $course->id)
            ->where('student_id', $this->user->id)
            ->first();
        return (!!$enrollment);
    }

    /**
     * @param $lesson_id
     * @param $course
     * @return bool
     */
    function checkCourseLesson($lesson_id, $course)
    {
        $lesson = DB::table('lessons')
            ->where('course_id', $course->id)
            ->where('id', $lesson_id)
            ->first();
        return (!!$lesson);
    }

    /**
     * @param $course
     * @return array
     */
    function getCompletedLessons($course)
    {
        $course_lessons = Lesson::query()->where('course_id', $course->id)
            ->get()->pluck('id')->toArray();
        $all_completed_lessons = $this->user->completed_lessons;
        return array_intersect($course_lessons, $all_completed_lessons);
    }


}
