<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;

Route::get('/user/email/verify/{id}', [UserController::class,'verifyEmail'])->name('modules.users.email.verify');
