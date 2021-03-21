<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/core/test', [\Ibt\Core\Http\Controllers\IbtCoreController::class,'show']);

Route::post('/user/password/reset/password/{token}', 'Auth\PasswordResetController@handlePassword');

Route::get('/user/verify/email/{id}', 'Auth\SignUpController@verifyEmail');

Route::post('/user/signup', 'Auth\SignUpController@signUp');

Route::post('/user/signin', 'Auth\SignInController@signIn');
