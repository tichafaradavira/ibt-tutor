<?php

namespace Modules\Courses\Services;


use Modules\Courses\Repositories\CourseRepository;
use Modules\Users\Models\Course;

class CourseService
{
    protected $repository;
    protected $user;

    function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
        $this->user = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $courses = $this->repository->browse($inputs);

        return $courses;
    }


    function add($inputs)
    {
        $courses = $this->repository->add($inputs);

        if ($courses) {
            return $courses;
        } else {
            return false;
        }
    }


    function edit($inputs, $id)
    {
        $course = $this->repository->edit($inputs, $id);

        if ($course) {
            return true;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $course = $this->repository->read($id);
            return $course;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        $course = $this->repository->delete($id);

        if ($course) {
            return $course;
        } else {
            return false;
        }
    }

    function enrolCourseStudents($inputs, $course_id)
    {
        $course = $this->repository->enrolCourseStudents($inputs, $course_id);

        if ($course) {
            return $course;
        } else {
            return false;
        }
    }


}
