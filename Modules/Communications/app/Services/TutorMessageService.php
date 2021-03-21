<?php

namespace Modules\Communications\Services;


use Modules\Communications\Repositories\StudentMessageRepository;
use Modules\Communications\Repositories\TutorMessageRepository;

class TutorMessageService
{
    protected $repository;
    protected $user;

    function __construct(TutorMessageRepository $repository)
    {
        $this->repository = $repository;
        $this->user = auth()->guard('api-students')->user();
    }

    function browse($inputs)
    {
        $message = $this->repository->browse($inputs);

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
