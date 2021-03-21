<?php

namespace Modules\Files\Services;


use Modules\Files\Repositories\FileRepository;
use Modules\Users\Models\File;

class FileService
{
    protected $repository;
    protected $user;

    function __construct(FileRepository $repository)
    {
        $this->repository = $repository;
        $this->user = auth()->guard('api')->user();
    }



    function add($inputs)
    {
        $file = $this->repository->add($inputs);

        if ($file) {
            return $file;
        } else {
            return false;
        }
    }


    function edit($inputs, $id)
    {
        $result = $this->repository->purgeFile($id);
        $file = $this->repository->edit($inputs, $id);

        if ($file) {
            return true;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $file = $this->repository->read($id);
            return $file;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        $file = $this->repository->delete($id);

        if ($file) {
            return $file;
        } else {
            return false;
        }
    }



}
