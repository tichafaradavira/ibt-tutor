<?php

namespace Modules\Assessments\Services;


use Modules\Assessments\Repositories\AssessmentRepository;
use Modules\Courses\Repositories\CourseRepository;
use Modules\Users\Models\User;

/**
 * Class AssessmentService
 * @package Modules\Assessments\Services
 */
class AssessmentService
{
    protected $repository;
    protected $course_repository;

    function __construct(AssessmentRepository $repository, CourseRepository $course_repository)
    {
        $this->repository = $repository;
        $this->course_repository = $course_repository;
    }




    /**
     * @param $inputs
     * @param $course_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|string
     */
    function browse($inputs, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $assessments = $this->repository->browse($inputs, $course);
            return $assessments;
        } else {
            return 'Course Not found';
        }
    }

    /**
     * @param $inputs
     * @param $course_id
     * @return false|\Modules\Assessments\Models\Assessment|string
     */
    function add($inputs, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $assessment = $this->repository->add($inputs, $course);
            return $assessment;
        } else {
            return 'Course Not found';
        }

    }


    /**
     * @param $inputs
     * @param $assessment_id
     * @param $course_id
     * @return bool|string
     */
    function edit($inputs, $questions, $assessment_id, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);
        if ($course) {
            $assessment = $this->repository->edit($inputs, $questions, $assessment_id,  $course);
            return $assessment;
        } else {
            return 'Course Not found';
        }

    }

    /**
     * @param $assessment_id
     * @param $course_id
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|string
     */
    function read($assessment_id, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);
        if ($course) {
            $assessment = $this->repository->read($assessment_id,  $course);
            return $assessment;
        } else {
            return 'Course Not found';
        }
    }


    /**
     * @param $assessment_id
     * @param $course_id
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|string
     * @throws \Exception
     */
    function delete($assessment_id, $course_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $assessment = $this->repository->delete($assessment_id, $course);
            return $assessment;
        } else {
            return 'Course Not found';

        }

    }

    function deleteQuestions($inputs, $course_id ,  $assessment_id)
    {
        $course = $this->course_repository->getCourse($course_id);

        if ($course) {
            $assessment = $this->repository->deleteQuestions($inputs, $assessment_id );
            return $assessment;
        } else {
            return 'Course Not found';

        }

    }

}
