<?php

namespace Modules\Users\Http\Controllers;

use Carbon\Carbon;
use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Modules\Users\Http\Requests\Student\ForgotPasswordRequest;
use Modules\Users\Http\Requests\Student\LoginRequest;
use Modules\Users\Http\Requests\Student\ProfileRequest;
use Modules\Users\Http\Requests\Student\ResetPasswordRequest;
use Modules\Users\Http\Resources\Student;
use Modules\Users\Services\StudentProfileService;
use Modules\Users\Http\Resources\Student as StudentResource;


class StudentProfileController extends Controller
{
    protected function signIn(LoginRequest $request, StudentProfileService $service)
    {
        $inputs = $request->all();
        $student = $service->getStudentByEmail($inputs['email']);

        if ($student) {
            if (Hash::check($inputs['password'], $student->password)) {
                if ($student->email_verified_at == null) {
                    $service->activateAccount($student);
                }

                $token = $student->createToken('Laravel Password Grant Client')->accessToken;
                return response(['user' => new StudentResource($student), 'token' => $token], 200);
            } else {
                return response("INVALID_CREDENTIALS", 401);
            }
        } else {
            return response('INVALID_CREDENTIALS', 401);
        }
    }

    protected function forgotPassword(ForgotPasswordRequest $request, StudentProfileService $service)
    {
        $email = $request->input('email');
        $result = $service->forgotPassword($email);
        if ($result) {
            return response('Email with instructions send.', 200);
        }

        return response('Unknown Email', 200);
    }

    protected function resetPassword(ResetPasswordRequest $request, StudentProfileService $service,$token)
    {
        $inputs = $request->all();
        $student = $service->resetPassword($inputs, $token);
        if ($student) {
            return response('Password reset!!', 200);
        }

        return response('Unknown Email', 200);
    }


    protected function logout(Request $request)
    {
        return response('Logged Out', 200);
        $token = $request->user()->token();
        $token->revoke();

        return response('Logged Out', 200);
    }


    public function profile(ProfileRequest $request)
    {
        $user = $request->user();
        return response(new Student($user), 200);
    }
}
