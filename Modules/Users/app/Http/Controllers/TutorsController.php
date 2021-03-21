<?php

namespace Modules\Users\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Users\Http\Requests\Tutor\AddTutorRequest;
use Modules\Users\Http\Requests\Tutor\DeleteTutorRequest;
use Modules\Users\Http\Requests\Tutor\EditTutorRequest;
use Modules\Users\Http\Requests\Tutor\ReadTutorRequest;
use Modules\Users\Http\Requests\Tutor\SuspendTutorRequest;
use Modules\Users\Http\Resources\User;
use Modules\Users\Http\Resources\UserCollection;
use Modules\Users\Services\TutorService;

class TutorsController extends Controller
{
    protected $admin;

    function __construct()
    {
        $this->admin =auth()->guard('api')->user();
    }

    function browse(Request $request, TutorService $service)
    {

        $inputs = $request->all();

        $tutors = $service->browse($inputs);
        return response(new UserCollection($tutors), 200);

    }

    function add(AddTutorRequest $request, TutorService $service)
    {
        $inputs = $request->all();

        $tutor = $service->add($inputs);
        if ($tutor) {
            return response(new User($tutor), 200);
        } else {
            return response('Tutor not added', 422);
        }
    }

    function edit(EditTutorRequest $request, TutorService $service, $entity)
    {
        $inputs = $request->all();

        $result = $service->edit($inputs, $entity);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Tutor not edit', 422);
        }
    }


    function read(ReadTutorRequest $request, TutorService $service, $entity)
    {
        $tutor = $service->read($entity);
        if ($tutor) {
            return response(new User($tutor), 200);
        } else {
            return response('Cannot read Tutor', 422);
        }
    }

    function delete(DeleteTutorRequest $request, TutorService $service, $entity)
    {
        $tutor = $service->delete($entity);
        if ($tutor) {
            return response(new User($tutor), 200);
        } else {
            return response('Cannot delete Tutor', 422);
        }
    }

    function suspend(SuspendTutorRequest $request, TutorService $service, $entity)
    {
        $inputs = $request->all();

        $tutor = $service->suspend($inputs, $entity);
        if ($tutor) {
            return response(new User($tutor), 200);
        } else {
            return response('Cannot delete Tutor', 422);
        }
    }

    function activate(SuspendTutorRequest $request, TutorService $service, $entity)
    {
        $tutor = $service->activate($entity);
        if ($tutor) {
            return response(new User($tutor), 200);
        } else {
            return response('Cannot delete Tutor', 422);
        }
    }

}
