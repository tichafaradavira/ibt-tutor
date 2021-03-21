<?php

namespace Modules\Courses\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Course extends JsonResource
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
            'name' => $this->name,
            'summary' => $this->summary,
            'description' => $this->description,
            'field_of_study' =>  $this->field_of_study,
            'tutor' => $this->whenLoaded('tutor'),
            'students' => $this->whenLoaded('students'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
