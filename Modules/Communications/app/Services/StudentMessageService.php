<?php

namespace Modules\Communications\Services;


use Modules\Communications\Repositories\StudentMessageRepository;

class StudentMessageService
{
    protected $repository;
    protected $user;

    function __construct(StudentMessageRepository $repository)
    {
        $this->repository = $repository;
        $this->user = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $message = $this->repository->browse($inputs);

        return $message;
    }


    function studentBrowse($inputs)
    {
        $message = $this->repository->studentBrowse($inputs);

        return $message;
    }


    function send($inputs)
    {
        $message = $this->repository->add($inputs);

        if ($message) {
            return $message;
        } else {
            return false;
        }
    }


    function read($id)
    {
        if ($id) {
            $message = $this->repository->read($id);
            return $message;
        } else {
            return false;
        }
    }


    function delete($data)
    {
        $message = $this->repository->delete($data);

        if ($message) {
            return $message;
        } else {
            return false;
        }
    }


}
