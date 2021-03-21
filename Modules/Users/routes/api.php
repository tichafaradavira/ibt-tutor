<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;
use Modules\Users\Http\Controllers\TutorsController;
use Modules\Users\Http\Controllers\StudentsController;
use Modules\Users\Http\Controllers\StudentProfileController;

/**
 * Tutor signup
 */
Route::post('/users/signup', [UserController::class, 'signup'])->name('modules.users.signup');
Route::post('/users/signin', [UserController::class, 'signIn'])->name('modules.users.signin');
Route::post('/users/forgotpassword', [UserController::class, 'forgotPassword'])->name('modules.users.forgot.paswword');
Route::post('/users/password/reset/{token}', [UserController::class, 'resetPassword'])->name('modules.users.password.reset');
Route::get('/users/logout', [UserController::class, 'logout'])->name('modules.users.logout')->middleware('auth:api');
Route::get('/users/tutor/profile', [UserController::class, 'profile'])->name('modules.users.tutor.profile')->middleware('auth:api');
Route::post('/users/tutor/edit/profile', [UserController::class, 'editProfile'])->name('modules.users.tutor.edit.profile')->middleware('auth:api');



Route::post('/users/student/profile/signin', [StudentProfileController::class, 'signIn'])->name('modules.users.student.profile.signin');
Route::post('/users/student/profile/forgot-password', [StudentProfileController::class, 'forgotPassword'])->name('modules.users.student.profile.forgot-password');
Route::post('/users/student/profile/reset-password/{token}', [StudentProfileController::class, 'resetPassword'])->name('modules.users.student.profile.reset-password');
Route::get('/users/student/profile', [StudentProfileController::class, 'profile'])->name('modules.users.student.profile')->middleware('auth:api-students');


/**
 * Student Account
 */

Route::post('/users/student/profile/logout', [StudentProfileController::class, 'logout'])
    ->name('modules.users.student.profile.logout')->middleware('auth:api-students');



/**
 * Admin Managing tutors
 */

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users/tutors', [TutorsController::class, 'browse'])->name('modules.users.tutor.browse');
    Route::post('/users/tutor/add', [TutorsController::class, 'add'])->name('modules.users.tutor.add');
    Route::post('/users/tutor/{entity}/edit', [TutorsController::class, 'edit'])->name('modules.users.tutor.edit');
    Route::post('/users/tutor/{entity}/delete', [TutorsController::class, 'delete'])->name('modules.users.tutor.delete');
    Route::post('/users/tutor/{entity}/suspend', [TutorsController::class, 'suspend'])->name('modules.users.tutor.suspend');
    Route::post('/users/tutor/{entity}/activate', [TutorsController::class, 'activate'])->name('modules.users.tutor.activate');
    Route::get('/users/tutor/{entity}', [TutorsController::class, 'read'])->name('modules.users.tutor.read');

});
/**
 * Admin and Tutors managing students
 */

Route::middleware(['auth:api'])->group(function () {
    Route::get('/users/students', [StudentsController::class, 'browse'])->name('modules.users.student.browse');
    Route::post('/users/student/add', [StudentsController::class, 'add'])->name('modules.users.student.add');
    Route::post('/users/student/{entity}/edit', [StudentsController::class, 'edit'])->name('modules.users.student.edit');
    Route::post('/users/student/{entity}/delete', [StudentsController::class, 'delete'])->name('modules.users.student.delete');
    Route::get('/users/students/{entity}', [StudentsController::class, 'read'])->name('modules.users.student.read');
    Route::get('/users/students/{entity}/course/{course}/progress', [StudentsController::class, 'courseProgress'])->name('modules.users.student.read');
    Route::get('/users/students/{entity}/course/{course}/assessments/progress', [StudentsController::class, 'assessmentProgress'])->name('modules.users.student.read');
    Route::get('/users/students/course/{course_id}/assessment/{assessment_response_id}/result', [StudentsController::class, 'viewAttempt'])->name('modules.assessments.assessment.result')->middleware('auth:api-students');

});

