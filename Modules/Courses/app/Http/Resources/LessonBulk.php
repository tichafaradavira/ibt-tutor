<?php

namespace Modules\Courses\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonBulk extends JsonResource
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
            'objectives' => $this->objectives,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
