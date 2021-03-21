<?php

namespace Modules\Files\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Courses\Repositories\CourseRepository;
use Modules\Files\Http\Controllers\Traits\Fileable;
use Modules\Files\Http\Requests\File\AddFileRequest;
use Modules\Files\Http\Requests\File\DeleteFileRequest;
use Modules\Files\Http\Requests\File\EditFileRequest;
use Modules\Files\Http\Requests\File\ReadFileRequest;
use Modules\Files\Http\Resources\File\File;
use Modules\Files\Services\FileService;


class FilesController extends Controller
{
    use Fileable;

    protected $course_repository;

    function __construct(CourseRepository $course_repository)
    {
        $this->course_repository = $course_repository;
    }

    function add(AddFileRequest $request, FileService $service, $course)
    {
        $course = $this->course_repository->getCourse($course);

        if(!$course){
            return response('Course not found!', 422);
        }

        $file_group = $request->input('file_group');

        $meta = $this->getFileMeta($request );
        $path = $request->file('file')->store($this->getDirectory($file_group));

        if ($path) {
            $meta['name'] = basename($path);
            $meta['file_path'] = $path;
        } else {
            return response('Cannot upload file', 422);
        }

        $file = $service->add($meta);
        if ($file) {
            return response(new File($file), 200);
        } else {
            return response('Cannot upload file', 422);
        }
    }

    function edit(EditFileRequest $request, FileService $service, $course, $entity)
    {
        $course = $this->course_repository->getCourse($course);

        if(!$course){
            return response('Course not found!', 422);
        }

        $meta = $this->getFileMeta($request);
        $path = $request->file('file')->store('questions');

        if ($path) {
            $meta['name'] = basename($path);
            $meta['file_path'] = $path;
        } else {
            return response('Cannot upload file', 422);

        }
        $result = $service->edit($meta, $entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('File not edited', 422);
        }
    }


    function read(ReadFileRequest $request, FileService $service, $course, $entity)
    {
        $course = $this->course_repository->getCourse($course);

        if(!$course){
            return response('Course not found!', 422);
        }

        $file = $service->read($entity);
        if ($file) {
            return response(new File($file), 200);
        } else {
            return response('Cannot read file', 422);
        }
    }

    function delete(DeleteFileRequest $request, FileService $service, $course, $entity)
    {
        $course = $this->course_repository->getCourse($course);

        if(!$course){
            return response('Course not found!', 422);
        }

        $file = $service->delete($entity);
        if ($file) {
            return response(new File($file), 200);
        } else {
            return response('Cannot delete file', 422);
        }
    }

}
