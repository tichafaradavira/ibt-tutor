<?php

namespace Modules\Courses\Services;


use Modules\Courses\Repositories\CourseRepository;
use Modules\Users\Models\User;
use Modules\Users\Repositories\LessonRepository;
use Modules\Users\Repositories\TutorRepository;
use Modules\Users\Repositories\UserRepository;

class LessonService
{
    protected $repository;
    protected $course_repository;

    function __construct(LessonRepository $repository, CourseRepository $course_repository)
    {
        $this->repository = $repository;
        $this->course_repository = $course_repository;
    }

    function browse($inputs, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $lessons = $this->repository->browse($inputs, $course);
            return $lessons;
        } else {
            return 'Course Not found';
        }


    }

    function add($inputs, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $lesson = $this->repository->add($inputs, $course);
            return $lesson;
        } else {
            return 'Course Not found';
        }

    }


    function edit($inputs, $lesson_id, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $lesson = $this->repository->edit($inputs, $course, $lesson_id);
            return $lesson;
        } else {
            return 'Course Not found';
        }

    }

    function read($lesson_id, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);
        if ($course) {
            $lesson = $this->repository->read($lesson_id,  $course);
            return $lesson;
        } else {
            return 'Course Not found';
        }
    }


    function delete($lesson_id, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $lesson = $this->repository->delete($lesson_id, $course);
            return $lesson;
        } else {
            return 'Course Not found';

        }

    }

}
