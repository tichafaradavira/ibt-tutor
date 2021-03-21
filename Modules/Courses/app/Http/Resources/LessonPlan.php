<?php

namespace Modules\Courses\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonPlan extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public $preserveKeys = true;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'topic' => $this->topic,
            'objectives' =>  $this->objectives,
            'study_material' =>  $this->study_material,
            'learning_aids' =>  $this->learning_aids,
            'activities' => $this->activities,
            'lesson_outcomes' => $this->lesson_outcomes,
            'course' => new Course($this->course),
            'lesson_at' => $this->created_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
