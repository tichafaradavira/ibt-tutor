<?php

namespace Modules\Assessments\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentBrowse extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
