<?php

namespace Modules\Assessments\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Courses\Http\Resources\Course;

class StudentAssessment extends JsonResource
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
            'label' => $this->label,
            'description' => $this->description,
            'topics' => $this->topics,
            'course' => new Course($this->course),
//            'fill_in_questions' => $this->fill_in_questions,
            'mcsa_questions' => McsaQuestion::collection($this->mcsa_questions),
            'mcma_questions' => McmaQuestion::collection($this->mcma_questions) ,
//            'free_response_questions' => $this->free_response_questions,
            'created_at' => $this->created_at->format('Y-m-d h:i:s '),
            'updated_at' => $this->updated_at->format('Y-m-d h:i:s '),
        ];
    }

}
