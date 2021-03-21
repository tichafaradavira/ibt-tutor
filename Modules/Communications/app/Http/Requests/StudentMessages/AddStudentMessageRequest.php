<?php

namespace Modules\Communications\Http\Requests\StudentMessages;

use Illuminate\Foundation\Http\FormRequest;

class AddStudentMessageRequest extends FormRequest
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
            'message' => 'required',
            'students' => 'required'
        ];


        return $rules;
    }

    public function messages()
    {
        return [
            'message.required' => 'The message name is required',
            'students.required' => 'The student is required',
        ];
    }
}
