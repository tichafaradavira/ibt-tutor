<?php

namespace Modules\Assessments\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Assessments\Http\Requests\Assessment\AddAssessmentRequest;
use Modules\Assessments\Http\Requests\Assessment\ReadAssessmentRequest;
use Modules\Assessments\Http\Requests\Assessment\SaveAssessmentRequest;
use Modules\Assessments\Http\Requests\AssessmentResponse\AssessmentHistoryRequest;
use Modules\Assessments\Http\Resources\Assessment;
use Modules\Assessments\Http\Resources\AssessmentResponse;
use Modules\Assessments\Http\Resources\AssessmentResponseCollection;
use Modules\Assessments\Services\AssessmentResponseService;
use Modules\Assessments\Services\AssessmentService;


/**
 * Class AssessmentsController
 * @package Modules\Assessments\Http\Controllers
 */
class AssessmentsResponseController extends Controller
{
    /**
     * @param Request $request
     * @param AssessmentResponseService $service
     * @param $course_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function assessmentHistory(AssessmentHistoryRequest $request, AssessmentResponseService $service, $course_id)
    {
        $inputs = $request->all();

        $assessments = $service->assessmentHistory($inputs, $course_id);
        return response(new AssessmentResponseCollection($assessments), 200);

    }

    /**
     * @param Request $request
     * @param AssessmentResponseService $service
     * @param $course_id
     * @param $assessment_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function attempt(Request $request, AssessmentResponseService $service, $course_id, $assessment_id)
    {
        $inputs = $request->all();

        $assessment = $service->attempt($inputs, $course_id, $assessment_id);
        return response(new Assessment($assessment), 200);

    }

    /**
     * @param AddAssessmentRequest $request
     * @param AssessmentService $service
     * @param $course_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function save(SaveAssessmentRequest $request, AssessmentResponseService $service, $course_id, $assessment_id)
    {
        $inputs = $request->all();
        $assessment = $service->save($inputs, $course_id, $assessment_id);
        if ($assessment) {
            return response(new AssessmentResponse($assessment), 200);
        } else {
            return response('Assessment not added', 422);
        }
    }


    /**
     * @param ReadAssessmentRequest $request
     * @param AssessmentService $service
     * @param $course_id
     * @param $entity
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function submit(SaveAssessmentRequest $request, AssessmentResponseService $service, $course_id, $assessment_id)
    {
        $inputs = $request->all();
        $assessment_response = $service->submit($inputs, $course_id, $assessment_id);
        if ($assessment_response) {
            return response(new AssessmentResponse($assessment_response), 200);
        } else {
            return response('Assessment not added', 422);
        }
    }


    function result(Request $request, AssessmentResponseService $service, $course_id, $assessment_response_id)
    {
        $inputs = $request->all();

        $assessment = $service->result($inputs, $course_id, $assessment_response_id);
        return response(new AssessmentResponse($assessment), 200);

    }


}
