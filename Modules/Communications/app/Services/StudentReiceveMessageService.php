<?php

namespace Modules\Communications\Services;


use Modules\Communications\Repositories\StudentMessageRepository;
use Modules\Communications\Repositories\StudentReiceveMessageRepository;

class StudentReiceveMessageService
{
    protected $repository;
    protected $user;

    function __construct(StudentReiceveMessageRepository $repository)
    {
        $this->repository = $repository;
        $this->user = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $message = $this->repository->browse($inputs);

        return $message;
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
