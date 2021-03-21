<?php

namespace Modules\Users\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class  CourseStudentCollection extends ResourceCollection
{
    private $pagination;

    public $collects = CourseStudent::class;

    public function __construct($resource)
    {
        $this->pagination = [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'total_pages' => $resource->lastPage()
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'pagination' => $this->pagination
        ];
    }
}
