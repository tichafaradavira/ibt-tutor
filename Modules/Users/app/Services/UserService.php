<?php

namespace Modules\Users\Services;


use Illuminate\Support\Arr;
use Modules\Users\Models\User;
use Modules\Users\Repositories\UserRepository;

class UserService
{
    protected $repository;

    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    function signup($inputs)
    {
        $user = $this->repository->signup($inputs);

        if ($user) {
            return $user;
        } else {
            return false;
        }


    }

    function forgotPassword(User $user)
    {
        $result = $this->repository->forgotPassword($user);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function resetPassword($inputs,$token)
    {
        $user = User::query()->where('recovery_token', $token)
            ->where('email', Arr::get($inputs, 'email'))->first();
        if(!$user){
            return false;
        }

        $result = $this->repository->resetPassword($inputs, $user);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    function verifyEmail($id)
    {
        $user = User::query()->find($id);

        if ($user) {
            return $this->repository->verifyEmail($user);

        } else {
            return false;
        }
    }

    function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            return $user;

        } else {
            return null;
        }
    }


    function updateProfile($data,$user)
    {
        $this->repository->updateProfile($data, $user);

        if ($user) {
            return $user;

        } else {
            return null;
        }
    }

}
