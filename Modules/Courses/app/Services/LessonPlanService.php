<?php

namespace Modules\Courses\Services;


use Modules\Courses\Repositories\CourseRepository;
use Modules\Users\Models\User;
use Modules\Users\Repositories\LessonPlanRepository;
use Modules\Users\Repositories\LessonRepository;
use Modules\Users\Repositories\TutorRepository;
use Modules\Users\Repositories\UserRepository;

class LessonPlanService
{
    protected $repository;
    protected $course_repository;
    protected $lesson_repository;

    function __construct(LessonPlanRepository  $repository, CourseRepository $course_repository, LessonRepository $lesson_repository )
    {
        $this->repository = $repository;
        $this->course_repository = $course_repository;
        $this->lesson_repository = $lesson_repository;
    }

    function browse($inputs, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $lessonPlans = $this->repository->browse($inputs, $course);

            return $lessonPlans;
        } else {
            return 'Course Not found';
        }


    }

    function add($inputs, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $lessonPlan = $this->repository->add($inputs, $course);
            return $lessonPlan;
        } else {
            return 'Course Not found';
        }

    }


    function edit($inputs, $course_id, $lesson_plan_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $lesson = $this->repository->edit($inputs,  $lesson_plan_id, $course);
            return $lesson;
        } else {
            return 'Course Not found';
        }

    }

    function read( $course_id, $lesson_plan_id)
    {
        $course = $this->course_repository->getCourse($course_id);
        if ($course) {
            $lessonPlan = $this->repository->read( $lesson_plan_id, $course);
            return $lessonPlan;
        } else {
            return 'Course Not found';
        }
    }


    function delete( $course_id, $lesson_plan_id)
    {
        $course = $this->course_repository->getCourse($course_id);
        if ($course) {
            $lessonPlan = $this->repository->delete( $lesson_plan_id, $course);
            return $lessonPlan;
        } else {
            return 'Course Not found';
        }
    }

}
