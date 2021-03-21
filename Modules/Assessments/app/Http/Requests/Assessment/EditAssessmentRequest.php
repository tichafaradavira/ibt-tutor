<?php

namespace Modules\Assessments\Http\Requests\Assessment;

use Illuminate\Foundation\Http\FormRequest;

class EditAssessmentRequest extends FormRequest
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
            'label' => 'required|max:100',
            'description' => 'required',
            'topics' => '',
        ];


        return $rules;
    }

    public function messages()
    {
        return [
            'label.required' => 'The assessment label is required',
            'label.max' => 'The  label cannot be more than 100 characters.',
            'description.required' => 'The assessment description is required',
        ];
    }
}
