<?php

namespace Modules\Courses\Repositories;

use Illuminate\Support\Arr;
use Modules\Courses\Models\Course;

class CourseRepository
{
    public $user;

    function __construct()
    {
        $this->user = auth()->guard('api')->user();

    }

    public function browse($browse_inputs)
    {

        $query = Course::query()
            ->where('tutor_id', $this->user->id);

        $courses = $query->paginate(15);

        return $courses;
    }


    function add($data)
    {
        $course = new Course($data);
        $course->tutor()->associate($this->user);

        if ($course->save()) {
            return $course;
        } else {
            return false;
        }


    }

    function edit($data, $course)
    {
        $saved = Course::where('tutor_id', $this->user->id)
            ->where('id', $course)
            ->update($data);

        if ($saved) {
            return true;
        } else {
            return false;
        }

    }

    function read($id)
    {
        $course = Course::query()
            ->where('tutor_id', $this->user->id)
            ->where('courses.id', $id)
            ->with('students')
            ->first();

        if ($course) {
            return $course;
        } else {
            return false;
        }

    }

    function delete($course)
    {
        $course = $this->getCourse($course);

        if ($course) {
            $course->delete();
            return $course;
        } else {
            return false;
        }

    }

    function enrolCourseStudents($data, $course_id)
    {
        $course = $this->getCourse($course_id);

        $filtered_ids = $this->filterStudents($data);

        $course->students()->sync($filtered_ids);

        if ($course->save()) {
            return true;
        } else {
            return false;
        }
    }

    function getCourse($id)
    {
        $course = Course::query()
            ->where('tutor_id', $this->user->id)
            ->where('courses.id', $id)
            ->first();

        return $course;
    }

    function getPlainCourse($id)
    {
        $course = Course::query()
            ->where('courses.id', $id)
            ->with('lessons')
            ->first();

        return $course;
    }

    function getStudentCourse($id)
    {
        $course = Course::query()
            ->where('courses.id', $id)
            ->first();

        return $course;
    }

    /*
     * Make sure the students reiceved belong to the user.
     */
    function filterStudents($data_students){
        $real_students = $this->user->student_ids;
        $filtered_ids = array_intersect($data_students,$real_students );

        return $filtered_ids;

    }



}
