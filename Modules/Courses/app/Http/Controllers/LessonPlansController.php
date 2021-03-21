<?php

namespace Modules\Courses\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Courses\Http\Requests\Lesson\DeleteLessonPlanRequest;
use Modules\Courses\Http\Requests\Lesson\EditLessonPlanRequest;
use Modules\Courses\Http\Requests\Lesson\ReadLessonPlanRequest;
use Modules\Courses\Http\Requests\LessonPlan\AddLessonPlanRequest;
use Modules\Courses\Http\Resources\LessonPlan;
use Modules\Courses\Http\Resources\LessonPlanCollection;
use Modules\Courses\Services\LessonPlanService;

class LessonPlansController extends Controller
{
    function browse(Request $request, LessonPlanService $service, $course_id)
    {
        $inputs = $request->all();

        $lessonPlans = $service->browse($inputs,$course_id);

        return response( new LessonPlanCollection($lessonPlans), 200);

    }

    function add(AddLessonPlanRequest $request, LessonPlanService $service, $course_id)
    {
        $inputs = $request->all();

        $lessonPlan = $service->add($inputs, $course_id);
        if ($lessonPlan) {
            return response(new LessonPlan($lessonPlan), 200);
        } else {
            return response('Lesson Plan not added', 422);
        }
    }

    function edit(EditLessonPlanRequest $request, LessonPlanService $service, $course_id, $entity)
    {
        $inputs = $request->all();

        $result = $service->edit($inputs, $course_id , $entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Lesson Plan not edited', 422);
        }
    }


    function read(ReadLessonPlanRequest $request, LessonPlanService $service,  $course_id, $entity)
    {
        $lessonPlan = $service->read( $course_id , $entity);
        if ($lessonPlan) {
            return response(new LessonPlan($lessonPlan), 200);
        } else {
            return response('Cannot read Lesson Plan', 422);
        }
    }

    function delete(DeleteLessonPlanRequest $request, LessonPlanService $service,  $course_id, $entity)
    {
        $lessonPlan = $service->delete( $course_id , $entity);
        if ($lessonPlan) {
            return response(new LessonPlan($lessonPlan), 200);
        } else {
            return response('Cannot delete Lesson Plan', 422);
        }
    }
}
