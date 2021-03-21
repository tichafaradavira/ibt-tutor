<?php

namespace Modules\Assessments\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Modules\Assessments\Models\Assessment;
use Modules\Assessments\Models\AssessmentResponse;
use Modules\Assessments\Models\MCMAQuestion;
use Modules\Assessments\Models\MCSAQuestion;
use Modules\Communications\Repositories\StudentMessageRepository;
use Modules\Communications\Repositories\TutorMessageRepository;

/**
 * Class AssessmentRepository
 * @package Modules\Assessments\Repositories
 */
class AssessmentResponseRepository
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
    public function assessmentHistory($browse_inputs, $course)
    {

        $query = AssessmentResponse::query()
            ->where('course_id', $course->id)
            ->where('student_id', $this->user->id)
            ->with(['assessment']);

        $assessments = $query->paginate(15);

        return $assessments;
    }


    /**
     * @param $browse_inputs
     * @param $course
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function attempt($browse_inputs, $assessment_id)
    {
        $query = Assessment::query()
            ->where('id', $assessment_id)
            ->with(['fill_in_questions', 'mcsa_questions', 'free_response_questions', 'mcsa_questions']);
        $assessment = $query->first();

        return $assessment;
    }


    /**
     * @param $course
     * @param $assessment
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function result($course, $assessment_response_id)
    {
        $query = AssessmentResponse::query()
            ->where('course_id', $course->id)
            ->where('id', $assessment_response_id);

        $assessment_response = $query->first();

        return $assessment_response;
    }


    /**
     * @param $data
     * @param $course
     * @return false|Assessment
     */
    function save($data, $course, $assesment)
    {
        $assessment_response = new AssessmentResponse($data);
        $assessment_response->assessment()->associate($assesment);
        $assessment_response->student()->associate($this->user);
        $assessment_response->course()->associate($course);
        $assessment_response->saved_at = Carbon::now();

        $assessment_response->student_response = $data;

        if ($assessment_response->save()) {
            return $assessment_response;
        } else {
            return false;
        }


    }

    /**
     * @param $data
     * @param $course
     * @return false|Assessment
     */
    function submit($data, $course, $assesment)
    {
//        $assessment_response = AssessmentResponse::query()->where('student_id', $this->user->id)
//            ->where('course_id', $course->id)
//            ->where('assessment_id', $assesment->id)
//            ->first();
        $assessment_response = new AssessmentResponse($data);


//        if (!$assessment_response) {
//            $assessment_response = new AssessmentResponse($data);
//        }

//        if ($id = Arr::get($data, 'id')) {
//            $assessment_response = AssessmentResponse::find($id);
//        }

        $assessment_response->assessment()->associate($assesment);
        $assessment_response->student()->associate($this->user);
        $assessment_response->course()->associate($course);
        $assessment_response->submitted_at = Carbon::now();

        $result = $this->assessStudent($data);
        $assessment_response->student_response = $data;
        $assessment_response->assessment_result = $result;

        if ($assessment_response->save()) {
//            $this->setAssessedMessage($course);

            return $assessment_response;
        } else {
            return false;
        }
    }

    /**
     * @param $assessment_response
     */
    public function setAssessedMessage($course)
    {
        $message_repository = resolve(TutorMessageRepository::class);
        $message = [
            'tutor' => $course->tutor->id,
            'message' => 'Assessment submitted.'
        ];
        $message_repository->add($message);
    }

    public function assessStudent($response)
    {
        $result = [];
        foreach ($response as $question) {
            if ($question['type'] == 'mcsa') {
                $mc_question = MCSAQuestion::find($question['id']);
                $points = 0;
                $correct = false;

                if ($question['val'] == $mc_question->correct_answer) {
                    $points = $mc_question->points;
                    $correct = true;
                }

                array_push($result, [
                    'question' => $mc_question,
                    'type' => $question['type'],
                    'student_answer' => $question['val'],
                    'correct_answer' => $mc_question->correct_answer,
                    'points' => $points,
                    'comment' => $mc_question->comment,
                    'correct' => $correct,
                ]);

            }

            if ($question['type'] == 'mcma') {
                $mc_question = MCMAQuestion::find($question['id']);
                $student_responses = [];

                foreach ($question['val'] as $key => $answer) {
                    if ($question['val'][$key]) {
                        array_push($student_responses, $answer);
                    }
                }

                array_push($result, [
                    'question' => $mc_question,
                    'type' => $question['type'],
                    'student_answer' => $student_responses,
                    'correct_answers' => $mc_question->correct_answers,
                    'comment' => $mc_question->comment,

                ]);

            }
        }

        return $result;

    }


}
