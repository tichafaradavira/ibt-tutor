<?php

namespace Modules\Courses\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Courses\Http\Requests\Lesson\AddLessonRequest;
use Modules\Courses\Http\Requests\Lesson\DeleteLessonRequest;
use Modules\Courses\Http\Requests\Lesson\EditLessonRequest;
use Modules\Courses\Http\Requests\Lesson\ReadLessonRequest;
use Modules\Courses\Http\Resources\Lesson;
use Modules\Courses\Http\Resources\LessonCollection;
use Modules\Courses\Services\LessonService;

class LessonsController extends Controller
{
    function browse(Request $request, LessonService $service, $course_id)
    {
        $inputs = $request->all();

        $lessons = $service->browse($inputs,$course_id);
        return response(new LessonCollection($lessons), 200);

    }

    function add(AddLessonRequest $request, LessonService $service, $course_id)
    {
        $inputs = $request->all();

        $lesson = $service->add($inputs, $course_id);
        if ($lesson) {
            return response(new Lesson($lesson), 200);
        } else {
            return response('Lesson not added', 422);
        }
    }

    function edit(EditLessonRequest $request, LessonService $service, $course_id, $entity)
    {
        $inputs = $request->all();

        $result = $service->edit($inputs, $entity, $course_id);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Lesson not edited', 422);
        }
    }


    function read(ReadLessonRequest $request, LessonService $service, $course_id, $entity)
    {
        $lesson = $service->read($entity, $course_id);
        if ($lesson) {
            return response(new Lesson($lesson), 200);
        } else {
            return response('Cannot read Lesson', 422);
        }
    }

    function delete(DeleteLessonRequest $request, LessonService $service, $course_id, $entity)
    {
        $lesson = $service->delete($entity, $course_id);
        if ($lesson) {
            return response(new Lesson($lesson), 200);
        } else {
            return response('Cannot delete Lesson', 422);
        }
    }
}
