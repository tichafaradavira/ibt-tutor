<?php

namespace Modules\Assessments\Services;


use Modules\Assessments\Repositories\TutorAssessmentResponseRepository;
use Modules\Courses\Repositories\CourseRepository;
use Modules\Users\Models\User;

/**
 * Class AssessmentService
 * @package Modules\Assessments\Services
 */
class TutorAssessmentResponseService
{
    protected $repository;
    protected $course_repository;

    function __construct(TutorAssessmentResponseRepository $repository, CourseRepository $course_repository)
    {
        $this->repository = $repository;
        $this->course_repository = $course_repository;
    }

    function studentAssessmentResponses($inputs, $course_id, $assessment_id)
    {
        $course = $this->course_repository->getStudentCourse($course_id);

        if ($course) {
            $assessments = $this->repository->studentAssessmentResponses($inputs, $course, $assessment_id);
            return $assessments;
        } else {
            return 'Assessment Response Not found';
        }
    }

    /**
     * @param $inputs
     * @param $course_id
     * @param $assessment_id
     * @return string
     */
    function assess($inputs, $course_id, $assessment_response_id)
    {
        $course = $this->course_repository->getStudentCourse($course_id);

        if ($course) {
            $assessmentResponses = $this->repository->assess($inputs, $course , $assessment_response_id);
            return $assessmentResponses;
        } else {
            return 'Course Not found';
        }
    }



}
