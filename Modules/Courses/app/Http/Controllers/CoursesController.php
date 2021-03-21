<?php

namespace Modules\Courses\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Courses\Http\Requests\Course\AddCourseRequest;
use Modules\Courses\Http\Requests\Course\DeleteCourseRequest;
use Modules\Courses\Http\Requests\Course\EditCourseRequest;
use Modules\Courses\Http\Requests\Course\EnrolCourseStudentsRequest;
use Modules\Courses\Http\Requests\Course\ReadCourseRequest;
use Modules\Courses\Http\Resources\CourseCollection;
use Modules\Courses\Services\CourseService;
use Modules\Courses\Http\Resources\Course as CourseResource;


class CoursesController extends Controller
{
    function browse(Request $request, CourseService $service)
    {
        $inputs = $request->all();

        $courses = $service->browse($inputs);
        return response(new CourseCollection($courses), 200);

    }

    function add(AddCourseRequest $request, CourseService $service)
    {
        $inputs = $request->all();

        $course = $service->add($inputs);
        if ($course) {
            return response( new CourseResource($course), 200);
        } else {
            return response('Course not added', 422);
        }
    }

    function edit(EditCourseRequest $request, CourseService $service, $entity)
    {
        $inputs = $request->all();

        $result = $service->edit($inputs, $entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Course not edited', 422);
        }
    }


    function read(ReadCourseRequest $request, CourseService $service, $entity)
    {
        $course = $service->read($entity);
        if ($course) {
            return response(new CourseResource($course), 200);
        } else {
            return response('Cannot read course', 422);
        }
    }

    function delete(DeleteCourseRequest $request, CourseService $service, $entity)
    {
        $course = $service->delete($entity);
        if ($course) {
            return response(new CourseResource($course), 200);
        } else {
            return response('Cannot delete course', 422);
        }
    }

    function enrolCourseStudents(EnrolCourseStudentsRequest $request, CourseService $service, $entity)
    {
        $inputs = $request->input('students');

        $result = $service->enrolCourseStudents($inputs, $entity);
        if ($result) {
            return response( $result, 200);
        } else {
            return response('Cannot enrol students in course', 422);
        }
    }
}
