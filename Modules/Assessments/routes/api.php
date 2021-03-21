<?php

use Illuminate\Support\Facades\Route;
use Modules\Assessments\Http\Controllers\AssessmentsController;
use Modules\Assessments\Http\Controllers\AssessmentsResponseController;
use Modules\Assessments\Http\Controllers\TutorAssessmentsResponseController;
use Modules\Assessments\Http\Controllers\StudentAssessmentsController;

/**
 * Course admin by tutors
 */

Route::middleware(['api'])->group(function () {
    Route::get('/assessments/course/{course_id}/assessments', [AssessmentsController::class, 'browse'])->name('modules.assessments.assessment.browse');
    Route::post('/assessments/course/{course_id}/assessments/add', [AssessmentsController::class, 'add'])->name('modules.assessments.assessment.add');
    Route::post('/assessments/course/{course_id}/assessments/{entity}/edit', [AssessmentsController::class, 'edit'])->name('modules.assessments.assessment.edit');
    Route::post('/assessments/course/{course_id}/assessments/{entity}/delete', [AssessmentsController::class, 'delete'])->name('modules.assessments.assessment.delete');
    Route::get('/assessments/course/{course_id}/assessments/{entity}', [AssessmentsController::class, 'read'])->name('modules.assessments.assessment.read');
    Route::post('/assessments/course/{course_id}/assessments/{entity}/questions/delete', [AssessmentsController::class, 'deleteQuestions'])->name('modules.assessments.assessment.delete-questions');
});

/**
 *
 */
Route::middleware(['auth:api-students'])->group(function () {
    Route::get('/tutor/{course_id}/assessments/{assessment_id}/responses', [TutorAssessmentsResponseController::class, 'studentAssessmentResponses'])->name('modules.assessments.assessment');
    Route::post('/tutor/{course_id}/assessments/{assessment_response_id}/assess', [TutorAssessmentsResponseController::class, 'assess'])->name('modules.assessments.assessment.assess');
});


Route::get('/student/assessments/course/{course_id}/assessments', [StudentAssessmentsController::class, 'browse'])->name('student.modules.assessments.assessment.browse')
    ->middleware('auth:api-students');


//Route::get('/student/assessments/course/{course_id}/assessment-', [AssessmentsResponseController::class, 'assessmentHistory'])
//    ->name('modules.assessments.assessment.assessment-history')->middleware('auth:api-students');
Route::get('/student/assessments/course/{course_id}/responses/assessment-history', [AssessmentsResponseController::class, 'assessmentHistory'])
    ->name('modules.assessments.assessment.assessment-history')->middleware('auth:api-students');

Route::get('/student/assessments/course/{course_id}/responses/{assessment_response_id}/result', [AssessmentsResponseController::class, 'result'])->name('modules.assessments.assessment.result')->middleware('auth:api-students');

Route::get('/student/assessments/course/{course_id}/responses/{assessment_id}/attempt', [AssessmentsResponseController::class, 'attempt'])->name('modules.assessments.assessment.attempt')->middleware('auth:api-students');

Route::post('/student/assessments/course/{course_id}/responses/{assessment_id}/submit', [AssessmentsResponseController::class, 'submit'])->name('modules.assessments.assessment.submit')->middleware('auth:api-students');

Route::post('/student/assessments/course/{course_id}/responses/{assessment_id}/save', [AssessmentsResponseController::class, 'save'])->name('modules.assessments.assessment.save')->middleware('auth:api-students');


