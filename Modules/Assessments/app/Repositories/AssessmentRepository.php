<?php

namespace Modules\Assessments\Repositories;

use Illuminate\Support\Arr;
use Modules\Assessments\Models\Assessment;

/**
 * Class AssessmentRepository
 * @package Modules\Assessments\Repositories
 */
class AssessmentRepository
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
            ->where('course_id', $course->id)
            ->with(['course']);

        $assessments = $query->paginate(15);

        return $assessments;
    }


    /**
     * @param $data
     * @param $course
     * @return false|Assessment
     */
    function add($data, $course)
    {
        $data['topics'] = Arr::get($data, 'topics');
        $assessment = new Assessment($data);
        $assessment->course()->associate($course);


        if ($assessment->save()) {
            if ($fi_questions = Arr::get($data, 'fill_in_questions')) {
                $this->questions_repository->insertFIQuestions($fi_questions, $assessment);
            }

            if ($mcsa_questions = Arr::get($data, 'mcsa_questions')) {
                $this->questions_repository->insertMCSAQuestions($mcsa_questions, $assessment);
            }

            if ($mcma_questions = Arr::get($data, 'mcma_questions')) {
                $this->questions_repository->insertMCMAQuestions($mcma_questions, $assessment);
            }

            if ($fr_questions = Arr::get($data, 'questions.free_response_questions')) {
                $this->questions_repository->insertFRQuestions($fr_questions, $assessment);
            }

            return $assessment;
        } else {
            return false;
        }


    }

    /**
     * @param $data
     * @param $assessment
     * @param $course
     * @return bool
     */
    function edit($data, $questions, $assessment, $course)
    {
        $assessment = Assessment::where('course_id', $course->id)
            ->where('id', $assessment)
            ->first();

        $assessment->description = $data['description'];
        $assessment->label = $data['label'];
        $assessment->topics = $data['topics'];

        if ($assessment->save()) {

            if ($fi_questions = Arr::get($questions, 'fill_in_questions')) {
                $this->questions_repository->editFIQuestions($fi_questions, $assessment);
            }

            if ($mcsa_questions = Arr::get($questions, 'mcsa_questions')) {
                $this->questions_repository->editMCSAQuestions($mcsa_questions, $assessment);
            }

            if ($mcma_questions = Arr::get($questions, 'mcma_questions')) {
                $this->questions_repository->editMCMAQuestions($mcma_questions, $assessment);
            }

            if ($fr_questions = Arr::get($questions, 'free_response_questions')) {
                $this->questions_repository->editFRQuestions($fr_questions, $assessment);
            }


            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $id
     * @param $course
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */

    function read($id, $course)
    {
        $assessment = Assessment::query()
            ->where('course_id', $course->id)
            ->where('assessments.id', $id)
            ->first();

        if ($assessment) {
            return $assessment;
        } else {
            return false;
        }

    }

    /**
     * @param $assessment
     * @param $course
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     * @throws \Exception
     */
    function delete($assessment, $course)
    {
        $assessment = $this->getAssessment($assessment, $course);

        if ($assessment) {
            $assessment->delete();
            return $assessment;
        } else {
            return false;
        }

    }


    function deleteQuestions($data, $assessment)
    {

        if ($fi_questions = Arr::get($data, 'questions.fill_in_questions')) {
            $this->questions_repository->deleteFIQuestions($fi_questions, $assessment);
        }

        if ($mcsa_questions = Arr::get($data, 'questions.mcsa_questions')) {
            $this->questions_repository->deleteMCSAQuestions($mcsa_questions, $assessment);
        }

        if ($mcma_questions = Arr::get($data, 'questions.mcma_questions')) {
            $this->questions_repository->deleteMCMAQuestions($mcma_questions, $assessment);
        }

        if ($fr_questions = Arr::get($data, 'questions.free_response_questions')) {
            $this->questions_repository->deleteFRQuestions($fr_questions, $assessment);
        }

        return true;


    }


    /**
     * @param $id
     * @param $course
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */

    function getAssessment($id, $course)
    {
        $assessment = Assessment::query()
            ->where('course_id', $course->id)
            ->where('assessments.id', $id)
            ->first();

        return $assessment;
    }


}
