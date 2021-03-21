<?php

namespace Modules\Assessments\Repositories;

use Illuminate\Support\Arr;
use Modules\Assessments\Models\Assessment;
use Modules\Assessments\Models\FIQuestion;
use Modules\Assessments\Models\FRQuestion;
use Modules\Assessments\Models\MCMAQuestion;
use Modules\Assessments\Models\MCSAQuestion;

/**
 * Class AssessmentRepository
 * @package Modules\Assessments\Repositories
 */
class QuestionRepository
{
    protected $user;

    /**
     * AssessmentRepository constructor.
     */
    function __construct()
    {
        $this->user = auth()->guard('api')->user();

    }

    /**
     * @param $data
     * @param $assessment
     * @return int
     */
   public function  insertFIQuestions($data, $assessment)
   {
       foreach($data as $question_data){
           $question = new FIQuestion($question_data);
           $question->assessment()->associate($assessment);
           $question->save();
       }
       return 1;

   }


    /**
     * @param $data
     * @param $assessment
     * @return int
     */
    public function  insertMCSAQuestions($data, $assessment)
    {
        foreach($data as $question_data){
            $question = new MCSAQuestion($question_data);
            $question->assessment()->associate($assessment);
            $question->save();
        }
        return 1;

    }

    /**
     * @param $data
     * @param $assessment
     * @return int
     */
    public function  insertMCMAQuestions($data, $assessment)
    {
        foreach($data as $question_data){
            $question = new MCMAQuestion($question_data);
            $question->assessment()->associate($assessment);
            $question->save();
        }
        return 1;

    }

    /**
     * @param $data
     * @param $assessment
     * @return int
     */
    public function  insertFRQuestions($data, $assessment)
    {
        foreach($data as $question_data){
            $question = new FRQuestion($question_data);
            $question->assessment()->associate($assessment);
            $question->save();
        }
        return 1;

    }


    public function  editFIQuestions($data, $assessment)
    {
        foreach($data as $question_data){
            FIQuestion::where('assessment_id', $assessment)
                ->where('id', $question_data['id'])
                ->update($question_data);
        }
        return 1;

    }


    /**
     * @param $data
     * @param $assessment
     * @return int
     */
    public function  editMCSAQuestions($data, $assessment)
    {
        foreach($data as $question_data){
            MCSAQuestion::where('assessment_id', $assessment)
                ->where('id', $question_data['id'])
                ->update($question_data);
        }
        return 1;

    }

    /**
     * @param $data
     * @param $assessment
     * @return int
     */
    public function  editMCMAQuestions($data, $assessment)
    {
        foreach($data as $question_data){
            MCMAQuestion::where('assessment_id', $assessment)
                ->where('id', $question_data['id'])
                ->update($question_data);
        }
        return 1;

    }

    /**
     * @param $data
     * @param $assessment
     * @return int
     */
    public function  editFRQuestions($data, $assessment)
    {
        foreach($data as $question_data){
            $question = new FRQuestion($question_data);
            $question->assessment()->associate($assessment);
            $question->save();
        }
        return 1;

    }

    /**
     * @param $questions
     * @param $assessment
     * @return mixed
     */
    public function deleteFIQuestions($questions, $assessment)
    {
        $result =  FIQuestion::whereIn('id',$questions)
            ->where('assessment_id', $assessment)
            ->delete();

        return $result;

    }

    /**
     * @param $questions
     * @param $assessment
     * @return mixed
     */
    public function deleteFRQuestions($questions, $assessment)
    {
        $result =  FRQuestion::whereIn('id',$questions)
            ->where('assessment_id', $assessment)
            ->delete();;

        return $result;

    }

    /**
     * @param $questions
     * @param $assessment
     * @return mixed
     */
    public function deleteMCSAQuestions($questions, $assessment)
    {
        $result =  MCSAQuestion::whereIn('id',$questions)
            ->where('assessment_id', $assessment)
            ->delete();

        return $result;

    }

    /**
     * @param $questions
     * @param $assessment
     * @return mixed
     */
    public function deleteMCMAQuestions($questions, $assessment)
    {
        $result =  MCMAQuestion::whereIn('id',$questions)
            ->where('assessment_id', $assessment)
            ->delete();;

        return $result;

    }

}
