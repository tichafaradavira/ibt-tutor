<?php

namespace Modules\Files\Http\Resources\File;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class File extends JsonResource
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
            'original_name' => $this->original_name,
            'name' => $this->name,
            'size' => $this->size,
            'file_url' => url(Storage::url($this->file_path)),
//            'reference_type' => $this->reference_type,
//            'reference_id' =>  $this->reference_id,
            'extension' => $this->extension,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
