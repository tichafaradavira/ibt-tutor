<?php

namespace Modules\Assessments\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Assessments\Http\Requests\Assessment\AddAssessmentRequest;
use Modules\Assessments\Http\Requests\Assessment\DeleteAssessmentQuestionsRequest;
use Modules\Assessments\Http\Requests\Assessment\DeleteAssessmentRequest;
use Modules\Assessments\Http\Requests\Assessment\EditAssessmentRequest;
use Modules\Assessments\Http\Requests\Assessment\ReadAssessmentRequest;
use Modules\Assessments\Http\Resources\Assessment;
use Modules\Assessments\Http\Resources\AssessmentCollection;
use Modules\Assessments\Http\Resources\Assessment as AssessmentResource;
use Modules\Assessments\Services\AssessmentService;


/**
 * Class AssessmentsController
 * @package Modules\Assessments\Http\Controllers
 */
class AssessmentsController extends Controller
{
    /**
     * @param Request $request
     * @param AssessmentService $service
     * @param $course_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function browse(Request $request, AssessmentService $service, $course_id)
    {
        $inputs = $request->all();

        $assessments = $service->browse($inputs, $course_id);
        return response( new AssessmentCollection($assessments), 200);

    }

    /**
     * @param AddAssessmentRequest $request
     * @param AssessmentService $service
     * @param $course_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function add(AddAssessmentRequest $request, AssessmentService $service, $course_id)
    {
        $inputs = $request->all();

        $assessment = $service->add($inputs, $course_id);
        if ($assessment) {
            return response(new Assessment($assessment), 200);
        } else {
            return response('Assessment not added', 422);
        }
    }

    /**
     * @param EditAssessmentRequest $request
     * @param AssessmentService $service
     * @param $course_id
     * @param $entity
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function edit(EditAssessmentRequest $request, AssessmentService $service, $course_id, $entity)
    {
        $inputs = $request->except('questions');
        $questions = $request->input('questions');

        $result = $service->edit($inputs,$questions, $entity, $course_id);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Assessment not edited', 422);
        }
    }

    /**
     * @param ReadAssessmentRequest $request
     * @param AssessmentService $service
     * @param $course_id
     * @param $entity
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function read(ReadAssessmentRequest $request, AssessmentService $service, $course_id, $entity)
    {
        $assessment = $service->read($entity, $course_id);
        if ($assessment) {
            return response(new Assessment($assessment), 200);
        } else {
            return response('Cannot read Assessment', 422);
        }
    }

    /**
     * @param DeleteAssessmentRequest $request
     * @param AssessmentService $service
     * @param $course_id
     * @param $entity
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    function delete(DeleteAssessmentRequest $request, AssessmentService $service, $course_id, $entity)
    {
        $assessment = $service->delete($entity, $course_id);
        if ($assessment) {
            return response(new Assessment($assessment), 200);
        } else {
            return response('Cannot delete Assessment', 422);
        }
    }

    function deleteQuestions(DeleteAssessmentQuestionsRequest $request, AssessmentService $service, $course_id, $entity)
    {
        $inputs = $request->all();

        $result = $service->deleteQuestions($inputs, $course_id, $entity);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }


}
