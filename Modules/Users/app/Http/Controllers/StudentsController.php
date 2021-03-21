<?php

namespace Modules\Users\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Assessments\Http\Resources\AssessmentResponse;
use Modules\Assessments\Services\AssessmentResponseService;
use Modules\Users\Http\Requests\Student\AddStudentsRequest;
use Modules\Users\Http\Requests\Student\DeleteStudentRequest;
use Modules\Users\Http\Requests\Student\EditStudentRequest;
use Modules\Users\Http\Requests\Student\ReadStudentRequest;
use Modules\Users\Http\Resources\AssessmentProgressCollection;
use Modules\Users\Http\Resources\CourseStudent;
use Modules\Users\Http\Resources\CourseStudentCollection;
use Modules\Users\Http\Resources\Progress;
use Modules\Users\Http\Resources\ProgressCollection;
use Modules\Users\Http\Resources\StudentCollection;
use Modules\Users\Services\StudentService;
use Modules\Users\Http\Resources\Student as StudentResource;


class StudentsController extends Controller
{
    function browse(Request $request, StudentService $service)
    {
        $inputs = $request->all();

        $students = $service->browse($inputs);
        return response(new CourseStudentCollection($students), 200);

    }

    function add(AddStudentsRequest $request, StudentService $service)
    {
        $inputs = $request->all();

        $students = $service->add($inputs);
        if ($students) {
            return response( StudentResource::collection($students), 200);
        } else {
            return response('Tutors not added', 422);
        }
    }

    function edit(EditStudentRequest $request, StudentService $service, $entity)
    {
        $inputs = $request->all();

        $result = $service->edit($inputs, $entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Tutor not edit', 422);
        }
    }


    function read(ReadStudentRequest $request, StudentService $service, $entity)
    {
        $student = $service->read($entity);
        if ($student) {
            return response(new CourseStudent($student), 200);
        } else {
            return response('Cannot read student', 422);
        }
    }

    function delete(DeleteStudentRequest $request, StudentService $service, $entity)
    {
        $student = $service->delete($entity);
        if ($student) {
            return response(new StudentResource($student), 200);
        } else {
            return response('Cannot delete student', 422);
        }
    }



    function courseProgress(Request $request, StudentService $service, $student , $course)
    {
        $progress = $service->courseProgress($student,$course);
        if ($progress) {
            return response(new ProgressCollection($progress), 200);
        } else {
            return response('Cannot read student', 422);
        }
    }

    function assessmentProgress(Request $request, StudentService $service, $student , $course)
    {
        $progress = $service->assessmentProgress($student,$course);
        if ($progress) {
            return response(new AssessmentProgressCollection($progress), 200);
        } else {
            return response('Cannot read student', 422);
        }
    }



    function viewAttempt(Request $request, AssessmentResponseService $service, $course_id, $assessment_response_id)
    {
        $inputs = $request->all();

        $assessment = $service->result($inputs, $course_id, $assessment_response_id);
        return response(new AssessmentResponse($assessment), 200);

    }
}
