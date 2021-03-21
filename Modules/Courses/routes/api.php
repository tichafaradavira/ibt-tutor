<?php

use Illuminate\Support\Facades\Route;
use Modules\Courses\Http\Controllers\LessonsController;
use Modules\Courses\Http\Controllers\LessonPlansController;
use Modules\Courses\Http\Controllers\CoursesController;
use Modules\Courses\Http\Controllers\TuitionController;
/**
 * Course admin by tutors
 */
Route::middleware(['auth:api'])->group(function () {
    Route::get('/courses/courses', [CoursesController::class,'browse'])->name('modules.courses.course.browse');
    Route::post('/courses/course/add', [CoursesController::class,'add'])->name('modules.courses.course.add');
    Route::post('/courses/course/{entity}/edit', [CoursesController::class,'edit'])->name('modules.courses.course.edit');
    Route::post('/courses/course/{entity}/delete', [CoursesController::class,'delete'])->name('modules.courses.course.delete');
    Route::get('/courses/courses/{entity}', [CoursesController::class,'read'])->name('modules.courses.course.read');
    Route::post('/courses/course/{entity}/enrol-course-students', [CoursesController::class,'enrolCourseStudents'])->name('modules.courses.course.enrol');

});
/**
 * Lessons admin by tutors
 */
Route::middleware(['auth:api'])->group(function () {
    Route::get('/courses/course/{course_id}/lessons', [LessonsController::class,'browse'])->name('modules.courses.lesson.browse');
    Route::post('/courses/course/{course_id}/lesson/add', [LessonsController::class,'add'])->name('modules.courses.lesson.add');
    Route::post('/courses/course/{course_id}/lesson/{entity}/edit', [LessonsController::class,'edit'])->name('modules.courses.lesson.edit');
    Route::post('/courses/course/{course_id}/lesson/{entity}/delete', [LessonsController::class,'delete'])->name('modules.courses.lesson.delete');
    Route::get('/courses/course/{course_id}/lesson/{entity}', [LessonsController::class,'read'])->name('modules.courses.lesson.read');

});
/**
 * Lessons for student
 */
    Route::get('/student/courses', [TuitionController::class,'browseCourses'])->name('modules.courses.students.browse-courses')->middleware('auth:api-students');
    Route::get('/student/courses/{course_id}', [TuitionController::class,'getCourse'])->name('modules.courses.lesson.browse-course-lessons');
    Route::get('/student/courses/{course_id}/lessons', [TuitionController::class,'browseCourseLessons'])->name('modules.courses.lesson.browse-course-lessons');
    Route::get('/student/courses/{course_id}/lessons/{lesson_id}', [TuitionController::class,'read'])->name('modules.courses.lesson.read');
    Route::post('/student/courses/{course_id}/lessons/{lesson_id}/complete', [TuitionController::class,'complete'])->name('modules.courses.lesson.complete');
    Route::post('/student/courses/{course_id}/lessons/{lesson_id}/mark-incomplete', [TuitionController::class,'markIncomplete'])->name('modules.courses.lesson.mark-incomplete');


    /*
     * Plans
     */
Route::middleware(['auth:api'])->group(function () {
    Route::get('/courses/course/{course_id}/lessons/plans', [LessonPlansController::class,'browse'])->name('modules.courses.lesson.plans.browse');
    Route::post('/courses/course/{course_id}/lessons/plans/add', [LessonPlansController::class,'add'])->name('modules.courses.lesson.plans.add');
    Route::post('/courses/course/{course_id}/lessons/plans/{entity}/edit', [LessonPlansController::class,'edit'])->name('modules.courses.lesson.plans.edit');
    Route::post('/courses/course/{course_id}/lessons/plans/{entity}/delete', [LessonPlansController::class,'delete'])->name('modules.courses.lesson.plans.delete');
    Route::get('/courses/course/{course_id}/lessons/plans/{entity}', [LessonPlansController::class,'read'])->name('modules.courses.lesson.plans.read');

});
