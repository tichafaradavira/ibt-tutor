<?php

namespace Modules\Assessments\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Modules\Assessments\Models\Assessment;
use Modules\Assessments\Models\AssessmentResponse;
use Modules\Communications\Repositories\StudentMessageRepository;

/**
 * Class AssessmentRepository
 * @package Modules\Assessments\Repositories
 */
class TutorAssessmentResponseRepository
{
    protected $user;
    protected $questions_repository;

    /**
     * AssessmentRepository constructor.
     */
    function __construct(AssessmentRepository $assessment_repository)
    {
        $this->user = auth()->guard('api-students')->user();

    }

    /**
     * @param $browse_inputs
     * @param $course
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function studentAssessmentResponses($browse_inputs, $course, $assessment_id)
    {

        $query = AssessmentResponse::query()
            ->where('course_id', $course->id)
            ->where('assessment_id', $assessment_id);

        $assessments = $query->paginate(15);

        return $assessments;
    }

    /**
     * @param $data
     * @param $course
     * @param $assessment_response_id
     * @return false
     */
    public function assess($data, $course, $assessment_response_id)
    {
        $assessment_response = AssessmentResponse::find($assessment_response_id);

        $assessment_response->assessed_at = Carbon::now();

        $assessment_response->assessment_result = json_encode($data);

        if ($assessment_response->save()) {
            $this->setAssessedMessage($assessment_response);
            return $assessment_response;
        } else {
            return false;
        }
    }


    /**
     * @param $assessment_response
     */
    public function setAssessedMessage($assessment_response)
    {
        $message_repository = resolve(StudentMessageRepository::class);
        $message = [
            'students' => [$assessment_response->student->id],
            'message' => 'The assessment has been assessed.'
        ];
        $message_repository->add($message);
    }


}
