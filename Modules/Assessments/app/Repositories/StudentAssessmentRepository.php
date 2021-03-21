<?php

namespace Modules\Assessments\Repositories;

use Illuminate\Support\Arr;
use Modules\Assessments\Models\Assessment;

/**
 * Class AssessmentRepository
 * @package Modules\Assessments\Repositories
 */
class StudentAssessmentRepository
{
    protected $user;
    protected $questions_repository;

    /**
     * AssessmentRepository constructor.
     */
    function __construct(QuestionRepository $questions_repository)
    {
        $this->user = auth()->guard('api')->user();
        $this->questions_repository = $questions_repository;

    }

    /**
     * @param $browse_inputs
     * @param $course
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function browse($browse_inputs, $course)
    {

        $query = Assessment::query()
            ->where('course_id', $course->id);

        $assessments = $query->paginate(15);

        return $assessments;
    }



}
