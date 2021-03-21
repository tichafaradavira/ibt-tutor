<?php

namespace Modules\Courses\Http\Requests\Tuition;

use Illuminate\Foundation\Http\FormRequest;

class CompleteLessonRequest extends FormRequest
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
