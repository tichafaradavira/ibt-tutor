<?php

namespace Modules\Communications\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Communications\Http\Requests\TutorMessages\AddTutorMessageRequest;
use Modules\Communications\Http\Requests\TutorMessages\DeleteTutorMessageRequest;
use Modules\Communications\Http\Requests\TutorMessages\ReadTutorMessageRequest;
use Modules\Communications\Http\Resources\TutorMessage;
use Modules\Communications\Http\Resources\TutorMessageCollection;
use Modules\Communications\Services\TutorMessageService;


class TutorMessagesController extends Controller
{

    function browse(Request $request, TutorMessageService $service)
    {
        $inputs = $request->all();

        $messages = $service->browse($inputs);
        return response(new TutorMessageCollection($messages), 200);

    }


    function send(AddTutorMessageRequest $request, TutorMessageService $service)
    {
        $inputs = $request->all();

        $message = $service->send($inputs);
        if ($message) {
            return response( $message, 200);
        } else {
            return response('Message not sent', 422);
        }
    }



    function read(ReadTutorMessageRequest $request, TutorMessageService $service, $entity)
    {
        $message = $service->read($entity);
        if ($message) {
            return response(new TutorMessage($message), 200);
        } else {
            return response('Cannot read communication', 422);
        }
    }

    function delete(DeleteTutorMessageRequest $request, TutorMessageService $service)
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
