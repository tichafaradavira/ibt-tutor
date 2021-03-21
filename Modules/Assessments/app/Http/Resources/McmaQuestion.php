<?php

namespace Modules\Assessments\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Courses\Http\Resources\Course;

class McmaQuestion extends JsonResource
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
            'E' => $this->E,
            'F' => $this->F,
            'correct_answers' => $this->correct_answers,
            'points' => $this->points,
            'comment' => $this->comment,
            'created_at' => $this->created_at->format('Y-m-d h:i:s '),
            'updated_at' => $this->updated_at->format('Y-m-d h:i:s '),
        ];
    }

}
