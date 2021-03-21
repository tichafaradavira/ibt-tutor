<?php

namespace Modules\Users\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Progress extends JsonResource
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
            'topic' => $this->topic,
            'completed_at' => $this->completed_at,
        ];
    }


}
