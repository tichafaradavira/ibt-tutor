<?php

namespace Modules\Files\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Modules\Courses\Models\Course;
use Modules\Files\Models\File;

class FileRepository
{
    protected $user;

    function __construct()
    {
        $this->user = auth()->guard('api')->user();

    }


    function add($data)
    {
        $file = new File($data);
        $file->tutor()->associate($this->user);

        if ($file->save()) {
            return $file;
        } else {
            return false;
        }


    }

    function edit($data, $file_id)
    {
        $saved = File::where('id', $file_id)
            ->update($data);

        if ($saved) {
            return true;
        } else {
            return false;
        }

    }

    function read($id)
    {
        $file = File::query()
            ->where('id', $id)
            ->first();

        if ($file) {
            return $file;
        } else {
            return false;
        }

    }

    function delete($file_id)
    {
        $file = $this->getFile($file_id);
        $this->purgeFile($file);

        if ($file) {
            $file->delete();
            return $file;
        } else {
            return false;
        }

    }

    function purgeFile($file)
    {
        if (is_object($file))
            $result = Storage::delete($file->file_path);
        else {
            $file = $this->getFile($file);
            $result = Storage::delete($file->file_path);

        }
        return $result;
    }

    function getFile($id)
    {
        $file = File::query()->where('id', $id)->first();
        return $file;

    }

}
