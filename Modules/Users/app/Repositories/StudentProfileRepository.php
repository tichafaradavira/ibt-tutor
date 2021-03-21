<?php

namespace Modules\Students\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Users\Emails\SendEmailPasswordReset;

class StudentProfileRepository
{
    function forgotPassword($student)
    {
        $student->recovery_token = Str::random(25);
        $student->save();

        Mail::to($student->email)
            ->send(new SendEmailPasswordReset($student));

        return true;
    }

    function resetPassword($data, $student)
    {
        $student->password = Hash::make($data['password']);
        $student->save();

        if ($student) {
            return $student;

        } else {
            return False;
        }
    }

}
