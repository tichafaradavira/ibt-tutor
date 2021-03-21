<?php

namespace Modules\Assessments\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Assessments\Http\Resources\Assessment;
use Modules\Assessments\Http\Resources\AssessmentBrowse;
use Modules\Assessments\Http\Resources\AssessmentCollection;
use Modules\Assessments\Http\Resources\Assessment as AssessmentResource;
use Modules\Assessments\Services\AssessmentService;
use Modules\Assessments\Services\StudentAssessmentService;


/**
 * Class AssessmentsController
 * @package Modules\Assessments\Http\Controllers
 */
class StudentAssessmentsController extends Controller
{
    /**
     * @param Request $request
     * @param AssessmentService $service
     * @param $course_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function browse(Request $request, StudentAssessmentService $service, $course_id)
    {
        $inputs = $request->all();

        $assessments = $service->browse($inputs, $course_id);
        return response(AssessmentBrowse::collection($assessments), 200);

    }


}
