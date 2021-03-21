<?php

namespace Modules\Courses\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Courses\Http\Requests\Lesson\ReadLessonRequest;
use Modules\Courses\Http\Requests\Tuition\BrowseCoursesRequest;
use Modules\Courses\Http\Requests\Tuition\CompleteLessonRequest;
use Modules\Courses\Http\Resources\Course;
use Modules\Courses\Http\Resources\CourseCollection;
use Modules\Courses\Http\Resources\Lesson;
use Modules\Courses\Http\Resources\StudentCourse;
use Modules\Courses\Http\Resources\StudentCourseCollection;
use Modules\Courses\Services\LessonService;
use Modules\Courses\Services\TuitionService;

class TuitionController extends Controller
{
    function browseCourses(BrowseCoursesRequest $request, TuitionService $service)
    {
        $inputs = $request->all();

        $courses = $service->browseCourses($inputs);
        return response(new StudentCourseCollection($courses), 200);

    }

    function browseCourseLessons(BrowseCoursesRequest $request, TuitionService $service, $course_id)
    {
        $inputs = $request->all();

        $lessons = $service->browseCourseLessons($inputs, $course_id);
        return response(Lesson::collection($lessons), 200);

    }

    function read(ReadLessonRequest $request, TuitionService $service, $course_id, $lesson_id)
    {
        $lesson = $service->read($lesson_id, $course_id);
        if ($lesson) {
            return response(new Lesson($lesson), 200);
        } else {
            return response('Cannot read Lesson', 422);
        }
    }

    /**
     * @param ReadLessonRequest $request
     * @param TuitionService $service
     * @param $course_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function getCourse(ReadLessonRequest $request, TuitionService $service, $course_id)
    {
        $course = $service->getCourse($course_id);
        if ($course) {
            return response(new StudentCourse($course), 200);
        } else {
            return response('Cannot read course', 422);
        }
    }

    function complete(CompleteLessonRequest $request, TuitionService $service, $course_id, $lesson_id)
    {
        $result = $service->complete($lesson_id, $course_id);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot complete Lesson', 422);
        }
    }

    function markIncomplete(CompleteLessonRequest $request, TuitionService $service, $course_id, $lesson_id)
    {
        $result = $service->markIncomplete($lesson_id, $course_id);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot un complete Lesson', 422);
        }
    }


}
