<?php

namespace Modules\Assessments\Http\Requests\Assessment;

use Illuminate\Foundation\Http\FormRequest;

class SaveAssessmentRequest extends FormRequest
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
        ];

        //TODO ADD VALIDATION FOR QUESTION INPUT


        return $rules;
    }

    public function messages()
    {
        return [
        ];
    }
}
