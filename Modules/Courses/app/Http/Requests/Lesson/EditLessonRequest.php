<?php

namespace Modules\Courses\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class EditLessonRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules()
    {
        $rules = [
            'topic' => 'required|max:100',
            'content' => 'required',
            'objectives' => '',

        ];

        return $rules;
    }

    /**
     * @return array|string[]
     */

    public function messages()
    {
        return [
            'topic.required' => 'The topic name is required',
            'topic.max' => 'The  topic cannot be more than 100 characters.',
            'content.required' => 'The content is required',
        ];
    }
}
