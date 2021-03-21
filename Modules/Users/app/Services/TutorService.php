<?php

namespace Modules\Users\Services;

use Modules\Users\Models\User;
use Modules\Users\Repositories\TutorRepository;
use Modules\Users\Repositories\UserRepository;

class TutorService
{
    protected $repository;

    function __construct(TutorRepository $repository)
    {
        $this->repository = $repository;
    }

    function browse($inputs)
    {
        $tutors = $this->repository->browse($inputs);

        return $tutors;
    }

    function add($inputs)
    {
        $tutor = $this->repository->add($inputs);

        if ($tutor) {
            return $tutor;
        } else {
            return false;
        }


    }


    function edit($inputs, $id)
    {
        $tutor = User::find($id);

        if ($tutor) {
            $tutor = $this->repository->edit($inputs, $tutor);
            return true;
        } else {
            return false;
        }


    }

    function read($id)
    {
        if ($id) {
            $tutor = $this->repository->read($id);
            return $tutor;
        } else {
            return false;
        }


    }


    function delete($id)
    {
        if ($id) {
            $tutor = $this->repository->delete($id);
            return $tutor;
        } else {
            return false;
        }
    }

    function suspend($inputs, $id)
    {
        $tutor = User::query()->where('id', $id)
            ->where('is_admin', false)
            ->first();

        if ($tutor) {
            $tutor = $this->repository->suspend($inputs, $tutor);
            return $tutor;
        } else {
            return false;
        }
    }


    function activate($id)
    {
        $tutor = User::query()->where('id', $id)
            ->where('is_admin', false)
            ->first();

        if ($tutor) {
            $tutor = $this->repository->activate($tutor);
            return $tutor;
        } else {
            return false;
        }
    }

}
