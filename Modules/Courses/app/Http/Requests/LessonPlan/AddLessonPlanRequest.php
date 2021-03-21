<?php

namespace Modules\Courses\Http\Requests\LessonPlan;

use Illuminate\Foundation\Http\FormRequest;

class  AddLessonPlanRequest extends FormRequest
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
            'lesson_at' => 'required:',
            'objectives' => 'required',
            'study_material' => '',
            'learning_aids' => '',
            'activities' => '',
            'lesson_outcomes' => '',

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
