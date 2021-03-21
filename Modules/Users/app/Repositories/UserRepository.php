<?php

namespace Modules\Users\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Users\Emails\SendEmailVerifyUserEmail;
use Modules\Users\Emails\SendForgotPasswordEmail;
use Modules\Users\Models\User;

class UserRepository
{


    function signup($data)
    {
        $data['dob'] = Carbon::parse($data['dob']);

        if ($password = Arr::get($data, 'password')) {
            $data['password'] = Hash::make($password);
        }

        $user = User::create($data);


        if ($user->save()) {
            Mail::to($user->email)
                ->send(new SendEmailVerifyUserEmail($user));

            return $user;
        } else {
            return false;
        }


    }

    function forgotPassword($user)
    {
        $user->recovery_token = Str::random(25);
        $user->save();
        Mail::to($user->email)
            ->send(new SendForgotPasswordEmail($user));

        return true;
    }


    function resetPassword($data, $user)
    {
        $user->password = Hash::make(Arr::get($data, 'password'));
        $user->save();

        return true;
    }



    function verifyEmail($user)
    {
        $user->email_verified_at = Carbon::now();

        if ($user->save()) {
            return $user;
        }
    }


    function updateProfile($data, $user){
        if($email = Arr::get($data, 'email'))
        {
            if($email !== $user->email){
                Mail::to($email)
                    ->send(new SendEmailVerifyUserEmail($user));
            }
        }

        $saved = User::where('id', $user->id)
            ->update($data);

        return $saved;

    }


}
