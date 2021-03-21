<?php

namespace Modules\Courses\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class ReadLessonPlanRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
