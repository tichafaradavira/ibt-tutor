<?php

namespace Modules\Communications\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentMessage extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public $preserveKeys = true;

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'subject' => $this->subject,
            'message' => $this->message,
            'sender' => $this->sender,
            'reicevers' => $this->whenLoaded('reicevers'),
            'read_at' => $this->read_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
