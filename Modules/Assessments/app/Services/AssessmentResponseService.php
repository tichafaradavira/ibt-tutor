<?php

namespace Modules\Assessments\Services;


use Modules\Assessments\Models\Assessment;
use Modules\Assessments\Models\AssessmentResponse;
use Modules\Assessments\Repositories\AssessmentRepository;
use Modules\Assessments\Repositories\AssessmentResponseRepository;
use Modules\Courses\Repositories\CourseRepository;
use Modules\Users\Models\User;

/**
 * Class AssessmentService
 * @package Modules\Assessments\Services
 */
class AssessmentResponseService
{
    protected $repository;
    protected $course_repository;

    function __construct(AssessmentResponseRepository $repository, CourseRepository $course_repository)
    {
        $this->repository = $repository;
        $this->course_repository = $course_repository;
    }

    function assessmentHistory($inputs, $course_id)
    {
        $course = $this->course_repository->getStudentCourse($course_id);

        if ($course) {
            $assessments = $this->repository->assessmentHistory($inputs, $course);
            return $assessments;
        } else {
            return 'Assessment Response Not found';
        }
    }




    /**
     * @param $inputs
     * @param $course_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|string
     */
    function attempt($inputs, $course_id, $assessment_id)
    {
        $course = $this->course_repository->getStudentCourse($course_id);

        if ($course) {
            $assessmentResponses = $this->repository->attempt($inputs, $assessment_id);
            return $assessmentResponses;
        } else {
            return 'Course Not found';
        }
    }

    /**
     * @param $inputs
     * @param $course_id
     * @return false|\Modules\Assessments\Models\Assessment|string
     */
    function save($inputs, $course_id, $assessment_id)
    {
        $course = $this->course_repository->getStudentCourse($course_id);

        if ($course) {
            $assessment = Assessment::query()->where('id',$assessment_id )
                ->first();

            $assessmentResponse = $this->repository->save($inputs, $course, $assessment);
            return $assessmentResponse;
        } else {
            return 'Course Not found';
        }

    }


    function submit($inputs, $course_id, $assessment_id)
    {
        $course = $this->course_repository->getStudentCourse($course_id);

        if ($course) {
            $assessment = Assessment::query()->where('id',$assessment_id )
                ->first();

            $assessment_response = $this->repository->submit($inputs, $course, $assessment);
            return $assessment_response;
        } else {
            return 'Course Not found';
        }

    }

    function result($inputs, $course_id, $assessment_response_id)
    {
        $course = $this->course_repository->getStudentCourse($course_id);

        if ($course) {

            $assessmentResponse = $this->repository->result($course, $assessment_response_id);
            return $assessmentResponse;
        } else {
            return 'Course Not found';
        }

    }

}
