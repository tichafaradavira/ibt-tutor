<?php

namespace Modules\Communications\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Communications\Http\Requests\StudentMessages\AddStudentMessageRequest;
use Modules\Communications\Http\Requests\StudentMessages\DeleteStudentMessageRequest;
use Modules\Communications\Http\Requests\StudentMessages\ReadStudentMessageRequest;
use Modules\Communications\Http\Resources\StudentMessage;
use Modules\Communications\Http\Resources\StudentMessageCollection;
use Modules\Communications\Services\StudentMessageService;


class StudentMessagesController extends Controller
{
    function browse(Request $request, StudentMessageService $service)
    {
        $inputs = $request->all();

        $messages = $service->browse($inputs);
        return response(new StudentMessageCollection($messages), 200);

    }


    function send(AddStudentMessageRequest $request, StudentMessageService $service)
    {
        $inputs = $request->all();

        $message = $service->send($inputs);
        if ($message) {
            return response( $message, 200);
        } else {
            return response('Message not sent', 422);
        }
    }



    function read(ReadStudentMessageRequest $request, StudentMessageService $service, $entity)
    {
        $message = $service->read($entity);
        if ($message) {
            return response(new StudentMessage($message), 200);
        } else {
            return response('Cannot read communication', 422);
        }
    }

    function delete(DeleteStudentMessageRequest $request, StudentMessageService $service)
    {
        $inputs = $request->all();

        $result = $service->delete($inputs);
        if ($result) {
            return response($result, 200);
        } else {
            return response('Cannot delete messages', 422);
        }
    }


}
