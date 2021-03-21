<?php

namespace Modules\Assessments\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Courses\Http\Resources\Course;

class McsaQuestion extends JsonResource
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
            'question' => $this->question,
            'A' => $this->A,
            'B' => $this->B,
            'C' => $this->C,
            'D' => $this->D,
            'correct_answer' => $this->correct_answer,
            'points' => $this->points,
            'comment' => $this->comment,
            'created_at' => $this->created_at->format('Y-m-d h:i:s '),
            'updated_at' => $this->updated_at->format('Y-m-d h:i:s '),
        ];
    }

}
