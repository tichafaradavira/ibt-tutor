<?php

namespace Modules\Communications\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Communications\Http\Requests\StudentMessages\ReadStudentReiceveMessageRequest;
use Modules\Communications\Http\Requests\TutorMessages\AddTutorMessageRequest;
use Modules\Communications\Http\Requests\TutorMessages\DeleteTutorMessageRequest;
use Modules\Communications\Http\Requests\TutorMessages\DeleteTutorReiceveMessageRequest;
use Modules\Communications\Http\Requests\TutorMessages\ReadTutorMessageRequest;
use Modules\Communications\Http\Resources\TutorMessage;
use Modules\Communications\Http\Resources\TutorMessageCollection;
use Modules\Communications\Services\TutorMessageService;
use Modules\Communications\Services\TutorReiceveMessageService;


class TutorReiceveMessagesController extends Controller
{

    function browse(Request $request, TutorReiceveMessageService $service)
    {
        $inputs = $request->all();

        $messages = $service->browse($inputs);
        return response(new TutorMessageCollection($messages), 200);

    }

    function read(ReadStudentReiceveMessageRequest $request, TutorReiceveMessageService $service, $entity)
    {
        $message = $service->read($entity);
        if ($message) {
            return response(new TutorMessage($message), 200);
        } else {
            return response('Cannot read communication', 422);
        }
    }

    function delete(DeleteTutorReiceveMessageRequest $request, TutorReiceveMessageService $service)
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
