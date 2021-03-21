<?php

namespace Modules\Assessments\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Assessments\Models\AssessmentResponse as AssResponse;
class AssessmentResponse extends JsonResource
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
            'student_response' => $this->student_response,
            'assessment_result' => $this->assessment_result,
            'assessment' => $this->assessment,
            'saved_at' => $this->saved_at,
            'submitted_at' => $this->submitted_at->format('Y-m-d h:i:s'),
            'assessed_at' => $this->assessed_at ? $this->assessed_at->format('Y-m-d h:i:s') : null ,
            'created_at' => $this->created_at->format('Y-m-d h:i:s '),
            'updated_at' => $this->updated_at->format('Y-m-d h:i:s '),
        ];
    }

}
