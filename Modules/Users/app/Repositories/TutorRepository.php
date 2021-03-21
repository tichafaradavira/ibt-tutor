<?php

namespace Modules\Users\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Users\Emails\ActivateAccountEmail;
use Modules\Users\Emails\AddTutorVerifyUserEmail;
use Modules\Users\Emails\SuspendAccountEmail;
use Modules\Users\Models\User;

class TutorRepository
{
    public static function browse($browse_inputs)
    {
        $query = User::query();

        $tutors = $query->paginate(15);

        return $tutors;
    }


    function add($data)
    {
        $temporary_password = Str::random(8);
        $data['password'] = Hash::make($temporary_password);
        $data['dob'] = Carbon::now();
        $data['user_type'] = 'tutor';


        $tutor = User::create($data);


        if ($tutor->save()) {
            Mail::to($tutor->email)
                ->send(new AddTutorVerifyUserEmail($tutor, $temporary_password));

            return $tutor;
        } else {
            return false;
        }


    }

    function edit($data, $tutor)
    {
        $data['dob'] = Carbon::parse($data['dob']);
        $saved = User::where('id', $tutor->id)
            ->update($data);
        if ($saved) {
            return $tutor;
        } else {
            return false;
        }
    }

    function read($id)
    {
        $tutor = User::query()
            ->where('id', $id)
            ->first();

        if ($tutor) {
            return $tutor;
        }
    }

    function suspend($data, $tutor)
    {
        $tutor->suspended_at = Carbon::now();

        if ($tutor->save()) {

            if ($message = Arr::get($data, 'message')) {
                Mail::to($tutor->email)
                    ->send(new SuspendAccountEmail($tutor, $message));
            }

            return $tutor;
        } else {
            return false;
        }
    }

    /**
     * @param $tutor
     * @return false
     */
    function activate($tutor)
    {
        $tutor->suspended_at = null;

        if ($tutor->save()) {
            Mail::to($tutor->email)
                ->send(new ActivateAccountEmail($tutor));


            return $tutor;
        } else {
            return false;
        }
    }


}
