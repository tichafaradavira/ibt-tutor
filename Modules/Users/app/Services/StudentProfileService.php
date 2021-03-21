<?php

namespace Modules\Users\Services;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Modules\Students\Repositories\StudentProfileRepository;
use Modules\Students\Repositories\StudentRepository;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;
use Modules\Users\Repositories\UserRepository;

class StudentProfileService
{
    protected $repository;

    function __construct(StudentProfileRepository $repository)
    {
        $this->repository = $repository;

    }

    function activateAccount($student)
    {
        $student->email_verified_at = Carbon::now();
        $student->activated_at = Carbon::now();
        $student->save();

    }

    function forgotPassword($email)
    {
        $student = $this->getStudentByEmail($email);
        if ($student) {
            $result = $this->repository->forgotPassword($student);
            return true;

        } else {
            return False;
        }
    }

    function resetPassword($inputs, $token)
    {
        $student = Student::query()->where('recovery_token', $token)
            ->where('email', Arr::get($inputs, 'email'))->first();

        if (!$student) {
            return false;
        }
        $student = $this->repository->resetPassword($inputs, $student);

        if ($student) {
            return $student;

        } else {
            return False;
        }
    }

    function getStudentByEmail($email)
    {
        $student = Student::where('email', $email)->first();

        if ($student) {
            return $student;

        } else {
            return null;
        }
    }

}
