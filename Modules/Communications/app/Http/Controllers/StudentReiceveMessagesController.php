<?php

namespace Modules\Communications\Http\Controllers;

use Ibt\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Communications\Http\Requests\StudentMessages\AddStudentMessageRequest;
use Modules\Communications\Http\Requests\StudentMessages\DeleteStudentMessageRequest;
use Modules\Communications\Http\Requests\StudentMessages\DeleteStudentReiceveMessageRequest;
use Modules\Communications\Http\Requests\StudentMessages\ReadStudentMessageRequest;
use Modules\Communications\Http\Requests\StudentMessages\ReadStudentReiceveMessageRequest;
use Modules\Communications\Http\Resources\StudentMessage;
use Modules\Communications\Http\Resources\StudentMessageCollection;
use Modules\Communications\Services\StudentMessageService;
use Modules\Communications\Services\StudentReiceveMessageService;


class StudentReiceveMessagesController extends Controller
{

    function browse(Request $request, StudentReiceveMessageService $service)
    {
        $inputs = $request->all();

        $messages = $service->browse($inputs);
        return response( StudentMessage::collection($messages), 200);

    }

    function read(ReadStudentReiceveMessageRequest $request, StudentReiceveMessageService $service, $entity)
    {
        $message = $service->read($entity);
        if ($message) {
            return response(new StudentMessage($message), 200);
        } else {
            return response('Cannot read communication', 422);
        }
    }

    function delete(DeleteStudentReiceveMessageRequest $request, StudentReiceveMessageService $service)
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
