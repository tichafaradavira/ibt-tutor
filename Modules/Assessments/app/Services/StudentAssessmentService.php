<?php

namespace Modules\Assessments\Services;


use Modules\Assessments\Repositories\StudentAssessmentRepository;
use Modules\Courses\Repositories\CourseRepository;
use Modules\Users\Models\User;

/**
 * Class AssessmentService
 * @package Modules\Assessments\Services
 */
class StudentAssessmentService
{
    protected $repository;
    protected $course_repository;

    function __construct(StudentAssessmentRepository $repository, CourseRepository $course_repository)
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
        $course = $this->course_repository->getPlainCourse($course_id);

        if ($course) {
            $assessments = $this->repository->browse($inputs, $course);
            return $assessments;
        } else {
            return 'Course Not found';
        }
    }


}
