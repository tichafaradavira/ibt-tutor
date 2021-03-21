<?php

namespace Modules\Courses\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class EditLessonPlanRequest extends FormRequest
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
            'lesson_at' => 'required:',
            'objectives' => 'required',
            'study_material' => '',
            'learning_aids' => '',
            'activities' => '',
            'learning_outcome' => '',

        ];


        return $rules;
    }

    public function messages()
    {
        return [
            'topic.required' => 'The topic name is required',
            'topic.max' => 'The  topic cannot be more than 100 characters.',
            'objectives.required' => 'A lesson should have objectives.',
        ];
    }
}
