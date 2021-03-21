<?php

namespace Modules\Assessments\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Assessments\Http\Requests\Assessment\AddAssessmentRequest;
use Modules\Assessments\Http\Requests\Assessment\DeleteAssessmentQuestionsRequest;
use Modules\Assessments\Http\Requests\Assessment\DeleteAssessmentRequest;
use Modules\Assessments\Http\Requests\Assessment\EditAssessmentRequest;
use Modules\Assessments\Http\Requests\Assessment\ReadAssessmentRequest;
use Modules\Assessments\Http\Requests\Assessment\SaveAssessmentRequest;
use Modules\Assessments\Http\Requests\AssessmentResponse\AssessmentHistoryRequest;
use Modules\Assessments\Http\Resources\Assessment;
use Modules\Assessments\Http\Resources\AssessmentCollection;
use Modules\Assessments\Http\Resources\Assessment as AssessmentResource;
use Modules\Assessments\Http\Resources\AssessmentResponse;
use Modules\Assessments\Http\Resources\AssessmentResponseCollection;
use Modules\Assessments\Services\AssessmentResponseService;
use Modules\Assessments\Services\AssessmentService;
use Modules\Assessments\Services\TutorAssessmentResponseService;


/**
 * Class AssessmentsController
 * @package Modules\Assessments\Http\Controllers
 */
class TutorAssessmentsResponseController extends Controller
{
    /**
     * @param Request $request
     * @param AssessmentResponseService $service
     * @param $course_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function studentAssessmentResponses(Request $request, TutorAssessmentResponseService $service, $course_id, $assessment_id)
    {
        $inputs = $request->all();

        $assessments = $service->studentAssessmentResponses($inputs, $course_id, $assessment_id);
        return response(new AssessmentResponseCollection($assessments), 200);

    }


    /**
     * @param Request $request
     * @param AssessmentResponseService $service
     * @param $course_id
     * @param $assessment_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function assess(Request $request, TutorAssessmentResponseService $service, $course_id, $assessment_response_id)
    {
        $inputs = $request->all();

        $assessment = $service->assess($inputs, $course_id, $assessment_response_id);
        return response(new AssessmentResponse($assessment), 200);

    }

}
