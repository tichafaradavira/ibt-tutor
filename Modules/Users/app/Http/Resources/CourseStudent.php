<?php

namespace Modules\Users\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Modules\Courses\Models\Course;

class CourseStudent extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'language' => $this->language,
            'courses' => $this->courses($this->id),
            'phone_number' => $this->phone_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'email_verified_at' => $this->email_verified_at,
            'activated_at' => $this->email_verified_at,
        ];
    }


    public function courses($id)
    {
        $courses = Course::query()
            ->join('student_courses', 'courses.id', '=', 'student_courses.course_id')
            ->where('student_courses.student_id', $id)
            ->where('courses.tutor_id', auth()->guard('api')->user()->id)
            ->select('courses.*')
            ->get()
            ->toArray();

        return $courses;
    }

}
