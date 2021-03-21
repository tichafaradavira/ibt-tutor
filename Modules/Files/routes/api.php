<?php

use Illuminate\Support\Facades\Route;
use Modules\Files\Http\Controllers\FilesController;
/**
 * Course admin by tutors
 */
Route::middleware(['api'])->group(function () {
    Route::post('/files/{course}/file/add', [FilesController::class,'add'])->name('modules.files.add');
    Route::post('/files/{course}/file/{entity}/edit', [FilesController::class,'edit'])->name('modules.files.edit');
    Route::post('/files/{course}/file/{entity}/delete', [FilesController::class,'delete'])->name('modules.files.delete');
    Route::get('/files/{course}/file/{entity}', [FilesController::class,'read'])->name('modules.files.read');

});
