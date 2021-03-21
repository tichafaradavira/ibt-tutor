<?php

use Illuminate\Support\Facades\Route;
use Modules\Communications\Http\Controllers\StudentMessagesController;
use Modules\Communications\Http\Controllers\StudentReiceveMessagesController;
use Modules\Communications\Http\Controllers\TutorReiceveMessagesController;
use Modules\Communications\Http\Controllers\TutorMessagesController;

/**
 * Tutor endpoints - student is the reicever
 */
Route::middleware(['api'])->group(function () {
    Route::get('/communications/student/messages', [StudentMessagesController::class, 'browse'])->name('modules.communications.student.messages.browse');
    Route::post('/communications/student/messages/send', [StudentMessagesController::class, 'send'])->name('modules.communications.student.messages.send');
    Route::post('/communications/student/messages/delete', [StudentMessagesController::class, 'delete'])->name('modules.communications.student.messages.delete');
    Route::get('/communications/student/messages/{entity}/read', [StudentMessagesController::class, 'read'])->name('modules.communications.student.messages.read');

});
/**
 * Tutor endpoints - reicever
 */
Route::middleware(['api-students'])->group(function () {
    Route::get('/communications/tutor/reiceve/messages', [TutorReiceveMessagesController::class, 'browse'])->name('modules.communications.student.messages.browse');
    Route::post('/communications/tutor/reiceve/messages/delete', [TutorReiceveMessagesController::class, 'delete'])->name('modules.communications.student.messages.delete');
    Route::get('/communications/tutor/reiceve/messages/{entity}/read', [TutorReiceveMessagesController::class, 'read'])->name('modules.communications.student.messages.read');

});


/**
 * Student endpoints - tutor is the reicever
 */
Route::middleware(['api-students'])->group(function () {
    Route::get('/communications/tutor/messages', [TutorMessagesController::class, 'browse'])->name('modules.communications.tutor.messages.browse');
    Route::post('/communications/tutor/messages/send', [TutorMessagesController::class, 'send'])->name('modules.communications.tutor.messages.send');
    Route::post('/communications/tutor/messages/delete', [TutorMessagesController::class, 'delete'])->name('modules.communications.tutor.messages.delete');
    Route::get('/communications/tutor/messages/{entity}/read', [TutorMessagesController::class, 'read'])->name('modules.communications.tutor.messages.read');

});

/**
 * Student endpoints - reicever
 */

    Route::get('/communications/student/reiceve/messages', [StudentReiceveMessagesController::class, 'browse'])->name('modules.communications.student.messages.browse')->middleware('auth:api-students');
    Route::post('/communications/student/reiceve/messages/delete', [StudentReiceveMessagesController::class, 'delete'])->name('modules.communications.student.messages.delete')->middleware('auth:api-students');
    Route::get('/communications/student/reiceve/messages/{entity}/read', [StudentReiceveMessagesController::class, 'read'])->name('modules.communications.student.messages.read')->middleware('auth:api-students');
