<?php

namespace Modules\Courses\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class EditCourseRequest extends FormRequest
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
            'name' => 'required|max:100',
            'summary' => 'required|max:200',
            'description' => 'required',
            'field_of_study' => '',
            'age_range' => '',
        ];


        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The course name is required',
            'name.max' => 'The  name cannot be more than 100 characters.',
            'summary.required' => 'The course summary is required',
            'summary.max' => 'The summary cannot be more than 200 characters.',
            'description.required' => 'The course description is required',
            'email.email' => 'The email address should be a valid email',
        ];
    }
}
