<?php

namespace Modules\Users\Http\Controllers;


use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Http\Requests\Tutor\ForgotPasswordRequest;
use Modules\Users\Http\Requests\Tutor\LoginRequest;
use Modules\Users\Http\Requests\Tutor\ResetPasswordRequest;
use Modules\Users\Http\Requests\Tutor\UserSignUpRequest;
use Modules\Users\Models\User;
use Modules\Users\Services\UserService;
use Modules\Users\Http\Resources\User as UserResource;

class UserController extends Controller
{
    protected function signUp(UserSignUpRequest $request, UserService $service)
    {

        $inputs = $request->all();
        $user = User::where('email', $inputs['email'])->first();

        if (!$user) {
            $user = $service->signup($inputs);
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;

            return response('VERIFY_EMAIL', 200);

        } else {
            return response('EMAIL_TAKEN', 200);

        }

    }

    protected function signIn(LoginRequest $request, UserService $service)
    {
        $inputs = $request->all();
        $user = $service->getUserByEmail($inputs['email']);

        if ($user) {
            if ($user->suspended_at != null) {
                return response("ACCOUNT_SUSPENDED", 503);
            }

            if ($user->email_verified_at == null) {
                return response("VERIFY_EMAIL", 200);
            }

            if (Hash::check($inputs['password'], $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                return response(['user' => new UserResource($user), 'token' => $token], 200);
            } else {
                return response("INVALID_CREDENTIALS", 401);
            }
        } else {
            return response('INVALID_CREDENTIALS', 401);
        }
    }



    public function verifyEmail(Request $request, UserService $service, $id)
    {
        $user = $service->verifyEmail($id);
        if ($user) {
            return response('EMAIL_VERIFIED', 200);
        } else {
            return response('lINK EXPIRED', 200);

        }
    }



    public function resetPassword(ResetPasswordRequest $request, UserService $service, $token)
    {
        $inputs = $request->all();

        $user = $service->resetPassword($inputs,$token);
        if ($user) {
            return response('PASSWORD_RESET', 200);
        } else {
            return response('PASSWORD_NOT_RESET', 422);

        }
    }

    public function forgotPassword(ForgotPasswordRequest $request, UserService $service)
    {
        $email = $request->input('email');
        $user = $service->getUserByEmail($email);
        if(!$user){
            return response('EMAIL_NOT_FOUND', 401);
        }

        $result = $service->forgotPassword($user);
        if ($result) {
            return response('PASSWORD_RESET_EMAIL_SEND', 200);
        } else {
            return response('lINK EXPIRED', 200);

        }
    }


    protected function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return response('Logged Out', 200);
    }

    protected function profile(Request $request)
    {
        $user = $request->user();

        return response(new UserResource($user), 200);
    }

    protected function editProfile(Request $request, UserService $service)
    {
        $user = $request->user();
        $inputs = $request->all();

        $service->updateProfile($inputs, $user);

        return response(new UserResource($user), 200);
    }


}
