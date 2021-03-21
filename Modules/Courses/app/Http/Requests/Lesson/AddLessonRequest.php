<?php

namespace Modules\Courses\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class AddLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
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

    public function messages()
    {
        return [
            'topic.required' => 'The topic name is required',
            'topic.max' => 'The  topic cannot be more than 100 characters.',
            'content.required' => 'The content is required',
        ];
    }
}
