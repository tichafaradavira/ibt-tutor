<?php

namespace Modules\Courses\Services;


use Modules\Courses\Repositories\CourseRepository;
use Modules\Users\Models\User;
use Modules\Users\Repositories\LessonRepository;
use Modules\Users\Repositories\TuitionRepository;
use Modules\Users\Repositories\TutorRepository;
use Modules\Users\Repositories\UserRepository;

class TuitionService
{
    protected $repository;
    protected $course_repository;

    function __construct(TuitionRepository $repository, CourseRepository $course_repository)
    {
        $this->repository = $repository;
        $this->course_repository = $course_repository;
    }

    function browseCourses($inputs)
    {
        $courses = $this->repository->browseCourses($inputs);
        if ($courses) {
            return $courses;
        } else {
            return 'No Course found';
        }


    }

    function browseCourseLessons($inputs, $course_id)
    {
        $course = $this->course_repository->getPlainCourse($course_id);

        if ($course) {
            $course_lessons = $this->repository->browseCourseLessons($inputs, $course);
//            $completed_lessons = $this->repository->getCompletedLessons($course);

//            $course_lessons = [
//                'lessons' => $lessons,
//                'completed_lessons' => $completed_lessons];

            return $course_lessons;
        } else {
            return 'No Course found';
        }
    }


    function edit($inputs, $lesson_id, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $lesson = $this->repository->edit($inputs, $lesson_id, $course);
            return $lesson;
        } else {
            return 'Course Not found';
        }

    }

    function getCourse( $course_id)
    {
        $course = $this->course_repository->getStudentCourse($course_id);
        if ($course) {
            return $course;
        } else {
            return 'Course not found';
        }
    }

    function read($lesson_id, $course_id)
    {
        $course = $this->course_repository->getPlainCourse($course_id);
        if ($course) {
            $lesson = $this->repository->read($lesson_id, $course);
            return $lesson;
        } else {
            return 'Course Not found';
        }
    }

    function complete($lesson_id, $course_id)
    {
        $course = $this->course_repository->getPlainCourse($course_id);
        if ($course) {
            $result = $this->repository->complete($lesson_id, $course);
            return $result;
        } else {
            return 'Course Not found';
        }
    }


    function markIncomplete($lesson_id, $course_id)
    {
        $course = $this->course_repository->getPlainCourse($course_id);
        if ($course) {
            $result = $this->repository->markIncomplete($lesson_id, $course);
            return $result;
        } else {
            return 'Course Not found';
        }
    }


//    function setCompletionStatus

}
